<?php
session_start();
include('../functions.php');
check_session_id();
?>

<?php
$title = '投稿を作成';
$bgColor = true;
$css = ['https://fonts.googleapis.com/icon?family=Material+Icons'];
include("../components/head.php");
?>

<div class="form-container">
  <div class="ui container">
    <h2 id="editor-title" class="ui center aligned">新しい投稿を作成</h2>
    <div id="error-message" class="ui red message hidden"></div>
    <div id="info-message" class="ui yellow message hidden"></div>
    <div class="ui form">
      <button id="import-button" class="ui button">GoogleMapからルートをインポート</button>
      <div class="flex-box">
        <div class="field">
          <label>出発地</label>
          <input id="departure" type="text" name="departure" placeholder="出発地">
        </div>
        <div class="field">
          <label>目的地</label>
          <input id="destination" type="text" name="destination" placeholder="目的地">
        </div>
      </div>
      <button id="search-button" class="ui fluid large teal button disabled">経路を検索する</button>
      <div id="map" class="map"></div>
      <div class="horizontal">
        <button id="remove-waypoint" class="ui button"><i class="trash icon"></i> 経由地の削除</button>
        <p id="remove-waypoint-hint">「経由地の削除」を押すと経由地を削除できるようになります</p>
      </div>
      <div class="horizontal">
        <h3><i class="walking icon"></i>距離: <span id="route-distance">----</span></h3>
        <h3><i class="clock icon"></i>所要時間: <span id="route-duration">----</span></h3>
      </div>
      <div class="field">
        <label>ルートの説明</label>
        <textarea id="description" rows="3" placeholder="このルートに関する説明を入力してください。説明はルート一覧および詳細ページで表示されます。"></textarea>
      </div>
      <button id="submit-button" class="ui fluid large teal submit button" type="submit">投稿</button>
    </div>
  </div>
</div>

<div id="import-modal" class="ui modal">
  <div class="basic header">GoogleMapからルートをインポートする</div>
  <div class="content">
    <div class="description">
      <p>GoogleMapのURLを貼り付けることでルートをインポートすることができます。</p>
      <p>以下にURLを貼り付けて「インポート」ボタンを押してください。</p>
      <div class="ui form">
        <div class="field">
          <label>GoogleMap URL</label>
          <input id="url-input" type="text" placeholder="https://www.google.com/maps/dir/...">
        </div>
      </div>
      <p>ステータス: <span id="url-status-message">URLを貼り付けてください</span></p>
    </div>
  </div>
  <div class="basic actions">
    <div class="ui deny button">キャンセル</div>
    <div id="import-confirm-button" class="ui positive right labeled icon button">インポートする<i class="checkmark icon"></i></div>
  </div>
</div>

<script src="https://maps.googleapis.com/maps/api/js?key=<?= get_env('api-key')['google-api-client'] ?>&callback=mapReady" defer></script>
<script src="/js/api.js"></script>
<script src="/js/url_parser.js"></script>
<script src="/js/post_page.js"></script>
<?php include("../components/footer.php"); ?>