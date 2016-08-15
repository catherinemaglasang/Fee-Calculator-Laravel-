<?php

namespace Thirty98\API\Stdlib\Traits;

use Carbon\Carbon;

trait DateValidationTrait
{
    public function getDays($date)
    {

        list($month, $day, $year) = explode('/', $date);        
        $selected_date = Carbon::createFromDate($year, $month, $day);

        return $selected_date->diffInDays(Carbon::now());
    }

}