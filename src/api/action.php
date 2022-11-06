<?php
session_start();
include('../functions.php');

// クエリがセットされていない場合は弾く
if(!isset($_GET['q']) && !isset($_POST['q'])) {
  http_response_code(400);
  exit();
}

$pdo = connect_to_db();

// 受け入れることの出来るソートカラム一覧
$acceptable_sort_list = ['like_count' => 'DESC', 'distance' => 'ASC', 'duration' => 'ASC'];

// 投稿IDからいいねの状態を取得
function get_is_liked($post_id, $user_id) {
  global $pdo;
  // いいね状態を取得
  // ユーザーIDが-1ならfalseを返す
  if ($user_id == -1) {
    $liked = [
      'liked' => false
    ];
  } else {
    $sql = "SELECT COUNT(*) AS liked FROM likes WHERE post_id = :post_id AND user_id = :user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':post_id', $post_id, PDO::PARAM_INT);
    $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    $status = $stmt->execute();
    db_error_check($status, $stmt);
    $liked = $stmt->fetch(PDO::FETCH_ASSOC);
  }

  return $liked['liked'] > 0;
}

function get_googlemap_url($data) {
  $API_URL = 'https://www.google.com/maps/dir/';
  $params = [];
  $params['api'] = 1;
  $params['origin'] = $data['departure_location'];
  $params['destination'] = $data['destination_location'];
  $params['travelmode'] = 'walking';
  $params['waypoints'] = implode('|', json_decode($data['waypoints'], true));

  return $API_URL . '?' . http_build_query($params);
}

// エラーを返す
function error($message) {
  echo json_encode([
    'error' => $message
  ]);
  exit();
}

// ログイン検証
function validate_login() {
  // ログインしていない場合は弾く
  if(!is_loggedin()) {
    http_response_code(401);
    error('ログインしてください');
    exit();
  }
}

// セッションからユーザーIDを取得
function get_user_id() {
  return is_loggedin() ? $_SESSION['user_id'] : -1;
}

