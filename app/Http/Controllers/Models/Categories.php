<?php

namespace Thirty98\Http\Controllers\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categories extends Model
{
	use SoftDeletes;

    // Laravel auto update timestamp feature.
    public $timestamps = true;

    // Set database for this model.
    protected $table = 'categories';

    // Set primary key.
    protected $primaryKey = 'id';
    
    // Used for softdeleting.
    protected $dates = ['deleted_at'];

    // Set fillable fields.
    protected $fillable = [];

}

#END OF PHP