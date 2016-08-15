<?php 

namespace Thirty98\Thirty98Rights\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{

    // Ignore timestamp
    public $timestamps = false;

    protected $connection = 'trs_dash';
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'permissions';

}

// EOF