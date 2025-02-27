<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

    <h2>ราคาน้ำมันวันที่ <?= esc($prices[0]['date'] ?? 'ไม่พบ') ?></h2>

    <table border="1">
        <thead>
            <tr>
                <th>ชนิด</th>
                <th>ราคา</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($prices as $price) : ?>
                <tr>
                    <td><?= esc($price['oil_type']) ?></td>
                    <td><?= esc($price['price']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>
