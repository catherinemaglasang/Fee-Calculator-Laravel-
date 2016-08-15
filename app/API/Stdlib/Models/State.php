<?php

namespace Thirty98\API\Stdlib\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table = 'states';
    
    protected $hidden = ['id', "created_at", "updated_at", "deleted_at"];
}