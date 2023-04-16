<?php
session_start();
include('functions.php');
?>

<?php
$title = "DiversMap";
$bgColor = false;
$css = ['/css/top_page.css'];
include("components/head.php");
?>

<div class="head-container">
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

<div class="ui divider"></div>

<div class="contents-container sponsors">
    <div>
        <h2>スポンサー</h2>
        <p>DiversMapは以下の企業様にご支援頂いております。</p>
        <div>
            <img src="/img/top/sponsor-fujikikai.png">
            <h3><a href="https://www.fujikikai-inc.co.jp/" target="_brank">株式会社フジキカイ</a> 様</h3>
        </div>

        <h2>協力団体</h2>
        <div>
            <img src="/img/top/coop-taiyototsukinoakari.jpg">
            <h3><a href="https://www.taiyo-tsukinoakari.com/" target="_brank">株式会社 太陽と月の明</a> 様</h3>
        </div>
    </div>
</div>

<?php
$js = ['/js/top_page.js'];
include("components/footer.php");
?>