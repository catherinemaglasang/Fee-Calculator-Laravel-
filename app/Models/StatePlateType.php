<?php

namespace Thirty98\Models;

use Illuminate\Database\Eloquent\Model;

class StatePlateType extends Model
{
    protected $table = 'state_plate_types';
    protected $primaryKey = 'id';

    public $timestamps = false;
}
