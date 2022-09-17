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
      $post_id = $_POST['post_id'];
      $user_id = $_SESSION['user_id'];
      $sql = "INSERT INTO likes (post_id, user_id, created_at) VALUES (:post_id, :user_id, now())";
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(':post_id', $post_id, PDO::PARAM_INT);
      $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
      $stmt->execute();
      break;
    }

    // 投稿へのいいねの取り消し
    case 'unlikePost': {
      $post_id = $_POST['post_id'];
      $user_id = $_SESSION['user_id'];
      $sql = "DELETE FROM likes WHERE post_id = :post_id AND user_id = :user_id";
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(':post_id', $post_id, PDO::PARAM_INT);
      $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
      $stmt->execute();
      break;
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
    // 投稿のいいね数を取得
    case 'getPostLikes': {
      $post_id = $_GET['post_id'];
      $sql = "SELECT COUNT(*) AS count FROM likes WHERE post_id = :post_id";
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(':post_id', $post_id, PDO::PARAM_INT);
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      echo json_encode($result);
      break;
    }
    
    // ユーザーが投稿にいいねしているかどうかを取得
    case 'isLikedPost': {
      $post_id = $_GET['post_id'];
      $user_id = $_SESSION['user_id'];
      $sql = "SELECT COUNT(*) AS count FROM likes WHERE post_id = :post_id AND user_id = :user_id";
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(':post_id', $post_id, PDO::PARAM_INT);
      $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      echo json_encode($result);
      break;
    }

    // 投稿を取得
    // pageクエリでオフセットを設定可能 (50件ずつ)
    case 'getPosts': {
      $sql = "SELECT * FROM todo_table ORDER BY updated_at DESC LIMIT 50 OFFSET :offset";
      $stmt = $pdo->prepare($sql);
      $offset = isset($_GET['page']) ? (max((int)$_GET['page'], 1) - 1) * 50 : 0;
      $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      echo json_encode($result);
      break;
    }

    // 無効なリクエスト
    default: {
      http_response_code(400);
      exit();
    }
  }
}