<?php
session_start();
include('../functions.php');
check_session_id();
?>

<?php
$title = "ルート一覧";
include("../components/head.php");
?>

<!-- TODO: 検索機能の実装 -->
<!-- TODO: 自身の投稿 (or管理者) の場合に編集/削除ボタンを表示させる -->
<!-- TODO: メニューの実装 -->

<body>
  <div class="ui container top-space">
    <a href="editor.php" class="ui button">ルートを投稿する</a>
    <div id="route-list" class="ui cards"></div>
  </div>
</body>

<script src="/js/api.js"></script>
<script src="/js/index_page.js"></script>
<?php include("../components/footer.php"); ?>