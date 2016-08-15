<?php

namespace Thirty98\API\General\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\Validator;

class State extends Eloquent
{
    // Set database for this model.
    protected $table = 'states';

    // Set primary key.
    protected $primaryKey = 'id';

    // Set fillable fields.
    protected $fillable = [];

    // Set validator.
    private $validator = null;

    // Validation rules.
    private $rules = [];

    protected $hidden = ['id'];

    /**
     * This will strip out "required" rule from each validation rule.
     * This means a field is not supposed to be required when validating data.
     *
     * @return array
     */
    public function noRequiredValidationRules()
    {
        $newRules = array();

        //Let's get each validation rule.
        foreach ($this->rules as $key => $value) {

            //Let's replace some required strings here.
            $value = str_replace('required|', '', $value);
            $value = str_replace('required', '', $value);

            //Set new validation rule.
            $newRules[$key] = $value;
        }

        $this->rules = $newRules;

        return $this->rules;
    }

    /**
     * This will allow you to customize or update the $rules
     * on the fly before validating a data.
     *
     * @param $field
     * @param $rule
     */
    public function setValidationRule($field, $rule)
    {
        $this->rules[$field] = $rule;
    }

    /**
     * This will validate $data.
     *
     * @param array $data
     * @return bool
     */
    public function valid($data = array())
    {
        $this->validator = Validator::make($data, $this->rules);

        if ($this->validator->fails()) {

            return false;
        }

        return true;
    }

    /**
     * Get validation errors.
     *
     * @return mixed
     */
    public function errors()
    {
        return $this->validator->messages();
    }

    /**
     * Get validator instance.
     *
     * @return null
     */
    public function validator()
    {
        return $this->validator;
    }

    /**
     * Get fees.
     *
     * @return Fee|Collection|\Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function fees()
    {
        return $this->belongsToMany('\Thirty98\API\General\Models\Fee', 'fees_states')->withPivot('amount');
    }

    /**
     * Get counties.
     *
     * @return Fee|Collection|\Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function counties()
    {
        return $this->hasMany('\Thirty98\API\General\Models\County', 'state_id', 'id');
    }
}


#END OF PHP