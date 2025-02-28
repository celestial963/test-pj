<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use SimpleXMLElement;

use App\Models\PTTOilModel;


class PTTController extends Controller
{
    public function index()
    {
        return view('ptt_oil_price');
    }

    public function getOilPrice()
    {
        $date = $this->request->getPost('date');
        if (!$date) {
            return "no date";
        }

        list($YYYY, $MM, $DD) = explode("-", $date);

        $url = "https://stg-orapiweb.pttor.com/oilservice/OilPrice.asmx";
        
        $soapRequest = <<<XML
        <?xml version="1.0" encoding="utf-8"?>
        <soap12:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
                         xmlns:xsd="http://www.w3.org/2001/XMLSchema" 
                         xmlns:soap12="http://www.w3.org/2003/05/soap-envelope">
          <soap12:Body>
            <GetOilPrice xmlns="http://www.pttor.com">
              <Language>TH</Language>
              <DD>{$DD}</DD>
              <MM>{$MM}</MM>
              <YYYY>{$YYYY}</YYYY>
            </GetOilPrice>
          </soap12:Body>
        </soap12:Envelope>
        XML;

        $headers = [
            "Content-Type: application/soap+xml; charset=utf-8",
            "Content-Length: " . strlen($soapRequest),
            "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64)",
            "Accept: application/xml",
            "Referer: https://stg-orapiweb.pttor.com/"
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $soapRequest);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode != 200) {
            return "code $httpCode\nres $response";
        }

        if (!$response) {
            return "er ไม่ได้ข้อมูล API";
        }

        try {
            $decodedResponse = html_entity_decode($response);

            $xml = new SimpleXMLElement($decodedResponse);

            $namespaces = $xml->getNamespaces(true);
            $body = $xml->children($namespaces['soap'])->Body;
            $getOilPriceResponse = $body->children($namespaces[''])->GetOilPriceResponse;
            $getOilPriceResult = $getOilPriceResponse->children($namespaces[''])->GetOilPriceResult;
            $pttorDs = $getOilPriceResult->children($namespaces[''])->PTTOR_DS;

            if (empty($pttorDs)) {
                return "er GetOilPriceResult ไม่มีข้อมูล";
            }

            return view('ptt_oil_table', ['oilData' => $pttorDs->FUEL]);
        } catch (\Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }
    public function saveAllOilPrices()
{
    $dates = $this->request->getPost('date');
    $products = $this->request->getPost('product');
    $prices = $this->request->getPost('price');

    $model = new PTTOilModel();

    foreach ($dates as $index => $date) {
        $model->save([
            'ptt_date' => date('Y-m-d', strtotime($date)),
            'ptt_product' => $products[$index],
            'ptt_price' => $prices[$index]
        ]);
    }

    return redirect()->to('/ptt/stats');
}

    // public function oilPriceSaved()
    // {
    //     return "บันทึกข้อมูลราคาน้ำมันเรียบร้อยแล้ว";
    // }
    public function stats(){
        $model = new PTTOilModel();
        $stats = $model->getPriceStatistics();
        return view('ptt_stats',['stats' => $stats]);
    }
}
