<?php

namespace Thirty98\Seeder;

use Thirty98\API\Stdlib\Seeders\AbstractDatabaseSeeder;
use Illuminate\Support\Facades\DB;

class FormFieldMasterlist extends AbstractDatabaseSeeder
{
    CONST TABLE = 'form_fields';
    
    protected function executeSeeder()
    {
        foreach ($this->getFormFields() AS $field) {            
            
            $field['slug'] = $this->slugit($field['label']);
            $exists =  DB::table(self::TABLE)->where('slug', $field['slug'])
                ->where("name", $field['name'])
                ->first();
            
            if (!$exists) {                 
                DB::table(self::TABLE)->insert($field);
            }
            
            continue;          
        }
    }
    
    private function getFormFields()
    {
        return [
            ["name" => "transaction_type", "label" => "Transaction Type"],
            ["name" => "vin", "label" => "VIN"],
            ["name" => "vehicle_type", "label" => "Vehicle Type"],
            ["name" => "model_year", "label" => "Model Year"],
            ["name" => "address", "label" => "Street Address"],
            ["name" => "zip", "label" => "Zip"],
            ["name" => "resident_county", "label" => "Select Resident County"],
            ["name" => "processing_county", "label" => "Select Processing County"],
            ["name" => "empty_weight", "label" => "Empty Weight"],
            ["name" => "carrying_capacity", "label" => "Carrying Capacity"],
            ["name" => "gvw", "label" => "GVW"],
            ["name" => "gvwr", "label" => "GVWR"],
            ["name" => "inspection_fee", "label" => "Inspection Fee"],
            ["name" => "freight", "label" => "Freight"],
            ["name" => "sales_price", "label" => "Sales Price"],             
            ["name" => "rebate_discount", "label" => "Rebate / Discount"],             
            ["name" => "trade_in_value", "label" => "Trade-in Value"],             
            ["name" => "taxable_value", "label" => "Taxable Value"],             
            ["name" => "fuel_type", "label" => "Fuel Type"],
            ["name" => "date_of_sale", "label" => "Date of Sale"],
            ["name" => "mortgage_fee", "label" => "Mortgage Fee"],
            ["name" => "address", "label" => "Customer Address"],
            ["name" => "county", "label" => "Select Prish"],
            ["name" => "city_limits", "label" => "City Limits?"],
            ["name" => "trailer_weight", "label" => "Trailer Weight"],
            ["name" => "sales_tax_credit", "label" => "Sales Tax Credit"]
        ];
    }
}
