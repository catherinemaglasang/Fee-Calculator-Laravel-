<?php

namespace Thirty98\Http\Requests\Validators;

use Thirty98\Http\Requests\Request;
use Auth;

class LouisianaRequestValidator extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(Auth::check())

        return true;
    
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type' => 'required',
            'parish' => 'required',
            'city'  => 'required',
            'office_location' => 'required'
        ];
    }
}
