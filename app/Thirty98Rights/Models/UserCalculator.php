<?php

namespace Thirty98\Thirty98Rights\Models;

use Illuminate\Database\Eloquent\Model;

class UserCalculator extends Model
{
    public $timestamps = false;

    public $connection = 'trs_dash';
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_calculator';

    public function user()
    {
        return $this->belongsTo('App\User', 'id', 'user_id');
    }

}
