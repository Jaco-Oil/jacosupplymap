<?php

namespace App\Console\Commands;

use App\Http\Controllers\Api\StationController;
use App\Http\Controllers\Api\TerminalController;
use App\Models\BestBuy;
use App\Models\BestBuyImport;
use App\Models\Station;
use App\Models\StationImport;
use App\Models\Terminal;
use App\Models\TerminalImport;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class importData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ext:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import new data and replace exists';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->importTerminal();
        $this->importStations();
        $this->importBestBuy();

        // save json

        $stationsAPI = new StationController();
        $stations = $stationsAPI->getAll();

        $terminalsAPI = new TerminalController();
        $terminals = $terminalsAPI->getAll();

        Storage::disk('public')->put('stations.json', json_encode($stations));
        Storage::disk('public')->put('terminals.json', json_encode($terminals));

    }

    private function importBestBuy()
    {
//        $best_buy_tmp = BestBuyImport::where('effectiveDate', '2020-04-28')->get();
        $best_buy_tmp = BestBuyImport::where('effectiveDate', 'cast(getDate() as Date')->get();

        if ($best_buy_tmp->count()) {
            $best_buy = BestBuy::truncate();
            foreach ($best_buy_tmp as $row) {
                $best_buy = new BestBuy();
                $best_buy->station_inner_id = $row->stationID;
                $best_buy->name = $this->trim($row->name);
                $best_buy->rank_id = $row->rankID;
                $best_buy->terminal_inner_id = $row->terminalID;
                $best_buy->alternate_terminal_name = $this->trim($row->AlternateTerminalName);
                $best_buy->supplier_id = $row->supplierID;
                $best_buy->alternate_supplier_name = $this->trim($row->AlternateSupplierName);
                $best_buy->carrier_id = $row->carrierID;
                $best_buy->effective_price = $row->effectivePrice;
                $best_buy->supplier_discount = $row->supplierDiscount;
                $best_buy->supplier_ec = $row->supplierEC;
                $best_buy->net_cost = $row->netCost;
                $best_buy->carrier_gas_freight = $row->carrierGasFreight;
                $best_buy->effective_date = $row->effectiveDate;
                $best_buy->effective_time = $row->effectiveTime;
                $best_buy->carrier_alternate_name = $this->trim($row->carrierAlternateName);
                $best_buy->direct_link = $row->directLink;
                $best_buy->fuel_tax = $row->fuelTax;
                $best_buy->product_grade_name = $this->trim($row->productGradeName);
                $best_buy->product_grade_id = $row->productGradeID;
                $best_buy->grade_enforced = $this->trim($row->gradeEnforced);
                $best_buy->epa_schedule_name = $this->trim($row->epaScheduleName);
                $best_buy->epa_date_begin = $row->epaDateBegin;
                $best_buy->epa_date_end = $row->epaDateEnd;
                $best_buy->epa_district_name = $this->trim($row->epaDistrictName);
                $best_buy->product_order = $row->productOrder;
                $best_buy->product_code = $this->trim($row->ProductCode);
                $best_buy->product_alternate_name = $this->trim($row->productAlternateName);
                $best_buy->carrier_surcharge_amt = $row->carrierSurchargeAmt;
                $best_buy->ust_fee = $row->ustFee;
                $best_buy->save();
            }
        }
    }


    private function importStations()
    {
        $stations_tmp = StationImport::all();

        if ($stations_tmp->count()) {
            foreach ($stations_tmp as $row) {
                $station = Station::updateOrCreate(
                  ['inner_id' => $row->stationID],
                  [
                    'name' => $this->trim($row->StationName),
                    'address' => $this->trim($row->StationAddress),
                    'city' => $this->trim($row->StationCity),
                    'state' => $this->trim($row->StationState),
                    'zip_code' => $row->StationZipCode,
                    'ownership_name' => $this->trim($row->ownershipName),
                    'operator' => $this->trim($row->StationOperator),
                    'email' => $this->trim($row->StationEmail),
                    'phone' => $this->trim($row->StationPhone),
                    'mobile' => $this->trim($row->StationMobile),
                    'supervisor_name' => $this->trim($row->SupervisorName),
                    'partnership' => $this->trim($row->Partnership),
                    'sms_email' => $this->trim($row->SMSEmail),
                    'sms_email2' => $this->trim($row->SMSEmail2),
                    'sms_email3' => $this->trim($row->SMSEmail3)
                  ]
                );
            }

        }
    }

    private function importTerminal()
    {
        $terminals_tmp = TerminalImport::where('EntityName', 'JACO')->get();

        if ($terminals_tmp->count()) {
            $terminals = Terminal::truncate();
            foreach ($terminals_tmp as $row) {
                $terminal = new Terminal();
                $terminal->inner_id = $row->TerminalID;
                $terminal->name = $this->trim($row->TerminalName);
                $terminal->latitude = $row->term_Latitude;
                $terminal->longitude = $row->term_Longitude;
                $terminal->type_id = $row->terminalTypeID;
                $terminal->address1 = $this->trim($row->Address1);
                $terminal->address2 = $this->trim($row->Address2);
                $terminal->city = $this->trim($row->City);
                $terminal->county = $this->trim($row->County);
                $terminal->state = $row->State;
                $terminal->zip_code = $row->ZipCode;
                $terminal->website = $row->terminalWebsite;
                $terminal->cadec_terminal_id = $row->CadecTerminalID;
                $terminal->status = $row->terminalStatus;
                $terminal->save();
            }
        }
    }

    private function trim($value)
    {
        return trim(str_replace('  ', ' ', $value));
    }
}
