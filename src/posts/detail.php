<?php
session_start();
include('../functions.php');

// IDが提供されているかどうかをチェック
if (!isset($_GET['id'])) {
    // されていなければリダイレクト
    header('Location:/posts');
    exit();
}
?>

<?php
$title = "投稿詳細";
$bgColor = true;
include("../components/head.php");
?>

<div class="form-container">
    <div class="ui container">
        <h2>投稿詳細</h2>
        <div id="error-message" class="ui red message hidden"></div>
        <div id="detail" class="route-detail">
            <h3 id="post-title"></h3>
            <img id="route-image" class="detail-image" src="">
            <a class="ui fluid button teal large" id="post-url" target="_blank" rel="noopener noreferrer">GoogleMapでこのルートを見る</a>
            <div id="post-detail-box" class="post-detail-box">
                <div class="horizontal">
                    <h3><i class="walking icon"></i>距離: <span id="route-distance"></span></h3>
                    <h3><i class="clock icon"></i>所要時間: <span id="route-duration"></span></h3>
                </div>
                <h4>このルートについて</h4>
                <p>投稿: <span id="post-created-at"></span></p>
                <p>最終更新: <span id="post-updated-at"></span></p>
                <div id="post-description-box">
                    <h4>このルートの説明</h4>
                    <p id="post-description"></p>
                </div>
            </div>
            <div id="like-button"></div>
        </div>
        <button class="ui button" onclick="history.back()"><i class="arrow left icon"></i>戻る</button>
    </div>
</div>

<script src="/js/api.js"></script>
<script src="/js/templates.js"></script>
<script src="/js/utils.js"></script>
<script src="/js/detail_page.js"></script>
<?php include("../components/footer.php"); ?>