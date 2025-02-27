<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<h1>จาก api ครับ</h1>

    <?php if (!empty($oilData) && isset($oilData['response']['stations'])): ?>
        <?php foreach ($oilData['response']['stations'] as $stationName => $stationData): ?>
            <h3>ชื่อปั๊ม <?= esc($stationName) ?></h3>
            <table border="1">
                <tr>
                    <th>ประเภทน้ำมัน</th>
                    <th>ราคา (บาท/ลิตร)</th>
                </tr>
                <?php foreach ($stationData as $fuelType => $fuelInfo): ?>
                    <tr>
                        <td><?= esc($fuelInfo['name']) ?></td>
                        <td><?= esc($fuelInfo['price']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <br>
        <?php endforeach; ?>
    <?php else: ?>
        <p>ไม่ได้</p>
    <?php endif; ?>

</body>
</html>
