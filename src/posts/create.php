<?php
session_start();
include('../functions.php');
check_session_id();

function create() {
  // POSTリクエストでなければ終了
  if($_SERVER['REQUEST_METHOD'] !== 'POST') return;

  // 入力チェック
  if (!isset($_POST['todo']) || $_POST['todo'] == '' || !isset($_POST['url']) || $_POST['url'] == '') return '入力が不足している箇所があります。';

  $todo = $_POST['todo'];
  $url = $_POST['url'];

  // DB接続
  $pdo = connect_to_db();

  $sql = 'INSERT INTO todo_table(id, todo, url, created_at, updated_at) VALUES(NULL, :todo, :url, now(), now())';

  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(':todo', $todo, PDO::PARAM_STR);
  $stmt->bindValue(':url', $url, PDO::PARAM_STR);
  $status = $stmt->execute();

  if ($status == false) {
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
  } else {
    header("Location:todo_input.php");
    exit();
  }
}

$error_message = create();
?>

<?php
$title = "投稿を作成";
include("../components/head.php");
?>

<body>
  <div class="form-container">
    <div class="ui container">
      <h2 class="ui center aligned">新しい投稿を作成</h2>
      <?php if ($error_message) echo '<div class="ui red message">' . $error_message . '</div>' ?>
      <form method="POST">
        <div class="ui form">
          <div class="field">
            <label>ルート名</label>
            <input type="text" name="todo" placeholder="ルート名">
          </div>
          <div class="field">
            <label>URL</label>
            <input type="url" name="url" placeholder="URL">
          </div>
          <button class="ui fluid large teal submit button" type="submit">投稿</button>
        </div>
      </form>
    </div>
  </div>
</body>

<?php include("../components/footer.php"); ?>