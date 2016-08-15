<?php

namespace Thirty98\Http\Controllers\Manage;

use Thirty98\http\controllers\models\Cities_Fees;
use Thirty98\Http\Controllers\Models\Counties;
use Thirty98\Http\Controllers\Models\Categories;
use Thirty98\Http\Controllers\Models\States;
use Thirty98\Http\Controllers\Models\TexasDates as Date;
use Thirty98\Http\Controllers\Controller;
use Thirty98\Models\PlateTypes;


class LouisianaManagerController extends Controller
{
    public function getFees( $category, $subCategory)
    {
        $data = [

            'state' => 'LA',
            'category' => $category,
            'type' => $subCategory,
            'state_id' => States::find('Louisiana')->id

        ];

        // Todo
        //

        switch ($subCategory) {

            // Fees
            case 'state_fees':

                $data['categories'] = Categories::all();

                break;

            case 'county_fees':

                $data['categories'] = Categories::all();
                $data['counties'] = Counties::where('state_id','=',States::find('Louisiana')->id)->get();

                break;

            // Penalties
            case 'state_penalties':

                $data['categories'] = Categories::all();

                break;

            case 'county_penalties':

                $data['categories'] = Categories::all();
                $data['counties'] = Counties::where('state_id','=',States::find('Louisiana')->id)->get();

                break;

            // Tax

            case 'state_tax':

                $data['categories'] = Categories::all();

                break;

            case 'county_tax':

                $data['categories'] = Categories::all();
                $data['counties'] = Counties::where('state_id','=',States::find('Louisiana')->id)->get();

                break;

            default:

                $data['categories'] = null;

                break;

        }

        return $data;
    }
}