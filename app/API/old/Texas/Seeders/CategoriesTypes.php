<?php

namespace Thirty98\API\Texas\Seeders;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Slugifier;
use Thirty98\API\General\Entities\APISeeder;

class CategoriesTypes extends APISeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data = 'Passenger,PASSENGER;
                Van-Truck Plates,TRUCK;
                SUV-Truck Plates,TRUCK;
                1/4 Pickup Truck,TRUCK;
                1/2 Pickup Truck,TRUCK;
                3/4 Pickup Truck,TRUCK;
                1 Ton Pickup Truck,TRUCK;
                Pickup Truck > 1 Ton,TRUCK;
                Truck Tractor,TRUCK;
                Combination Truck,TRUCK;
                City Bus,BUS;
                Private Bus,BUS;
                Motor Bus,BUS;
                Moped,MOTORCYCLE;
                Motorcycle,MOTORCYCLE;
                Off-Road Motorcycle,MOTORCYCLE;
                Mini-Bike,MOTORCYCLE;
                ATV Type Vehicle,MOTORCYCLE;
                Motor Home,RECREATIONAL;
                Travel Trailer,RECREATIONAL;
                Token Trailer,TRAILER;
                Trailer,TRAILER;
                Utility Trailer,TRAILER;
                Collector Vehicle,VINTAGE;
                Exempt Vehicle,EXEMPT';

        $data = explode(';', $data);

        foreach ($data as $element) {

            $element = explode(',', $element);

            $typeInput = Slugifier::slugify(trim($element[0]));
            $categoryInput = Slugifier::slugify(trim($element[1]));
            $slug = trim($element[0]);

            // Add category.
            $category = DB::table('categories')->where('name', $categoryInput)->first();
            if (!$category) {
                $now = Carbon::now()->toDateTimeString();
                $categoryId = DB::table('categories')->insertGetId([
                    'name' => $categoryInput,
                    'created_at' => $now,
                    'updated_at' => $now
                ]);

                $category = DB::table('categories')->where('id', $categoryId)->first();
            }

            // Add type.
            $type = DB::table('types')->where('name', $typeInput)->first();
            if (!$type) {
                $now = Carbon::now()->toDateTimeString();
                $typeId = DB::table('types')->insertGetId([
                    'name' => $typeInput,
                    'slug' => $slug,
                    'created_at' => $now,
                    'updated_at' => $now
                ]);

                $type = DB::table('types')->where('id', $typeId)->first();
            }

            // Junction Table.
            $found = DB::table('categories_types')
                ->where('category_id', $category->id)
                ->where('type_id', $type->id)
                ->first();

            if(!$found) {
                DB::table('categories_types')->insert(['category_id' => $category->id, 'type_id' => $type->id]);
            }
        }
    }
}
