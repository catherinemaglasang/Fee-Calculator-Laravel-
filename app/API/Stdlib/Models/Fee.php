<?php

namespace Thirty98\API\Stdlib\Models;

use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    protected $table = 'fees';
    
    protected $hidden = ['id'];
}