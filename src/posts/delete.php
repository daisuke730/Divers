<?php
session_start();
include('../functions.php');
check_session_id();

// データ受け取り
$id = $_GET['id'];
$pdo = connect_to_db();

$sql = 'DELETE FROM todo_table WHERE id=:id';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);
$status = $stmt->execute();

// エラーチェック
db_error_check($status, $stmt);

header("Location:./");
exit();
?>