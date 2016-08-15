<?php

namespace Thirty98\API\General\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class CityList extends Eloquent
{
    // Laravel auto update timestamp feature.
    public $timestamps = false;

    // Set database for this model.
    protected $table = 'city_list';

    // Set primary key.
    protected $primaryKey = 'id';

    // Set fillable fields.
    protected $fillable = [];

}

// EOF