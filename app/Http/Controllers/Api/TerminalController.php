<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Station;
use App\Models\Terminal;
use App\Models\BestBuy;

class TerminalController extends Controller
{

    public function getAll(Request $request)
    {
        $data = [];

//        $terminals = Terminal::whereInnerId('1003')->with('bestBuy')->get();
        $terminals = Terminal::whereTypeId('1')->with('bestBuy')->get();


        foreach ($terminals as $terminal) {
            $_station = [];
            $products = [];
            foreach ($terminal->bestBuy as $station) {
                $products[$station->station_inner_id][] =  [
                    "name" => trim($station->product_alternate_name),
                    "carrier_name" => trim($station->carrier_alternate_name),
                    "supplier_name" => trim($station->alternate_supplier_name),
                    "price" => $station->net_cost
                ];


                $_station[$station->station_inner_id] = [
                    "storeId" => $station->station_inner_id,
                    "name" => trim($station->alternate_supplier_name),
                    "carrierName" => trim($station->carrier_alternate_name),
                    "products" => [
                        $products[$station->station_inner_id]
                    ]

                ];
            }

            if(count($_station) > 0) {
                $data[] = [
                    'id' => $terminal->id,
                    'terminalId' => $terminal->inner_id,
                    'name' => trim($terminal->name),
                    'latitude' => $terminal->latitude,
                    'longitude' => $terminal->longitude,
                    'stores' => [
                        $_station
                    ]
                ];
            }

            unset($_station);
            unset($products);

            $data = self::multyarray_unique($data);

        }
        return response()->json($data);
    }

    private static function multyarray_unique($array)
    {
        $result = array_map("unserialize", array_unique(array_map("serialize", $array)));

        foreach ($result as $key => $value)
        {
            if ( is_array($value) )
            {
                $result[$key] = self::multyarray_unique($value);
            }
        }

        return $result;
    }


}
