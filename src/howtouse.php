<?php
session_start();
include('functions.php');
?>

<?php
$title = "DiversMapの使い方";
$bgColor = true;
$css = ["/css/howtouse.css"];
include("components/head.php");
?>

<div class="form-container article-container container-with-toc">
  <div class="in-toc-wrapper">
    <div class="ui container in-toc">
      <!-- <h2>目次</h2> -->
      <nav class="toc">
        <div class="about_main">
          <ul class="about_title-nav">
              <li to="" class="item_movie">
                  <img src="/img/howtouse/map-pin_02_blue-300x300.png" width="30" height="30" viewBox="0 0 19 19" class="mark">
                      <path id="square_272" data-name="square 272" d="M9.5,0H19a0,0,0,0,1,0,0V9.5A9.5,9.5,0,0,1,9.5,19h0A9.5,9.5,0,0,1,0,9.5v0A9.5,9.5,0,0,1,9.5,0Z" fill="rgba(0,0,0,0.12)"></path>
                  </img>
                  <a href="#sub_00" align="right"><b><ruby>Divers Map<rt>ダイバーズマップ</rt></ruby>の使い方説明動画</b></a>
              </li>
              <li to="" class="item_main">
                  <img src="/img/howtouse/map-pin_02_red-300x300.png" width="30" height="30" viewBox="0 0 19 19" class="mark">
                      <path id="square_272" data-name="square 272" d="M9.5,0H19a0,0,0,0,1,0,0V9.5A9.5,9.5,0,0,1,9.5,19h0A9.5,9.5,0,0,1,0,9.5v0A9.5,9.5,0,0,1,9.5,0Z" fill="rgba(0,0,0,0.12)"></path>
                  </img>
                  <a href="#sub_01" align="right"><b><ruby>Divers Map<rt>ダイバーズマップ</rt></ruby>の使い方〜スマホ版〜</b></a>
              </li>
          </ul>
          <ul class="about_main-nav">
              <li to="" class="item_main">
                  <img src="/img/howtouse/map-pin_blue-300x300.png" width="19" height="19" viewBox="0 0 19 19" class="mark">
                      <path id="square_272" data-name="square 272" d="M9.5,0H19a0,0,0,0,1,0,0V9.5A9.5,9.5,0,0,1,9.5,19h0A9.5,9.5,0,0,1,0,9.5v0A9.5,9.5,0,0,1,9.5,0Z" fill="rgba(0,0,0,0.12)"></path>
                  </img>
                      <b><a href="#sub_01-3_main">〜ルートを閲覧する〜</a></b>
              </li>
              <li to="" class="item">
                  <img src="/img/howtouse/map-pin_green-300x300.png" width="19" height="19" viewBox="0 0 19 19" class="mark">
                      <path id="square_272" data-name="square 272" d="M9.5,0H19a0,0,0,0,1,0,0V9.5A9.5,9.5,0,0,1,9.5,19h0A9.5,9.5,0,0,1,0,9.5v0A9.5,9.5,0,0,1,9.5,0Z" fill="rgba(0,0,0,0.12)"></path>
                  </img>
                      <b><a href="#sub_01-3">ルート一覧</a></b>
              </li>
              <li to="" class="item">
                  <img src="/img/howtouse/map-pin_yellow-300x300.png" width="19" height="19" viewBox="0 0 19 19" class="mark">
                      <path id="square_272" data-name="square 272" d="M9.5,0H19a0,0,0,0,1,0,0V9.5A9.5,9.5,0,0,1,9.5,19h0A9.5,9.5,0,0,1,0,9.5v0A9.5,9.5,0,0,1,9.5,0Z" fill="rgba(0,0,0,0.12)"></path>
                  </img>
                      <b><a href="#sub_03-1">検索・ソート機能</a></b>
              </li>
              <li to="" class="item">
                  <img src="/img/howtouse/map-pin_blue-300x300.png" width="19" height="19" viewBox="0 0 19 19" class="mark">
                      <path id="square_272" data-name="square 272" d="M9.5,0H19a0,0,0,0,1,0,0V9.5A9.5,9.5,0,0,1,9.5,19h0A9.5,9.5,0,0,1,0,9.5v0A9.5,9.5,0,0,1,9.5,0Z" fill="rgba(0,0,0,0.12)"></path>
                  </img>
                      <b><a href="#sub_01-4">投稿詳細</a></b>
              </li>

              <li to="" class="item">
                  <img src="/img/howtouse/map-pin_red-300x300.png" width="19" height="19" viewBox="0 0 19 19" class="mark">
                      <path id="square_272" data-name="square 272" d="M9.5,0H19a0,0,0,0,1,0,0V9.5A9.5,9.5,0,0,1,9.5,19h0A9.5,9.5,0,0,1,0,9.5v0A9.5,9.5,0,0,1,9.5,0Z" fill="rgba(0,0,0,0.12)"></path>
                  </img>
                      <b><a href="#sub_01-5">Googleマップへ</a></b>
              </li>

              <li to="" class="item_main">
                  <img src="/img/howtouse/map-pin_blue-300x300.png" width="19" height="19" viewBox="0 0 19 19" class="mark">
                      <path id="square_272" data-name="square 272" d="M9.5,0H19a0,0,0,0,1,0,0V9.5A9.5,9.5,0,0,1,9.5,19h0A9.5,9.5,0,0,1,0,9.5v0A9.5,9.5,0,0,1,9.5,0Z" fill="rgba(0,0,0,0.12)"></path>
                  </img>
                      <b><a href="#sub_01_main">〜ルートを投稿する〜</a></b>
              </li>
              <li to="" class="item">
                  <img src="/img/howtouse/map-pin_green-300x300.png" width="19" height="19" viewBox="0 0 19 19" class="mark">
                      <path id="square_272" data-name="square 272" d="M9.5,0H19a0,0,0,0,1,0,0V9.5A9.5,9.5,0,0,1,9.5,19h0A9.5,9.5,0,0,1,0,9.5v0A9.5,9.5,0,0,1,9.5,0Z" fill="rgba(0,0,0,0.12)"></path>
                  </img>
                      <b><a href="#sub_01-6">ルートの投稿</a></b>
              </li>

              <li to="" class="item item_current">
                  <!-- 文字横のピン -->
                  <img src="/img/howtouse/map-pin_yellow-300x300.png" width="19" height="19" viewBox="0 0 19 19" class="mark">
                      <path id="square_272" data-name="square 272" d="M9.5,0H19a0,0,0,0,1,0,0V9.5A9.5,9.5,0,0,1,9.5,19h0A9.5,9.5,0,0,1,0,9.5v0A9.5,9.5,0,0,1,9.5,0Z" fill="rgba(0,0,0,0.12)"></path>
                  </img>
                  <b><a href="#sub_01-1">新規登録画面</a></b>
              </li>
              <li to="" class="item">
                  <img src="/img/howtouse/map-pin_red-300x300.png" width="19" height="19" viewBox="0 0 19 19" class="mark">
                      <path id="square_272" data-name="square 272" d="M9.5,0H19a0,0,0,0,1,0,0V9.5A9.5,9.5,0,0,1,9.5,19h0A9.5,9.5,0,0,1,0,9.5v0A9.5,9.5,0,0,1,9.5,0Z" fill="rgba(0,0,0,0.12)"></path>
                  </img>
                      <b><a href="#sub_01-2">ログイン画面</a></b>
              </li>
              
          </ul>
          <ul class="about_title-nav">
              <li to="" class="item_main">
                  <img src="/img/howtouse/map-pin_02_red-300x300.png" width="30" height="30" viewBox="0 0 19 19" class="mark">
                      <path id="square_272" data-name="square 272" d="M9.5,0H19a0,0,0,0,1,0,0V9.5A9.5,9.5,0,0,1,9.5,19h0A9.5,9.5,0,0,1,0,9.5v0A9.5,9.5,0,0,1,9.5,0Z" fill="rgba(0,0,0,0.12)"></path>
                  </img>
                  <a href="#sub_02"><b><ruby>Divers Map<rt>ダイバーズマップ</rt></ruby>の使い方〜PC版〜</b></a>
              </li>
          </ul> 
          <ul class="about_main-nav">
              <li to="" class="item_main">
                  <img src="/img/howtouse/map-pin_blue-300x300.png" width="19" height="19" viewBox="0 0 19 19" class="mark">
                      <path id="square_272" data-name="square 272" d="M9.5,0H19a0,0,0,0,1,0,0V9.5A9.5,9.5,0,0,1,9.5,19h0A9.5,9.5,0,0,1,0,9.5v0A9.5,9.5,0,0,1,9.5,0Z" fill="rgba(0,0,0,0.12)"></path>
                  </img>
                      <b><a href="#sub_02-1_main">〜ルートを閲覧する〜</a></b>
              </li>
              
              <li to="" class="item">
                  <img src="/img/howtouse/map-pin_green-300x300.png" width="19" height="19" viewBox="0 0 19 19" class="mark">
                      <path id="square_272" data-name="square 272" d="M9.5,0H19a0,0,0,0,1,0,0V9.5A9.5,9.5,0,0,1,9.5,19h0A9.5,9.5,0,0,1,0,9.5v0A9.5,9.5,0,0,1,9.5,0Z" fill="rgba(0,0,0,0.12)"></path>
                  </img>
                      <b><a href="#sub_02-3">ルート一覧</a></b>
              </li>
              <li to="" class="item">
                  <img src="/img/howtouse/map-pin_yellow-300x300.png" width="19" height="19" viewBox="0 0 19 19" class="mark">
                      <path id="square_272" data-name="square 272" d="M9.5,0H19a0,0,0,0,1,0,0V9.5A9.5,9.5,0,0,1,9.5,19h0A9.5,9.5,0,0,1,0,9.5v0A9.5,9.5,0,0,1,9.5,0Z" fill="rgba(0,0,0,0.12)"></path>
                  </img>
                      <b><a href="#sub_03-2">検索・ソート機能</a></b>
              </li>
              <li to="" class="item">
                  <img src="/img/howtouse/map-pin_blue-300x300.png" width="19" height="19" viewBox="0 0 19 19" class="mark">
                      <path id="square_272" data-name="square 272" d="M9.5,0H19a0,0,0,0,1,0,0V9.5A9.5,9.5,0,0,1,9.5,19h0A9.5,9.5,0,0,1,0,9.5v0A9.5,9.5,0,0,1,9.5,0Z" fill="rgba(0,0,0,0.12)"></path>
                  </img>
                      <b><a href="#sub_02-4">投稿詳細</a></b>
              </li>

              <li to="" class="item">
                  <img src="/img/howtouse/map-pin_red-300x300.png" width="19" height="19" viewBox="0 0 19 19" class="mark">
                      <path id="square_272" data-name="square 272" d="M9.5,0H19a0,0,0,0,1,0,0V9.5A9.5,9.5,0,0,1,9.5,19h0A9.5,9.5,0,0,1,0,9.5v0A9.5,9.5,0,0,1,9.5,0Z" fill="rgba(0,0,0,0.12)"></path>
                  </img>
                      <b><a href="#sub_02-5">Googleマップへ</a></b>
              </li>

              <li to="" class="item_main">
                  <img src="/img/howtouse/map-pin_blue-300x300.png" width="19" height="19" viewBox="0 0 19 19" class="mark">
                      <path id="square_272" data-name="square 272" d="M9.5,0H19a0,0,0,0,1,0,0V9.5A9.5,9.5,0,0,1,9.5,19h0A9.5,9.5,0,0,1,0,9.5v0A9.5,9.5,0,0,1,9.5,0Z" fill="rgba(0,0,0,0.12)"></path>
                  </img>
                      <b><a href="#sub_02-2_main">〜ルートを投稿する〜</a></b>
              </li>
              <li to="" class="item">
                  <img src="/img/howtouse/map-pin_green-300x300.png" width="19" height="19" viewBox="0 0 19 19" class="mark">
                      <path id="square_272" data-name="square 272" d="M9.5,0H19a0,0,0,0,1,0,0V9.5A9.5,9.5,0,0,1,9.5,19h0A9.5,9.5,0,0,1,0,9.5v0A9.5,9.5,0,0,1,9.5,0Z" fill="rgba(0,0,0,0.12)"></path>
                  </img>
                      <b><a href="#sub_01-6">ルートの投稿</a></b>
              </li>
              <li to="" class="item item_current">
                  <!-- 文字横のピン -->
                  <img src="/img/howtouse/map-pin_yellow-300x300.png" width="19" height="19" viewBox="0 0 19 19" class="mark">
                      <path id="square_272" data-name="square 272" d="M9.5,0H19a0,0,0,0,1,0,0V9.5A9.5,9.5,0,0,1,9.5,19h0A9.5,9.5,0,0,1,0,9.5v0A9.5,9.5,0,0,1,9.5,0Z" fill="rgba(0,0,0,0.12)"></path>
                  </img>
                  <b><a href="#sub_02-1">新規登録画面</a></b>
              </li>
              <li to="" class="item">
                  <img src="/img/howtouse/map-pin_blue-300x300.png" width="19" height="19" viewBox="0 0 19 19" class="mark">
                      <path id="square_272" data-name="square 272" d="M9.5,0H19a0,0,0,0,1,0,0V9.5A9.5,9.5,0,0,1,9.5,19h0A9.5,9.5,0,0,1,0,9.5v0A9.5,9.5,0,0,1,9.5,0Z" fill="rgba(0,0,0,0.12)"></path>
                  </img>
                      <b><a href="#sub_02-2">ログイン画面</a></b>
              </li>
              <li to="" class="item">
                  <img src="/img/howtouse/map-pin_red-300x300.png" width="19" height="19" viewBox="0 0 19 19" class="mark">
                      <path id="square_272" data-name="square 272" d="M9.5,0H19a0,0,0,0,1,0,0V9.5A9.5,9.5,0,0,1,9.5,19h0A9.5,9.5,0,0,1,0,9.5v0A9.5,9.5,0,0,1,9.5,0Z" fill="rgba(0,0,0,0.12)"></path>
                  </img>
                      <a href="#sub_03"><b>まとめ</b></a>
              <!-- </li> -->
          </ul>
        <div>
      </nav>
    </div>
  </div>

  <!-- メインコンテンツ -->
  <div class="ui container main-contents">
    <h1 class="title">Divers Map の使い方</h1>
    <a name="sub_00"></a>
    <div class="movie">
      <h2 class="hdg-type-3" align="left">使い方の説明動画</h2>
      <div class="youtube">
          <iframe width="560" height="315" src="https://www.youtube.com/embed/kGf3RS186SM" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
          </div>
    </div>

    <div class="heading section">
      <a name="sub_01"></a>
      <h2 class="hdg-type-3">Divers Map（ダイバーズマップ）の使い方〜スマホ版〜</h2>
    </div>

    <div class="heading section">
      <a name="sub_01-3_main"></a>
      <h3 class="hdg-type-3" align="left">〜ルートを閲覧する〜</h3>
    </div>
    
    <div class="heading section">
      <a name="sub_01-3"></a>
      <h3 class="hdg-type-3" align="left">ルート一覧</h3>
    </div>
    <p align="left"> 投稿されたルート一覧はこちらのページからご覧いただけます。</p>
    <img src="/img/howtouse/iphone_rote3.PNG" alt="Divers Map（ダイバーズマップ）の使い方〜スマホ版">

    <p align="left">投稿の詳細を閲覧する場合は、赤い枠で囲んだところをタップしてください。</p>
    <img src="/img/howtouse/iphone_rote4.PNG" alt="Divers Map（ダイバーズマップ）の使い方〜スマホ版">

    <div class="heading section">
      <a name="sub_03-1"></a>
      <h3 class="hdg-type-3" align="left">検索・ソート機能</h3>
    </div>
    <p align="left">DiversMapには検索・ソート機能があります。赤枠のボタンを押してください。</p>
    <img src="/img/howtouse/iphone_search1.png" alt="Divers Map（ダイバーズマップ）の使い方〜スマホ版">
    <p align="left">出発地や目的地を入力し、並び替えたい順番を選び、検索ボタンを押します。</p>
    <img src="/img/howtouse/iphone_search2.png" alt="Divers Map（ダイバーズマップ）の使い方〜スマホ版">
    <p align="left">検索のワードに当てはまる投稿を並び替えられた状態で表示することができます。</p>
    <img src="/img/howtouse/iphone_search3.png" alt="Divers Map（ダイバーズマップ）の使い方〜スマホ版">

    <div class="heading section">
      <a name="sub_01-4"></a>
      <h3 class="hdg-type-3" align="left">投稿詳細</h3>  
    </div>

    <p align="left">投稿詳細のページでは、経路、距離、所要時間、投稿日時、ルートの説明がご覧いただけます。</p>
    <p align="left">また、Googleマップでより詳しい経路をご覧になる際は、「GoogleMapでこのルートを見る」のボタンをタップしてください。</p>

    <img src="/img/howtouse/iphone_postdetails2.PNG" alt="Divers Map（ダイバーズマップ）の使い方〜スマホ版">

    <div class="heading section">
      <a name="sub_01-5"></a>
      <h3 class="hdg-type-3" align="left">Googleマップへ</h3>
    </div>

    <p align="left">投稿したルートがGoogleマップアプリを持っている方はアプリで、持っていない方はブラウザのままご覧いただけます。</p>

    <img src="/img/howtouse/iphone_google.PNG" alt="Divers Map（ダイバーズマップ）の使い方〜スマホ版">

    <div class="heading section">
      <a name="sub_01_main"></a>
      <h3 class="hdg-type-3" align="left">〜ルートを投稿する〜</h3>
    </div>

    <p align="left">ルートを投稿する際は、ルート一覧のページから「ルートを投稿する」ボタンを押します。</p>
    <div class="new_link">
      <p align="left">※ルートの投稿には、ログインが必要になります。ログインしていない場合は、新規登録画面またはログイン画面に移行します。<a href="#sub_01-1_sub" >新規登録・ログインの仕方はこちら</a>
    </div>
   
    <img src="/img/howtouse/iphone_rote1.PNG" alt="Divers Map（ダイバーズマップ）の使い方〜スマホ版">

    <div class="heading section">
      <a name="sub_01-6"></a>
      <h3 class="hdg-type-3" align="left">ルートの投稿</h3>
    </div>

    <p align="left">出発地と目的地をそれぞれ入力すると、経路が表示されます。</p>

    <img src="/img/howtouse/iphone_newpost1.PNG" alt="Divers Map（ダイバーズマップ）の使い方〜iphone版">
    <img src="/img/howtouse/iphone_newpost2.PNG" alt="Divers Map（ダイバーズマップ）の使い方〜iphone版">

    <p align="left">経路に触れると、白い丸が現れるので、こちらをドラッグして、投稿したい経路になるように編集してください。</p>
    <img src="/img/howtouse/iphone_newrote.PNG" alt="Divers Map（ダイバーズマップ）の使い方〜iphone版">

    <p align="left">投稿したい経路に編集できたら、任意で説明も追記していただき、「投稿」のボタンを押して投稿完了です。</p>
    <img src="/img/howtouse/iphone_newrote2.PNG" alt="Divers Map（ダイバーズマップ）の使い方〜iphone版">

    <p align="left">投稿した経路がルート一覧に追加されたことを確認し、投稿した経路をタップする。</p>
    <p align="left">※投稿の閲覧の仕方は本ページに別で用意してありますので、そちらをご参照ください。</p>

    <img src="/img/howtouse/iphone_rote5.PNG" alt="Divers Map（ダイバーズマップ）の使い方〜スマホ版">

    <div class="heading section">
      <a name="sub_01-1"></a>
      <a name="sub_01-1_sub"></a>
      <h3 class="hdg-type-3">新規登録画面(※ルートの投稿には、ログインが必要になります。ログインしていない場合は、新規登録する必要があります。)</h3>
    </div>

    <p>新規で登録するユーザー名、パスワードを入力します。</p>
    <p>入力完了後、登録ボタンを押すと、ログイン画面に移り変わります。</p>

    <img src="/img/howtouse/iphone_new.PNG" alt="Divers Map（ダイバーズマップ）の使い方〜スマホ版">

    <div class="heading section">
      <a name="sub_01-2"></a>
      <h3 class="hdg-type-3" align="left">ログイン画面</h3>
    </div>

    <p align="left">登録したユーザー名、パスワードを入力し、ログインボタンを押します。</p>

    <img src="/img/howtouse/iphone_login.PNG" alt="Divers Map（ダイバーズマップ）の使い方〜スマホ版">

    <!-- ここから新しく作ったPC版の使い方の説明です。 -->

    <div class="heading section">
      <a name="sub_02"></a>
      <h2 class="hdg-type-3" align="left">Divers Map（ダイバーズマップ）の使い方〜PC版〜</h2>
    </div>

    <div class="heading section">
      <a name="sub_02-1_main"></a>
      <h3 class="hdg-type-3" align="left">〜ルートを閲覧する〜</h3>
    </div>
    
    <div class="heading section">
      <a name="sub_02-3"></a>
      <h3 class="hdg-type-3" align="left">ルート一覧</h3>
    </div>

    <p align="left"> 投稿されたルート一覧はこちらのページからご覧いただけます。</p>
    <p align="left"></p>

    <img src="/img/howtouse/pc_rote1.PNG" alt="Divers Map（ダイバーズマップ）の使い方〜PC版">

    <p align="left">投稿の詳細を閲覧する場合は、閲覧したい投稿をタップしてください。</p>

    <img src="/img/howtouse/pc_rote3.PNG" alt="Divers Map（ダイバーズマップ）の使い方〜PC版">

    <div class="heading section">
      <a name="sub_03-2"></a>
      <h3 class="hdg-type-3" align="left">検索・ソート機能</h3>
    </div>
    <p align="left">DiversMapには検索・ソート機能があります。赤枠のボタンを押してください。</p>
    <img src="/img/howtouse/pc_serch1.PNG" alt="Divers Map（ダイバーズマップ）の使い方〜スマホ版">
    <p align="left">出発地や目的地を入力し、並び替えたい順番を選び、検索ボタンを押します。</p>
    <img src="/img/howtouse/pc_serch2.PNG" alt="Divers Map（ダイバーズマップ）の使い方〜スマホ版">
    <p align="left">検索のワードに当てはまる投稿を並び替えられた状態で表示することができます。</p>
    <img src="/img/howtouse/pc_serch3.PNG" alt="Divers Map（ダイバーズマップ）の使い方〜スマホ版">

    <div class="heading section">
      <a name="sub_02-4"></a>
      <h3 class="hdg-type-3" align="left">投稿詳細</h3>  
    </div>

    <p align="left">投稿詳細のページでは、経路、距離、所要時間、投稿日時、ルートの説明がご覧いただけます。</p>
    <p align="left">また、Googleマップでより詳しい経路をご覧になる際は、「GoogleMapでこのルートを見る」のボタンをタップしてください。</p>

    <img src="/img/howtouse/pc_postdetails.PNG" alt="Divers Map（ダイバーズマップ）の使い方〜PC版">

    <div class="heading section">
      <a name="sub_02-5"></a>
      <h3 class="hdg-type-3" align="left">Googleマップへ</h3>
    </div>

    <p align="left">投稿したルートがGoogleマップからご覧いただけます。</p>

    <img src="/img/howtouse/pc_google.PNG" alt="Divers Map（ダイバーズマップ）の使い方〜PC版">

    <div class="heading section">
      <a name="sub_02-2_main"></a>
      <h3 class="hdg-type-3" align="left">〜ルートを投稿する〜</h3>
    </div>

    <p align="left">ルートを投稿する際は、ルート一覧のページから「ルートを投稿する」ボタンを押します。</p>
    <div class="new_link">
      <p align="left">※ルートの投稿には、ログインが必要になります。ログインしていない場合は、新規登録画面またはログイン画面に移行します。<a href="#sub_02-1_sub" >新規登録・ログインの仕方はこちら</a>
    </div>
   
    <img src="/img/howtouse/pc_rote_new2.PNG" alt="Divers Map（ダイバーズマップ）の使い方〜PC版">

    <div class="heading section">
      <a name="sub_02-6"></a>
      <h3 class="hdg-type-3" align="left">ルートの投稿</h3>
    </div>

    <p align="left">出発地と目的地をそれぞれ入力すると、経路が表示されます。</p>

    <img src="/img/howtouse/pc_newpost.PNG" alt="Divers Map（ダイバーズマップ）の使い方〜PC版">

    <p align="left">経路に触れると、白い丸が現れるので、こちらをドラッグして、投稿したい経路になるように編集してください。</p>
    <img src="/img/howtouse/pc_newpost3-1.PNG" alt="Divers Map（ダイバーズマップ）の使い方〜PC版">

    <p align="left">投稿したい経路に編集できたら、任意で説明も追記していただき、「投稿」のボタンを押して投稿完了です。</p>
    <img src="/img/howtouse/pc_newpost4.PNG" alt="Divers Map（ダイバーズマップ）の使い方〜PC版">

    <p align="left">投稿した経路がルート一覧に追加されたことを確認し、投稿した経路をタップする。</p>
    <p align="left">※投稿の閲覧の仕方は本ページに別で用意してありますので、そちらをご参照ください。</p>

    <img src="/img/howtouse/pc_rote_new3.PNG" alt="Divers Map（ダイバーズマップ）の使い方〜PC版">

    <div class="heading section">
      <a name="sub_02-1"></a>
      <a name="sub_02-1_sub"></a>
      <h3 class="hdg-type-3">新規登録画面(※ルートの投稿には、ログインが必要になります。ログインしていない場合は、新規登録する必要があります。)</h3>
    </div>

    <p>新規で登録するユーザー名、パスワードを入力します。</p>
    <p>入力完了後、登録ボタンを押すと、ログイン画面に移り変わります。</p>

    <img src="/img/howtouse/pc_new.PNG" alt="Divers Map（ダイバーズマップ）の使い方〜PC版">

    <div class="heading section">
      <a name="sub_02-2"></a>
      <h3 class="hdg-type-3" align="left">ログイン画面</h3>
    </div>

    <p align="left">登録したユーザー名、パスワードを入力し、ログインボタンを押します。</p>

    <img src="/img/howtouse/pc_login.PNG" alt="Divers Map（ダイバーズマップ）の使い方〜PC版">
    
    <div class="heading section">
      <a name="sub_03"></a>
      <h2 class="hdg-type-3" align="center">まとめ</h2>
    </div>

    <p align="center">以上、Divers Mapの使い方をご紹介しました。</p>
    <p align="center">使い方をマスターして、より多くの投稿をしていくことで、より便利な地図になっていきます。</p>
    <p align="center">Divers Mapを使いこなして、便利で安心安全な暮らしをお楽しみください。</p>
  </div>
</div>

<a class="pagetop" href="#"><div class="pagetop__arrow"></div></a>

<?php include("components/footer.php"); ?>