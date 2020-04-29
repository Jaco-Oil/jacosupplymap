<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BestBuyImport extends Model
{
    protected $connection = 'sqlsrv';
    protected $table='wfifuel.bbm.vBestBuyMapData';
}
