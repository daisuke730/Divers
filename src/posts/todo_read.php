<?php
session_start();
include("functions.php");
check_session_id();

$pdo = connect_to_db();

$sql = 'SELECT * FROM todo_table ORDER BY url ASC';

$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

if ($status == false) {
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $output = "";
  foreach ($result as $record) {
    $output .= !$_SESSION['is_admin'] ? "
      <tr>
        
        <td>{$record["todo"]}</td>
        <td class=\"break\">{$record["url"]}</td>
        
      </tr>
    " : "
      <tr>
        
        <td>{$record["todo"]}</td>
        <td class=\"break\"><a href=\"{$record['url']}\" target=\"_blank\" rel=\"noopener noreferrer\">{$record["url"]}</a></td>
        <td>
        <a href='todo_edit.php?id={$record["id"]}'>edit</a>
        </td>
        <td>
        <a href='todo_delete.php?id={$record["id"]}'>delete</a>
        </td>  
      </tr>
    ";
  }
  unset($record);
}
?>

<?php
$title = "DB連携型todoリスト（一覧画面）";
include("components/head.php");
?>

<body>
<fieldset>
    <legend>DB連携型todoリスト（一覧画面）</legend>
    <a href="todo_input.php">入力画面</a>
    <a href="todo_logout.php">logout</a>
    <table>
      <thead>
        <tr>
        <th>行き先</th>
          <th>url</th>
          
          <th></th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?= $output ?>
      </tbody>
    </table>
  </fieldset>
</body>

<?php include("components/footer.php"); ?>