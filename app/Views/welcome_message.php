<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<p style="font-size:30px;">แบบดึงจาก api ของ ptt ครับ</p>
<button onclick="window.location.href='<?= site_url('ptt') ?>'" style="padding: 30px;font-size:25px">ไปหน้า PTT</button>
    <hr>
    <p>ดูราคาตามโจทย์ ขอใช้จากหน้าเว็บของบางจาก เพราะหาราคาของ ptt ที่ใช้งานได้ไม่เจอจริง ๆ ครับ</p>
    <button onclick="window.location.href='<?= site_url('bangchak') ?>'">ไปหน้าบางจาก</button>
    <hr>
    <p>แบบดึงจาก api ครับ</p>
    <button onclick="window.location.href='<?= site_url('apioilprice') ?>'">ไปหน้าดึงจาก api</button>
</body>
</html>