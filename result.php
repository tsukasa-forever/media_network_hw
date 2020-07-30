<?php

header("Content-Type: text/html; charset=UTF-8");

// ファイルの読み込み
if ($fp = fopen("./result.csv", "r")) {
    flock($fp, LOCK_SH);

    $count["chicken"] = 0;
    $count["cheeze"] = 0;
    $count["katsu"] = 0;

    $data_count = 0;

    while ($csv_line = fgets($fp)) {
        $data = explode(",", trim($csv_line, "\n"));
        if (count($data) != 3) {
            continue;
        }

        $menu = (string)$data[2];
        if (isset($count[$menu])) {
            $count[$menu] ++;
        }
        $data_count ++;
    }

    flock($fp, LOCK_UN);
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta http-equiv="content-type" charset="utf-8">
    <title>アンケートフォーム</title>
    <style>
        td, th {
            text-align: center;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" ></script>
    <script>
        window.onload = function () {
          var ctx = document.getElementById('myChart').getContext('2d');
          var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
              labels: ['チキン', 'チーズ', 'カツ'],
              datasets: [{
                label: 'アンケート結果',
                data: [<?= $count["chicken"] ?>, <?= $count["cheeze"] ?>, <?= $count["katsu"] ?>],
                backgroundColor: [
                  'rgba(255, 99, 132, 0.2)',
                  'rgba(54, 162, 235, 0.2)',
                  'rgba(255, 206, 86, 0.2)'
                ],
                borderColor: [
                  'rgba(255, 99, 132, 1)',
                  'rgba(54, 162, 235, 1)',
                  'rgba(255, 206, 86, 1)'
                ],
                borderWidth: 1
              }]
            },
            options: {

            }
          });
        };
    </script>
</head>
<body>
<?php if (is_readable("./result.csv")): ?>
<header>
    <h1>みんなの好きなメニュー</h1>
    現時点でのアンケート結果です。
</header>
<table>
    <tr>
        <th>
            商品名
        </th>
        <th>
            得票数
        </th>
        <th>
            割合
        </th>
    </tr>
    <tr>
        <td>
            チキンおろしだれ
        </td>
        <td>
            <?= $count["chicken"] ?>
        </td>
        <td>
            <?= sprintf("%d",  $count["chicken"]/$data_count * 100) ?> %
        </td>
    </tr>
    <tr>
        <td>
            クリームチーズメンチカツ
        </td>
        <td>
            <?= $count["cheeze"] ?>
        </td>
        <td>
            <?= sprintf("%d",  $count["cheeze"]/$data_count * 100) ?> %
        </td>
    </tr>
    <tr>
        <td>
            カツカレー
        </td>
        <td>
            <?= $count["katsu"] ?>
        </td>
        <td>
            <?= sprintf("%d",  $count["katsu"]/$data_count * 100) ?> %
        </td>
    </tr>
</table>
<div style="width: 600px;margin-top: 50px">
    <canvas id="myChart"></canvas>
</div>
<p>
    <a href="./form.php" target="_self">
        フォームに戻る
    </a>
</p>
<?php else : ?>
<p>CSVファイルがありません。前回の講義の実習が完了しているか確認してください</p>

<?php endif; ?>
</body>
</html>
