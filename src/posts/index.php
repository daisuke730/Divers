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
<!-- TODO: メニューの実装 -->
<!-- TODO: 詳細ページの実装 -->

<body>
  <div class="card-container">
    <div class="ui container">
      <h2>ルート一覧</h2>
      <a href="editor.php" class="ui button teal">ルートを投稿する</a>
      <div id="route-list" class="ui cards"></div>
    </div>
  </div>
  <div id="deleteConfirmModal" class="ui modal mini">
    <div class="header">投稿を削除しますか？</div>
    <div class="content">
      <p>この操作は取り消すことが出来ません。</p>
      <p>本当に投稿を削除しますか？</p>
    </div>
    <div class="actions">
      <div class="ui ok red labeled icon button" id="delete-confirm-button">
        <i class="trash icon"></i>
        削除する
      </div>
      <div class="ui cancel green button">いいえ</div>
    </div>
  </div>
</body>

<script src="/js/api.js"></script>
<script src="/js/index_page.js"></script>
<?php include("../components/footer.php"); ?>