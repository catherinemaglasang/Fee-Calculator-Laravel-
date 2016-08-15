<?php

namespace Thirty98\Http\Controllers\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class TTLTypes extends Model
{

    // Laravel auto update timestamp feature.
    public $timestamps = true;

    // Set database for this model.
    protected $table = 'ttltypes';

    // Set primary key.
    protected $primaryKey = 'id';

}

#END OF PHP