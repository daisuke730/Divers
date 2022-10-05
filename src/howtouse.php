<?php
session_start();
include('functions.php');
?>

<?php
$title = "DiversMap";
$bgColor = true;
$css = ["/css/howtouse.css"];
include("components/head.php");
?>

<div class="form-container article-container">
  <div class="ui container">
    <h1 class="title">Divers Map の使い方</h1>
    <h2>目次</h2>
    <ul>
      <li><a href="#sub_01">Divers Map（ダイバーズマップ）の使い方〜スマートフォン版〜</a></li>
      <ul>
        <li><a href="#sub_01-1">新規登録画面</a></li>
        <li><a href="#sub_01-2">ログイン画面</a></li>
        <li><a href="#sub_01-3">ルート一覧</a></li>
        <li><a href="#sub_01-4">投稿詳細</a></li>
        <li><a href="#sub_01-5">Googleマップへ</a></li>
      </ul>
      <li><a href="#sub_02">Divers Map（ダイバーズマップ）の使い方〜PC版〜</a>
      <ul>
        <li><a href="#sub_02-1">新規登録画面</a></li>
        <li><a href="#sub_02-2">ログイン画面</a></li>
        <li><a href="#sub_02-3">ルート一覧</a></li>
        <li><a href="#sub_02-4">投稿詳細</a></li>
        <li><a href="#sub_02-5">Googleマップへ</a></li>
      </ul>
      <li><a href="#sub_03">まとめ</a></li>
    </ul>

    <div class="heading section">
      <a name="sub_01"></a>
      <h2 class="hdg-type-3">Divers Map（ダイバーズマップ）の使い方〜スマートフォン版〜</h2>
    </div>

    <div class="heading section">
      <a name="sub_01-1"></a>
      <h3 class="hdg-type-3">新規登録画面</h3>
    </div>

    <p>新規で登録するユーザー名、パスワードを入力します。</p>
    <p>入力完了後、登録ボタンを押すと、ログイン画面に移り変わります。</p>

    <img src="/img/howtouse/new.jpg" alt="Divers Map（ダイバーズマップ）の使い方〜PC版">

    <div class="heading section">
      <a name="sub_01-2"></a>
      <h3 class="hdg-type-3" align="left">ログイン画面</h3>
    </div>

    <p align="left">登録したユーザー名、パスワードを入力し、ログインボタンを押します。</p>

    <img src="/img/howtouse/login.jpg" alt="Divers Map（ダイバーズマップ）の使い方〜PC版">

    <div class="heading section">
      <a name="sub_01-3"></a>
      <h3 class="hdg-type-3" align="left">ルート一覧</h3>
    </div>

    <h4 align="left">ルートを投稿する</h4>
    <p align="left">ルート一覧のページからルートを投稿するボタンを押す。</p>

    <img src="/img/howtouse/route3.jpg" alt="Divers Map（ダイバーズマップ）の使い方〜PC版">

    <p align="left">新しく投稿したい経路のURLをGoogleマップからコピーしてきて、URLの欄にペーストします。</p>
    <p align="left">URLを貼り付けると出発地と目的地が自動的に入力されます。(この機能は開発途中のため、想定通りに動作しないことがあります。)</p>
    <p align="left">入力されない場合、出発地と目的地を手動で入力し、投稿ボタンを押す。</p>

    <img src="/img/howtouse/NewPost2.jpg" alt="Divers Map（ダイバーズマップ）の使い方〜PC版">

    <p align="left">投稿した経路がルート一覧に追加されたことを確認し、投稿した経路をタップする。</p>

    <img src="/img/howtouse/route4.jpg" alt="Divers Map（ダイバーズマップ）の使い方〜PC版">

    <div class="heading section">
      <a name="sub_01-4"></a>
      <h3 class="hdg-type-3" align="left">投稿詳細</h3>  
    </div>

    <p align="left">投稿詳細のページの『このルートを見る』をタップする。</p>

    <img src="/img/howtouse/post2.jpg" alt="Divers Map（ダイバーズマップ）の使い方〜PC版">

    <div class="heading section">
      <a name="sub_01-5"></a>
      <h3 class="hdg-type-3" align="left">Googleマップへ</h3>
    </div>

    <p align="left">投稿したルートがGoogleマップアプリを持っている方はアプリで、持っていない方はブラウザのままご覧いただけます。</p>

    <img src="/img/howtouse/Google2.jpg" alt="Divers Map（ダイバーズマップ）の使い方〜PC版">

    <div class="heading section">
      <a name="sub_02"></a>
      <h2 class="hdg-type-3" align="left">Divers Map（ダイバーズマップ）の使い方〜PC版〜</h2>
    </div>

    <div class="heading section">
      <a name="sub_02-1"></a>
      <h3 class="hdg-type-3" align="left">新規登録画面</h3>
    </div>

    <p align="left">新規で登録するユーザー名、パスワードを入力します。</p>
    <p align="left">入力完了後、登録ボタンを押すと、ログイン画面に移り変わります。</p>

    <img src="/img/howtouse/new02.png" alt="Divers Map（ダイバーズマップ）の使い方〜PC版">

    <div class="heading section">
      <a name="sub_02-2"></a>
      <h3 class="hdg-type-3" align="left">ログイン画面</h3>
    </div>

    <p align="left">登録したユーザー名、パスワードを入力し、ログインボタンを押します。</p>

    <img src="/img/howtouse/login02.png" alt="Divers Map（ダイバーズマップ）の使い方〜PC版">

    <div class="heading section">
      <a name="sub_02-3"></a>
      <h3 class="hdg-type-3" align="left">ルート一覧</h3>
    </div>

    <h4 align="left">ルートを投稿する</h4>
    <p align="left">ルート一覧のページからルートを投稿するボタンを押す。</p>

    <img src="/img/howtouse/route02.png" alt="Divers Map（ダイバーズマップ）の使い方〜PC版">

    <p align="left">新しく投稿したい経路のURLをGoogleマップからコピーしてきて、URLの欄にペーストします。</p>
    <p align="left">URLを貼り付けると出発地と目的地が自動的に入力されます。(この機能は開発途中のため、想定通りに動作しないことがあります。)</p>
    <p align="left">入力されない場合、出発地と目的地を手動で入力し、投稿ボタンを押す。</p>

    <img src="/img/howtouse/newpost02.png" alt="Divers Map（ダイバーズマップ）の使い方〜PC版">

    <p align="left">投稿した経路がルート一覧に追加されたことを確認し、投稿した経路をタップする。</p>

    <img src="/img/howtouse/route02-2.png" alt="Divers Map（ダイバーズマップ）の使い方〜PC版">

    <div class="heading section">
      <a name="sub_02-4"></a>
      <h3 class="hdg-type-3" align="left">投稿詳細</h3>
    </div>

    <p align="left">投稿詳細のページの『このルートを見る』をタップする。</p>

    <img src="/img/howtouse/post02.png" alt="Divers Map（ダイバーズマップ）の使い方〜PC版">

    <div class="heading section">
      <a name="sub_02-5"></a>
      <h3 class="hdg-type-3" align="left">Googleマップへ</h3>
    </div>

    <p align="left">投稿したルートがGoogleマップアプリを持っている方はアプリで、持っていない方はブラウザのままご覧いただけます。</p>

    <img src="/img/howtouse/Google02.png" alt="Divers Map（ダイバーズマップ）の使い方〜PC版">

    <div class="heading section">
      <a name="sub_03"></a>
      <h2 class="hdg-type-3" align="center">まとめ</h2>
    </div>

    <p align="center">以上、Divers Mapの使い方をご紹介しました。</p>
    <p align="center">使い方をマスターして、より多くの投稿をしていくことで、より便利な地図になっていきます。</p>
    <p align="center">Divers Mapを使いこなして、便利で安心安全な暮らしをお楽しみください。</p>
  </div>
</div>

<?php include("components/footer.php"); ?>