<?php

namespace Thirty98\http\controllers\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cities extends Model
{
    use SoftDeletes;

    // Laravel auto update timestamp feature.
    public $timestamps = true;

    // Set database for this model.
    protected $table = 'cities';

    // Set primary key.
    protected $primaryKey = 'id';

    // Used for softdeleting.
    protected $dates = ['deleted_at'];

    // Set fillable fields.
    protected $fillable = [];
}
