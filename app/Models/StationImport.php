<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StationImport extends Model
{
    protected $connection = 'mysql2';
    protected $table='stations';
}
