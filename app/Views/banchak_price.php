<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

    <h2>เลือกวันที่ราคาน้ำมัน</h2>
    <form action="<?= site_url('bangchak/getPricesByDate') ?>" method="post">
        <select name="date">
            <?php foreach ($dates as $date) : ?>
                <option value="<?= $date['date'] ?>"><?= $date['date'] ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit">ดูราคา</button>
    </form>
    <table border="1">
    <tr>
        <th>ชนิด</th>
        <th>เฉลี่ย</th>
        <th>สูงสุด</th>
        <th>ต่ำสุด</th>
    </tr>
    <?php foreach ($stats as $stat): ?>
        <tr>
            <td><?= esc($stat['oil_type']) ?></td>
            <td><?= number_format($stat['avg_price'], 2) ?></td>
            <td><?= number_format($stat['max_price'], 2) ?></td>
            <td><?= number_format($stat['min_price'], 2) ?></td>
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>
