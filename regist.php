<?php
$id = htmlspecialchars($_POST['id']);
$password = htmlspecialchars($_POST['password']);
$filename = "./list.csv";

if (strcmp($id, "") == 0 || strcmp($password, "") == 0) {
    exit("エラー:IDかパスワードが空白です");
}

if (!file_exists($filename)) {
    touch($filename);
}

$fp = fopen($filename, "r+");
flock($fp, LOCK_EX);
$flag = false;
while ($line = fgetcsv($fp)) {
    if (strcmp($line[0], $id) == 0) {
        $flag = true;
        break;
    }
}

if ($flag) {
    exit("すでに登録されています");
} else {
    fputcsv($fp, [$id, hash("md5", $password)]);
}

flock($fp, LOCK_UN);
fclose($fp);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>登録完了</title>
</head>
<body>

<header>
    <h1>登録が完了しました</h1>
</header>

ユーザー名: <?= $id ?><br>
パスワード: <?= $password ?><br>
<a href="./regist.html">登録画面に戻る</a>


</body>
</html>









