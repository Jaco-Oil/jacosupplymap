<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Terminal extends Model
{
    protected $table = 'terminals';
    public $timestamps = false;

    protected $guarded = [];

    public function bestBuy()
    {
        return $this->hasMany('App\Models\BestBuy', 'terminal_inner_id', 'inner_id');
    }
}
