<?php
session_start();
include('functions.php');
?>

<?php
$title = "DiversMap";
$bgColor = false;
$css = ['https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.3/dist/css/splide.min.css', '/css/top_page.css'];
include("components/head.php");
?>

<div class="head-container">
    <!-- <div id="slide" class="splide" role="group" aria-label="">
        <div class="splide__track">
            <ul class="splide__list">
                <li class="splide__slide"><div class="slider-image" style="background-image: url(/img/top/image1.jpg)"></li>
                <li class="splide__slide"><div class="slider-image" style="background-image: url(/img/top/image2.jpg)"></li>
                <li class="splide__slide"><div class="slider-image" style="background-image: url(/img/top/image3.jpg)"></li>
                <li class="splide__slide"><div class="slider-image" style="background-image: url(/img/top/image4.jpg)"></li>
            </ul>
        </div>
    </div> -->
    <img src="/img/logo_top.png" alt="logo" class="head-logo">
    <h3>みんなで作る、ルート共有アプリ</h3>
    <div class="horizon button-container">
        <a class="ui button yellow big" href="/posts">ルートを見てみる</a>
        <a class="ui button white big" href="/howtouse.php">使い方</a>
    </div>
</div>

<div class="contents-container reverse">
    <img src="/img/top/mockup_route_list.png">
    <div>
        <h2>DiversMapとは？</h2>
        <p>DiversMapは、足が不自由な方や車いすを利用されている方のほか、ベビーカーをお持ちの方・お年寄りの方など、<br>様々な方々が段差の多い道などの"通りづらい道"を避けて通れるルートを共有できるアプリです。</p>
    </div>
</div>

<div class="contents-container">
    <div>
        <h2>誰でも、簡単に。</h2>
        <p>ルートは誰でも作成することができ、出発地と目的地を入力するだけでOK。<br>表示されたルートに通りづらい場所がある場合は、簡単にその場所を避けたルートに変更することができます。</p>
    </div>
    <img src="/img/top/mockup_route_post.png">
</div>

<?php
$js = ['https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.3/dist/js/splide.min.js', '/js/top_page.js'];
include("components/footer.php");
?>