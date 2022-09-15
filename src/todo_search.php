<?php
session_start();
include("functions.php");
check_session_id();

// 検索クエリがあるかを確認
$isExistQuery = isset($_GET['query']) && !empty($_GET['query']);
$query = $isExistQuery ? $_GET['query'] : '';

// クエリがあればデータベースから検索
if ($isExistQuery) {
    $pdo = connect_to_db();
    $sql = 'SELECT * FROM todo_table WHERE todo LIKE :query';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue('query', '%'.$query.'%');
    $status = $stmt->execute();
}
?>

<?php
$title = "DB連携型todoリスト（検索画面）";
include("components/head.php");
?>

<body>
    <fieldset>
        <legend>DB連携型todoリスト（検索画面）</legend>
        <form>
            <input type="search" name="query" placeholder="ここに地点名などを入力" value="<?= $query ?>">
            <button>検索</button>
        </form>
        <?php
            if($isExistQuery && $status) {
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                echo '<p>検索結果：' . count($result) . '件</p>';
                foreach ($result as $record) {
                    echo "<div><a href=\"{$record['url']}\" target=\"_blank\" rel=\"noopener noreferrer\">{$record['todo']}</a></div>";
                }
            }
        ?>
    </fieldset>
</body>

<?php include("components/footer.php"); ?>