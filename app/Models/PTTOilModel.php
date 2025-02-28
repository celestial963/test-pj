<?php

namespace App\Models;

use CodeIgniter\Model;

class PTTOilModel extends Model
{
    protected $table = 'ptt_oil_prices';
    protected $primaryKey = 'id';
    protected $allowedFields = ['ptt_date', 'ptt_product', 'ptt_price'];
    protected $useTimestamps = false;

    public function getPriceStatistics()
    {
        return $this->select('ptt_product, AVG(ptt_price) AS avg_price, MAX(ptt_price) AS max_price, MIN(ptt_price) AS min_price')
            ->groupBy('ptt_product')
            ->findAll();
    }
}
// CREATE TABLE ptt_oil_prices (
//     id INT AUTO_INCREMENT PRIMARY KEY,
//     ptt_date DATE NOT NULL,
//     ptt_product VARCHAR(100) NOT NULL,
//     ptt_price DECIMAL(10,2) NOT NULL
// );