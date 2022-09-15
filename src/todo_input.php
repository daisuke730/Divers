<?php
session_start();
include("functions.php");
check_session_id();

$title = "DB連携型todoリスト（入力画面）";
include("components/head.php");
?>

<body>
<form action="todo_create.php" method="POST">
    <fieldset>
      <legend>DB連携型todoリスト（入力画面）</legend>
      <a href="todo_read.php">一覧画面</a>
      <a href="todo_logout.php">logout</a>
      <div>
        行き先: <input type="text" name="todo">
      </div>
      <div>
      url: <input type="url" name="url">
      </div>
      <div>
        <button>submit</button>
      </div>
    </fieldset>
  </form>

</body>

</html>