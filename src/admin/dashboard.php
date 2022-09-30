<?php
session_start();
include('../functions.php');
check_session_id();

// 管理者でなければリダイレクト
if (!is_admin()) {
  header("Location:/");
  exit();
}
?>

<?php
$title = "ダッシュボード";
$bgColor = true;
include("../components/head.php");
?>

<div class="card-container">
  <div class="ui container">
    <div class="flex-container">
      <h2>ダッシュボード</h2>
      <div class="ui action input">
        <input id="search-input" type="text" placeholder="検索">
        <button id="search-button" class="ui icon button">
          <i class="search icon"></i>
        </button>
      </div>
    </div>
    <table class="ui celled striped table">
      <thead>
        <tr><th colspan="6">投稿一覧</th></tr>
        <tr>
          <th>投稿ID</th>
          <th>投稿名</th>
          <th>URL</th>
          <th>最終更新日時</th>
          <th>ユーザーID</th>
          <th>操作</th>
        </tr>
      </thead>
      <tbody id="route-list"></tbody>
    </table>
    <p class="centered-contents" id="route-count"></p>
    <div class="centered-contents">
      <div id="pagination" class="ui pagination menu"></div>
    </div>
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

<script src="/js/api.js"></script>
<script src="/js/templates.js"></script>
<script src="/js/dashboard_page.js"></script>
<?php include("../components/footer.php"); ?>