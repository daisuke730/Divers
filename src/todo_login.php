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

<?php
$title = "ログイン";
include("components/head.php");
?>

<body>
  <div class="flex min-h-full items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-md space-y-8">
      <div>
        <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">ログイン</h2>
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
            <input id="username" name="username" type="text" autocomplete="email" required class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" placeholder="ユーザー名">
          </div>
          <div>
            <label for="password" class="sr-only">パスワード</label>
            <input id="password" name="password" type="password" autocomplete="current-password" required class="relative block w-full appearance-none rounded-none rounded-b-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" placeholder="パスワード">
          </div>
        </div>
        <div>
          <button type="submit" class="group relative flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
            ログイン
          </button>
        </div>
      </form>
      <div>
        <p class="mt-6 text-center tracking-tight text-gray-900">または<a href="todo_register.php" class="text-indigo-500 text-bold">新規登録</a></p>
      </div>
    </div>
  </div>
</body>

<?php include("components/footer.php"); ?>