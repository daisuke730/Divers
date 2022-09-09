<h1>・DBの作成</h1><br>
<h2>・DBを作成する。</h2><br>
「Database name」に「dec_todo」を入力する。<br>
「utf8mb4_unicode_ci」を選択→「作成」をクリックする。<br>
正常に作成されると，画面左側に作成したDB名が表示される。<br>
<h1>・テーブルの作成</h1><br>
<h2>・テーブルを作成する。</h2><br>
1つ目のテーブルは、名前欄に「todo_table」を入力する。<br>
カラム数を「5」に設定する。<br>
2つ目のテーブルは、名前欄に「users_table」を入力する。<br>
カラム数を「7」に設定する。<br>

<h2>テーブル名：todo_table</h2>

![image](https://user-images.githubusercontent.com/89437189/188614800-35fa60da-372c-4ed4-ad4d-86c0541d7f19.png)

<h2>テーブル名：users_table</h2>

![image](https://user-images.githubusercontent.com/89437189/188614693-8aa6a065-4881-4eb8-ae90-a2230c6d92f6.png)




<h1>・XAMPP環境構築</h1><br>
<h2>ダウンロード</h2><br>
下記URLにアクセスする．<br>
https://www.apachefriends.org/jp/download.html<br>
最新版をインストールすること。<br>
↓アクセス画面<br>
![image](https://user-images.githubusercontent.com/89437189/189385531-f969b870-8c26-48f0-b77e-ad499e9a9804.png)

Macの人は下記からダウンロード．<br>
![image](https://user-images.githubusercontent.com/89437189/189385743-7a1623e4-0c87-4f3f-8ee1-0238644eff0a.png)

Windowsの人は下記からダウンロード．<br>
![image](https://user-images.githubusercontent.com/89437189/189385882-5a099cc1-c139-4aed-a0fc-46d40ac46e08.png)

インストール<br>
ダウンロードしたらインストールを進める．<br>
![image](https://user-images.githubusercontent.com/89437189/189386004-2870d51e-531c-48c9-9bfa-8b775bc6da1f.png)

動作確認（サーバ起動）<br>
インストールが済んだらアプリケーションを立ち上げる．<br>
Macの人は以下のようにサーバを起動させる．<br>
![image](https://user-images.githubusercontent.com/89437189/189386150-a9515933-b297-420e-acb6-c503c1b4018c.png)

Windowsの人は以下の画面．<br>
![image](https://user-images.githubusercontent.com/89437189/189386225-03371dcd-fc38-45c3-90f6-836d2a86164d.png)

動作確認（画面表示）<br>
アプリケーションサーバ動作確認<br>
ブラウザでhttps://localhost/にアクセスして下記画面が表示されればOK．<br>
![image](https://user-images.githubusercontent.com/89437189/189386400-1b9e132b-2daf-4466-95c8-564db8a02171.png)

DBサーバ動作確認<br>
ブラウザでhttps://localhost/phpmyadminにアクセスして下記画面が表示されればOK．<br>
![image](https://user-images.githubusercontent.com/89437189/189386490-b7e8c010-d951-4e13-95cc-bffb5b7867b8.png)

まとめ<br>
下記3点が実施できていることを確認しよう！<br>
XAMPPの起動確認<br>
http://localhost/のアクセス確認<br>
http://localhost/phpmyadminのアクセス確認<br>
