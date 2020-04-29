<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BestBuy extends Model
{
    protected $table = 'best_buy';
    public $timestamps = false;

    public function station()
    {
        return $this->belongsTo('App\Models\Station', 'inner_id', 'station_inner_id');
    }

    public function terminal()
    {
        return $this->belongsTo('App\Models\Terminal', 'inner_id', 'terminal_inner_id');
    }

}
