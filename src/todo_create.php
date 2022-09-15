<?php
session_start();
include('functions.php');
check_session_id();
if (
  !isset($_POST['todo']) || $_POST['todo'] == '' ||
  !isset($_POST['url']) || $_POST['url'] == ''
) {
  exit('paramError');
}

$todo = $_POST['todo'];
$url = $_POST['url'];

// DB接続
$pdo = connect_to_db();

$sql = 'INSERT INTO todo_table(id, todo, url, created_at, updated_at) VALUES(NULL, :todo, :url, now(), now())';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':todo', $todo, PDO::PARAM_STR);
$stmt->bindValue(':url', $url, PDO::PARAM_STR);
$status = $stmt->execute();

if ($status == false) {
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  header("Location:todo_input.php");
  exit();
}
