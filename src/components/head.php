<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/semantic-ui@2.4.2/dist/semantic.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/hamburger.css">
</head>

<body <?php if(isset($bgColor) && $bgColor) echo 'class="body-bg"'; ?>>
    <div class="ui secondary menu stackable">
        <img class="item header logo-header" src="/img/logo.png" alt="logo">
        <a class="item" href="/">トップページ</a>
        <a class="item" href="/posts">投稿一覧</a>
        <?php if (is_admin()) echo '<a class="item" href="/admin/dashboard.php">ダッシュボード</a>' ?>
        <div class="right menu">
            <a class="ui item" href="<?= is_loggedin() ? '/logout.php' : '/login.php' ?>"><?= is_loggedin() ? 'ログアウト' : 'ログイン' ?></a>
        </div>
        <div class="hamburger">
            <i id="hamburger-toggle" class="bars icon"></i>
        </div>
    </div>