<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    protected $table = 'stations';
    protected $guarded = [];
    public $timestamps = false;

    public function bestBuy()
    {
        return $this->hasMany('App\Models\BestBuy', 'station_inner_id', 'inner_id');
    }
}
