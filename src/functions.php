<?php
require('env.php');

function connect_to_db() {
  // データベースの接続に関する設定は env.php から編集してください

  $env = get_env("database");
  $dbn="mysql:dbname={$env["db-name"]};charset=utf8;port={$env["port"]};host={$env["host"]}";
  try {
    return new PDO($dbn, $env["user"], $env["pass"]);
  } catch (PDOException $e) {
    // TODO: エラー画面を表示する
    echo json_encode(["db error" => "{$e->getMessage()}"]);
    exit();
  }
}

function db_error_check($status, $stmt) {
  if ($status == false) {
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
  }
}

function check_session_id() {
  if (!isset($_SESSION["session_id"]) || $_SESSION["session_id"] != session_id()) {
    header("Location:/login.php");
  } else {
    session_regenerate_id(true);
    $_SESSION["session_id"] = session_id();
  }
}

function is_loggedin() {
  return isset($_SESSION["session_id"]) && $_SESSION["session_id"] == session_id();
}

function is_admin() {
  return is_loggedin() && $_SESSION["is_admin"];
}

function queryCheck($params) {
  foreach($params as $param) {
    // 不足しているクエリがあればfalseを返す
    if(!isset($_POST[$param]) || $_POST[$param] == '') return false;
  }

  // 全てのクエリがあればtrueを返す
  return true;
}
?>