<?php

namespace Thirty98\API\Calculator\Controllers;

use Thirty98\API\Stdlib\Controllers\AbstractPostController;
use Thirty98\API\Calculator\Services\FeeCalculatorService;
use Thirty98\API\Stdlib\Services\ResponseService;
use Illuminate\Http\Request;
use DB;

class CalculatorController extends AbstractPostController
{
    /**
     * @var Thirty98\API\General\Services\FeeCalculatorService
     */
    protected $service;
    protected $payload;

    /**
     * @param FeeCalculatorService $service
     */
    public function __construct(FeeCalculatorService $service)
    {
        $this->service = $service;
    }

    public function getLogs(Request $request)
    {
        $payload = $request->all();

        $state = $payload['state']['code'];
        $status = $payload['status'];

        $logs = DB::table('fee_calculator_logs');

        // Put state condition.
        if ($state != 'ALL') {
            $logs = $logs->where('state_code', $state);
        }

        // Put status condition.
        if ($status !== 'ALL') {
            $logs = $logs->where('status', '=', $status);
        }

        // Enable pagination.
        $logs = $logs->paginate(50)->toArray();
        $response = ['logs' => $logs, 'payload' => $payload];
        return ResponseService::success("Here's the logs.", $response);
    }


    public function getStateRules(Request $request)
    {
        $payload = $request->all();

        $output = [
            "LA" => [40, 60, 90, 120, 150],
            "TX" => [30, 60]
        ];

        $response = ['State Late Fee Penalty Date Ranges' => $output, 'payload' => $payload];
        return ResponseService::success("Here's the Date Ranges", $response);
    }

    public function batchCalculateFees(Request $request)
    {
        $payload = $request->all();

        $calc_params = $payload['calc_params'];
        $results = [];

        // State options.
        // Dynamically add if not provided.
        $options = [
            'LA' => [
                'no_fees' => false,
                'temp_tag' => false,
                'farm_use' => false,
                'exempt_from_sales_tax' => false,
                'include_late_fees' => true
            ],
            'TX' => [
                'no_fees' => false,
                'temp_tag' => false,
                'is_trade_in_leased' => false,
                'farm_ranch' => false,
                'member_of_military' => false,
                'off_highway_use' => false,
                'rebuilt_salvage' => false,
                'exempt_from_sales_tax' => false,
                'include_inspection_fee' => true,
                'include_vit_tax' => false,
                'include_late_fees' => true
            ],
        ];

        foreach ($calc_params as $calc_param) {
            if ($this->ifParam($calc_param, 'state')) {
                $state = $calc_param['state'];

                // Add default state options if not provided in payload.
                foreach ($options[$state] as $key => $value) {
                    if (!isset($calc_param[$key])) {
                        $calc_param[$key] = $value;
                    }
                }
            }

            // Makes all true and false, 0 or 1s.
            foreach ($calc_param as $key => $value) {
                if ($calc_param[$key] === true) {
                    $calc_param[$key] = 1;
                } else if ($calc_param[$key] === false) {
                    $calc_param[$key] = 0;
                }
            }

            // Determine options.
            $response = $this->getPostRequest('/api/calculator/v1/calculate', $calc_param);
            $results[] = $response;
        }

        $response = ['calculations' => $results, 'payload' => $payload];
        return ResponseService::success("Here's the Batch Calculations", $response);
    }

