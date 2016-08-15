<?php

namespace Thirty98\Models;

use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    protected $table = 'fees';
    protected $primaryKey = 'id';

    public $timestamps = false;
}