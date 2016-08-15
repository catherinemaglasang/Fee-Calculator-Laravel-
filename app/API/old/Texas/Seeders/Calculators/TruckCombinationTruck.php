<?php

namespace Thirty98\API\Texas\Seeders\Calculators;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Thirty98\API\General\Entities\APISeeder;
use Thirty98\API\Texas\Entities\Repositories\TruckCombinationTruckRepository;

class TruckCombinationTruck extends APISeeder
{
    public $fees;

    public function __construct()
    {
        $now = Carbon::now()->toDateTimeString();

        // Get category type.
        $category = DB::table('categories')->where('name', TruckCombinationTruckRepository::CATEGORY)->first();
        $type = DB::table('types')->where('name', TruckCombinationTruckRepository::TYPE)->first();
        $category_type = DB::table('categories_types')
            ->where('category_id', $category->id)
            ->where('type_id', $type->id)->first();

        $this->fees = [
            [
                'name' => 'SALES_TAX_RATE',
                'type' => APISeeder::TYPE_TAX,
                'created_at' => $now,
                'updated_at' => $now,
                '_amount' => null,
                '_category_type_id' => $category_type->id
            ],
            [
                'name' => 'SALES_TAX_LT_PNLTY',
                'type' => APISeeder::TYPE_PENALTY,
                'created_at' => $now,
                'updated_at' => $now,
                '_amount' => null,
                '_category_type_id' => $category_type->id
            ],
            [
                'name' => 'NEW_RESID_TAX',
                'type' => APISeeder::TYPE_TAX,
                'created_at' => $now,
                'updated_at' => $now,
                '_amount' => 90,
                '_category_type_id' => $category_type->id
            ],
            [
                'name' => 'GIFT_TAX',
                'type' => APISeeder::TYPE_TAX,
                'created_at' => $now,
                'updated_at' => $now,
                '_amount' => 10,
                '_category_type_id' => $category_type->id
            ],
            [
                'name' => 'EVEN_TRADE_TAX',
                'type' => APISeeder::TYPE_TAX,
                'created_at' => $now,
                'updated_at' => $now,
                '_amount' => 5,
                '_category_type_id' => $category_type->id
            ],
            [
                'name' => 'EMISSION_FEE',
                'type' => APISeeder::TYPE_FEE,
                'created_at' => $now,
                'updated_at' => $now,
                '_amount' => null,
                '_category_type_id' => $category_type->id
            ],
            [
                'name' => 'TITLE_FEE',
                'type' => APISeeder::TYPE_FEE,
                'created_at' => $now,
                'updated_at' => $now,
                '_amount' => null,
                '_category_type_id' => $category_type->id
            ],
            [
                'name' => 'DUP_TITLE_FEE',
                'type' => APISeeder::TYPE_FEE,
                'created_at' => $now,
                'updated_at' => $now,
                '_amount' => 2,
                '_category_type_id' => $category_type->id
            ],
            [
                'name' => 'DLR_LT_PNLTY',
                'type' => APISeeder::TYPE_PENALTY,
                'created_at' => $now,
                'updated_at' => $now,
                '_amount' => null,
                '_category_type_id' => $category_type->id
            ],
            [
                'name' => 'CASUAL_LT_PNLTY',
                'type' => APISeeder::TYPE_PENALTY,
                'created_at' => $now,
                'updated_at' => $now,
                '_amount' => null,
                '_category_type_id' => $category_type->id
            ],
            [
                'name' => 'REG_FEE ',
                'type' => APISeeder::TYPE_FEE,
                'created_at' => $now,
                'updated_at' => $now,
                '_amount' => null,
                '_category_type_id' => $category_type->id
            ],
            [
                'name' => 'REG_OPTIONS',
                'type' => APISeeder::TYPE_FEE,
                'created_at' => $now,
                'updated_at' => $now,
                '_amount' => null,
                '_category_type_id' => $category_type->id
            ],
            [
                'name' => 'LOCAL_FEE',
                'type' => APISeeder::TYPE_FEE,
                'created_at' => $now,
                'updated_at' => $now,
                '_amount' => null,
                '_category_type_id' => $category_type->id
            ],
            [
                'name' => 'FARM_RANCH_EXEMPT',
                'type' => APISeeder::TYPE_FEE,
                'created_at' => $now,
                'updated_at' => $now,
                '_amount' => null,
                '_category_type_id' => $category_type->id
            ],
            [
                'name' => 'REG_DPS_FEE',
                'type' => APISeeder::TYPE_FEE,
                'created_at' => $now,
                'updated_at' => $now,
                '_amount' => 1,
                '_category_type_id' => $category_type->id
            ],
            [
                'name' => 'AUTOMAT_FEE',
                'type' => APISeeder::TYPE_FEE,
                'created_at' => $now,
                'updated_at' => $now,
                '_amount' => 1,
                '_category_type_id' => $category_type->id
            ],
            [
                'name' => 'TEMP_TAG_FEE',
                'type' => APISeeder::TYPE_FEE,
                'created_at' => $now,
                'updated_at' => $now,
                '_amount' => 5,
                '_category_type_id' => $category_type->id
            ],
            [
                'name' => 'DIESEL_FEE',
                'type' => APISeeder::TYPE_FEE,
                'created_at' => $now,
                'updated_at' => $now,
                '_amount' => null,
                '_category_type_id' => $category_type->id
            ],
            [
                'name' => 'EMM_SURCHARGE',
                'type' => APISeeder::TYPE_FEE,
                'created_at' => $now,
                'updated_at' => $now,
                '_amount' => null,
                '_category_type_id' => $category_type->id
            ],
            [
                'name' => 'YNG_FRMR_FEE',
                'type' => APISeeder::TYPE_FEE,
                'created_at' => $now,
                'updated_at' => $now,
                '_amount' => 5,
                '_category_type_id' => $category_type->id
            ],
            [
                'name' => 'VIT_TAX',
                'type' => APISeeder::TYPE_TAX,
                'created_at' => $now,
                'updated_at' => $now,
                '_amount' => null,
                '_category_type_id' => $category_type->id
            ],
            [
                'name' => 'INSP_FEE',
                'type' => APISeeder::TYPE_FEE,
                'created_at' => $now,
                'updated_at' => $now,
                '_amount' => null,
                '_category_type_id' => $category_type->id
            ]
        ];
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            DB::transaction(function () {
                foreach ($this->fees as $fee) {
                    // Check if already added.
                    $found = DB::table('fees')->where('name', $fee['name'])->first();

                    // If already exists, don't re-add to the database.
                    if ($found) {
                        continue;
                    }

                    // Remove _amount in the input.
                    $fee = array_except($fee, ['_amount', '_category_type_id']);

                    // Save fee.
                    DB::table('fees')->insertGetId($fee);
                }
            });
        } catch (\Exception $e) {
            $this->command->error('Unable to add Fees fields for Texas. Error:' . $e->getMessage());
        }
    }
}
