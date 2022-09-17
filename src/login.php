<?php
session_start();
include('functions.php');

function login() {
  // POSTリクエストでなければ終了
  if($_SERVER['REQUEST_METHOD'] !== 'POST') return;

  // 入力チェック
  $isValidInput = isset($_POST['username']) && $_POST['username'] !== '' && isset($_POST['password']) && $_POST['password'] !== '';
  if (!$isValidInput) return 'ユーザ名またはパスワードが入力されていません。';

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
  header("Location:./posts");
  exit();
}

$error_message = login();
?>

<?php
$title = "ログイン";
include("components/head.php");
?>

<body>
  <div class="form-container">
    <div class="ui container">
      <h2 class="ui center aligned">ログイン</h2>
      <?php if ($error_message) echo '<div class="ui red message">' . $error_message . '</div>' ?>
      <form method="POST">
        <div class="ui form">
          <div class="field">
            <label>ユーザ名</label>
            <input type="text" name="username" placeholder="ユーザ名">
          </div>
          <div class="field">
            <label>パスワード</label>
            <input type="password" name="password" placeholder="パスワード">
          </div>
          <button class="ui fluid large teal submit button" type="submit">ログイン</button>
        </div>
      </form>
      <h4>アカウントをお持ちでない場合は<a href="register.php">新規登録</a></h4>
    </div>
  </div>
</body>

<?php include("components/footer.php"); ?>