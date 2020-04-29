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
        $best_buy_tmp = BestBuyImport::where('effectiveDate', 'cast(getDate() as Date')->get();

        return view("backend.dashboard");
    }
}
