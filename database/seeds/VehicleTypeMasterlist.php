<?php

namespace Thirty98\Seeder;

use Thirty98\API\Stdlib\Seeders\AbstractDatabaseSeeder;
use Illuminate\Support\Facades\DB;

class VehicleTypeMasterlist extends AbstractDatabaseSeeder
{
    CONST TABLE = 'vehicle_types';

    protected function executeSeeder()
    {
        foreach ($this->getVehicleTypes() AS $type) {

            $slug = $this->slugit($type['name']);
            $type['slug'] = $slug;

            $exists = DB::table(self::TABLE)->where('slug', $slug)->where("class", $type['class'])->first();

            if (!$exists) {
                DB::table(self::TABLE)->insert($type);
            }

            continue;
        }
    }

    protected function getVehicleTypes()
    {
        return [
            ["name" => "Passenger", "category" => 'passenger', "class" => "passenger"],
            ["name" => "Alternative Fuel AFV", "category" => 'passenger', "class" => "afv"],
            ["name" => "Station Wagons", "category" => 'passenger', "class" => "station wagons"],
            ["name" => "Van", "category" => 'passenger', "class" => "van"],
            ["name" => "Van Pool", "category" => 'passenger', "class" => "van pool"],
            ["name" => "SUV", "category" => 'passenger', "class" => "suv"],
            ["name" => "Pickup", "category" => 'passenger', "class" => "pickup"],
            ["name" => "Collector Vehicle", "category" => 'passenger', "class" => "collector vehicle"],
            ["name" => "Pioneer Vehicle", "category" => 'passenger', "class" => "pioneer vehicle"],
            ["name" => "Classic Car", "category" => 'passenger', "class" => "classic car"],
            ["name" => "Street Rod Vehicle", "category" => 'passenger', "class" => "street rod vehicle"],
            ["name" => "Exempt Vehicle", "category" => 'passenger', "class" => "exempt vehicle"],
            ["name" => "Ambulance", "category" => 'passenger', "class" => "ambulance"],
            ["name" => "Hearse", "category" => 'passenger', "class" => "hearse"],
            ["name" => "Taxi", "category" => 'passenger', "class" => "taxi"],
            ["name" => "Limousine", "category" => 'passenger', "class" => "limousine"],
            ["name" => "Passenger Commercial", "category" => 'passenger', "class" => "passenger commercial"],
            ["name" => "Truck", "category" => "truck", "class" => "truck"],
            ["name" => "Van Truck Plates", "category" => "truck", "class" => "van truck"],
            ["name" => "SUV Truck Plates", "category" => "truck", "class" => "suv truck"],
            ["name" => "1/4 Pickup Truck", "category" => "truck", "class" => "pickup truck 1_4"],
            ["name" => "1/2 Pickup Truck", "category" => "truck", "class" => "pickup truck 1_2"],
            ["name" => "3/4 Pickup Truck", "category" => "truck", "class" => "pickup truck 3_4"],

            ["name" => "1/2 Pickup Van", "category" => "van", "class" => "pickup van 1_2"],
            ["name" => "3/4 Pickup Van", "category" => "van", "class" => "pickup van 3_4"],
            ["name" => "1 Ton Pickup Van", "category" => "van", "class" => "pickup van"],


            ["name" => "1 Ton Pickup Truck", "category" => "truck", "class" => "pickup truck"],
            ["name" => "Pickup Truck > 1 Ton", "category" => "truck", "class" => "pickup truck over ton"],
            ["name" => "Truck Camper", "category" => "truck", "class" => "truck camper"],
            ["name" => "Antique Vehicle", "category" => "car", "class" => "antique vehicle"],
            ["name" => "Dump Truck", "category" => "truck", "class" => "dump truck"],
            ["name" => "Tow Truck", "category" => "truck", "class" => "tow truck"],
            ["name" => "Truck Tractor", "category" => "truck", "class" => "truck tractor"],
            ["name" => "Freight Truck", "category" => "truck", "class" => "freight truck"],
            ["name" => "Commercial Truck", "category" => "truck", "class" => "commercial truck"],
            ["name" => "Combination Truck", "category" => "truck", "class" => "combination truck"],
            ["name" => "Bus", "category" => "bus", "class" => "bus"],
            ["name" => "City Bus", "category" => "bus", "class" => "city bus"],
            ["name" => "Intercity Bus", "category" => "bus", "class" => "intercity bus"],
            ["name" => "Charter Bus", "category" => "bus", "class" => "charter bus"],
            ["name" => "Private Bus", "category" => "bus", "class" => "private bus"],
            ["name" => "Motor Bus", "category" => "bus", "class" => "motor bus"],
            ["name" => "Motor Home", "category" => "bus", "class" => "motor home"],
            ["name" => "Motorcycle", "category" => "motorcycle", "class" => "motorcycle"],
            ["name" => "Motorcycle Side Car", "category" => "motorcycle", "class" => "motorcycle side car"],

            ["name" => "Motorized Bike Standard", "category" => "motorcycle", "class" => "motorized bike standard"],
            ["name" => "Motorized Bike Automatic", "category" => "motorcycle", "class" => "motorized bike automatic"],

            ["name" => "Off-Road Motorcycle", "category" => "motorcycle", "class" => "off road motorcycle"],
            ["name" => "Moped", "category" => "motorcycle", "class" => "moped"],
            ["name" => "Mini-Bike", "category" => "motorcycle", "class" => "mini bike"],
            ["name" => "ATV Type Vehicle", "category" => "motorcycle", "class" => "atv"],
            ["name" => "Snowmobile", "category" => "motorcycle", "class" => "snowmobile"],
            ["name" => "Trailer", "category" => "trailer", "class" => "trailer"],
            ["name" => "Horse Trailer", "category" => "trailer", "class" => "horse trailer"],
            ["name" => "Utility Trailer", "category" => "trailer", "class" => "utility trailer"],
            ["name" => "Tent Trailer", "category" => "trailer", "class" => "tent trailer"],
            ["name" => "Travel Trailer", "category" => "trailer", "class" => "travel trailer"],
            ["name" => "Semi Trailer", "category" => "trailer", "class" => "semi trailer"],
            ["name" => "Token Trailer", "category" => "trailer", "class" => "token trailer"],
            ["name" => "Boat Trailer", "category" => "trailer", "class" => "boat trailer"],
            ["name" => "Commercial Trailer", "category" => "trailer", "class" => "commercial trailer"],
            ["name" => "Vessel", "category" => "vessel", "class" => "vessel"],
            ["name" => "Personal Vessel", "category" => "vessel", "class" => "personal vessel"],
            ["name" => "Vessel Outboard Motor", "category" => "vessel", "class" => "vessel outboard motor"],
            ["name" => "Car", "category" => "car", "class" => "car"],
            ["name" => "Off-Road Vehicle", "category" => "motorcycle", "class" => "off road vehicle"]
        ];
    }
}