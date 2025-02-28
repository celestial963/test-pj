<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<h2>ราคาน้ำมันวันที่ <?= date('d/m/Y') ?></h2>

<form action="<?= site_url('ptt/saveAllOilPrices') ?>" method="post">
    <table border="1">
        <thead>
            <tr>
                <th>วันที่</th>
                <th>ชื่อน้ำมัน</th>
                <th>ราคา</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($oilData as $fuel): ?>
                <tr>
                    <td><?= htmlspecialchars($fuel->PRICE_DATE) ?></td>
                    <td><?= htmlspecialchars($fuel->PRODUCT) ?></td>
                    <td><?= htmlspecialchars($fuel->PRICE) ?></td>
                    <input type="hidden" name="date[]" value="<?= htmlspecialchars($fuel->PRICE_DATE) ?>">
                    <input type="hidden" name="product[]" value="<?= htmlspecialchars($fuel->PRODUCT) ?>">
                    <input type="hidden" name="price[]" value="<?= htmlspecialchars($fuel->PRICE) ?>">
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <button type="submit" >ดูสถิติราคา</button>
</form>

</body>
</html>
