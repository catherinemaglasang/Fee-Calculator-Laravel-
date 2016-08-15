<?php

namespace Thirty98\Http\Controllers\Models;

use Illuminate\Database\Eloquent\Model;

class Fees extends Model
{

    // Laravel auto update timestamp feature.
    public $timestamps = true;

    // Set database for this model.
    protected $table = 'fees';

    // Set primary key.
    protected $primaryKey = 'id';

    // Set fillable fields.
    protected $fillable = [];


}

#END OF PHP