<?php

namespace Thirty98\Http\Controllers\Models;

use Illuminate\Database\Eloquent\Model;

class CountyFees extends Model
{

    // Laravel auto update timestamp feature.
    public $timestamps = false;

    // Set database for this model.
    protected $table = 'counties_fees';

    // Set primary key.
    protected $primaryKey = 'fee_id';

    // Set fillable fields.
    protected $fillable = ['amount'];

}

#END OF PHP