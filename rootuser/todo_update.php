<?php
session_start();
include("functions.php");
check_session_id();
// 入力項目のチェック
if (
  !isset($_POST['todo']) || $_POST['todo'] == '' ||
  !isset($_POST['url']) || $_POST['url'] == '' ||
  !isset($_POST['id']) || $_POST['id'] == ''
) {
  exit('paramError');
}

$todo = $_POST['todo'];
$url = $_POST['url'];
$id = $_POST['id'];

// DB接続

$pdo = connect_to_db();

$sql = 'UPDATE todo_table SET todo=:todo, url=:url, updated_at=now() WHERE id=:id';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':todo', $todo, PDO::PARAM_STR);
$stmt->bindValue(':url', $url, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);
$status = $stmt->execute();

// SQL実行
if ($status == false) {
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  header('Location:todo_read.php');
  exit();
}?>