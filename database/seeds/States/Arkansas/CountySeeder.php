<?php

namespace Thirty98\Seeder\States\Arkansas;

use Thirty98\API\Stdlib\AbstractDatabaseSeeder;
use Illuminate\Support\Facades\DB;
use Thirty98\Models;

class CountySeeder extends AbstractDatabaseSeeder
{
    public $state_code = 'AR';
    protected $table_name = 'counties';

    protected function executeSeeder()
    {
        $state = DB::table('states')->where('code', $this->state_code)->first();

        foreach ($this->getCounties() AS $county) {

            $county_code = trim($county['code']);;
            $count_name = trim($county['county_name']);;
            $county_slug = trim($county['slug']);;

            $exists = DB::table($this->table_name)->where('code', $county_code)
                ->where('state_code', $state->code)
                ->first();

            if (!$exists) {
                // DB::table($this->table_name)->insert(array_merge(['state_code' => $state->code], $county));
                $result = DB::table($this->table_name)->insertGetId(
                    [
                        'state_code' => $state->code,
                        'code' => $county_code,
                        'name' => $count_name,
                        'slug' => $county_slug
                    ]
                );
            }

            continue;
        }
    }

    private function getCounties()
    {
        return [
            [ 'county_name' => 'Arkansas', 'slug' => $this->slugit('Arkansas'), 'code' => '0001' ],
            [ 'county_name' => 'Ashley', 'slug' => $this->slugit('Ashley'), 'code' => '0002' ],
            [ 'county_name' => 'Baxter', 'slug' => $this->slugit('Baxter'), 'code' => '0003' ],
            [ 'county_name' => 'Benton', 'slug' => $this->slugit('Benton'), 'code' => '0004' ],
            [ 'county_name' => 'Boone', 'slug' => $this->slugit('Boone'), 'code' => '0005' ],
            [ 'county_name' => 'Bradley', 'slug' => $this->slugit('Bradley'), 'code' => '0006' ],
            [ 'county_name' => 'Calhoun', 'slug' => $this->slugit('Calhoun'), 'code' => '0007' ],
            [ 'county_name' => 'Carroll', 'slug' => $this->slugit('Carroll'), 'code' => '0008' ],
            [ 'county_name' => 'Chicot', 'slug' => $this->slugit('Chicot'), 'code' => '0009' ],
            [ 'county_name' => 'Clark', 'slug' => $this->slugit('Clark'), 'code' => '0010' ],
            [ 'county_name' => 'Clay', 'slug' => $this->slugit('Clay'), 'code' => '0011' ],
            [ 'county_name' => 'Cleburne', 'slug' => $this->slugit('Cleburne'), 'code' => '0012' ],
            [ 'county_name' => 'Cleveland', 'slug' => $this->slugit('Cleveland'), 'code' => '0013' ],
            [ 'county_name' => 'Columbia', 'slug' => $this->slugit('Columbia'), 'code' => '0014' ],
            [ 'county_name' => 'Conway', 'slug' => $this->slugit('Conway'), 'code' => '0015' ],
            [ 'county_name' => 'Craighead', 'slug' => $this->slugit('Craighead'), 'code' => '0016' ],
            [ 'county_name' => 'Crawford', 'slug' => $this->slugit('Crawford'), 'code' => '0017' ],
            [ 'county_name' => 'Crittenden', 'slug' => $this->slugit('Crittenden'), 'code' => '0018' ],
            [ 'county_name' => 'Cross', 'slug' => $this->slugit('Cross'), 'code' => '0019' ],
            [ 'county_name' => 'Dallas', 'slug' => $this->slugit('Dallas'), 'code' => '0020' ],
            [ 'county_name' => 'Desha', 'slug' => $this->slugit('Desha'), 'code' => '0021' ],
            [ 'county_name' => 'Drew', 'slug' => $this->slugit('Drew'), 'code' => '0022' ],
            [ 'county_name' => 'Faulkner', 'slug' => $this->slugit('Faulkner'), 'code' => '0023' ],
            [ 'county_name' => 'Franklin', 'slug' => $this->slugit('Franklin'), 'code' => '0024' ],
            [ 'county_name' => 'Fulton', 'slug' => $this->slugit('Fulton'), 'code' => '0025' ],
            [ 'county_name' => 'Garland', 'slug' => $this->slugit('Garland'), 'code' => '0026' ],
            [ 'county_name' => 'Grant', 'slug' => $this->slugit('Grant'), 'code' => '0027' ],
            [ 'county_name' => 'Greene', 'slug' => $this->slugit('Greene'), 'code' => '0028' ],
            [ 'county_name' => 'Hempstead', 'slug' => $this->slugit('Hempstead'), 'code' => '0029' ],
            [ 'county_name' => 'Hot Spring', 'slug' => $this->slugit('Hot Spring'), 'code' => '0030' ],
            [ 'county_name' => 'Howard', 'slug' => $this->slugit('Howard'), 'code' => '0031' ],
            [ 'county_name' => 'Independence', 'slug' => $this->slugit('Independence'), 'code' => '0032' ],
            [ 'county_name' => 'Izard', 'slug' => $this->slugit('Izard'), 'code' => '0033' ],
            [ 'county_name' => 'Jackson', 'slug' => $this->slugit('Jackson'), 'code' => '0034' ],
            [ 'county_name' => 'Jefferson', 'slug' => $this->slugit('Jefferson'), 'code' => '0035' ],
            [ 'county_name' => 'Johnson', 'slug' => $this->slugit('Johnson'), 'code' => '0036' ],
            [ 'county_name' => 'Lafayette', 'slug' => $this->slugit('Lafayette'), 'code' => '0037' ],
            [ 'county_name' => 'Lawrence', 'slug' => $this->slugit('Lawrence'), 'code' => '0038' ],
            [ 'county_name' => 'Lee', 'slug' => $this->slugit('Lee'), 'code' => '0039' ],
            [ 'county_name' => 'Lincoln', 'slug' => $this->slugit('Lincoln'), 'code' => '0040' ],
            [ 'county_name' => 'Little River', 'slug' => $this->slugit('Little River'), 'code' => '0041' ],
            [ 'county_name' => 'Logan', 'slug' => $this->slugit('Logan'), 'code' => '0042' ],
            [ 'county_name' => 'Lonoke', 'slug' => $this->slugit('Lonoke'), 'code' => '0043' ],
            [ 'county_name' => 'Madison', 'slug' => $this->slugit('Madison'), 'code' => '0044' ],
            [ 'county_name' => 'Marion', 'slug' => $this->slugit('Marion'), 'code' => '0045' ],
            [ 'county_name' => 'Miller', 'slug' => $this->slugit('Miller'), 'code' => '0046' ],
            [ 'county_name' => 'Mississippi', 'slug' => $this->slugit('Mississippi'), 'code' => '0047' ],
            [ 'county_name' => 'Monroe', 'slug' => $this->slugit('Monroe'), 'code' => '0048' ],
            [ 'county_name' => 'Montgomery', 'slug' => $this->slugit('Montgomery'), 'code' => '0049' ],
            [ 'county_name' => 'Nevada', 'slug' => $this->slugit('Nevada'), 'code' => '0050' ],
            [ 'county_name' => 'Newton', 'slug' => $this->slugit('Newton'), 'code' => '0051' ],
            [ 'county_name' => 'Ouachita', 'slug' => $this->slugit('Ouachita'), 'code' => '0052' ],
            [ 'county_name' => 'Perry', 'slug' => $this->slugit('Perry'), 'code' => '0053' ],
            [ 'county_name' => 'Phillips', 'slug' => $this->slugit('Phillips'), 'code' => '0054' ],
            [ 'county_name' => 'Pike', 'slug' => $this->slugit('Pike'), 'code' => '0055' ],
            [ 'county_name' => 'Poinsett', 'slug' => $this->slugit('Poinsett'), 'code' => '0056' ],
            [ 'county_name' => 'Polk', 'slug' => $this->slugit('Polk'), 'code' => '0057' ],
            [ 'county_name' => 'Pope', 'slug' => $this->slugit('Pope'), 'code' => '0058' ],
            [ 'county_name' => 'Prairie', 'slug' => $this->slugit('Prairie'), 'code' => '0059' ],
            [ 'county_name' => 'Pulaski', 'slug' => $this->slugit('Pulaski'), 'code' => '0060' ],
            [ 'county_name' => 'Randolph', 'slug' => $this->slugit('Randolph'), 'code' => '0061' ],
            [ 'county_name' => 'Saline', 'slug' => $this->slugit('Saline'), 'code' => '0062' ],
            [ 'county_name' => 'Scott', 'slug' => $this->slugit('Scott'), 'code' => '0063' ],
            [ 'county_name' => 'Searcy', 'slug' => $this->slugit('Searcy'), 'code' => '0064' ],
            [ 'county_name' => 'Sebastian', 'slug' => $this->slugit('Sebastian'), 'code' => '0065' ],
            [ 'county_name' => 'Sevier', 'slug' => $this->slugit('Sevier'), 'code' => '0066' ],
            [ 'county_name' => 'Sharp', 'slug' => $this->slugit('Sharp'), 'code' => '0067' ],
            [ 'county_name' => 'St. Francis', 'slug' => $this->slugit('St. Francis'), 'code' => '0068' ],
            [ 'county_name' => 'Stone', 'slug' => $this->slugit('Stone'), 'code' => '0069' ],
            [ 'county_name' => 'Union', 'slug' => $this->slugit('Union'), 'code' => '0070' ],
            [ 'county_name' => 'Van Buren', 'slug' => $this->slugit('Van Buren'), 'code' => '0071' ],
            [ 'county_name' => 'Washington', 'slug' => $this->slugit('Washington'), 'code' => '0072' ],
            [ 'county_name' => 'White', 'slug' => $this->slugit('White'), 'code' => '0073' ],
            [ 'county_name' => 'Woodruff', 'slug' => $this->slugit('Woodruff'), 'code' => '0074' ],
            [ 'county_name' => 'Yell', 'slug' => $this->slugit('Yell'), 'code' => '0075' ]
        ];
    }
}
