<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Station;
use App\Models\Terminal;
use App\Models\BestBuy;

class StationController extends Controller
{

    public function getAll()
    {
        $data = [];

//        $stations = Station::whereInnerId('3368')->with('bestBuy')->get();
        $stations = Station::with('bestBuy')->get();

        foreach ($stations as $station) {

            $getLast = $station->bestBuy->where('rank_id', 0);
            if (!$getLast->isEmpty()) {
                $last = (object)$this->getLast($getLast);

                $getAlternative = $station
                    ->bestBuy
                    ->where('rank_id', 1)
                    ->where('supplier_id', '<>', $last->supplierId)
                    ->sortBy('net_cost');

                $alternative = (object)$this->getAlternative($getAlternative);


                $data[] = [
                    'id' => $station->id,
                    'stationId' => $station->inner_id,
                    'ownership' => $station->ownership_name,
                    'name' => $station->name,
                    'address' => $station->address,
                    'city' => $station->city,
                    'state' => $station->state,
                    'zip' => $station->zip_code,
                    'phone' => $station->phone,
                    'manager' => $station->operator,
                    'email' => $station->email,
                    'latitude' => $station->latitude,
                    'longitude' => $station->longitude,
                    'stores' => [
                        $last, $alternative
                    ]
                ];

                unset($_stores);

            }
        }

        return response()->json($data);
    }


    private function getAlternative($data)
    {

        foreach ($data as $row) {
            $products[trim($row->product_alternate_name)][] =
                [
                    'name' => trim($row->alternate_supplier_name),
                    'carrier_name' => trim($row->carrier_alternate_name),
                    'terminal_name' => trim($row->alternate_terminal_name),
                    'price' => round(trim($row->ust_fee) + trim($row->carrier_surcharge_amt)+ trim($row->fuel_tax)+ trim($row->carrier_gas_freight)+ trim($row->effective_price), 5)
                ];
        }

        if (isset($products)) {
            $result = [
                'supplierType' => 'alternative',
                'products' => $products
            ];

        } else {
            $result = [];
        }

        return $result;
    }

    private function getLast($data)
    {
        foreach ($data as $row) {
            $supplierType = 'last';
            $supplierName = trim($row->alternate_supplier_name);
            $terminalName = trim($row->alternate_terminal_name);
            $supplierId = $row->supplier_id;
            $carrierName = trim($row->carrier_alternate_name);
            $products[] =
                [
                    'name' => trim($row->product_alternate_name),
                    'price' => round(trim($row->ust_fee) + trim($row->carrier_surcharge_amt)+ trim($row->fuel_tax)+ trim($row->carrier_gas_freight)+ trim($row->effective_price), 5)
                ];
        }

        if (isset($supplierType)) {
            $result = [
                'supplierType' => $supplierType,
                'supplierName' => $supplierName,
                'terminalName' => $terminalName,
                'supplierId' => $supplierId,
                'carrierName' => $carrierName,
                'products' => $products
            ];

        } else {
            $result = [];
        }

        return $result;
    }
}
