<?php 

namespace Thirty98\Thirty98Rights\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    // Ignore timestamp
    public $timestamps = false;

    protected $connection = 'trs_dash';
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'roles';

    public function permissions(){
        return $this->hasMany('App\Thirty98Rights\Models\RoleApplications', 'role_id', 'id')->where('applications', env('APP_NAME', null));
    }

}

// EOF