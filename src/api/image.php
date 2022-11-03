<?php
session_start();
include('../functions.php');

// IDがセットされていない場合は弾く
if(!isset($_GET['id'])) {
  http_response_code(400);
  exit();
}

$id = $_GET['id'];

$pdo = connect_to_db();

// 投稿を取得
$sql = "SELECT * FROM posts WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$post_result = $stmt->fetch(PDO::FETCH_ASSOC);

// 投稿が存在しない場合は弾く
if(!$post_result) {
  http_response_code(404);
  exit();
}

// 画像があるか確認
$sql = "SELECT * FROM images WHERE post_id = :post_id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':post_id', $id, PDO::PARAM_INT);
$stmt->execute();
$img_result = $stmt->fetch(PDO::FETCH_ASSOC);

// 画像がある場合は再生成する必要があるかチェックし、なければリダイレクト
if ($img_result) {
  $updated_at = new DateTime($img_result['updated_at']);
  $now = new DateTime();
  $diff = (int)$now->diff($updated_at)->format('%a');

  // 画像がレンダリングされた時のpolylineと現在のpolylineが同じで、画像の生成から1ヶ月が経っていない場合は再生成しない
  if ($img_result['poly_hash'] === md5($post_result['polyline']) && 30 > $diff) {
    // リダイレクト
    header('Location: /static/thumbnails/' . $img_result['poly_hash'] . '.png');
    exit();
  }
}

// 再生成
$GOOGLE_MAP_STATIC_API = 'https://maps.googleapis.com/maps/api/staticmap';

// パラメーター
$staticmap_api_params = [];
$staticmap_api_params['language'] = 'ja';
$staticmap_api_params['size'] = '640x360';
$staticmap_api_params['scale'] = '2';
$staticmap_api_params['markers'] = ['size:mid|color:blue|' . $post_result['departure_location'], 'size:mid|color:red|' . $post_result['destination_location']];
$staticmap_api_params['path'] = 'enc:' . $post_result['polyline'];
$staticmap_api_params['key'] = get_env('api-key')['google-api-server'];

$staticmap_api_query = preg_replace('/%5B\d+%5D=/i', '=', http_build_query($staticmap_api_params));

// APIリクエスト
$response = file_get_contents($GOOGLE_MAP_STATIC_API . '?' . $staticmap_api_query);
$image_hash = md5($post_result['polyline']);
file_put_contents('../static/thumbnails/' . $image_hash . '.png', $response);

// データベースに情報を保存

// 情報がなければ追加
if (!$image_result) {
  $sql = 'INSERT INTO images (id, post_id, poly_hash, updated_at) VALUES (NULL, :post_id, :poly_hash, now())';
} else {
  // 情報があれば更新
  $sql = 'UPDATE images SET poly_hash = :poly_hash, updated_at = now() WHERE post_id = :post_id';
}

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':post_id', $id, PDO::PARAM_INT);
$stmt->bindValue(':poly_hash', $image_hash, PDO::PARAM_STR);
$stmt->execute();

// リダイレクト
header('Location: /static/thumbnails/' . $image_hash . '.png');
exit();