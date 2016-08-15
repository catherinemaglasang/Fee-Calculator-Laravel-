<?php

namespace Thirty98\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = "cities";
    protected $hidden = ['id', 'county_id'];
}
