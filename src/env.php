<?php
// 環境変数
// 本番環境の情報は入力しないでください

// データベース
$database = array(
  'host' => 'localhost',
  'port' => 3306,
  'user' => 'root',
  'pass' => '',
  'db-name' => 'diversmap',
);

// APIKeys
$keys = array(
  'google-api-server' => '',
  'google-api-client' => '',
);

// デプロイ
$deploy = array(
  'key' => '',
  'path' => '/var/www/html',
  'branch' => 'release',
);

// env.php外から環境変数を取得する関数
function get_env($key) {
  global $database;
  global $deploy;
  global $keys;

  $env_list = array(
    'database' => $database,
    'deploy' => $deploy,
    'api-key' => $keys,
  );

  return $env_list[$key];
}
?>