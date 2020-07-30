<?php
if (!isset($_COOKIE['is_login'])) {
	echo "閲覧が許可されていません。<br>";
	echo "<a href='./login.html'>ログイン画面</a>に戻ってログインしてください";
	exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>シークレットページ</title>
</head>
<body>
<h1>ようこそ</h1>
<h2><?= $_COOKIE['username'] ?>さんこんにちは</h2>

</body>
</html>