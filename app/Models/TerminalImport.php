<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TerminalImport extends Model
{
    protected $connection = 'sqlsrv';
    protected $table='wfifuel.dbo.vw_WF_Terminal';
//    protected $table='wfifuel.bbm.vBestBuyMapTerminal';
}
