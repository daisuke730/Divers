<?php
session_start();
include('functions.php');
?>

<?php
$title = "DiversMap";
$bgColor = false;
$css = ["/css/top/style_tyarekyara.css", "https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"];
include("components/head.php");
?>
<div class="overlay">
  <div class="slider_wrap">
    <ul class="slider">
      <li><div class="full-img" style="background-image: url(/img/top/image1.jpg)"></div></li>
      <li><div class="full-img" style="background-image: url(/img/top/image2.jpg)"></div></li>
      <li><div class="full-img" style="background-image: url(/img/top/image3.jpg)"></div></li>
      <li><div class="full-img" style="background-image: url(/img/top/image4.jpg)"></div></li>
    </ul>

    <div class="thumbnail">
      <li class="thumbnail-img"><img src="/img/top/image1.jpg"></li>
      <li class="thumbnail-img"><img src="/img/top/image2.jpg"></li>
      <li class="thumbnail-img"><img src="/img/top/image3.jpg"></li>
      <li class="thumbnail-img"><img src="/img/top/image4.jpg"></li>
    </div>
  </div>
  <div class="contents">
    <div class="responsive-container">
      <a class="ui button teal big" href="/register.php">新規登録</a>
      <span>または</span>
      <a class="ui button big" href="/login.php">ログイン</a>
    </div>
    <div class="ui info message" style="margin-top: 32px;">
      <a href="/howtouse.php">使い方はこちらをご覧ください</a>
    </div>
    <p>画像提供: 福岡市</p>
  </div>
</div>

<!--これはジャバスクリプトの読み込み-->
<?php
$js = ["https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js", "/js/top/main_screen1.js"];
include("components/footer.php");
?>