<?php 

namespace Thirty98\Thirty98Rights\Models;

use Illuminate\Database\Eloquent\Model;

class RoleApplications extends Model
{

    // Ignore timestamp
    public $timestamps = false;

    protected $connection = 'trs_dash';
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'role_applications';

    public function role()
    {
        return $this->belongsTo('App\Thirty98Rights\Models\Role', 'id', 'role_id');
    }

}