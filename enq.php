<?php
header("Content-Type: text/html; charset=UTF-8");
if (strlen($_POST["name"])) {
    $name = $_POST["name"];
    $course = $_POST["course"];
    $menu = $_POST["menu"];

    $fp = fopen("./result.csv", "a+");
    flock($fp, LOCK_EX);
    $output = join(",", array($name, $course, $menu)) . "\n";
    fputs($fp, $output);
    flock($fp, LOCK_UN);
    fclose($fp);
} else {
    exit("アンケート入力に不備があるようです。<br>アンケート入力画面に戻って再入力をお願いします");
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta http-equiv="content-type" charset="utf-8">
    <title>アンケート受付完了</title>
</head>
<body>
<header>
    <h1>回答ありがとうございます</h1>
    回答内容は以下の通りです。
</header>
<p>
    氏名: <?= $name ?><br>
    プログラム: <?= $course ?><br>
    メニュー: <?= $menu ?>
</p>
<p>
    注意<br>
    プログラム名: <br>
    security(セキュリティ情報学)<br>
    electronic(電子情報学)<br>
    media(メディア情報学)<br>
    management(経営情報学)<br>
    advanced(先端工学基礎課程)
</p>
<p>
    メニュー名: <br>
    chicken(チキンおろしだれ)<br>
    cheeze(クリームチーズメンチカツ)<br>
    katsu(カツカレー)
</p>
<p>
    <a href="./result.php" target="_self">アンケート集計結果に戻る</a><br>
    <a href="./form.php" target="_self">フォームに戻る</a>
</p>

</body>
</html>