    public function batchCalculateLateFees(Request $request)
    {
        $payload = $request->all();
        $results = [];

        $calculation_params = $payload['calc_params'];

        foreach ($calculation_params as $calc_param) {
            // Check these 2.
            $ends = '';
            $deal_id = '';
            $date_of_sale = '';

            $errors = [];

            $calc_param['late_fees_only'] = true;

            // check if array.
            if (!isset($calc_param['ends'])) {
                if (!is_array($calc_param['ends'])) {
                    $error = [
                        'error' => [
                            'http_code' => 200,
                            'response_msg' => "No valid end date found",
                            'response_code' => "NO_END_DATE_FOUND",
                            "exception" => "No valid end date"
                        ]
                    ];

                    $ends = false;
                    $errors[] = $error;
                } else {
                    $ends = $calc_param['ends'];
                }
            } else {
                $ends = $calc_param['ends'];
            }

            if (!isset($calc_param['deal_id'])) {
                $error = [
                    'error' => [
                        'http_code' => 200,
                        'response_msg' => "No deal id found",
                        'response_code' => "NO_DEAL_ID_FOUND",
                        "exception" => "No deal id found"
                    ]
                ];

                $deal_id = false;
                $errors[] = $error;
            } else {
                $deal_id = $calc_param['deal_id'];
            }

            if (!isset($calc_param['date_of_sale'])) {
                $error = [
                    'error' => [
                        'http_code' => 200,
                        'response_msg' => "No deal id found",
                        'response_code' => "NO_DEAL_ID_FOUND",
                        "exception" => "No deal id found"
                    ]
                ];

                $date_of_sale = false;
                $errors[] = $error;
            } else {
                $date_of_sale = $calc_param['date_of_sale'];
            }

            if ($deal_id != false && $ends != false && $date_of_sale != false) {
                $end_dates = $calc_param['ends'];
                $state = isset($calc_param['state']) ? $calc_param['state'] : '';

                foreach ($end_dates as $key => $value) {
                    // Check end date.|
                    $calc_param['days_elapsed'] = $key;

                    $response = $this->getPostRequest('/api/calculator/v1/calculateLateFees', $calc_param);
                    $response_code = $response->response_code;

                    if ($response_code === "SUCCESS") {
                        $results[] = [
                            'deal_id' => $deal_id,
                            'late_fee' => $response->data->calculation->summary->{"Late Fees"}->total->overall,
                            'days' => $key,
                            'end' => $value,
                        ];
                    } else {
                        $results[] = [
                            'deal_id' => $deal_id,
                            'late_fee' => 'NO LATE FEE FOUND',
                            'days' => $key,
                            'end' => $value,
                        ];
                    }
                }
            } else {
                $results[] = $errors;
            }
        }


        $response = ['calculations' => $results, 'payload' => $payload];
        return ResponseService::success("Here's the calculations", $response);
    }


    public function calculate(Request $request)
    {
        $payload = $request->all();
        //$this->service->inititialize($payload['state']); // TO DO
        $this->payload = $payload;

        $validator = $this->postRequestValidator($payload);
        if ($validator->fails()) {
            $response = ['error' => $validator->errors(), 'payload' => $payload];
            return ResponseService::success("Validation failed", $response, 200, "FAILED_VALIDATION");
        }

        $output = $this->service->calculate($payload);
        if (isset($output['error'])) {
            $data = ['error' => $output['error']['exception'], 'payload' => $payload];
            $message = $output['error']['response_msg'];
            $message_code = $output['error']['response_code'];
            return ResponseService::success($message, $data, 200, $message_code);
        }

        if($payload['state']['code'] === "LA") {
            $output['Sales Tax Rate'] = $payload['sales_tax_rate'];
            $output['Rebate Tax Comp'] = $payload['rebate_tax_rate'];
            $output['Vendors Comp Rate'] = $payload['vendors_comp_rate'];
        }


        $response = ['calculation' => $output, 'payload' => $payload];
        return ResponseService::success("Here's the calculation", $response);
    }

    public function log(Request $request)
    {
        $payload = $request->all();

        $output = $this->service->add_log($payload);
        if (isset($output['error'])) {
            $data = ['error' => $output['error']['exception'], 'payload' => $payload];
            $message = $output['error']['response_msg'];
            $message_code = $output['error']['response_code'];
            return ResponseService::success($message, $data, 200, $message_code);
        }

        $response = ['calculation' => $output, 'payload' => $payload];
        return ResponseService::success("Log insert successful.", $response);
    }

    protected
    function postValidationRules()
    {
        $common = [
//            'api_key'           => 'required|alpha_num',
            //"vehicle_type"      => "required|string",
            // "model_year" => "required",
            "transaction_type" => "required|string",
//            "sales_price"       => "numeric",
//            "freight"           => "numeric",
//            "rebate_discount"   => "numeric",
//            "taxable_amount"    => "numeric",
//            "sales_tax_rate"    => "numeric",
            "date_of_sale" => "date_format:m/d/Y",
            // 'fuel_type' => 'required_if:state.code,LA, TX',
            // 'fuel_type' => 'required_if:state.code,TX',
//            "gvwr"               => "numeric",
//            "gvw"               => "numeric",
//            'county'            => 'required|string',
//            'registration_year' => 'required|numeric|min:1',
//            'crub_weight'       => 'sometimes|numeric',
//            'tonnage'           => 'sometimes|numeric',
        ];

        // Custom fuel type validation.
        $fuel_types = ["TX"];
        $state = $this->payload['state']['code'];

        if (in_array($state, $fuel_types)) {
            $common['fuel_type'] = 'required';
        }

        if ($this->ifParam($this->payload, 'late_fees_only') == true) {
            return [
                "date_of_sale" => "required|date_format:m/d/Y"
            ];
        } else {
            return array_merge($common, $this->getTexaxRules(), $this->getLouisianaRules());
        }
    }


