<?php
session_start();
include('../functions.php');

// ログインしていない場合は弾く
if(!is_loggedin()) {
  http_response_code(401);
  exit();
}

// クエリがセットされていない場合は弾く
if(!isset($_GET['q']) && !isset($_POST['q'])) {
  http_response_code(400);
  exit();
}

$pdo = connect_to_db();

// POSTリクエスト
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  switch($_POST['q']) {
    // 投稿へのいいね
    case 'likePost': {
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
      exit();
    }

    // 投稿へのいいねの取り消し
    case 'unlikePost': {
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
      exit();
    }

    // 無効なリクエスト
    default: {
      http_response_code(400);
      exit();
    }
  }
}

// GETリクエスト
if($_SERVER['REQUEST_METHOD'] === 'GET') {
  switch($_GET['q']) {
    // 投稿のいいね数および自分がいいねしているかを取得
    case 'getPostLikes': {
      if (!isset($_GET['post_id'])) {
        http_response_code(400);
        exit();
      }

      $post_id = $_GET['post_id'];
      $sql = "SELECT user_id FROM likes WHERE post_id = :post_id";
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(':post_id', $post_id, PDO::PARAM_INT);
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

      $res = [
        'likes' => count($result),
        'isLiked' => in_array($_SESSION['user_id'], array_column($result, 'user_id'))
      ];

      echo json_encode($res);
      exit();
    }

    // 投稿一覧を取得
    // pageクエリでオフセットを設定可能 (20件ずつ)
    case 'getPosts': {
      $sql = "SELECT * FROM todo_table ORDER BY updated_at DESC LIMIT 50 OFFSET :offset";
      $stmt = $pdo->prepare($sql);
      $offset = isset($_GET['page']) ? (max((int)$_GET['page'], 1) - 1) * 20 : 0;
      $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      echo json_encode($result);
      exit();
    }

    // 無効なリクエスト
    default: {
      http_response_code(400);
      exit();
    }
  }
}