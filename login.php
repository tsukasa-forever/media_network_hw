<?php

$id = htmlspecialchars($_POST['id']);
$password = htmlspecialchars($_POST['password']);
$filename = "./list.csv";
$dest = "./secret.php";

if (strcmp($id, "") == 0 || strcmp($password, "") == 0) {
	exit("エラー:IDまたはパスワードが空白です");
}

if (!file_exists($filename)) {
	exit("誰も登録していません");
}

$fp = fopen($filename, "r");
flock($fp, LOCK_SH);
$flag = false;

while ($line = fgetcsv($fp)) {
	if (strcmp($line[0], $id) == 0 && strcmp($line[1], hash("md5", $password)) == 0) {
		$flag = true;
		break;
	}
}

flock($fp, LOCK_UN);
fclose($fp);

if ($flag) {
	setcookie("is_login", true, time()+60);
    setcookie("username", $id, time()+60);
	header("HTTP/1.1 301 Moved Permanently");
	header("Location: $dest");
	exit;
}

else {
	exit("IDまたはパスワードが違います");
}
?>
