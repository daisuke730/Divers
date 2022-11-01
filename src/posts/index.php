<?php
session_start();
include('../functions.php');
?>

<?php
$title = "ルート一覧";
$bgColor = true;
include("../components/head.php");
?>

<div class="card-container">
  <div class="ui container">
    <h2>ルート一覧</h2>
    <div class="flex-container">
      <a href="editor.php" class="ui button teal"><i class="pen icon"></i>ルートを投稿する</a> 
      <button id="open-search-modal" class="ui button"><i class="search icon"></i>ルートを検索する</button>
    </div>
    <div id="route-list" class="ui centered cards"></div>
    <p class="centered-contents" id="route-count"></p>
    <div class="centered-contents">
      <div id="pagination" class="ui pagination menu"></div>
    </div>
  </div>
</div>

<div id="delete-confirm-modal" class="ui modal mini">
  <div class="basic header">投稿を削除しますか？</div>
  <div class="content">
    <p>この操作は取り消すことが出来ません。</p>
    <p>本当に投稿を削除しますか？</p>
  </div>
  <div class="basic actions">
    <div class="ui ok red labeled icon button" id="delete-confirm-button">
      <i class="trash icon"></i>
      削除する
    </div>
    <div class="ui cancel green button">いいえ</div>
  </div>
</div>

<div id="search-modal" class="ui modal search-modal">
  <div class="basic header">ルート検索</div>
  <div class="content">
    <h3>検索</h3>
    <div class="ui fluid input">
      <input id="search-input" type="text" placeholder="行きたい地点名や出発地などを入力してみてください">
    </div>
    <h3>並び替え</h3>
    <div id="sort-lists" class="ui form horizontal"></div>
  </div>
  <div class="basic actions">
    <div class="ui cancel button">キャンセル</div>
    <div class="ui ok button teal" id="search-button"><i class="search icon"></i>検索</div>
  </div>
</div>

<script src="/js/api.js"></script>
<script src="/js/state_manager.js"></script>
<script src="/js/templates.js"></script>
<script src="/js/utils.js"></script>
<script src="/js/index_page.js"></script>
<?php include("../components/footer.php"); ?>