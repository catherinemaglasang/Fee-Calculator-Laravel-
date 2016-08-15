<?php

namespace Thirty98\Seeder\States\Louisiana;

use Thirty98\API\Stdlib\AbstractDatabaseSeeder;
use Thirty98\Models\LABodyStyles;
use Thirty98\Models\VehicleType;
use Carbon\Carbon;

class BodyStylesSeeder extends AbstractDatabaseSeeder
{
    public $state_code = 'LA';

    protected function executeSeeder()
    {
        $vehicle_types = VehicleType::all();

        $hash_vehicle_types = $this->getHashMap($vehicle_types, 'slug', 'id');

        foreach ($this->getBodyStyles() AS $body_style_details) {
            $vehicle_id = $hash_vehicle_types[$this->slugit($body_style_details['vehicle_category'])];
            $body_style = $body_style_details['body_styles'];
            $code = $body_style_details['code'];
            $slug = $this->slugit($body_style_details['vehicle_category'] . ' ' . $body_style . ' ' . $code);
            $display_order = $body_style_details['display_order'];
            $start_date = Carbon::parse($body_style_details['start_date'])->format('Y/m/d');
            $end_date = Carbon::parse($body_style_details['end_date'])->format('Y/m/d');

            $exists = LABodyStyles::where('vehicle_id', '=', $vehicle_id)
                ->where('body_style', '=', $body_style)
                ->where('code', '=', $code)
                ->where('slug', '=', $slug)
                ->where('priority', '=', $display_order)
                ->where('start_date', '=', $start_date)
                ->where('end_date', '=', $end_date)
                ->first();

            if (!$exists) {
                $insert_id = LABodyStyles::insertGetId([
                    'vehicle_id' => $vehicle_id,
                    'body_style' => $body_style,
                    'code' => $code,
                    'slug' => $slug,
                    'priority' => $display_order,
                    'start_date' => $start_date,
                    'end_date' => $end_date
                ]);

                if (!is_numeric($insert_id)) {
                    die('not inserted');
                }
            }

            continue;
        }
    }

