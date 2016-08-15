<?php

/*Identify own namespace dir*/
namespace Thirty98\API\Louisiana\Entities\Repositories;

/*When extending or using something else*/

use Illuminate\Http\Request;
use Thirty98\API\General\Entities\ApiException;
use Thirty98\API\General\Entities\ApiResponse;
use Thirty98\API\General\Entities\Avalara;
use Thirty98\API\General\Models\Category;
use Thirty98\API\General\Models\Fee;
use Thirty98\API\General\Models\State;
use Thirty98\API\General\Models\Type;
use Thirty98\API\Louisiana\Contracts\CalculatorRepositoryInterface;
use DB;


class OffRoadOffRoadRepository implements CalculatorRepositoryInterface
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
// Param request.
        $request_category = $this->request->get('category');
        $request_type = $this->request->get('type');

        // Get State (LA) and Fee (68.50).
        // We need this to query the fees - so we will know which states they belong.
        $state = State::where('code', 'LA')->first()->id;
        $fee = Fee::where('name', 'LICENSE_FEE')->first()->id;

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
            return 'No license fee found.';
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
        $gvwr = $this->request->get('gvwr');

        $parish_name_store = [
            'Ascension', 'East Baton Rouge', 'Iberville',
            'Livingston', 'West Baton Rouge'
        ];

        // Check if required params are present.
        if ($parish_name && $model_year && $gvwr) {
            if (in_array($parish_name, $parish_name_store) && $model_year >= 1980 && $gvwr <= 10000) {
                return "18.00";
            } else {
                return "10.00";
            }
        } else {
            return 'Params (parish_name) and (model_year) and (gvwr) is expected.';
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
        return "";
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
        return "";
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
        return '';
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
        return '';
    }

    /**
     * Get personal plate fee.
     * @return float
     */
    public function getPersnlPlateAdminFee()
    {
        return '';
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
    }
}