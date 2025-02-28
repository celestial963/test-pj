<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <h2>เลือกวันที่</h2>
    <form action="<?= base_url('ptt/getOilPrice') ?>" method="post">
        <label for="date">เลือกวันที่:</label>
        <input type="date" id="date" name="date" required>
        <button type="submit">ดูราคา</button>
    </form>
</body>
</html>
