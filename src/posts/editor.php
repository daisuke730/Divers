<?php
session_start();
include('../functions.php');
check_session_id();
?>

<?php
$title = '投稿を作成';
$bgColor = true;
include("../components/head.php");
?>

<div class="form-container">
  <div class="ui container">
    <h2 id="editor-title" class="ui center aligned">新しい投稿を作成</h2>
    <div id="error-message" class="ui red message hidden"></div>
      <div class="ui form">
        <div class="field">
          <label>URL</label>
          <input id="url-input" name="url" placeholder="URL" value="">
        </div>
        <p>出発地と目的地はURLを貼り付けると自動的に入力されます。</p>
        <p>(この機能は開発途中のため、想定通りに動作しないことがあります。)</p>
        <div class="ui two column doubling grid">
          <div class="column">
            <div class="field">
              <label>出発地</label>
              <input id="departure" type="text" name="departure" placeholder="出発地">
            </div>
          </div>
          <div class="column">
            <div class="field">
              <label>目的地</label>
              <input id="destination" type="text" name="destination" placeholder="目的地">
            </div>
          </div>
        </div>
        <div class="field">
          <label>ルートの説明 (任意)</label>
          <textarea rows="3" placeholder="このルートに関する説明を入力してください。説明はルート一覧および詳細ページで表示されます。"></textarea>
        </div>
        <button id="submit-button" class="ui fluid large teal submit button" type="submit">投稿</button>
      </div>
  </div>
</div>

<script src="/js/api.js"></script>
<script src="/js/url_parser.js"></script>
<script src="/js/post_page.js"></script>
<?php include("../components/footer.php"); ?>