<?php

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: ./view.php");
}

if (strlen($_POST["name"]) != 0) {
    $name = htmlspecialchars($_POST['name']);
} else {
    $name = "名無しさん";
}

date_default_timezone_set("Asia/Tokyo");
$time = date("Y/m/j H:i:s");
$content = htmlspecialchars($_POST["content"]);
$content = preg_replace("/\r\n|\n|\r/", "<br>", $content); // 追加課題1

$fp = fopen("./log.csv", "a");
flock($fp, LOCK_EX);

//$line = '"' . $name . '","' . $time . '","' . $content . '"'."\n";
//fputs($fp, $line);

$data = [$name, $time, $content];
fputcsv($fp, $data);

flock($fp, LOCK_UN);
fclose($fp);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta http-equiv="content-type" charset="utf-8">
    <title>投稿内容確認</title>
</head>
<body>
<header style="margin-bottom: 40px">
    <h1>投稿内容</h1>
</header>

<p>
    <b>名前: <?= $name ?></b> 投稿日時 <time><?= $time ?></time><br>
    <?= $content ?>
</p>

<hr>

<p>
    <a href="./view.php" target="_self">掲示板に戻る</a><br>
    <a href="./index.html" target="_self">トップに戻る</a>
</p>

</body>
</html>