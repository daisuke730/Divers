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
  <div class="flex min-h-full items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-md space-y-8">
      <div>
        <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">新規登録</h2>
      </div>
      <?php if ($error_message) echo '
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <span class="block sm:inline">'. $error_message .'</span>
      </div>'
      ?>
      <form class="mt-8 space-y-6" method="POST">
        <div class="-space-y-px rounded-md shadow-sm">
          <div>
            <label for="username" class="sr-only">ユーザー名</label>
            <input id="username" name="username" type="text" required class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" placeholder="ユーザー名">
          </div>
          <div>
            <label for="password" class="sr-only">パスワード</label>
            <input id="password" name="password" type="password" required class="relative block w-full appearance-none rounded-none rounded-b-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" placeholder="パスワード">
          </div>
        </div>
        <div>
          <button type="submit" class="group relative flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
            登録
          </button>
        </div>
      </form>
      <div>
        <p class="mt-6 text-center tracking-tight text-gray-900">既にアカウントがある場合は<a href="todo_login.php" class="text-indigo-500 text-bold">こちらからログイン</a></p>
      </div>
    </div>
  </div>
</body>

<?php include("components/footer.php"); ?>