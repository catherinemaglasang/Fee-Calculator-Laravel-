<?php namespace Thirty98\API\Texas\Seeders;

use Illuminate\Support\Facades\DB;
use Thirty98\API\General\Entities\APISeeder;

class ActivationDates extends APISeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list = [
            'passenger' => [
                'passenger' => ['start' => '2014-05-01', 'end' => '2099-12-31'],
            ],
            'truck' => [
                'van-truck-plates'      => ['start' => '2014-05-01', 'end' => '2099-12-31'],
                'suv-truck-plates'      => ['start' => '2014-05-01', 'end' => '2099-12-31'],
                '1-4-pickup-truck'      => ['start' => '2014-05-01', 'end' => '2099-12-31'],
                '1-2-pickup-truck'      => ['start' => '2014-05-01', 'end' => '2099-12-31'],
                '3-4-pickup-truck'      => ['start' => '2014-05-01', 'end' => '2099-12-31'],
                '1-ton-pickup-truck'    => ['start' => '2014-05-01', 'end' => '2099-12-31'],
                'pickup-truck-1-ton'    => ['start' => '2014-05-01', 'end' => '2099-12-31'],
                'truck-tractor'         => ['start' => '2014-05-01', 'end' => '2099-12-31'],
                'combination-truck'     => ['start' => '2014-05-01', 'end' => '2099-12-31'],
            ],
            'bus' => [
                'city-bus'      => ['start' => '2014-05-01', 'end' => '2099-12-31'],
                'private-bus'   => ['start' => '2014-05-01', 'end' => '2099-12-31'],
                'motor-bus'     => ['start' => '2014-05-01', 'end' => '2099-12-31'],
            ],
            'motorcycle' => [
                'moped'                 => ['start' => '2014-05-01', 'end' => '2099-12-31'],
                'motorcycle'            => ['start' => '2014-05-01', 'end' => '2099-12-31'],
                'off-road-motorcycle'   => ['start' => '2014-05-01', 'end' => '2099-12-31'],
                'mini-bike'             => ['start' => '2014-05-01', 'end' => '2099-12-31'],
                'atv-type-vehicle'      => ['start' => '2014-05-01', 'end' => '2099-12-31'],
            ],
            'recreational' => [
                'motor-home'        => ['start' => '2014-05-01', 'end' => '2099-12-31'],
                'travel-trailer'    => ['start' => '2014-05-01', 'end' => '2099-12-31'],
            ],
            'trailer' => [
                'token-trailer'     => ['start' => '2014-05-01', 'end' => '2099-12-31'],
                'trailer'           => ['start' => '2014-05-01', 'end' => '2099-12-31'],
                'utility-trailer'   => ['start' => '2014-05-01', 'end' => '2099-12-31'],
            ],
            'vintage' => [
                'collector-vehicle' => ['start' => '2014-05-01', 'end' => '2099-12-31'],
            ],
            'exempt' => [
                'exempt-vehicle' => ['start' => '2014-05-01', 'end' => '2099-12-31'],
            ]
        ];

        foreach ($list as $c => $v) {
            foreach ($v as $t => $dates) {
                $category = DB::table('categories')->where('name', $c)->first();
                $type = DB::table('types')->where('name', $t)->first();

                $categoryType = DB::table('categories_types')->where('category_id', $category->id)->where('type_id',
                    $type->id)->first();

                if ($categoryType) {
                    DB::table('categories_types')
                        ->where('id', $categoryType->id)
                        ->update(['start_date' => $dates['start'], 'end_date' => $dates['end']]);
                }
            }
        }
    }
}
