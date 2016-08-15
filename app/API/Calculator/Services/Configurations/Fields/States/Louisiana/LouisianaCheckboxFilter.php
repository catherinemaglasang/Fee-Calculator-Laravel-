<?php

namespace Thirty98\API\Calculator\Services\Configurations\Fields\States\Louisiana;

use Thirty98\API\Stdlib\Helpers\RequestHelperService;

class LouisianaCheckboxFilter
{
    protected $master_fields = [];

    protected $trailer_weighted_vehicles = [
        "truck",
        "truck_tractor"
    ];

    protected $boat_vehicles = [
        "boat_trailer",
        "utility_trailer"
    ];

    protected $form_fields = [
        "trailer_weight" => ["name" => "trailer_weight", "title" => "Trailer Weight", "required" => true, 'display_order' => 13, 'field_type' => 'input'],
        "number_of_passengers" => ["name" => "number_of_passengers", "title" => "No of Passengers?", "required" => true, 'display_order' => 11, 'field_type' => 'input']
    ];

    protected $option_fields = [
        'did_pull_a_trailer' => [
            'name' => 'did_pull_a_trailer',
            'title' => 'Do you ever pull a Trailer?',
            'display_order' => 4,
            'field_type' => 'checkbox',
            'default' => false
        ],
    ];

    public function filter($master_fields, $payload)
    {
        if (!isset($payload['vehicle_type']['slug'])) {
            return $master_fields;
        }

        $this->master_fields = $master_fields;

        $transaction_type = isset($payload['transaction_type']) ? $payload['transaction_type'] : false;
        $vehicle_type = isset($payload['vehicle_type']['slug']) ? $payload['vehicle_type']['slug'] : false;
        $type_of_plate = isset($payload['type_of_plate']) ? $payload['type_of_plate'] : false;


        // Checkbox fields.
        $did_pull_a_trailer = isset($payload['did_pull_a_trailer']) ? $payload['did_pull_a_trailer'] : false;

        if (in_array($vehicle_type, $this->trailer_weighted_vehicles) && $did_pull_a_trailer == true) {
            foreach ($this->master_fields['calculator_options'] as $key => $calculator_option) {
                if ($calculator_option['name'] === 'did_pull_a_trailer') {
                    $this->master_fields['calculator_options'][$key]['default'] = true;
                }
            }

            if ($transaction_type === "NR" || $transaction_type === "TP") {
                array_push($this->master_fields['form_fields'], $this->form_fields['trailer_weight']);
            }
        } else if (in_array($vehicle_type, $this->boat_vehicles)) {
            if ($did_pull_a_trailer == false) {
                foreach ($this->master_fields['calculator_options'] as $key => $calculator_option) {
                    if ($calculator_option['name'] === 'did_pull_a_trailer') {
                        $this->master_fields['calculator_options'][$key]['default'] = false;
                    }
                }

                foreach ($this->master_fields['form_fields'] as $key => $form_field) {
                    if ($form_field['name'] === 'trailer_weight') {
                        unset($this->master_fields['form_fields'][$key]);
                    }
                }

            } else {
                // Set did pull a trailer to true.
                foreach ($this->master_fields['calculator_options'] as $key => $calculator_option) {
                    if ($calculator_option['name'] === 'did_pull_a_trailer') {
                        $this->master_fields['calculator_options'][$key]['default'] = true;
                    }
                }
            }
        } else if ($vehicle_type === 'private_bus' && $type_of_plate === "hire_passenger_plate") {
            array_push($this->master_fields['form_fields'], $this->form_fields['number_of_passengers']);
        }



        return $this->master_fields;
    }


    /**
     * Unique for every State filter.
     *
     * Sets name and title.
     * Transaction type filter will filter required and will remmove non required fields
     *
     * @return array
     */
    public function getCheckboxOptions()
    {
        return [

        ];
    }
}