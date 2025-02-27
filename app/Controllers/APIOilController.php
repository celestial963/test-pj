<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class APIOilController extends Controller
{
    public function index()
    {
        $apiUrl = "https://api.chnwt.dev/thai-oil-api/latest";

        $response = file_get_contents($apiUrl);

        if ($response) {
            $data = json_decode($response, true);
            return view('api_oil_price', ['oilData' => $data]);
        } else {
            return view('api_oil_price', ['oilData' => []]);
        }
    }
}
