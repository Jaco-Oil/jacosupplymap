<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StationImport extends Model
{
    protected $connection = 'sqlsrv';
    protected $table='gasstation.bbm.vGasStationInfo';
}
