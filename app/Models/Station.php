<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    protected $table = 'stations';

    public function bestBuy()
    {
        return $this->hasMany('App\Models\BestBuy', 'station_inner_id', 'inner_id');
    }
}
