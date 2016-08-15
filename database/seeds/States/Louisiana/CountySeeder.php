<?php

namespace Thirty98\Seeder\States\Louisiana;

use Thirty98\API\Stdlib\AbstractDatabaseSeeder;
use Illuminate\Support\Facades\DB;
use Thirty98\Models;

class CountySeeder extends AbstractDatabaseSeeder
{
    public $state_code = 'LA';
    protected $table_name = 'counties';

    protected function executeSeeder()
    {
        $state = DB::table('states')->where('code', $this->state_code)->first();

        foreach ($this->getCounties() AS $county) {

            $exists = DB::table($this->table_name)->where('code', $county['county_code'])
                ->where('state_code', $state->code)
                ->first();

            if (!$exists) {
                // DB::table($this->table_name)->insert(array_merge(['state_code' => $state->code], $county));
                $result = DB::table($this->table_name)->insertGetId(
                    [
                        'state_code' => $state->code,
                        'code' => $county['county_code'],
                        'name' => $county['name'],
                        'slug' => $county['slug'],
                        'is_parish' => 1
                    ]
                );
            }

            continue;
        }
    }

    private function getCounties()
    {
        return [
            [
                'name' => 'Acadia',
                'slug' => $this->slugit('Acadia'),
                'county_code' => '0100',
                'parish_tax' => '0.0425',
                'parish_vendor_discount' => '0.02'
            ],
            [
                'name' => 'Allen',
                'slug' => $this->slugit('Allen'),
                'county_code' => '0200',
                'parish_tax' => '0.04.7',
                'parish_vendor_discount' => '0.02'
            ],
            [
                'name' => 'Ascension East',
                'slug' => $this->slugit('Ascension East'),
                'county_code' => '0304',
                'parish_tax' => '0.04',
                'parish_vendor_discount' => '0.02'
            ],
            [
                'name' => 'Ascension West',
                'slug' => $this->slugit('Ascension West'),
                'county_code' => '0303',
                'parish_tax' => '0.04',
                'parish_vendor_discount' => '0.02'
            ],
            [
                'name' => 'Assumption',
                'slug' => $this->slugit('Assumption'),
                'county_code' => '0400',
                'parish_tax' => '0.05',
                'parish_vendor_discount' => '0.02'
            ],
            [
                'name' => 'Avoyelles',
                'slug' => $this->slugit('Avoyelles'),
                'county_code' => '0500',
                'parish_tax' => '0.0325',
                'parish_vendor_discount' => '0.02'
            ],
            [
                'name' => 'Beauregard',
                'slug' => $this->slugit('Beauregard'),
                'county_code' => '0600',
                'parish_tax' => '0.0475',
                'parish_vendor_discount' => '0.015'
            ],
            [
                'name' => 'Bienville',
                'slug' => $this->slugit('Bienville'),
                'county_code' => '0700',
                'parish_tax' => '0.03',
                'parish_vendor_discount' => '0.02'
            ],
            [
                'name' => 'Bossier',
                'slug' => $this->slugit('Bossier'),
                'county_code' => '0800',
                'parish_tax' => '0.0425',
                'parish_vendor_discount' => '0.01'
            ],
            [
                'name' => 'Caddo',
                'slug' => $this->slugit('Caddo'),
                'county_code' => '0900',
                'parish_tax' => '0.0335',
                'parish_vendor_discount' => '0'
            ],
            [
                'name' => 'Calcasieu',
                'slug' => $this->slugit('Calcasieu'),
                'county_code' => '1000',
                'parish_tax' => '0.0275',
                'parish_vendor_discount' => '0.01'
            ],
            [
                'name' => 'Caldwell',
                'slug' => $this->slugit('Caldwell'),
                'county_code' => '1100',
                'parish_tax' => '0.05',
                'parish_vendor_discount' => '0.02'
            ],
            [
                'name' => 'Cameron',
                'slug' => $this->slugit('Cameron'),
                'county_code' => '1200',
                'parish_tax' => '0',
                'parish_vendor_discount' => '0'
            ],
            [
                'name' => 'Catahoula',
                'slug' => $this->slugit('Catahoula'),
                'county_code' => '1300',
                'parish_tax' => '0.06',
                'parish_vendor_discount' => '0.02'
            ],
            [
                'name' => 'Claiborne',
                'slug' => $this->slugit('Claiborne'),
                'county_code' => '1400',
                'parish_tax' => '0.0362',
                'parish_vendor_discount' => '0.02'
            ],
            [
                'name' => 'Concordia',
                'slug' => $this->slugit('Concordia'),
                'county_code' => '1500',
                'parish_tax' => '0.0475',
                'parish_vendor_discount' => '0.02'
            ],
            [
                'name' => 'De Soto',
                'slug' => $this->slugit('De Soto'),
                'county_code' => '1600',
                'parish_tax' => '0.04',
                'parish_vendor_discount' => '0.01'
            ],
            [
                'name' => 'East Baton Rouge',
                'slug' => $this->slugit('East Baton Rouge'),
                'county_code' => '1700',
                'parish_tax' => '0.03',
                'parish_vendor_discount' => '0.01'
            ],
            [
                'name' => 'East Carroll',
                'slug' => $this->slugit('East Carroll'),
                'county_code' => '1800',
                'parish_tax' => '0.05',
                'parish_vendor_discount' => '0.02'
            ],
            [
                'name' => 'East Feliciana',
                'slug' => $this->slugit('East Feliciana'),
                'county_code' => '1900',
                'parish_tax' => '0.05',
                'parish_vendor_discount' => '0.02'
            ],
            [
                'name' => 'Evangenline',
                'slug' => $this->slugit('Evangenline'),
                'county_code' => '2008',
                'parish_tax' => '0',
                'parish_vendor_discount' => '0'
            ],
            [
                'name' => 'Franklin',
                'slug' => $this->slugit('Franklin'),
                'county_code' => '2100',
                'parish_tax' => '0.04',
                'parish_vendor_discount' => '0.01'
            ],
            [
                'name' => 'Grant',
                'slug' => $this->slugit('Grant'),
                'county_code' => '2200',
                'parish_tax' => '0.04',
                'parish_vendor_discount' => '0.02'
            ],
            [
                'name' => 'Iberia',
                'slug' => $this->slugit('Iberia'),
                'county_code' => '2300',
                'parish_tax' => '0.0325',
                'parish_vendor_discount' => '0.01'
            ],
            [
                'name' => 'Iberville',
                'slug' => $this->slugit('Iberville'),
                'county_code' => '2400',
                'parish_tax' => '0.05',
                'parish_vendor_discount' => '0.015'
            ],
            [
                'name' => 'Jackson',
                'slug' => $this->slugit('Jackson'),
                'county_code' => '2500',
                'parish_tax' => '0.04',
                'parish_vendor_discount' => '0.02'
            ],
            [
                'name' => 'Jefferson',
                'slug' => $this->slugit('Jefferson'),
                'county_code' => '2600',
                'parish_tax' => '0.0475',
                'parish_vendor_discount' => '0.01'
            ],
            [
                'name' => 'Jefferson Davis',
                'slug' => $this->slugit('Jefferson Davis'),
                'county_code' => '2700',
                'parish_tax' => '0.03',
                'parish_vendor_discount' => '0.02'
            ],
            [
                'name' => 'Lafayette',
                'slug' => $this->slugit('Lafayette'),
                'county_code' => '2800',
                'parish_tax' => '0.03',
                'parish_vendor_discount' => '0'
            ],
            [
                'name' => 'Lafourche',
                'slug' => $this->slugit('Lafourche'),
                'county_code' => '2900',
                'parish_tax' => '0.037',
                'parish_vendor_discount' => '0.011'
            ],
            [
                'name' => 'Lasalle',
                'slug' => $this->slugit('Lasalle'),
                'county_code' => '3000',
                'parish_tax' => '0.035',
                'parish_vendor_discount' => '0.015'
            ],
            [
                'name' => 'Lincoln',
                'slug' => $this->slugit('Lincoln'),
                'county_code' => '3100',
                'parish_tax' => '0.0325',
                'parish_vendor_discount' => '0.02'
            ],
            [
                'name' => 'Livingston',
                'slug' => $this->slugit('Livingston'),
                'county_code' => '3200',
                'parish_tax' => '0.04',
                'parish_vendor_discount' => '0.01'
            ],
            [
                'name' => 'Madison',
                'slug' => $this->slugit('Madison'),
                'county_code' => '3300',
                'parish_tax' => '0.035',
                'parish_vendor_discount' => '0.01'
            ],
            [
                'name' => 'Morehouse',
                'slug' => $this->slugit('Morehouse'),
                'county_code' => '3400',
                'parish_tax' => '0.04',
                'parish_vendor_discount' => '0.011'
            ],
            [
                'name' => 'Natchitoches',
                'slug' => $this->slugit('Natchitoches'),
                'county_code' => '3500',
                'parish_tax' => '0.035',
                'parish_vendor_discount' => '0.02'
            ],
            [
                'name' => 'Orleans',
                'slug' => $this->slugit('Orleans'),
                'county_code' => '3600',
                'parish_tax' => '0.05',
                'parish_vendor_discount' => '0.01'
            ],
            [
                'name' => 'Ouachita',
                'slug' => $this->slugit('Ouachita'),
                'county_code' => '3700',
                'parish_tax' => '0.046',
                'parish_vendor_discount' => '0.01'
            ],
            [
                'name' => 'Plaquemines',
                'slug' => $this->slugit('Plaquemines'),
                'county_code' => '3800',
                'parish_tax' => '0.04',
                'parish_vendor_discount' => '0.02'
            ],
            [
                'name' => 'Pointe Coupee',
                'slug' => $this->slugit('Pointe Coupee'),
                'county_code' => '3900',
                'parish_tax' => '0.04',
                'parish_vendor_discount' => '0.01'
            ],
            [
                'name' => 'Rapides',
                'slug' => $this->slugit('Rapides'),
                'county_code' => '4000',
                'parish_tax' => '0.03',
                'parish_vendor_discount' => '0.01'
            ],
            [
                'name' => 'Red River',
                'slug' => $this->slugit('Red River'),
                'county_code' => '4100',
                'parish_tax' => '0.045',
                'parish_vendor_discount' => '0.02'
            ],
            [
                'name' => 'Richland',
                'slug' => $this->slugit('Richland'),
                'county_code' => '4200',
                'parish_tax' => '0.04',
                'parish_vendor_discount' => '0.015'
            ],
            [
                'name' => 'Sabine',
                'slug' => $this->slugit('Sabine'),
                'county_code' => '4300',
                'parish_tax' => '',
                'parish_vendor_discount' => ''
            ],
            [
                'name' => 'St Bernard',
                'slug' => $this->slugit('St Bernard'),
                'county_code' => '4400',
                'parish_tax' => '0.05',
                'parish_vendor_discount' => '0.015'
            ],
            [
                'name' => 'St Charles',
                'slug' => $this->slugit('St Charles'),
                'county_code' => '4500',
                'parish_tax' => '0.05',
                'parish_vendor_discount' => '0.02'
            ],
            [
                'name' => 'St Helena',
                'slug' => $this->slugit('St Helena'),
                'county_code' => '4600',
                'parish_tax' => '0.05',
                'parish_vendor_discount' => '0.01'
            ],
            [
                'name' => 'St James',
                'slug' => $this->slugit('St James'),
                'county_code' => '4700',
                'parish_tax' => '0.035',
                'parish_vendor_discount' => '1.5'
            ],
            [
                'name' => 'St. John The Baptist',
                'slug' => $this->slugit('St. John The Baptist'),
                'county_code' => '4800',
                'parish_tax' => '0.05',
                'parish_vendor_discount' => '0.02'
            ],
            [
                'name' => 'St. Landry',
                'slug' => $this->slugit('St. Landry'),
                'county_code' => '4900',
                'parish_tax' => '0.0555',
                'parish_vendor_discount' => '0.02'
            ],
            [
                'name' => 'St Martin',
                'slug' => $this->slugit('St Martin'),
                'county_code' => '5000',
                'parish_tax' => '',
                'parish_vendor_discount' => ''
            ],
            [
                'name' => 'St Mary',
                'slug' => $this->slugit('St Mary'),
                'county_code' => '5100',
                'parish_tax' => '',
                'parish_vendor_discount' => ''
            ],
            [
                'name' => 'St Tammany',
                'slug' => $this->slugit('St Tammany'),
                'county_code' => '5200',
                'parish_tax' => '0.0475',
                'parish_vendor_discount' => '0.011'
            ],
            [
                'name' => 'Tangipahoa',
                'slug' => $this->slugit('Tangipahoa'),
                'county_code' => '5300',
                'parish_tax' => '0.03',
                'parish_vendor_discount' => '0.01'
            ],
            [
                'name' => 'Tensas',
                'slug' => $this->slugit('Tensas'),
                'county_code' => '5400',
                'parish_tax' => '0.0525',
                'parish_vendor_discount' => '0.02'
            ],
            [
                'name' => 'Terrebonne',
                'slug' => $this->slugit('Terrebonne'),
                'county_code' => '5500',
                'parish_tax' => '0.055',
                'parish_vendor_discount' => '0.02'
            ],
            [
                'name' => 'Union',
                'slug' => $this->slugit('Union'),
                'county_code' => '5600',
                'parish_tax' => '0.05',
                'parish_vendor_discount' => '0.02'
            ],
            [
                'name' => 'Vermilion',
                'slug' => $this->slugit('Vermilion'),
                'county_code' => '5700',
                'parish_tax' => '0.0375',
                'parish_vendor_discount' => '0.02'
            ],
            [
                'name' => 'Vernon',
                'slug' => $this->slugit('Vernon'),
                'county_code' => '5800',
                'parish_tax' => '0.04',
                'parish_vendor_discount' => '0.02'
            ],
            [
                'name' => 'Washington',
                'slug' => $this->slugit('Washington'),
                'county_code' => '5900',
                'parish_tax' => '0.0383',
                'parish_vendor_discount' => '0.01'
            ],
            [
                'name' => 'Webster',
                'slug' => $this->slugit('Webster'),
                'county_code' => '6000',
                'parish_tax' => '0.03',
                'parish_vendor_discount' => '0.015'
            ],
            [
                'name' => 'West Baton Rouge',
                'slug' => $this->slugit('West Baton Rouge'),
                'county_code' => '6100',
                'parish_tax' => '0.05',
                'parish_vendor_discount' => '0.01'
            ],
            [
                'name' => 'West Carroll',
                'slug' => $this->slugit('West Carroll'),
                'county_code' => '6200',
                'parish_tax' => '0.05',
                'parish_vendor_discount' => '0.01'
            ],
            [
                'name' => 'West Feliciana',
                'slug' => $this->slugit('West Feliciana'),
                'county_code' => '6300',
                'parish_tax' => '0.05',
                'parish_vendor_discount' => '0.011'
            ],
            [
                'name' => 'Winn',
                'slug' => $this->slugit('Winn'),
                'county_code' => '6400',
                'parish_tax' => '0.04',
                'parish_vendor_discount' => '0.02'
            ]
        ];
    }
}