// POSTリクエスト
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  switch($_POST['q']) {
    // 投稿へのいいね
    case 'likePost': {
      validate_login();

      if (!isset($_POST['post_id'])) {
        http_response_code(400);
        exit();
      }

      $post_id = $_POST['post_id'];
      $user_id = $_SESSION['user_id'];

      // いいね済みかどうか
      $sql = 'SELECT * FROM likes WHERE post_id = :post_id AND user_id = :user_id';
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(':post_id', $post_id, PDO::PARAM_INT);
      $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      
      // 既にいいねしていた場合は終了
      if ($result) {
        exit();
      }

      // いいね処理
      $sql = "INSERT INTO likes (post_id, user_id, created_at) VALUES (:post_id, :user_id, now())";
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(':post_id', $post_id, PDO::PARAM_INT);
      $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
      $stmt->execute();

      echo json_encode([
        'success' => true
      ]);

      exit();
    }

    // 投稿へのいいねの取り消し
    case 'unlikePost': {
      validate_login();

      if (!isset($_POST['post_id'])) {
        http_response_code(400);
        exit();
      }

      $post_id = $_POST['post_id'];
      $user_id = $_SESSION['user_id'];
      $sql = "DELETE FROM likes WHERE post_id = :post_id AND user_id = :user_id";
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(':post_id', $post_id, PDO::PARAM_INT);
      $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
      $stmt->execute();

      echo json_encode([
        'success' => true
      ]);

      exit();
    }

    // ルート投稿
    case 'postRoute': {
      validate_login();

      if (!queryCheck(['id', 'departure', 'destination', 'departure_location', 'destination_location', 'waypoints'])) return error('必要な情報が欠けているようです。再度お試しください。');

      $id = (int)$_POST['id'];
      $name = $_POST['departure'] . ' から ' . $_POST['destination'] . ' まで';
      $description = isset($_POST['description']) ? $_POST['description'] : '';

      $GOOGLE_MAP_DIRECTION_API = 'https://maps.googleapis.com/maps/api/directions/json';

      // APIパラメーター
      $direction_api_params = [];
      $direction_api_params['mode'] = 'walking';
      $direction_api_params['language'] = 'ja';
      $direction_api_params['origin'] = $_POST['departure_location'];
      $direction_api_params['destination'] = $_POST['destination_location'];
      $direction_api_params['waypoints'] = implode('|', json_decode($_POST['waypoints']));
      $direction_api_params['key'] = get_env('api-key')['google-api-server'];

      $direction_api_query = http_build_query($direction_api_params);

      // APIリクエスト
      $response = file_get_contents($GOOGLE_MAP_DIRECTION_API . '?' . $direction_api_query);
      $direction_result = json_decode($response, true);

      // エラーがあった場合はエラーを返す
      if ($direction_result['status'] !== 'OK') error('指定されたルートをサーバー側で正しく処理できませんでした。時間をおいて再度お試しください。');

      // 新規投稿か編集かで処理を分ける
      if($id === -1) {
        // 新規投稿
        $sql = 'INSERT INTO posts (id, name, departure, destination, departure_location, destination_location, waypoints, distance, duration, polyline, description, created_at, updated_at, user_id) VALUES (null, :name, :departure, :destination, :departure_location, :destination_location, :waypoints, :distance, :duration, :polyline, :description, now(), now(), :user_id)';
      } else {
        // 編集

        // 投稿者と編集しようとしている人が同一か (または管理者か) 判別
        $sql = 'SELECT * FROM posts WHERE id=:id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $status = $stmt->execute();

        // エラーチェック
        db_error_check($status, $stmt);

        $record = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($record['user_id'] !== $_SESSION['user_id'] && !is_admin()) {
          return error('投稿者以外は編集できません。');
        }

        $sql = 'UPDATE posts SET name=:name, departure=:departure, destination=:destination, departure_location=:departure_location, destination_location=:destination_location, waypoints=:waypoints, distance=:distance, duration=:duration, polyline=:polyline, description=:description, updated_at=now() WHERE id=:id';
      }

      $distanceNum = 0;
      $durationNum = 0;

      foreach ($direction_result['routes'][0]['legs'] as $leg) {
        $distanceNum += $leg['distance']['value'];
        $durationNum += $leg['duration']['value'];
      }

      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(':name', $name, PDO::PARAM_STR);
      $stmt->bindValue(':departure', $_POST['departure'], PDO::PARAM_STR);
      $stmt->bindValue(':destination', $_POST['destination'], PDO::PARAM_STR);
      $stmt->bindValue(':departure_location', $_POST['departure_location'], PDO::PARAM_STR);
      $stmt->bindValue(':destination_location', $_POST['destination_location'], PDO::PARAM_STR);
      $stmt->bindValue(':waypoints', $_POST['waypoints'], PDO::PARAM_STR);
      $stmt->bindValue(':distance', $distanceNum, PDO::PARAM_INT);
      $stmt->bindValue(':duration', $durationNum, PDO::PARAM_INT);
      $stmt->bindValue(':polyline', $direction_result['routes'][0]['overview_polyline']['points'], PDO::PARAM_STR);
      $stmt->bindValue(':description', $description, PDO::PARAM_STR);

      // 新規投稿の場合はuser_idをバインド
      if($id === -1) {
        $stmt->bindValue(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
      }

      // 編集の場合はIDをバインド
      if($id !== -1) {
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
      }

      $status = $stmt->execute();

      // エラーチェック
      db_error_check($status, $stmt);

      echo json_encode([
        'success' => true
      ]);
      exit();
    }


    // 無効なリクエスト
    default: {
      error('Invalid request');
    }
  }
}

