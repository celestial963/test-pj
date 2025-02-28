<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<table border="1">
    <tr>
        <th>น้ำทัน</th>
        <th>เฉลี่ย</th>
        <th>สูงสุด</th>
        <th>ต่ำสุด</th>
    </tr>
    <?php foreach ($stats as $stat): ?>
        <tr>
            <td><?= esc($stat['ptt_product']) ?></td>
            <td><?= number_format($stat['avg_price'], 2) ?></td>
            <td><?= number_format($stat['max_price'], 2) ?></td>
            <td><?= number_format($stat['min_price'], 2) ?></td>
        </tr>
    <?php endforeach; ?>
</table>
<br>
<a href="<?= site_url('ptt') ?>">กลับหน้า ptt</a>
</body>
</html>