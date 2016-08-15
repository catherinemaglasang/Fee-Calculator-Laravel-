<?php

namespace Thirty98\API\DataOne\Models;

use Illuminate\Database\Eloquent\Model;

class DataOne extends Model
{
    protected $connection = 'mysql_mytrs';
    protected $table = 'DataOneVINPatterns';
    
    protected $hidden = ['id'];
}