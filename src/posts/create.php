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
    header("Location:.");
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
            <label>URL</label>
            <input id="url-input" type="url" name="url" placeholder="URL">
          </div>
          <p>出発地と目的地はURLを貼り付けると自動的に入力されます。</p>
          <p>(この機能は開発途中のため、想定通りに動作しないことがあります。)</p>
          <div class="ui two column doubling grid">
            <div class="column">
              <div class="field">
                <label>出発地</label>
                <input id="start-point-name" type="text" name="start" placeholder="出発地">
              </div>
            </div>
            <div class="column">
              <div class="field">
                <label>目的地</label>
                <input id="end-point-name" type="text" name="end" placeholder="目的地">
              </div>
            </div>
          </div>
          <input id="route-name" type="hidden" name="todo">
          <button class="ui fluid large teal submit button" type="submit">投稿</button>
        </div>
      </form>
    </div>
  </div>
</body>

<script src="/js/url_parser.js"></script>
<script src="/js/post_page.js"></script>
<?php include("../components/footer.php"); ?>