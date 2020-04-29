<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BestBuyImport extends Model
{
    protected $connection = 'mysql2';
    protected $table='best_buy';
}
