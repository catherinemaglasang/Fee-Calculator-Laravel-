<?php

namespace Thirty98\Http\Controllers\Models;

use Illuminate\Database\Eloquent\Model;

class CategoriesTypes extends Model
{
    // Laravel auto update timestamp feature.
    public $timestamps = true;

    // Set database for this model.
    protected $table = 'categories_types';

    // Set primary key.
    protected $primaryKey = 'id';

    // Set fillable fields.
    protected $fillable = [];

}

#END OF PHP