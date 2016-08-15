<?php

namespace Thirty98\Http\Requests\Validators;

use Thirty98\Http\Requests\Request;
use Auth;

class DelawareRequestValidator extends Request
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
            'model_year' => 'required',
            'price' => 'required|numeric',
            'trade_in_value'  => 'required|numeric',
            'no_of_years' => 'required'
        ];
    }
}
