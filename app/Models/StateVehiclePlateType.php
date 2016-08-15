<?php

namespace Thirty98\Models;

use Illuminate\Database\Eloquent\Model;

class StateVehiclePlateType extends Model
{
    protected $table = 'state_vehicle_plate_types';
    protected $primaryKey = 'id';

    public $timestamps = false;
}
