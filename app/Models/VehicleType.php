<?php

namespace Thirty98\Models;

use Illuminate\Database\Eloquent\Model;

class VehicleType extends Model
{
    protected $table = 'vehicle_types';
    protected $primaryKey = 'id';

    public $timestamps = false;
    
    protected $hidden = ['id'];
}
