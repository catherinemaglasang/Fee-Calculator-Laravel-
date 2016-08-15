<?php

/*Identify own namespace dir*/
namespace Thirty98\API\Louisiana\Entities\Repositories;

/*When extending or using something else*/

use Illuminate\Http\Request;
use Thirty98\API\General\Entities\Avalara;
use Thirty98\API\General\Models\Category;
use Thirty98\API\General\Models\Fee;
use Thirty98\API\General\Models\State;
use Thirty98\API\General\Models\Type;
use Thirty98\API\Louisiana\Contracts\CalculatorRepositoryInterface;
use Thirty98\Http\Controllers\Models\LALicenseTruckWeightFees;
use DB;


class VanVanRepository implements CalculatorRepositoryInterface
{
    private $ttltypes = [];

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->getTransactionTypeCodes($this->request->get('transaction_type'));
    }

    /**
     * Get all ttltypes.
     */
    public function getTransactionTypeCodes()
    {
        $sql_ttltypes = "SELECT
                          t.code
                        FROM
                          ttltypes t
                          INNER JOIN ttltype_states ts
                            ON t.id = ts.`ttltype_id`
                            AND state_id =
                            (SELECT
                              id
                            FROM
                              states
                            WHERE `code` = 'LA')";

        $this->ttltypes = DB::select(DB::raw($sql_ttltypes));
        $this->ttltypes = $this->ttltypes;
    }

    /**
     * Check if ttl type is in array.
     */
    public function ttlTypeCheck($ttltype)
    {
        $ttltypes = $this->ttltypes;

        foreach ($ttltypes as $data) {
            if ($ttltype == $data->code) {
                return true;
            }
        }

        return false;
    }

    public function getSalesTaxRate()
    {

        $request_address = $this->request->get('address');
        $request_amount = $this->request->get('amount');
        $date_of_sale = $this->request->get('date_of_sale');
        $parish = $this->request->get('parish');
        $city = $this->request->get('city');
        $sales_tax_credit = $this->request->get('sales_tax_credit');
        $transaction_type = $this->request->get('transaction_type');

        // Duplicate Title and Title Registration Correction.
        if($this->ttlTypeCheck($transaction_type) == false || $transaction_type == 'DT' || $transaction_type == 'TRC') {
            return "";
        }

        $httpVars = [
            'Request Address' => $request_address,
            'Request Amount' => $request_amount,
            'Date of Sale' => $date_of_sale
        ];

        if ($request_address == false || $request_amount == false || $date_of_sale == false) {
            // return json_encode($httpVars);
            return 'Address, Date of Sale and Amount Parameters are Required for Avalara Sales Tax.';
        }

        $avalara = new Avalara();

        // $address = '55 Tera Ave Alexandria LA 71303-2259';
        // $amount = 20000;

        $result = $avalara->louisianaSalesTaxRate($request_address, $request_amount, $date_of_sale, $parish, $city, $sales_tax_credit);

        return $result;
    }

    public function getNotaryFee()
    {
        $transaction_type = $this->request->get('transaction_type');

        // Title Registration Correction.
        if($this->ttlTypeCheck($transaction_type) == false || $transaction_type != 'TRC') {
            return "";
        }

        // Param request.
        $request_category = $this->request->get('category');
        $request_type = $this->request->get('type');

        // Get State (LA) and Fee (68.50).
        // We need this to query the fees - so we will know which states they belong.
        $state = State::where('code', 'LA')->first()->id;
        $fee = Fee::where('name', 'NOTARY_FEE')->first()->id;

        // We need the category and type (passenger) (passenger)
        $category = Category::where('name', $request_category)->first()->id;
        $type = Type::where('name', $request_type)->first()->id;

        // After getting those values, we can now consolidate them to a single table and extract it's id.
        $category_id = DB::table('categories_types')
            ->where('category_id', $category)
            ->where('type_id', $type)
            ->first()->id;

        // After we get the category ID, which is references the (state), (fee), (request_category) and (request_type)
        $title_fee = DB::table('fees_states')
            ->where('state_id', $state)
            ->where('fee_id', $fee)
            ->where('category_type_id', $category_id)
            ->first();

        // We can then get the fee.
        if ($title_fee) {
            return $title_fee->amount;
        } else {
            return 'No notary fee found.';
        }
    }

    public function getConvenienceFee()
    {
        // Param request.
        $request_category = $this->request->get('category');
        $request_type = $this->request->get('type');
        $transaction_type = $this->request->get('transaction_type');

        // Must have an LA transaction type.
        if($this->ttlTypeCheck($transaction_type) == false) {
            return "";
        }

        // Get State (LA) and Fee (68.50).
        // We need this to query the fees - so we will know which states they belong.
        $state = State::where('code', 'LA')->first()->id;
        $fee = Fee::where('name', 'CONVENIENCE_FEE')->first()->id;

        // We need the category and type (passenger) (passenger)
        $category = Category::where('name', $request_category)->first()->id;
        $type = Type::where('name', $request_type)->first()->id;

        // After getting those values, we can now consolidate them to a single table and extract it's id.
        $category_id = DB::table('categories_types')
            ->where('category_id', $category)
            ->where('type_id', $type)
            ->first()->id;

        // After we get the category ID, which is references the (state), (fee), (request_category) and (request_type)
        $title_fee = DB::table('fees_states')
            ->where('state_id', $state)
            ->where('fee_id', $fee)
            ->where('category_type_id', $category_id)
            ->first()->amount;

        // We can then get the fee.
        if ($title_fee) {
            return $title_fee;
        } else {
            return 'No convenience fee found.';
        }
    }

    public function getMailFee()
    {
        // Param request.
        $request_category = $this->request->get('category');
        $request_type = $this->request->get('type');
        $transaction_type = $this->request->get('transaction_type');

        // Must have an LA transaction type.
        if($this->ttlTypeCheck($transaction_type) == false) {
            return "";
        }

        // Get State (LA) and Fee (68.50).
        // We need this to query the fees - so we will know which states they belong.
        $state = State::where('code', 'LA')->first()->id;
        $fee = Fee::where('name', 'MAIL_FEE')->first()->id;

        // We need the category and type (passenger) (passenger)
        $category = Category::where('name', $request_category)->first()->id;
        $type = Type::where('name', $request_type)->first()->id;

        // After getting those values, we can now consolidate them to a single table and extract it's id.
        $category_id = DB::table('categories_types')
            ->where('category_id', $category)
            ->where('type_id', $type)
            ->first()->id;

        // After we get the category ID, which is references the (state), (fee), (request_category) and (request_type)
        $title_fee = DB::table('fees_states')
            ->where('state_id', $state)
            ->where('fee_id', $fee)
            ->where('category_type_id', $category_id)
            ->first()->amount;

        // We can then get the fee.
        if ($title_fee) {
            return $title_fee;
        } else {
            return 'No mail fee found.';
        }
    }

    public function getProcessingFee()
    {
        // Param request.
        $request_category = $this->request->get('category');
        $request_type = $this->request->get('type');
        $transaction_type = $this->request->get('transaction_type');

        // Must have an LA transaction type.
        if($this->ttlTypeCheck($transaction_type) == false) {
            return "";
        }

        // Get State (LA) and Fee (68.50).
        // We need this to query the fees - so we will know which states they belong.
        $state = State::where('code', 'LA')->first()->id;
        $fee = Fee::where('name', 'PROCESSING_FEE')->first()->id;

        // We need the category and type (passenger) (passenger)
        $category = Category::where('name', $request_category)->first()->id;
        $type = Type::where('name', $request_type)->first()->id;

        // After getting those values, we can now consolidate them to a single table and extract it's id.
        $category_id = DB::table('categories_types')
            ->where('category_id', $category)
            ->where('type_id', $type)
            ->first()->id;

        // After we get the category ID, which is references the (state), (fee), (request_category) and (request_type)
        $title_fee = DB::table('fees_states')
            ->where('state_id', $state)
            ->where('fee_id', $fee)
            ->where('category_type_id', $category_id)
            ->first()->amount;

        // We can then get the fee.
        if ($title_fee) {
            return $title_fee;
        } else {
            return 'No processing fee found.';
        }
    }

    public function getLicenseFee()
    {
        $request_type = $this->request->get('type');
        $request_category = $this->request->get('category');
        $gvwr = $this->request->get('gvwr');
        $taxable_value = $this->request->get('amount');
        $type_of_plate = $this->request->get('type_of_plate');
        $date_of_sale = $this->request->get('date_of_sale');
        $transaction_type = $this->request->get('transaction_type');

        // New Title / Transfer Plate
        if ($transaction_type != false && ($transaction_type != 'NR')) {
            return '';
        }

        $result_arr = array(
            'msg' => '',
            'VALUE' => ''
        );

        if ($type_of_plate == false || $taxable_value == false || $date_of_sale == false) {
            $report = [
                'type of plate' => $type_of_plate,
                'taxable value' => $taxable_value,
                'date of sale' => $date_of_sale
            ];

            $result_arr['msg'] = "Type of Plate, Date of Sale and Taxable Value must be included in the request parameters. " . json_encode($report);

            return $result_arr;
        }

        if ($type_of_plate == 'Car Plate') {
            // Hack. Set gvwr to false so it always gets the license fee by value.
            if ($gvwr != false && $gvwr >= 10000) {
                $result = $this->getLicenseTruckWeightFees($gvwr, $request_type, $request_category, $type_of_plate, $date_of_sale);

                return $result;
            } else {
                $result = $this->getLicenseFeeByValue($taxable_value, $request_type, $request_category, $date_of_sale);

                return $result;
            }
        } else if ($type_of_plate == '1-Yr Commercial Plate') {
            $date_of_sale_check = $this->checkLicenseDateOfSales($date_of_sale);

            if ($date_of_sale_check['invalid_date'] == true) {
                return $date_of_sale_check;
            }

            if ($gvwr >= 10000) {
                $result_arr = array(
                    'msg' => '1-Yr Commercial Plate Cannot have a gvw/gvwr that is over 10000 lbs',
                    'VALUE' => ''
                );

                return $result_arr;
            } else {

                // Get commercial fee.
                $sql = "
                    SELECT
                      fs.amount
                    FROM
                      fees_states fs
                      INNER JOIN categories_types ct
                        ON fs.`category_type_id` = ct.id
                      INNER JOIN categories c
                        ON ct.`category_id` = c.id
                        AND c.`name` = :category_name
                      INNER JOIN `types` t
                        ON ct.`type_id` = t.`id`
                        AND t.`name` = :type_name
                      INNER JOIN fees f
                        ON f.`id` = fs.`fee_id`
                      INNER JOIN states s
                        ON fs.`state_id` = s.`id`
                        AND fs.`state_id` =
                        (SELECT
                          id
                        FROM
                          states
                        WHERE `code` = 'LA')
                        AND f.`name` = :fee_name
                ";

                $result = DB::select(DB::raw($sql), array(
                    'category_name' => $request_category,
                    'type_name' => $request_type,
                    'fee_name' => '1-Yr Commercial Plate'
                ));

                $amount = (isset($result[0]->amount) ? $result[0]->amount : '');

                $result_arr = array(
                    'msg' => '1-Yr Commercial Plate',
                    'VALUE' => $amount
                );

                return $result_arr;
            }
        } else if ($type_of_plate == '2-Yr Commercial Plate') {
            $date_of_sale_check = $this->checkLicenseDateOfSales($date_of_sale);

            if ($date_of_sale_check['invalid_date'] == true) {
                return $date_of_sale_check;
            }

            if ($gvwr >= 10000) {
                $result_arr = array(
                    'msg' => '2-Yr Commercial Plate Cannot have a gvw/gvwr that is over 10000 lbs',
                    'VALUE' => ''
                );

                return $result_arr;
            } else {
                // Get commercial fee.
                $sql = "
                    SELECT
                      fs.amount
                    FROM
                      fees_states fs
                      INNER JOIN categories_types ct
                        ON fs.`category_type_id` = ct.id
                      INNER JOIN categories c
                        ON ct.`category_id` = c.id
                        AND c.`name` = :category_name
                      INNER JOIN `types` t
                        ON ct.`type_id` = t.`id`
                        AND t.`name` = :type_name
                      INNER JOIN fees f
                        ON f.`id` = fs.`fee_id`
                      INNER JOIN states s
                        ON fs.`state_id` = s.`id`
                        AND fs.`state_id` =
                        (SELECT
                          id
                        FROM
                          states
                        WHERE `code` = 'LA')
                        AND f.`name` = :fee_name
                ";

                $result = DB::select(DB::raw($sql), array(
                    'category_name' => $request_category,
                    'type_name' => $request_type,
                    'fee_name' => '2-Yr Commercial Plate'
                ));

                $amount = (isset($result[0]->amount) ? $result[0]->amount : '');

                $result_arr = array(
                    'msg' => '2-Yr Commercial Plate',
                    'VALUE' => $amount
                );

                return $result_arr;
            }
        } else if ($type_of_plate == 'Farm Plate') {
            if ($gvwr != false) {
                $result = $this->getLicenseTruckWeightFees($gvwr, $request_type, $request_category, $type_of_plate, $date_of_sale);

                return $result;
            } else {
                $result = $this->getLicenseFeeByValue($taxable_value, $request_type, $request_category, $date_of_sale);
                $result['VALUE'] = ($result['VALUE'] != '' ? $result['VALUE'] - 7 : '');

                return $result;
            }
            /**
             * End
             */
        } else {
            return "Plate: $type_of_plate not found.";
        }
    }

    public function getLicenseFeeByValue($taxable_value, $type, $category, $date_of_sale)
    {
        $date_of_sale_check = $this->checkLicenseDateOfSales($date_of_sale);

        if ($date_of_sale_check['invalid_date'] == true) {
            return $date_of_sale_check;
        }

        $result_arr = array(
            'msg' => '',
            'VALUE' => ''
        );

        // Check taxable value.
        if ($taxable_value < 10000) {
            $taxable_value = 10000;
        }

        $sql = "
                SELECT
                  t.name,
                  c.name,
                  la.`min_value`,
                  la.`max_value`,
                  la.`reg_fee`
                FROM
                  la_taxable_values la
                  INNER JOIN categories_types ct
                    ON ct.`id` = la.`categories_types_id`
                  INNER JOIN `types` t
                    ON t.`id` = ct.`type_id`
                  INNER JOIN categories c
                    ON c.id = ct.`category_id`
                WHERE :taxable_value BETWEEN la.`min_value`
                  AND la.`max_value`
                  AND c.name = :category
                  AND t.name = :type
        ";

        $sql_raw = "
                SELECT
                  t.name,
                  c.name,
                  la.`min_value`,
                  la.`max_value`,
                  la.`reg_fee`
                FROM
                  la_taxable_values la
                  INNER JOIN categories_types ct
                    ON ct.`id` = la.`categories_types_id`
                  INNER JOIN `types` t
                    ON t.`id` = ct.`type_id`
                  INNER JOIN categories c
                    ON c.id = ct.`category_id`
                WHERE '$taxable_value' BETWEEN la.`min_value`
                  AND la.`max_value`
                  AND c.name = '$category'
                  AND t.name = '$type'
        ";

        $reg_fee = DB::select(DB::raw($sql), array(
            'category' => $category,
            'type' => $type,
            'taxable_value' => $taxable_value
        ));

        $result_arr = array(
            'msg' => 'License Fee by value',
            'VALUE' => (isset($reg_fee[0]->reg_fee) ? $reg_fee[0]->reg_fee : '')
        );

        return $result_arr;
    }

    public function checkLicenseDateOfSales($date_of_sale, $gvwr = false)
    {
        $result_arr = array(
            'msg' => '',
            'license_fee' => '',
            'invalid_date' => false
        );

        if (strtotime($date_of_sale) == "") {
            $result_arr['msg'] = 'Date of Sale invalid.';
            $result_arr['invalid_date'] = true;

            return $result_arr;
        }

        $current_date = date('Y-m-d');

        // Staggered.
        $day_difference = (strtotime($current_date) - strtotime($date_of_sale)) / (60 * 60 * 24);

        if ($day_difference > 90 || $day_difference < -180) {

            $day_difference = ($day_difference < 0 ? ($day_difference * -1) . ' days after' : $day_difference . ' days prior');
            $day_difference = 'License Fee Registration can only be done 90 days prior and 180 days after the current date. This Date of Sale is ' . $day_difference . ' the limit';

            $result_arr['msg'] = $day_difference;
            $result_arr['invalid_date'] = true;

            return $result_arr;
        }

        return $result_arr;
    }

    /**
     * "Rule Summary
     * : 10, 000 lbs and below are classified as staggered and has a 90 prior and 180 after current date registration period.
     * : 10, 000 lbs more are classified as prorated and can be registered in before this year's july, or if july has passed,
     * : before next year's july"
     */
    public function getLicenseTruckWeightFees($gvwr, $type, $category, $type_of_plate, $date_of_sale)
    {
        $date_of_sale_check = $this->checkLicenseDateOfSales($date_of_sale);

        if ($date_of_sale_check['invalid_date'] == true) {
            return $date_of_sale_check;
        }

        $result_arr = array(
            'msg' => '',
            'license_fee' => ''
        );

        $roundUPgvwr = ceil($gvwr / 100) * 100;

        if (preg_match('/farm/i', $type_of_plate)) {
            $fee_formula = LALicenseTruckWeightFees::getFeeByPlate($roundUPgvwr, $type, $category, $type_of_plate, $date_of_sale);
        } else {
            $fee_formula = LALicenseTruckWeightFees::getFee($roundUPgvwr, $type, $category, $date_of_sale);
        }

        if (!isset($fee_formula[0]->formula)) {
            $result_arr['msg'] = 'No fee found.';
            $result_arr['VALUE'] = '';

            return $result_arr;
        }

        $fee_formula = $fee_formula[0]->formula;

        if (strpos($fee_formula, 'LBS') !== false) {
            $fee_formula = explode('/', trim($fee_formula));

            $fee = str_replace('$', '', $fee_formula[0]);
            $rate = str_replace(' LBS', '', $fee_formula[1]);

            $fee_rate = $fee / $rate;

            $license_fee = $fee_rate * $gvwr;
        } else {
            $license_fee =  str_replace('$', '', $fee_formula);
        }

        // Prorated.
        if ($gvwr >= 10000) {
            // Date of sale must be in this year.
            // License calculation prorates to this july (if july has not elapsed)
            // Else prorates to next year's july.

            $date_of_sale_month = date('m', strtotime($date_of_sale));
            $july_diff_count = 7 - $date_of_sale_month;

            if ($july_diff_count > 0) {
                $license_multiplier = 7 - ($july_diff_count * -1);
                $prorated_license_fee = ($license_fee / 12) * $license_multiplier;

                $result_arr['msg'] = 'License Fee';
                $result_arr['formula'] = "$license_fee * $license_multiplier";
                $result_arr['VALUE'] = $prorated_license_fee;

                return $result_arr;
            } else {
                $license_multiplier = 12 - ($date_of_sale_month) + 7;
                $prorated_license_fee = ($license_fee / 12) * $license_multiplier;

                $result_arr['msg'] = 'License Fee';
                $result_arr['formula'] = "$license_fee * $license_multiplier";
                $result_arr['VALUE'] = $prorated_license_fee;

                return $result_arr;
            }
        } else {
            $result_arr['VALUE'] = str_replace('$', '', $result_arr['VALUE']);

            return $result_arr;
        }
    }

    public function getLicensePenaltyFee()
    {
        return "";

        $transaction_type = $this->request->get('transaction_type');

        // Duplicate Title and Title Registration Correction
        if(($transaction_type == 'DT' || $transaction_type == 'TRC') || $this->ttlTypeCheck($transaction_type) == false) {
            return "";
        }

        // Param request.
        $request_category = $this->request->get('category');
        $request_type = $this->request->get('type');

        // Get State (LA) and Fee (68.50).
        // We need this to query the fees - so we will know which states they belong.
        $state = State::where('code', 'LA')->first()->id;
        $fee = Fee::where('name', 'LICENSE_PNLTY_FEE')->first()->id;

        // We need the category and type (passenger) (passenger)
        $category = Category::where('name', $request_category)->first()->id;
        $type = Type::where('name', $request_type)->first()->id;

        // After getting those values, we can now consolidate them to a single table and extract it's id.
        $category_id = DB::table('categories_types')
            ->where('category_id', $category)
            ->where('type_id', $type)
            ->first()->id;

        // After we get the category ID, which is references the (state), (fee), (request_category) and (request_type)
        $fee = DB::table('fees_states')
            ->where('state_id', $state)
            ->where('fee_id', $fee)
            ->where('category_type_id', $category_id)
            ->first();

        // We can then get the fee.
        if ($fee) {
            return $fee->amount;
        } else {
            return 'No license penalty fee found.';
        }
    }

    public function getMortgageFee()
    {
        $transaction_type = $this->request->get('transaction_type');

        // Duplicate Title, Title Registration Correction or no transaction type passed.
        if ($transaction_type == 'DT' || $transaction_type == 'TRC' || $this->ttlTypeCheck($transaction_type) == false) {
            return '';

        } else {
            $mortgage_fee = $this->request->get('mortgage_fee');

            return $mortgage_fee;
        }
    }

    public function getVehInsFee()
    {
        // Require params.
        $parish_name = $this->request->get('parish_name');
        $model_year = $this->request->get('model_year');
        $fuel_type = $this->request->get('fuel_type');

        $parish_name_store = [
            'Ascension', 'East Baton Rouge', 'Iberville',
            'Livingston', 'West Baton Rouge'
        ];

        // Check if required params are present.
        if ($parish_name && $model_year && $fuel_type) {
            if (in_array($parish_name, $parish_name_store) && $model_year >= 1980 && $fuel_type == "G") {
                return "18.00";
            } else {
                return "10.00";
            }
        } else {
            return 'Params (parish_name) and (model_year) and (gasoline_fueled) is expected.';
        }

    }

    public function getServiceFee()
    {
        $office_loc = $this->request->get('office_loc');

        if ($office_loc) {
            $query = DB::select(
                DB::raw(
                    "SELECT cf.fee_id, c.name, cf.amount
                    FROM
                        cities_fees cf
                    INNER JOIN fees f
                      ON cf.fee_id = f.id
                      AND f.name = 'SERVICE_FEE'
                    INNER JOIN cities c
                      ON cf.city_id = c.id
                      AND c.name = :office_location "
                ),
                array('office_location' => $office_loc)
            );

            if (! empty($query)) {
                $result = $query[0]->amount;
            } else {
                $result = 'Cannot get fee specified by office - ' . $office_loc;
            }

            return $result;
        } else {
            return 'No office parameter received - cannot get office fee.';
        }
    }

    /**
     * Get title fee.
     * @return float
     */
    public function getTitleFee()
    {
        $transaction_type = $this->request->get('transaction_type');

        // DT
        if($transaction_type == 'DT' || $this->ttlTypeCheck($transaction_type) == false) {
            return "";
        }

        // Param request.
        $request_category = $this->request->get('category');
        $request_type = $this->request->get('type');

        // Get State (LA) and Fee (68.50).
        // We need this to query the fees - so we will know which states they belong.
        $state = State::where('code', 'LA')->first()->id;
        $fee = Fee::where('name', 'TITLE_FEE')->first()->id;

        // We need the category and type (passenger) (passenger)
        $category = Category::where('name', $request_category)->first()->id;
        $type = Type::where('name', $request_type)->first()->id;

        // After getting those values, we can now consolidate them to a single table and extract it's id.
        $category_id = DB::table('categories_types')
            ->where('category_id', $category)
            ->where('type_id', $type)
            ->first()->id;

        // After we get the category ID, which is references the (state), (fee), (request_category) and (request_type)
        $title_fee = DB::table('fees_states')
            ->where('state_id', $state)
            ->where('fee_id', $fee)
            ->where('category_type_id', $category_id)
            ->first()->amount;

        // We can then get the fee.
        if ($title_fee) {
            return $title_fee;
        } else {
            return 'No title fee found.';
        }
    }

    /**
     * Get title correction fee.
     * @return float
     */
    public function getTitleCorrectionFee()
    {
        $transaction_type = $this->request->get('transaction_type');

        // Needs Title Registration Correction.
        if($transaction_type != 'TRC' || $this->ttlTypeCheck($transaction_type) == false) {
            return "";
        }

        $request_category = $this->request->get('category');
        $request_type = $this->request->get('type');

        // Get State (LA) and Fee (18.50)
        $LA = State::where('code', 'LA')->first()->id;
        $fee = Fee::where('name', 'TITLE_CORRECTION_FEE')->first()->id;

        $category = Category::where('name', $request_category)->first()->id;
        $type = Type::where('name', $request_type)->first()->id;

        $category_id = DB::table('categories_types')
            ->where('category_id', $category)
            ->where('type_id', $type)
            ->first()->id;

        $title_fee = DB::table('fees_states')
            ->where('state_id', $LA)
            ->where('fee_id', $fee)
            ->where('category_type_id', $category_id)
            ->first();

        if ($title_fee) {
            return $title_fee->amount;
        } else {
            return 'No title correction fee found.';
        }
    }

    /**
     * Get handling fee.
     * @return float
     */
    public function getHandlingFee()
    {
        $request_category = $this->request->get('category');
        $request_type = $this->request->get('type');
        $transaction_type = $this->request->get('transaction_type');

        // Must have an LA transaction type.
        if($this->ttlTypeCheck($transaction_type) == false) {
            return "";
        }

        // Get State (LA) and Fee (18.50)
        $LA = State::where('code', 'LA')->first()->id;
        $fee = Fee::where('name', 'HANDLING_FEE')->first()->id;

        $category = Category::where('name', $request_category)->first()->id;
        $type = Type::where('name', $request_type)->first()->id;

        $category_id = DB::table('categories_types')
            ->where('category_id', $category)
            ->where('type_id', $type)
            ->first()->id;

        $title_fee = DB::table('fees_states')
            ->where('state_id', $LA)
            ->where('fee_id', $fee)
            ->where('category_type_id', $category_id)
            ->first()->amount;

        if ($title_fee) {
            return $title_fee;
        } else {
            return 'No title correction fee found.';
        }
    }

    /**
     * Get duplicate title fee.
     * @return float
     */
    public function getDupTitleFee()
    {
        $transaction_type = $this->request->get('transaction_type');

        // DT
        if($transaction_type == 'DT' && $this->ttlTypeCheck($transaction_type) != false) {
            $handling_fee = $this->getHandlingFee();
            $title_fee = $this->getTitleFee();

            $dup_title_fee = floatval($handling_fee) + floatval($title_fee);

            return "$dup_title_fee";
        } else {
            return "";
        }
    }

    /**
     * Get reg fee.
     * @return float
     */
    public function getRegFee()
    {
        $request_category = $this->request->get('category');
        $request_type = $this->request->get('type');
        $taxable_value = $this->request->get('taxable_value');

        if ($request_category && $request_type && $taxable_value) {
            // Tables involved: tx_taxable_values, category, type, categories_types
            $category_check = DB::table('categories')
                ->where('name', '=', $request_category)
                ->first();

            $type_check = DB::table('types')
                ->where('name', '=', $request_category)
                ->first();

            // Get category and type.
            if ($category_check && $type_check) {
                $category_id = $category_check->id;
                $type_id = $type_check->id;
            } else {
                return 'No match found in category and type.';
            }

            // Use category and type get categories types id.
            $category_type_check = DB::table('categories_types')
                ->where('category_id', '=', $category_id)
                ->where('type_id', '=', $type_id)
                ->first();


            if ($category_type_check) {
                $category_type_id = $category_type_check->id;
            } else {
                return 'No category type id.';
            }



            // Get range using taxable value basing on the categories types id.
            /*$la_taxable_value = DB::table('la_taxable_values')
                                  ->where('categories_types_id', '=', $category_type_id)
                                  ->first();*/
            $la_taxable_value = DB::select(DB::raw("SELECT
                                                      reg_fee
                                                    FROM
                                                      la_taxable_values
                                                    WHERE categories_types_id = :category_type_id
                                                      AND :taxable_value BETWEEN `min_value`
                                                      AND `max_value`  "), array(
                'taxable_value' => $taxable_value,
                'category_type_id' => $category_type_id
            ));

            if ($la_taxable_value) {
                return "{$la_taxable_value[0]->reg_fee}";
            } else {
                return '3';
            }

        } else {
            return "Some missing parameters.";
            /*throw new ApiException(
                ApiResponse::CODE_BAD_REQUEST,
                'Taxable value must not be negative.',
                null,
                ApiResponse::HTTPCODE_BAD_REQUEST
            );*/
        }
    }

    /**
     * Get reciprocirt fee.
     * @return float
     */
    public function getReciprocity()
    {

    }

    /**
     * Get reg duplicated fee fee.
     * @return float
     */
    public function getRegDupFee()
    {
        $request_category = $this->request->get('category');
        $request_type = $this->request->get('type');

        // Get State (LA) and Fee (18.50)
        $LA = State::where('code', 'LA')->first()->id;
        $fee = Fee::where('name', 'REG_DUP_FEE')->first()->id;

        $category = Category::where('name', $request_category)->first()->id;
        $type = Type::where('name', $request_type)->first()->id;

        $category_id = DB::table('categories_types')
            ->where('category_id', $category)
            ->where('type_id', $type)
            ->first()->id;

        $title_fee = DB::table('fees_states')
            ->where('state_id', $LA)
            ->where('fee_id', $fee)
            ->where('category_type_id', $category_id)
            ->first()->amount;

        if ($title_fee) {
            return $title_fee;
        } else {
            return 'No title correction fee found.';
        }
    }

    /**
     * Get license transfer fee.
     * @return float
     */
    public function getLicenseTrnsfrFee()
    {
        $request_category = $this->request->get('category');
        $request_type = $this->request->get('type');
        $transaction_type = $this->request->get('transaction_type');

        // New Title / Transfer Plate
        if($transaction_type != 'TP' || $this->ttlTypeCheck($transaction_type) == false) {
            return "";
        }

        // Get State (LA) and Fee (18.50)
        $LA = State::where('code', 'LA')->first()->id;
        $fee = Fee::where('name', 'LICENSE_TRNSFR_FEE')->first()->id;

        $category = Category::where('name', $request_category)->first()->id;
        $type = Type::where('name', $request_type)->first()->id;

        $category_id = DB::table('categories_types')
            ->where('category_id', $category)
            ->where('type_id', $type)
            ->first()->id;

        $title_fee = DB::table('fees_states')
            ->where('state_id', $LA)
            ->where('fee_id', $fee)
            ->where('category_type_id', $category_id)
            ->first()->amount;

        if ($title_fee) {
            return $title_fee;
        } else {
            return 'No license transfer fee found.';
        }
    }

    /**
     * Get get dup fee.
     * @return float
     */
    public function getDupPlateFee()
    {
        // Param request.
        $request_category = $this->request->get('category');
        $request_type = $this->request->get('type');

        // We need this to query the fees - so we will know which states they belong.
        $state = State::where('code', 'LA')->first()->id;
        $fee = Fee::where('name', 'DUP_PLATE_FEE')->first()->id;

        // We need the category and type (passenger) (passenger)
        $category = Category::where('name', $request_category)->first()->id;
        $type = Type::where('name', $request_type)->first()->id;

        // After getting those values, we can now consolidate them to a single table and extract it's id.
        $category_id = DB::table('categories_types')
            ->where('category_id', $category)
            ->where('type_id', $type)
            ->first()->id;

        // After we get the category ID, which is references the (state), (fee), (request_category) and (request_type)
        $title_fee = DB::table('fees_states')
            ->where('state_id', $state)
            ->where('fee_id', $fee)
            ->where('category_type_id', $category_id)
            ->first()->amount;

        // We can then get the fee.
        if ($title_fee) {
            // Change return type to account for handling fee.
            $handling_fee = $this->getHandlingFee();
            return (string)($title_fee + floatval($handling_fee));
        } else {
            return 'No title fee found.';
        }
    }

    /**
     * Get person plate fee.
     * @return float
     */
    public function DUP_TITLE_FEE()
    {
        $request_category = $this->request->get('category');
        $request_type = $this->request->get('type');

        // Get State (LA) and Fee (18.50)
        $LA = State::where('code', 'LA')->first()->id;
        $fee = Fee::where('name', 'LICENSE_TRNSFR_FEE')->first()->id;


    }

    /**
     * Get person handling fee.
     * @return float
     */
    public function getPersnlPlateHandlingFee()
    {
        // Param request.
        $request_category = $this->request->get('category');
        $request_type = $this->request->get('type');

        // We need this to query the fees - so we will know which states they belong.
        $state = State::where('code', 'LA')->first()->id;
        $fee = Fee::where('name', 'PERSL_PLATE_HANDLING_FEE')->first()->id;

        // We need the category and type (passenger) (passenger)
        $category = Category::where('name', $request_category)->first()->id;
        $type = Type::where('name', $request_type)->first()->id;

        // After getting those values, we can now consolidate them to a single table and extract it's id.
        $category_id = DB::table('categories_types')
            ->where('category_id', $category)
            ->where('type_id', $type)
            ->first()->id;

        // After we get the category ID, which is references the (state), (fee), (request_category) and (request_type)
        $title_fee = DB::table('fees_states')
            ->where('state_id', $state)
            ->where('fee_id', $fee)
            ->where('category_type_id', $category_id)
            ->first();

        // We can then get the fee.
        if ($title_fee) {
            return "$title_fee->amount";
            // return 'One time $' . $title_fee . ' fee';
        } else {
            return 'No PERSL_PLATE_HANDLING_FEE fee found.';
        }
    }

    /**
     * Get spec plate fee.
     * @return float
     */
    public function getSpecPlateFee()
    {

    }

    /**
     * Get personal plate fee.
     * @return float
     */
    public function getPersnlPlateFee()
    {
        // Param request.
        $request_category = $this->request->get('category');
        $request_type = $this->request->get('type');

        // We need this to query the fees - so we will know which states they belong.
        $state = State::where('code', 'LA')->first()->id;
        $fee = Fee::where('name', 'PERSNL_PLATE_FEE')->first()->id;

        // We need the category and type (passenger) (passenger)
        $category = Category::where('name', $request_category)->first()->id;
        $type = Type::where('name', $request_type)->first()->id;

        // After getting those values, we can now consolidate them to a single table and extract it's id.
        $category_id = DB::table('categories_types')
            ->where('category_id', $category)
            ->where('type_id', $type)
            ->first()->id;

        // After we get the category ID, which is references the (state), (fee), (request_category) and (request_type)
        $title_fee = DB::table('fees_states')
            ->where('state_id', $state)
            ->where('fee_id', $fee)
            ->where('category_type_id', $category_id)
            ->first();

        // We can then get the fee.
        if ($title_fee) {
            return "{$title_fee->amount}";
            // return '$' . $title_fee . '/YR';
        } else {
            return 'No title fee found.';
        }
    }

    /**
     * Get personal plate fee.
     * @return float
     */
    public function getPersnlPlateAdminFee()
    {
        // Param request.
        $request_category = $this->request->get('category');
        $request_type = $this->request->get('type');

        // We need this to query the fees - so we will know which states they belong.
        $state = State::where('code', 'LA')->first()->id;
        $fee = Fee::where('name', 'PERSL_PLATE_ADMIN_FEE')->first()->id;

        // We need the category and type (passenger) (passenger)
        $category = Category::where('name', $request_category)->first()->id;
        $type = Type::where('name', $request_type)->first()->id;

        // After getting those values, we can now consolidate them to a single table and extract it's id.
        $category_id = DB::table('categories_types')
            ->where('category_id', $category)
            ->where('type_id', $type)
            ->first()->id;

        // After we get the category ID, which is references the (state), (fee), (request_category) and (request_type)
        $title_fee = DB::table('fees_states')
            ->where('state_id', $state)
            ->where('fee_id', $fee)
            ->where('category_type_id', $category_id)
            ->first();

        // We can then get the fee.
        if ($title_fee) {
            return "$title_fee->amount";
            // return 'One time $' . $title_fee . ' fee';
        } else {
            return 'No title fee found.';
        }
    }

    /**
     * Functions searching for a single condition and if it is found we return it's ID,
     * if not - insert and get it's newly generated ID.
     */
    public function autoInsert($table_name, $search_conditions, $insert_data)
    {
        // Isolate search condition params.
        $search_column = $search_conditions['search_column'];
        $operation = $search_conditions['operation'];
        $value = $search_conditions['value'];
        $not_found_insert = $insert_data;

        $search_query = DB::table($table_name)
            ->where($search_conditions['column'], $search_conditions['operation'], $search_conditions['value'])
            ->first();

        if ($search_query) {

        } else {
            // Insert and get new ID.

        }
    }

    public function getLicenseDupFee()
    {
        $request_category = $this->request->get('category');
        $request_type = $this->request->get('type');

        // Get State (LA) and Fee (18.50)
        $LA = State::where('code', 'LA')->first()->id;
        $fee = Fee::where('name', 'LICENSE_DUP_FEE')->first()->id;

        $category = Category::where('name', $request_category)->first()->id;
        $type = Type::where('name', $request_type)->first()->id;

        $category_id = DB::table('categories_types')
            ->where('category_id', $category)
            ->where('type_id', $type)
            ->first()->id;

        $title_fee = DB::table('fees_states')
            ->where('state_id', $LA)
            ->where('fee_id', $fee)
            ->where('category_type_id', $category_id)
            ->first()->amount;

        if ($title_fee) {
            return $title_fee;
        } else {
            return 'No license dup fee found.';
        }
    }}