<?php

namespace Thirty98\Http\Controllers\Models;

use Illuminate\Database\Eloquent\Model;

class TexasDates extends Model
{

    // Laravel auto update timestamp feature.
    public $timestamps = false;

    // Set database for this model.
    protected $table = 'tx_weightfees';

    // Set primary key.
    protected $primaryKey = 'id';

    // Set fillable fields.
    protected $fillable = ['min_weight','max_weight','amount','start_date','end_date'];

}

#END OF PHP