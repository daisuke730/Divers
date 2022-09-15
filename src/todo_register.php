<?php
include('functions.php');

function register() {
  // POSTリクエストでなければ終了
  if($_SERVER['REQUEST_METHOD'] !== 'POST') return;

  // 入力チェック
  $isValidInput = isset($_POST['username']) && $_POST['username'] !== '' && isset($_POST['password']) && $_POST['password'] !== '';
  if (!$isValidInput) return 'ユーザ名またはパスワードが入力されていません。';

  $username = $_POST["username"];
  $password = $_POST["password"];

  $pdo = connect_to_db();
  $sql = 'SELECT COUNT(*) FROM users_table WHERE username=:username';
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(':username', $username, PDO::PARAM_STR);
  $status = $stmt->execute();

  if ($status == false) {
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
  }

  // すでに登録されていた場合
  if ($stmt->fetchColumn() > 0) return '既に登録されているユーザーです。';

  $sql = 'INSERT INTO users_table(id, username, password, is_admin, is_deleted, created_at, updated_at) VALUES(NULL, :username, :password, 0, 0, sysdate(), sysdate())';
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(':username', $username, PDO::PARAM_STR);
  $stmt->bindValue(':password', $password, PDO::PARAM_STR);
  $status = $stmt->execute();

  if ($status == false) {
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
  }

  header("Location:todo_login.php");
  exit();
}

$error_message = register();
?>

<?php
$title = "ユーザ登録";
include("components/head.php");
?>

<body>
  <form method="POST">
    <fieldset>
      <legend>todoリストユーザ登録画面</legend>
      <?php if ($error_message) echo "<p>{$error_message}</p>" ?>
      <div>
        username: <input type="text" name="username">
      </div>
      <div>
        password: <input type="text" name="password">
      </div>
      <div>
        <button>Register</button>
      </div>
      <a href="todo_login.php">or login</a>
    </fieldset>
  </form>

</body>

</html>