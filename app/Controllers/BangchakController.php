<?php

namespace App\Controllers;

use App\Models\OilPriceModel;
use DOMDocument;
use DOMXPath;

class BangchakController extends BaseController
{
    public function fetchToTable()
    {
        $url = 'https://www.bangchak.co.th/th/oilprice/historical';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $html = curl_exec($ch);
        curl_close($ch);

        $dom = new DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($html);
        libxml_clear_errors();

        $xpath = new DOMXPath($dom);
        $table = $xpath->query("//table[contains(@class, 'table--historical-oilprice')]")->item(0);

        if (!$table) {
            return "no table";
        }

        $rows = $table->getElementsByTagName("tr");

        $headers = [];
        foreach ($rows->item(1)->getElementsByTagName("th") as $th) {
            if ($th->hasAttribute("title")) {
                $headers[] = trim($th->getAttribute("title"));
            }
        }

        $oil_prices = [];
        for ($i = 2; $i < $rows->length; $i++) {
            $cols = $rows->item($i)->getElementsByTagName("td");
            $date = trim($rows->item($i)->getElementsByTagName("th")->item(0)->nodeValue);

            foreach ($cols as $index => $col) {
                $oil_prices[] = [
                    'date'     => date('Y-m-d', strtotime(str_replace("/", "-", $date))),
                    'oil_type' => $headers[$index],
                    'price'    => trim($col->nodeValue),
                ];
            }
        }

        $model = new OilPriceModel();
        $model->insertBatch($oil_prices);

        return view("fetch_success");
    }
    public function index()
    {
        return view('bangchak');
    }

    public function price()
    {
        $model = new OilPriceModel();
        $dates = $model->getDates();
        $stats = $model->getPriceStatistics();

        return view('banchak_price', ['dates' => $dates, 'stats' => $stats]);
    }

    public function getPricesByDate()
    {
        $date = $this->request->getPost('date');
        $model = new OilPriceModel();
        $prices = $model->getPricesByDate($date);
        

        return view('bangchak_price_table', ['prices' => $prices]);
    }
}
