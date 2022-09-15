<?php

function connect_to_db() {
    $dbn='mysql:dbname=dec_todo;charset=utf8;port=3306;host=localhost';
    $user = 'root';
    $pwd = '';
    try {
      return new PDO($dbn, $user, $pwd);
    } catch (PDOException $e) {
      exit('dbError:'.$e->getMessage());
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