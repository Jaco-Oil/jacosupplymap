<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TerminalImport extends Model
{
    protected $connection = 'mysql2';
    protected $table='terminals';
}
