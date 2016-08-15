<?php 

namespace Thirty98\Thirty98Rights\Models;

use Illuminate\Database\Eloquent\Model;

class UserRoleApplications extends Model
{

    // Ignore timestamp
    public $timestamps = false;

    protected $connection = 'trs_dash';
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_role_applications';

    public function user()
    {
        return $this->belongsTo('App\User', 'id', 'user_id');
    }

}

// EOF