<?php

namespace Thirty98\API\Calculator\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class StateTransactionType extends Eloquent
{
    protected $table = "states_transaction_types";
    
    protected $hidden = ['id', 'priority'];
}