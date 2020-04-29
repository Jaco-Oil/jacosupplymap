<?php

namespace App\Http\Controllers\Backend;

use App\Models\BestBuyImport;
use App\Models\StationImport;
use App\Models\TerminalImport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {

        $terminals_tmp = TerminalImport::where('EntityName', 'JACO')->get();
        $stations_tmp = StationImport::all();
        $best_buy_tmp = BestBuyImport::where('effectiveDate', '2020-04-28')->get();

        dd($terminals_tmp, $stations_tmp, $best_buy_tmp);


        $terminals_tmp = DB::connection('sqlsrv')
          ->table('wfifuel.dbo.vw_WF_Terminal')
          ->select(DB::raw('TOP (1000) [TerminalID]
                  ,[TerminalName]
                  ,[terminalTypeID]
                  ,[terminalTypeName]
                  ,[entityID]
                  ,[entityName]
                  ,[factorTerminalID]
                  ,[AlternateTerminalName]
                  ,[Address1]
                  ,[Address2]
                  ,[City]
                  ,[County]
                  ,[State]
                  ,[stateName]
                  ,[ZipCode]
                  ,[terminalWebsite]
                  ,[entityNotes]
                  ,[petroTerminalID]
                  ,[CadecTerminalID]
                  ,[term_Latitude]
                  ,[term_Longitude]
                  ,[terminalStatus]'))
          ->get();

//	dd($terminals_tmp);
        $best_buy_tmp = DB::connection('sqlsrv')
          ->table('wfifuel.bbm.vBestBuyMapData')
          ->select(DB::raw('[stationID]
                  ,[name]
                  ,[rankID]
                  ,[terminalID]
                  ,[AlternateTerminalName]
                  ,[supplierID]
                  ,[AlternateSupplierName]
                  ,[carrierID]
                  ,[effectivePrice]
                  ,[supplierDiscount]
                  ,[supplierEC]
                  ,[netCost]
                  ,[carrierGasFreight]
                  ,[effectiveDate]
                  ,[effectiveTime]
                  ,[carrierAlternateName]
                  ,[directLink]
                  ,[fuelTax]
                  ,[productGradeName]
                  ,[productGradeID]
                  ,[gradeEnforced]
                  ,[epaScheduleName]
                  ,[epaDateBegin]
                  ,[epaDateEnd]
                  ,[epaDistrictName]
                  ,[productOrder]
                  ,[ProductCode]
                  ,[productAlternateName]
                  ,[carrierSurchargeAmt]
                  ,[ustFee]'))
//          ->where('effectiveDate', 'cast(getDate() as Date')
          ->where('effectiveDate', '2020-04-28')


          ->get();

        $stations_tmp = DB::connection('sqlsrv')
          ->table('gasstation.bbm.vGasStationInfo')
          ->select(DB::raw('TOP (1000) [stationID]
                          ,[StationName]
                          ,[StationAddress]
                          ,[StationCity]
                          ,[StationState]
                          ,[StationZipCode]
                          ,[ownershipName]
                          ,[StationOperator]
                          ,[StationEmail]
                          ,[StationPhone]
                          ,[StationMobile]
                          ,[SupervisorName]
                          ,[Partnership]
                          ,[SMSEmail]
                          ,[SMSEmail2]
                          ,[SMSEmail3]'))
          ->get();

        dd($best_buy_tmp, $stations_tmp, $terminals_tmp);


        $t = TerminalImport::all();

        $s = StationImport::all();

//        $t = DB::table('terminals')->select(DB::raw('
//        *'))->get();

//        foreach ($t as $tt) {
//            dd($tt->inner_id);
//        }

        dd($best_buy_tmp, $stations_tmp, $terminals_tmp);



        return view("backend.dashboard");
    }
}
