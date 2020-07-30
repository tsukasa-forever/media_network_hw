<!DOCTYPE html>
<html lang="ja">
<head>
    <meta http-equiv="content-type" charset="utf-8">
    <title>掲示板</title>
</head>
<body>
<header style="margin-bottom: 40px">
    <h1>掲示板</h1>
</header>

<div>
    <b>投稿フォーム</b>
    <form method="post" action="./post.php">
        名前:<input type="text" name="name"><br>
        投稿内容:<br>
        <textarea name="content" rows="5"></textarea><br>
        <input type="submit" value="送信">
    </form>
</div>
<hr>

<?php
if (!is_file("./log.csv")): ?>
<p>誰も投稿していません</p>
<?php else: ?>

<?php
//    $fp = fopen("./log.csv", "r");
//    flock($fp, LOCK_SH);
//    $count = 1;
//    while ($line = fgets($fp)):
//        $content = explode(",", $line);
//
//        if (count($content) != 3) {
//            continue;
//        }  ?>
<!--    <p>-->
<!--        --><?//= $count ?><!-- <strong>名前: --><?//= $content[0] ?><!--</strong> 投稿日時 <time>--><?//= $content[1] ?><!--</time><br>-->
<!--        --><?//= $content[2] ?>
<!--        <hr>-->
<!--    </p>-->
<?php //$count++; endwhile; ?>

<?php
    $fp = fopen("./log.csv", "r");
    flock($fp, LOCK_SH);
    $lines = [];
    while ($content = fgetcsv($fp)) {
        if (count($content) != 3) {
            continue;
        }
        array_unshift($lines, $content);
    }
    foreach ($lines as $index => $content): ?>
        <p>
            <?= $index + 1 ?> <strong>名前: <?= $content[0] ?></strong> 投稿日時 <time><?= $content[1] ?></time><br>
            <?= $content[2] ?>
        </p>
        <hr>
<?php endforeach; ?>
<?php flock($fp, LOCK_UN); fclose($fp); endif; ?>


<p>
    <a href="./result.php" target="_self">アンケート集計結果に戻る</a><br>
    <a href="./form.php" target="_self">フォームに戻る</a>
</p>

</body>
</html>