// GETリクエスト
if($_SERVER['REQUEST_METHOD'] === 'GET') {
  switch($_GET['q']) {
    // 投稿一覧を取得
    // - pageクエリでオフセットを設定可能 (10件ずつ)
    // - searchクエリで投稿を検索可能
    case 'getPosts': {
      $keyword_dep = isset($_GET['departure']) ? $_GET['departure'] : '';
      $keyword_des = isset($_GET['destination']) ? $_GET['destination'] : '';
      $sort_query = isset($_GET['sort']) ? $_GET['sort'] : '';

      // ソート出来るかどうかを判別
      $can_sort = array_key_exists($sort_query, $acceptable_sort_list);
      $sort_column = $can_sort ? $sort_query : 'created_at';
      $sort_order = $can_sort ? $acceptable_sort_list[$sort_query] : 'DESC';

      // likesテーブルからいいね数を取得し、そのデータを投稿データに結合
      // 任意のカラムで並び替え、オフセットを設定して投稿を取得
      $sql = 'SELECT posts.*, COUNT(likes.post_id) AS like_count FROM posts LEFT JOIN likes ON posts.id = likes.post_id WHERE posts.departure LIKE :keyword_dep AND posts.destination LIKE :keyword_des GROUP BY posts.id ORDER BY ' . $sort_column . ' ' . $sort_order . ' LIMIT 10 OFFSET :offset';
      $stmt = $pdo->prepare($sql);
      $offset = isset($_GET['page']) ? (max((int)$_GET['page'], 1) - 1) * 10 : 0;
      $stmt->bindValue(':keyword_dep', "%{$keyword_dep}%", PDO::PARAM_STR);
      $stmt->bindValue(':keyword_des', "%{$keyword_des}%", PDO::PARAM_STR);
      $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

      foreach($result as &$post) {
        // 自分がいいねしているかを取得
        $post['is_liked'] = get_is_liked($post['id'], get_user_id());

        // この投稿を編集できるかどうか
        $post['can_edit'] = $post['user_id'] === get_user_id() || is_admin();

        // URLを追加
        $post['url'] = get_googlemap_url($post);
      }

      // 投稿の件数を取得
      $sql = "SELECT COUNT(*) AS count FROM posts WHERE departure LIKE :keyword_dep AND destination LIKE :keyword_des";
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(':keyword_dep', "%{$keyword_dep}%", PDO::PARAM_STR);
      $stmt->bindValue(':keyword_des', "%{$keyword_des}%", PDO::PARAM_STR);
      $stmt->execute();
      $count = $stmt->fetch(PDO::FETCH_ASSOC);

      // 投稿の件数と投稿を返す
      echo json_encode([
        'count' => $count['count'],
        'offset' => $offset,
        'posts' => $result
      ]);

      exit();
    }

    // 投稿を取得
    case 'getPost': {
      if (!isset($_GET['id'])) {
        http_response_code(400);
        exit();
      }

      $post_id = $_GET['id'];
      $user_id = get_user_id();

      // likesテーブルからいいね数を取得し、そのデータを投稿データに結合
      $sql = 'SELECT posts.*, COUNT(likes.post_id) AS like_count FROM posts LEFT JOIN likes ON posts.id = likes.post_id WHERE posts.id = :post_id GROUP BY posts.id';
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(':post_id', $post_id, PDO::PARAM_INT);
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_ASSOC);

      // 投稿が存在しなければエラーを返して終了
      if (!$result) return error('投稿が存在しません');

      // 自分がいいねしているかを取得
      $result['is_liked'] = get_is_liked($post_id, get_user_id());

      // この投稿を編集できるかどうか
      $result['can_edit'] = $result['user_id'] === $user_id || is_admin();

      // URLを追加
      $result['url'] = get_googlemap_url($result);

      echo json_encode($result);
      exit();
    }

    // オリジナルURLを取得
    case 'getOriginalUrl': {
      validate_login();

      if (!isset($_GET['url'])) {
        http_response_code(400);
        exit();
      }

      $url = $_GET['url'];

      // URLを取得
      $headers = get_headers($url, true);

      echo json_encode([
        'status' => $headers[0],
        'url' => $headers['Location']
      ]);
      
      exit();
    }

    // ログインしているかどうかを返す
    case 'isLoggedIn': {
      echo json_encode([
        'isLoggedIn' => isset($_SESSION['user_id'])
      ]);
      exit();
    }

    // 無効なリクエスト
    default: {
      error('Invalid request');
    }
  }
}