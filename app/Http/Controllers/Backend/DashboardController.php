<?php

namespace App\Http\Controllers\Backend;

use App\Models\TerminalImport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $t = TerminalImport::all();

        dd($t);



        return view("backend.dashboard");
    }
}