    private
    function getFuelTypeConditions()
    {
        $fuel_type_states = ["LA", "TX"];

        // if(in_array())
    }

    private
    function getTexaxRules()
    {
        return [
            // TX Requirements
            // "new_or_used" => "required_if:state.code,TX|boolean",
            // "no_fees" => "required_if:state.code,TX|boolean", //options; applicable to all state
            // "temp_tag" => "required_if:state.code,TX|boolean", //options
            // "is_trade_in_leased" => "required_if:state.code,TX|boolean", //options
            // "farm_ranch" => "required_if:state.code,TX|boolean", //options
            // "member_of_military" => "required_if:state.code,TX|boolean", //options
            // "off_highway_use" => "required_if:state.code,TX|boolean", //options
            // "rebuilt_salvage" => "required_if:state.code,TX|boolean", //options
            // "exempt_from_sales_tax" => "required_if:state.code,TX|boolean", //options; applicable to all state
            // "include_inspection_fee" => "required_if:state.code,TX|boolean", //options
            // "include_vit_tax" => "required_if:state.code,TX|boolean", //options

            //TEXAS FEES
            // 'sales_tax' => "required_if:state.code,TX|boolean",
            // 'new_registration_tax' => "required_if:state.code,TX|boolean",
            // 'gift_tax' => "required_if:state.code,TX|boolean",
            // 'even_trade_tax' => "required_if:state.code,TX|boolean",
        ];
    }

    private function getLouisianaRules()
    {
        $transaction_type = $this->payload['transaction_type'];
        $vehicle_type = $this->payload['vehicles']['slug'];
        $state = $this->payload['state']['code'];

        if ($state === "LA") {
            // Common LA rules.
            $louisiana_rules = [
                "no_fees" => "required_if:state.code,LA|boolean", //options; applicable to all state
                "exempt_from_sales_tax" => "required_if:state.code,LA|boolean", //options; applicable to all state
                "include_late_fees" => "required_if:state.code,LA|boolean",
                "date_of_sale" => "date_format:m/d/Y",
                "rebate" => "required|numeric",
                "mortgage_fee" => "required|numeric",
            ];

            // Farm use.
            if($vehicle_type === 'truck' || $vehicle_type === 'truck_tractor') {
                $louisiana_rules["farm_use"] = "required_if:vehicles.slug,$vehicle_type|boolean";
            }

            // Did pull a trailer.
            if($vehicle_type === 'truck' || $vehicle_type === 'truck_tractor' || $vehicle_type === 'boat_trailer') {
                $louisiana_rules["farm_use"] = "required_if:vehicles.slug,$vehicle_type|boolean";
            }

            // Taxable value.
            if($transaction_type !== "DT" && $transaction_type !== "TRC") {
                $louisiana_rules["taxable_value"] = "required_if:transaction_type,$transaction_type|numeric";
            }

            return $louisiana_rules;
        } else {
            return [
                // LA Requirements
                "no_fees" => "required_if:state.code,LA|boolean", //options; applicable to all state
                "farm_use" => "required_if:state.code,LA|boolean", //options
                "did_pull_a_trailer" => "required_if:state.code,LA|boolean", //options
                "exempt_from_sales_tax" => "required_if:state.code,LA|boolean", //options; applicable to all state
                "include_late_fees" => "required_if:state.code,LA|boolean"
            ];
        }

        $rules = [
            "no_fees" => "required_if:state.code,LA|boolean", //options; applicable to all state
            "exempt_from_sales_tax" => "required_if:state.code,LA|boolean", //options; applicable to all state
            "include_late_fees" => "required_if:state.code,LA|boolean"
        ];
    }
}