<?php
require('env.php');

function connect_to_db() {
  // データベースの接続に関する設定は env.php から編集してください

  $env = get_env("database");
  $dbn="mysql:dbname={$env["dbName"]};charset=utf8;port={$env["port"]};host={$env["host"]}";
  try {
    return new PDO($dbn, $env["user"], $env["pass"]);
  } catch (PDOException $e) {
    echo json_encode(["db error" => "{$e->getMessage()}"]);
    exit();
  }
}

function check_session_id() {
  if (
    !isset($_SESSION["session_id"]) ||
    $_SESSION["session_id"] != session_id()
  ) {
    header("Location:todo_login.php");
  } else {
    session_regenerate_id(true);
    $_SESSION["session_id"] = session_id();
  }
}
?>