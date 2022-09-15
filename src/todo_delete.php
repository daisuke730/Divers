<?php
session_start();
include('functions.php');
check_session_id();
// データ受け取り
$id = $_GET['id'];


$pdo = connect_to_db();

$sql = 'DELETE FROM todo_table WHERE id=:id';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);
$status = $stmt->execute();

if ($status == false) {
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  header("Location:todo_read.php");
  exit();
}?>

// DB接続


// SQL実行
