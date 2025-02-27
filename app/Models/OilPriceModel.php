<?php

namespace App\Models;

use CodeIgniter\Model;

class OilPriceModel extends Model
{
    protected $table      = 'oil_prices';
    protected $primaryKey = 'id';
    protected $allowedFields = ['date', 'oil_type', 'price'];

    public function getDates()
    {
        return $this->select('date')->distinct()->findAll();
    }

    public function getPricesByDate($date)
    {
        return $this->where('date', $date)->findAll();
    }
    public function getPriceStatistics()
    {
        return $this->select('oil_type, AVG(price) AS avg_price, MAX(price) AS max_price, MIN(price) AS min_price')
            ->groupBy('oil_type')
            ->findAll();
    }
}
//ใช้คำสั่งนี้สร้างตารางใน mysql ครับ
// CREATE TABLE `oil_prices` (
//     `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//     `date` DATE NOT NULL,
//     `oil_type` VARCHAR(255) NOT NULL,
//     `price` DECIMAL(10,2) NOT NULL
// );
