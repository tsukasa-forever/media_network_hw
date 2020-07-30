<!DOCTYPE html>
<html lang="ja">
<head>
    <meta http-equiv="content-type" charset="utf-8">
    <title>アンケートフォーム</title>
</head>
<body>
<h1>アンケートフォーム</h1>
以下の項目を入力してください。<br>
<form method="POST" action="./enq.php">
	<table>
		<tr>
			<td>
				氏名
			</td>
			<td>
				<input type="text" name="name" placeholder="山田 太郎">
			</td>
		</tr>
		<tr>
			<td>プログラム/コース</td>
			<td>
				<input type="radio" name="course" value="security" checked>セキュリティ情報学<br>
				<input type="radio" name="course" value="electronic">電子情報学<br>
				<input type="radio" name="course" value="media">メディア情報学<br>
				<input type="radio" name="course" value="management">経営情報学<br>
				<input type="radio" name="course" value="advanced">先端工学基礎課程
			</td>
		</tr>
		<tr>
			<td>生協食堂で一番好きなメニュー</td>
			<td>
				<select name="menu">
					<option value="chicken" selected>チキンおろしだれ</option>
					<option value="cheeze"> クリームチーズメンチカツ</option>
					<option value="katsu">カツカレー</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				<input type="submit" value="送信">
			</td>
		</tr>
	</table>
</form>
<p><small>&copy; copyright 2013 s.kimura</small></p>
</body>
</html>