    protected function getBodyStyles()
    {
        return [
            [
                'vehicle_category' => 'Bus',
                'body_styles' => 'Motor Home',
                'code' => 'MH',
                'display_order' => '1',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Car',
                'body_styles' => 'Ambulance',
                'code' => 'AM',
                'display_order' => '1',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Car',
                'body_styles' => 'Coach',
                'code' => 'CH',
                'display_order' => '2',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Car',
                'body_styles' => 'Convertible',
                'code' => 'CV',
                'display_order' => '3',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Car',
                'body_styles' => 'Coupe',
                'code' => 'CP',
                'display_order' => '4',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Car',
                'body_styles' => 'Hardtop *',
                'code' => 'HT',
                'display_order' => '5',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Car',
                'body_styles' => 'Hardtop 2 Door',
                'code' => '2T',
                'display_order' => '6',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Car',
                'body_styles' => 'Hardtop 4 Door',
                'code' => '4T',
                'display_order' => '7',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Car',
                'body_styles' => 'Hearse',
                'code' => 'HR',
                'display_order' => '8',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Car',
                'body_styles' => 'Limousine',
                'code' => 'LM',
                'display_order' => '9',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Car',
                'body_styles' => 'Open Body',
                'code' => 'OP',
                'display_order' => '10',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Car',
                'body_styles' => 'Retractable Hardtop',
                'code' => 'RH',
                'display_order' => '11',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Car',
                'body_styles' => 'Retractable Roadster',
                'code' => 'RD',
                'display_order' => '12',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Car',
                'body_styles' => 'Runabout or 3 Door',
                'code' => '3D',
                'display_order' => '13',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Car',
                'body_styles' => 'Sedan *',
                'code' => 'SD',
                'display_order' => '14',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Car',
                'body_styles' => 'Sedan 2 Door',
                'code' => '2D',
                'display_order' => '15',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Car',
                'body_styles' => 'Sedan 4 Door',
                'code' => '4D',
                'display_order' => '16',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Car',
                'body_styles' => 'Sports Utility Vehicle',
                'code' => 'LL',
                'display_order' => '17',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Car',
                'body_styles' => 'Station Wagon',
                'code' => 'SD',
                'display_order' => '18',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Motorcycle',
                'body_styles' => 'Motorcycles',
                'code' => 'MC',
                'display_order' => '1',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Off Road Vehicle',
                'body_styles' => '3 Wheels',
                'code' => '3W',
                'display_order' => '1',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Off Road Vehicle',
                'body_styles' => '4 Wheels',
                'code' => '4W',
                'display_order' => '2',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Off Road Vehicle',
                'body_styles' => '6 Wheels',
                'code' => '6W',
                'display_order' => '3',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Off Road Vehicle',
                'body_styles' => '8 Wheels',
                'code' => '8W',
                'display_order' => '4',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Off Road Vehicle',
                'body_styles' => 'Dirt Bike',
                'code' => 'MC',
                'display_order' => '5',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Trailer',
                'body_styles' => 'Auto Carrier',
                'code' => 'AC',
                'display_order' => '1',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Trailer',
                'body_styles' => 'Boat',
                'code' => 'BT',
                'display_order' => '2',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Trailer',
                'body_styles' => 'Cable Reef',
                'code' => 'CL',
                'display_order' => '3',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Trailer',
                'body_styles' => 'Camping Trailer',
                'code' => 'CT',
                'display_order' => '4',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Trailer',
                'body_styles' => 'Dump Trailer',
                'code' => 'DT',
                'display_order' => '5',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Trailer',
                'body_styles' => 'Fire Truck',
                'code' => 'FT',
                'display_order' => '6',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Trailer',
                'body_styles' => 'Flat-Bed or Platform',
                'code' => 'FB',
                'display_order' => '7',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Trailer',
                'body_styles' => 'Gondola',
                'code' => 'GA',
                'display_order' => '8',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Trailer',
                'body_styles' => 'Grain',
                'code' => 'GN',
                'display_order' => '9',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Trailer',
                'body_styles' => 'Hopper',
                'code' => 'HO',
                'display_order' => '10',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Trailer',
                'body_styles' => 'Horse Trailer',
                'code' => 'HE',
                'display_order' => '11',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Trailer',
                'body_styles' => 'House Trailer (Mobile Home)',
                'code' => 'HS',
                'display_order' => '12',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Trailer',
                'body_styles' => 'Livestock',
                'code' => 'LS',
                'display_order' => '13',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Trailer',
                'body_styles' => 'Logging, Pipe or Pole',
                'code' => 'LP',
                'display_order' => '14',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Trailer',
                'body_styles' => 'Lowbed or Lowboy',
                'code' => 'LB',
                'display_order' => '15',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Trailer',
                'body_styles' => 'Office Trailer',
                'code' => 'HS',
                'display_order' => '16',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Trailer',
                'body_styles' => 'Refrigerated Van (Reefer)',
                'code' => 'RF',
                'display_order' => '17',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Trailer',
                'body_styles' => 'Semi *',
                'code' => 'SE',
                'display_order' => '18',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Trailer',
                'body_styles' => 'Service',
                'code' => 'SR',
                'display_order' => '19',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Trailer',
                'body_styles' => 'Single Wheel',
                'code' => '1W',
                'display_order' => '20',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Trailer',
                'body_styles' => 'Stake or Rack',
                'code' => 'ST',
                'display_order' => '21',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Trailer',
                'body_styles' => 'Tanker',
                'code' => 'TN',
                'display_order' => '22',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Trailer',
                'body_styles' => 'Tent Trailer',
                'code' => 'TE',
                'display_order' => '23',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Trailer',
                'body_styles' => 'Travel Trailer',
                'code' => 'TV',
                'display_order' => '24',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Trailer',
                'body_styles' => 'Truck Mount Camper',
                'code' => 'TM',
                'display_order' => '25',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Trailer',
                'body_styles' => 'Two Wheel',
                'code' => '2W',
                'display_order' => '26',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Trailer',
                'body_styles' => 'Utility',
                'code' => 'UT',
                'display_order' => '27',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Trailer',
                'body_styles' => 'Van',
                'code' => 'VN',
                'display_order' => '28',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Trailer',
                'body_styles' => 'Watercraft',
                'code' => 'WC',
                'display_order' => '29',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Truck',
                'body_styles' => ' Armored Truck',
                'code' => 'AR',
                'display_order' => '1',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Truck',
                'body_styles' => ' Auto Carrier',
                'code' => 'AC',
                'display_order' => '2',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Truck',
                'body_styles' => ' Beverage Rack',
                'code' => 'BR',
                'display_order' => '3',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => ' Bus',
                'body_styles' => ' Bus',
                'code' => 'BU',
                'display_order' => '4',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Truck',
                'body_styles' => 'Ambulance',
                'code' => 'AM',
                'display_order' => '5',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Truck',
                'body_styles' => 'Carryall-Travelall ',
                'code' => 'LL',
                'display_order' => '6',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Truck',
                'body_styles' => 'Chassis',
                'code' => 'CB',
                'display_order' => '7',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Truck',
                'body_styles' => 'Chassis and Cab',
                'code' => 'CB',
                'display_order' => '8',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Truck',
                'body_styles' => 'Concrete or Transmit Mixer',
                'code' => 'CM',
                'display_order' => '9',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Truck',
                'body_styles' => 'Crane',
                'code' => 'CR',
                'display_order' => '10',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Truck',
                'body_styles' => 'Dump',
                'code' => 'DP',
                'display_order' => '11',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Truck',
                'body_styles' => 'Fire Truck',
                'code' => 'FT',
                'display_order' => '12',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Truck',
                'body_styles' => 'Flat-Bed or Platform',
                'code' => 'FB',
                'display_order' => '13',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Truck',
                'body_styles' => 'Flat-Rack',
                'code' => 'FR',
                'display_order' => '14',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Truck',
                'body_styles' => 'Fork Lift',
                'code' => 'FL',
                'display_order' => '15',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Truck',
                'body_styles' => 'Garbage or Refuse',
                'code' => 'GG',
                'display_order' => '16',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Truck',
                'body_styles' => 'Glass Rack',
                'code' => 'GR',
                'display_order' => '17',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Truck',
                'body_styles' => 'Grain',
                'code' => 'GN',
                'display_order' => '18',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Truck',
                'body_styles' => 'Hopper',
                'code' => 'HO',
                'display_order' => '19',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Truck',
                'body_styles' => 'Line Construction',
                'code' => 'LC',
                'display_order' => '20',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Truck',
                'body_styles' => 'Livestock Rack',
                'code' => 'LS',
                'display_order' => '21',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Truck',
                'body_styles' => 'Lunch Wagon',
                'code' => 'LW',
                'display_order' => '22',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Truck',
                'body_styles' => 'Motorized Home',
                'code' => 'MH',
                'display_order' => '23',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Truck',
                'body_styles' => 'Pallet',
                'code' => 'PL',
                'display_order' => '24',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Truck',
                'body_styles' => 'Panel',
                'code' => 'PN',
                'display_order' => '25',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Truck',
                'body_styles' => 'Pickup',
                'code' => 'PK',
                'display_order' => '26',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Truck',
                'body_styles' => 'Pickup w/Camper Mounted on the Bed',
                'code' => 'PM',
                'display_order' => '27',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Truck',
                'body_styles' => 'Refrigerated Freezer Van',
                'code' => 'RF',
                'display_order' => '28',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Truck',
                'body_styles' => 'Semi *',
                'code' => 'SE',
                'display_order' => '29',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Truck',
                'body_styles' => 'Shovel',
                'code' => 'SH',
                'display_order' => '30',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Truck',
                'body_styles' => 'Sports Van',
                'code' => 'SV',
                'display_order' => '31',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Truck',
                'body_styles' => 'Stake or Rack',
                'code' => 'ST',
                'display_order' => '32',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Truck',
                'body_styles' => 'Tank',
                'code' => 'TN',
                'display_order' => '33',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Truck',
                'body_styles' => 'Tow Truck or Wrecker',
                'code' => 'WK',
                'display_order' => '34',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Truck',
                'body_styles' => 'Tractor (Track Type)',
                'code' => 'TC',
                'display_order' => '35',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Truck',
                'body_styles' => 'Tractor Truck (Diesel)',
                'code' => 'DS',
                'display_order' => '36',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Truck',
                'body_styles' => 'Tractor Truck (Gasoline)',
                'code' => 'TR',
                'display_order' => '37',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Truck',
                'body_styles' => 'Tractor, Farm (& other Wheel types)',
                'code' => 'TF',
                'display_order' => '38',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Truck',
                'body_styles' => 'Travelall ( Blazers, Explorers, 4-Runners, etc.)',
                'code' => 'LL',
                'display_order' => '39',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Truck',
                'body_styles' => 'Truck **',
                'code' => 'TK',
                'display_order' => '40',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Truck',
                'body_styles' => 'Truck w/ Chassis Mount Camper +',
                'code' => 'TW',
                'display_order' => '41',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Truck',
                'body_styles' => 'Truck-Diesel',
                'code' => 'DS',
                'display_order' => '42',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Van',
                'body_styles' => 'Van',
                'code' => 'VN',
                'display_order' => '1',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Van',
                'body_styles' => 'Van Camper',
                'code' => 'VC',
                'display_order' => '2',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
            [
                'vehicle_category' => 'Van',
                'body_styles' => 'Vanette (Including Metro, Step Van, and Handy Van)',
                'code' => 'VT',
                'display_order' => '3',
                'start_date' => '6/28/2005',
                'end_date' => '12/31/2099',
            ],
        ];
    }

}
