<?php
session_start();
include('functions.php');

function login() {
  // ログインしようとしているかどうかを判定 (username, passwordがPOSTされているかどうか)
  if (!isset($_POST['username']) && !isset($_POST['password'])) return;

  $username = $_POST['username'];
  $password = $_POST['password'];

  $pdo = connect_to_db();
  $sql = 'SELECT * FROM users_table WHERE username=:username AND password=:password AND is_deleted=0';
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(':username', $username, PDO::PARAM_STR);
  $stmt->bindValue(':password', $password, PDO::PARAM_STR);
  $status = $stmt->execute();

  // エラーであれば終了
  if ($status == false) {
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
  }

  $val = $stmt->fetch(PDO::FETCH_ASSOC);

  // ログインに失敗した場合
  if (!$val) return 'ユーザ名またはパスワードに誤りがあります。';

  $_SESSION = array();
  $_SESSION['session_id'] = session_id();
  $_SESSION['is_admin'] = $val['is_admin'];
  $_SESSION['username'] = $val['username'];
  header("Location:todo_read.php");
  exit();
}

$error_message = login();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>todoリストログイン画面</title>
</head>

<body>
  <form method="POST">
    <fieldset>
      <legend>todoリストログイン画面</legend>
      <?php if ($error_message) echo "<p>{$error_message}</p>" ?>
      <div>
        username: <input type="text" name="username">
      </div>
      <div>
        password: <input type="text" name="password">
      </div>
      <div>
        <button>Login</button>
      </div>
      <a href="todo_register.php">or register</a>
    </fieldset>
  </form>

</body>

</html>