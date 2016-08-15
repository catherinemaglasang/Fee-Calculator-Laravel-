<?php

namespace Thirty98\Seeder\States\Arkansas;

use Thirty98\API\Stdlib\AbstractDatabaseSeeder;
use Illuminate\Support\Facades\DB;
use Thirty98\Models\County;

class CitySeeder extends AbstractDatabaseSeeder
{
    public $state_code = 'AR';
    protected $table_name = 'cities';

    protected function executeSeeder()
    {
        // County index map.
        $counties = County::where('state_code', $this->state_code)->get();
        $countiesIndexes = [];

        foreach ($counties as $county) {
            $countiesIndexes[$county['code']] = $county['id'];
        }

        foreach ($this->getCities() AS $city) {
            $countyID = $countiesIndexes[$city['county_code']];
            $city_code = trim($city['county_code']);
            $city_name = trim($city['name']);
            $city_slug = trim($city['slug']);

            $exists = DB::table($this->table_name)->where('slug', $city['slug'])
                ->where('county_id', $countyID)
                ->first();

            if (!$exists) {
                $insert_arr = [
                    'county_id' => trim($countyID),
                    'code' => $city_code,
                    'name' => $city_name,
                    'slug' => $city_slug
                ];

                $result = DB::table($this->table_name)->insertGetId($insert_arr);

                if (!is_numeric($result)) {
                    die('City Inserted Failed for: ' . json_encode($insert_arr));
                }
            }

            continue;
        }
    }

    protected function getCities()
    {
        return [
            ['county_code' => '0001', 'name' => 'Almyra', 'slug' => $this->slugit('Almyra'), 'code' => '0005'],
            ['county_code' => '0001', 'name' => 'Dewitt', 'slug' => $this->slugit('Dewitt'), 'code' => '0002'],
            ['county_code' => '0001', 'name' => 'Gillett', 'slug' => $this->slugit('Gillett'), 'code' => '0004'],
            ['county_code' => '0001', 'name' => 'Humphrey', 'slug' => $this->slugit('Humphrey'), 'code' => '0003'],
            ['county_code' => '0001', 'name' => 'St. Charles', 'slug' => $this->slugit('St. Charles'), 'code' => '0006'],
            ['county_code' => '0001', 'name' => 'Stuttgart', 'slug' => $this->slugit('Stuttgart'), 'code' => '0001'],
            ['county_code' => '0002', 'name' => 'Crossett', 'slug' => $this->slugit('Crossett'), 'code' => '0001'],
            ['county_code' => '0002', 'name' => 'Fountain Hill', 'slug' => $this->slugit('Fountain Hill'), 'code' => '0002'],
            ['county_code' => '0002', 'name' => 'Hamburg', 'slug' => $this->slugit('Hamburg'), 'code' => '0003'],
            ['county_code' => '0003', 'name' => 'Briarcliff', 'slug' => $this->slugit('Briarcliff'), 'code' => '0009'],
            ['county_code' => '0003', 'name' => 'Cotter', 'slug' => $this->slugit('Cotter'), 'code' => '0002'],
            ['county_code' => '0003', 'name' => 'Gassville', 'slug' => $this->slugit('Gassville'), 'code' => '0003'],
            ['county_code' => '0003', 'name' => 'Lakeview', 'slug' => $this->slugit('Lakeview'), 'code' => '0005'],
            ['county_code' => '0003', 'name' => 'Mountain Home', 'slug' => $this->slugit('Mountain Home'), 'code' => '0001'],
            ['county_code' => '0003', 'name' => 'Norfork', 'slug' => $this->slugit('Norfork'), 'code' => '0004'],
            ['county_code' => '0003', 'name' => 'Salesville', 'slug' => $this->slugit('Salesville'), 'code' => '0007'],
            ['county_code' => '0004', 'name' => 'Avoca', 'slug' => $this->slugit('Avoca'), 'code' => '0013'],
            ['county_code' => '0004', 'name' => 'Bella Vista', 'slug' => $this->slugit('Bella Vista'), 'code' => '0023'],
            ['county_code' => '0004', 'name' => 'Bentonville', 'slug' => $this->slugit('Bentonville'), 'code' => '0003'],
            ['county_code' => '0004', 'name' => 'Bethel Heights', 'slug' => $this->slugit('Bethel Heights'), 'code' => '0004'],
            ['county_code' => '0004', 'name' => 'Cave Springs', 'slug' => $this->slugit('Cave Springs'), 'code' => '0011'],
            ['county_code' => '0004', 'name' => 'Centerton', 'slug' => $this->slugit('Centerton'), 'code' => '0009'],
            ['county_code' => '0004', 'name' => 'Decatur', 'slug' => $this->slugit('Decatur'), 'code' => '0005'],
            ['county_code' => '0004', 'name' => 'Garfield', 'slug' => $this->slugit('Garfield'), 'code' => '0014'],
            ['county_code' => '0004', 'name' => 'Gentry', 'slug' => $this->slugit('Gentry'), 'code' => '0006'],
            ['county_code' => '0004', 'name' => 'Gravette ', 'slug' => $this->slugit('Gravette '), 'code' => '0007'],
            ['county_code' => '0004', 'name' => 'Highfill', 'slug' => $this->slugit('Highfill'), 'code' => '0016'],
            ['county_code' => '0004', 'name' => 'Little Flock', 'slug' => $this->slugit('Little Flock'), 'code' => '0017'],
            ['county_code' => '0004', 'name' => 'Lowell', 'slug' => $this->slugit('Lowell'), 'code' => '0008'],
            ['county_code' => '0004', 'name' => 'Pea Ridge', 'slug' => $this->slugit('Pea Ridge'), 'code' => '0010'],
            ['county_code' => '0004', 'name' => 'Rogers', 'slug' => $this->slugit('Rogers'), 'code' => '0002'],
            ['county_code' => '0004', 'name' => 'Siloam Springs', 'slug' => $this->slugit('Siloam Springs'), 'code' => '0001'],
            ['county_code' => '0004', 'name' => 'Springtown', 'slug' => $this->slugit('Springtown'), 'code' => '0021'],
            ['county_code' => '0004', 'name' => 'Sulphur Springs', 'slug' => $this->slugit('Sulphur Springs'), 'code' => '0012'],
            ['county_code' => '0005', 'name' => 'Diamond City', 'slug' => $this->slugit('Diamond City'), 'code' => '0015'],
            ['county_code' => '0005', 'name' => 'Harrison', 'slug' => $this->slugit('Harrison'), 'code' => '0012'],
            ['county_code' => '0005', 'name' => 'Alpena', 'slug' => $this->slugit('Alpena'), 'code' => '0002'],
            ['county_code' => '0006', 'name' => 'Hermitage', 'slug' => $this->slugit('Hermitage'), 'code' => '0002'],
            ['county_code' => '0006', 'name' => 'Warren', 'slug' => $this->slugit('Warren'), 'code' => '0003'],
            ['county_code' => '0007', 'name' => 'Thornton', 'slug' => $this->slugit('Thornton'), 'code' => '0003'],
            ['county_code' => '0008', 'name' => 'Berryville', 'slug' => $this->slugit('Berryville'), 'code' => '0002'],
            ['county_code' => '0008', 'name' => 'Eureka Springs', 'slug' => $this->slugit('Eureka Springs'), 'code' => '0001'],
            ['county_code' => '0008', 'name' => 'Green Forest', 'slug' => $this->slugit('Green Forest'), 'code' => '0003'],
            ['county_code' => '0008', 'name' => 'Oak Grove', 'slug' => $this->slugit('Oak Grove'), 'code' => '0013 '],
            ['county_code' => '0009', 'name' => 'Dermott', 'slug' => $this->slugit('Dermott'), 'code' => '0003'],
            ['county_code' => '0009', 'name' => 'Eudora', 'slug' => $this->slugit('Eudora'), 'code' => '0002'],
            ['county_code' => '0009', 'name' => 'Lake Village', 'slug' => $this->slugit('Lake Village'), 'code' => '0001'],
            ['county_code' => '0010', 'name' => 'Amity', 'slug' => $this->slugit('Amity'), 'code' => '0004'],
            ['county_code' => '0010', 'name' => 'Arkadelphia', 'slug' => $this->slugit('Arkadelphia'), 'code' => '0002'],
            ['county_code' => '0010', 'name' => 'Caddo Valley', 'slug' => $this->slugit('Caddo Valley'), 'code' => '0001'],
            ['county_code' => '0010', 'name' => 'Gum Springs', 'slug' => $this->slugit('Gum Springs'), 'code' => '0005'],
            ['county_code' => '0010', 'name' => 'Gurdon', 'slug' => $this->slugit('Gurdon'), 'code' => '0003'],
            ['county_code' => '0011', 'name' => 'Corning', 'slug' => $this->slugit('Corning'), 'code' => '0001'],
            ['county_code' => '0011', 'name' => 'Piggott', 'slug' => $this->slugit('Piggott'), 'code' => '0003'],
            ['county_code' => '0011', 'name' => 'Rector', 'slug' => $this->slugit('Rector'), 'code' => '0002'],
            ['county_code' => '0012', 'name' => 'Heber Springs', 'slug' => $this->slugit('Heber Springs'), 'code' => '0003'],
            ['county_code' => '0012', 'name' => 'Quitman', 'slug' => $this->slugit('Quitman'), 'code' => '0005'],
            ['county_code' => '0013', 'name' => 'Kingsland', 'slug' => $this->slugit('Kingsland'), 'code' => '0002'],
            ['county_code' => '0013', 'name' => 'Rison', 'slug' => $this->slugit('Rison'), 'code' => '0001'],
            ['county_code' => '0014', 'name' => 'Magnolia', 'slug' => $this->slugit('Magnolia'), 'code' => '0003'],
            ['county_code' => '0014', 'name' => 'Taylor', 'slug' => $this->slugit('Taylor'), 'code' => '0004'],
            ['county_code' => '0015', 'name' => 'Menifee', 'slug' => $this->slugit('Menifee'), 'code' => '0002'],
            ['county_code' => '0015', 'name' => 'Morrilton', 'slug' => $this->slugit('Morrilton'), 'code' => '0001'],
            ['county_code' => '0015', 'name' => 'Oppelo', 'slug' => $this->slugit('Oppelo'), 'code' => '0003'],
            ['county_code' => '0015', 'name' => 'Plumerville', 'slug' => $this->slugit('Plumerville'), 'code' => '0004'],
            ['county_code' => '0016', 'name' => 'Bay', 'slug' => $this->slugit('Bay'), 'code' => '0001'],
            ['county_code' => '0016', 'name' => 'Bono', 'slug' => $this->slugit('Bono'), 'code' => '0003'],
            ['county_code' => '0016', 'name' => 'Brookland', 'slug' => $this->slugit('Brookland'), 'code' => '0004'],
            ['county_code' => '0016', 'name' => 'Caraway', 'slug' => $this->slugit('Caraway'), 'code' => '0005'],
            ['county_code' => '0016', 'name' => 'Jonesboro', 'slug' => $this->slugit('Jonesboro'), 'code' => '0011'],
            ['county_code' => '0016', 'name' => 'Lake City', 'slug' => $this->slugit('Lake City'), 'code' => '0009'],
            ['county_code' => '0017', 'name' => 'Alma', 'slug' => $this->slugit('Alma'), 'code' => '0001'],
            ['county_code' => '0017', 'name' => 'Dyer ', 'slug' => $this->slugit('Dyer '), 'code' => '0007'],
            ['county_code' => '0017', 'name' => 'Kibler', 'slug' => $this->slugit('Kibler'), 'code' => '0005'],
            ['county_code' => '0017', 'name' => 'Mountainburg', 'slug' => $this->slugit('Mountainburg'), 'code' => '0004'],
            ['county_code' => '0017', 'name' => 'Mulberry', 'slug' => $this->slugit('Mulberry'), 'code' => '0003'],
            ['county_code' => '0017', 'name' => 'Van Buren ', 'slug' => $this->slugit('Van Buren '), 'code' => '0002'],
            ['county_code' => '0018', 'name' => 'Anthonyville', 'slug' => $this->slugit('Anthonyville'), 'code' => '0012'],
            ['county_code' => '0018', 'name' => 'Earle', 'slug' => $this->slugit('Earle'), 'code' => '0003'],
            ['county_code' => '0018', 'name' => 'Gilmore', 'slug' => $this->slugit('Gilmore'), 'code' => '0006'],
            ['county_code' => '0018', 'name' => 'Jennette', 'slug' => $this->slugit('Jennette'), 'code' => '0008'],
            ['county_code' => '0018', 'name' => 'Marion ', 'slug' => $this->slugit('Marion '), 'code' => '0001'],
            ['county_code' => '0018', 'name' => 'Sunset', 'slug' => $this->slugit('Sunset'), 'code' => '0010'],
            ['county_code' => '0018', 'name' => 'Turrell', 'slug' => $this->slugit('Turrell'), 'code' => '0011'],
            ['county_code' => '0018', 'name' => 'West Memphis', 'slug' => $this->slugit('West Memphis'), 'code' => '0002'],
            ['county_code' => '0019', 'name' => 'Cherry Valley', 'slug' => $this->slugit('Cherry Valley'), 'code' => '0001'],
            ['county_code' => '0019', 'name' => 'Wynne', 'slug' => $this->slugit('Wynne'), 'code' => '0004'],
            ['county_code' => '0020', 'name' => 'Fordyce', 'slug' => $this->slugit('Fordyce'), 'code' => '0002'],
            ['county_code' => '0020', 'name' => 'Sparkman', 'slug' => $this->slugit('Sparkman'), 'code' => '0001'],
            ['county_code' => '0021', 'name' => 'Dumas', 'slug' => $this->slugit('Dumas'), 'code' => '0003'],
            ['county_code' => '0021', 'name' => 'Mcgehee', 'slug' => $this->slugit('Mcgehee'), 'code' => '0001'],
            ['county_code' => '0022', 'name' => 'Monticello', 'slug' => $this->slugit('Monticello'), 'code' => '0001'],
            ['county_code' => '0023', 'name' => 'Conway ', 'slug' => $this->slugit('Conway '), 'code' => '0001'],
            ['county_code' => '0023', 'name' => 'Damascus', 'slug' => $this->slugit('Damascus'), 'code' => '0005'],
            ['county_code' => '0023', 'name' => 'Greenbrier', 'slug' => $this->slugit('Greenbrier'), 'code' => '0003'],
            ['county_code' => '0023', 'name' => 'Guy', 'slug' => $this->slugit('Guy'), 'code' => '0007'],
            ['county_code' => '0023', 'name' => 'Mayflower', 'slug' => $this->slugit('Mayflower'), 'code' => '0002'],
            ['county_code' => '0023', 'name' => 'Vilonia', 'slug' => $this->slugit('Vilonia'), 'code' => '0004'],
            ['county_code' => '0024', 'name' => 'Altus', 'slug' => $this->slugit('Altus'), 'code' => '0004'],
            ['county_code' => '0024', 'name' => 'Branch', 'slug' => $this->slugit('Branch'), 'code' => '0002'],
            ['county_code' => '0024', 'name' => 'Charleston', 'slug' => $this->slugit('Charleston'), 'code' => '0005'],
            ['county_code' => '0024', 'name' => 'Ozark', 'slug' => $this->slugit('Ozark'), 'code' => '0007'],
            ['county_code' => '0024', 'name' => 'Wiederkehr Village', 'slug' => $this->slugit('Wiederkehr Village'), 'code' => '0003'],
            ['county_code' => '0025', 'name' => 'Mammoth Spring', 'slug' => $this->slugit('Mammoth Spring'), 'code' => '0001'],
            ['county_code' => '0025', 'name' => 'Salem', 'slug' => $this->slugit('Salem'), 'code' => '0002'],
            ['county_code' => '0025', 'name' => 'Viola', 'slug' => $this->slugit('Viola'), 'code' => '0003'],
            ['county_code' => '0026', 'name' => 'Hot Springs ', 'slug' => $this->slugit('Hot Springs '), 'code' => '0001'],
            ['county_code' => '0026', 'name' => 'Mountain Pine', 'slug' => $this->slugit('Mountain Pine'), 'code' => '0003'],
            ['county_code' => '0027', 'name' => 'Sheridan', 'slug' => $this->slugit('Sheridan'), 'code' => '0001'],
            ['county_code' => '0028', 'name' => 'Marmaduke', 'slug' => $this->slugit('Marmaduke'), 'code' => '0003'],
            ['county_code' => '0028', 'name' => 'Paragould', 'slug' => $this->slugit('Paragould'), 'code' => '0005'],
            ['county_code' => '0029', 'name' => 'Blevins', 'slug' => $this->slugit('Blevins'), 'code' => '0002'],
            ['county_code' => '0029', 'name' => 'Hope', 'slug' => $this->slugit('Hope'), 'code' => '0001'],
            ['county_code' => '0029', 'name' => 'Patmos', 'slug' => $this->slugit('Patmos'), 'code' => '0008'],
            ['county_code' => '0029', 'name' => 'Washington ', 'slug' => $this->slugit('Washington '), 'code' => '0010'],
            ['county_code' => '0030', 'name' => 'Malvern', 'slug' => $this->slugit('Malvern'), 'code' => '0001'],
            ['county_code' => '0030', 'name' => 'Perla', 'slug' => $this->slugit('Perla'), 'code' => '0002'],
            ['county_code' => '0030', 'name' => 'Rockport', 'slug' => $this->slugit('Rockport'), 'code' => '0003'],
            ['county_code' => '0031', 'name' => 'Dierks', 'slug' => $this->slugit('Dierks'), 'code' => '0002'],
            ['county_code' => '0031', 'name' => 'Mineral Springs', 'slug' => $this->slugit('Mineral Springs'), 'code' => '0003'],
            ['county_code' => '0031', 'name' => 'Nashville', 'slug' => $this->slugit('Nashville'), 'code' => '0001'],
            ['county_code' => '0032', 'name' => 'Batesville ', 'slug' => $this->slugit('Batesville '), 'code' => '0001'],
            ['county_code' => '0033', 'name' => 'Calico Rock', 'slug' => $this->slugit('Calico Rock'), 'code' => '0003'],
            ['county_code' => '0033', 'name' => 'Franklin ', 'slug' => $this->slugit('Franklin '), 'code' => '0005'],
            ['county_code' => '0033', 'name' => 'Guion', 'slug' => $this->slugit('Guion'), 'code' => '0007'],
            ['county_code' => '0033', 'name' => 'Horseshoe Bend', 'slug' => $this->slugit('Horseshoe Bend'), 'code' => '0001'],
            ['county_code' => '0033', 'name' => 'Melbourne', 'slug' => $this->slugit('Melbourne'), 'code' => '0002'],
            ['county_code' => '0033', 'name' => 'Oxford', 'slug' => $this->slugit('Oxford'), 'code' => '0006'],
            ['county_code' => '0033', 'name' => 'Pineville', 'slug' => $this->slugit('Pineville'), 'code' => '0004'],
            ['county_code' => '0034', 'name' => 'Beedeville', 'slug' => $this->slugit('Beedeville'), 'code' => '0005'],
            ['county_code' => '0034', 'name' => 'Diaz', 'slug' => $this->slugit('Diaz'), 'code' => '0007'],
            ['county_code' => '0034', 'name' => 'Newport', 'slug' => $this->slugit('Newport'), 'code' => '0001'],
            ['county_code' => '0034', 'name' => 'Swifton', 'slug' => $this->slugit('Swifton'), 'code' => '0009'],
            ['county_code' => '0034', 'name' => 'Tuckerman', 'slug' => $this->slugit('Tuckerman'), 'code' => '0002'],
            ['county_code' => '0035', 'name' => 'Altheimer', 'slug' => $this->slugit('Altheimer'), 'code' => '0005'],
            ['county_code' => '0035', 'name' => 'Pine Bluff', 'slug' => $this->slugit('Pine Bluff'), 'code' => '0001'],
            ['county_code' => '0035', 'name' => 'Redfield', 'slug' => $this->slugit('Redfield'), 'code' => '0004'],
            ['county_code' => '0035', 'name' => 'Sherrill', 'slug' => $this->slugit('Sherrill'), 'code' => '0007'],
            ['county_code' => '0035', 'name' => 'Wabbaseka', 'slug' => $this->slugit('Wabbaseka'), 'code' => '0002'],
            ['county_code' => '0035', 'name' => 'White Hall', 'slug' => $this->slugit('White Hall'), 'code' => '0003'],
            ['county_code' => '0036', 'name' => 'Clarksville', 'slug' => $this->slugit('Clarksville'), 'code' => '0001'],
            ['county_code' => '0036', 'name' => 'Coal Hill', 'slug' => $this->slugit('Coal Hill'), 'code' => '0002'],
            ['county_code' => '0036', 'name' => 'Lamar', 'slug' => $this->slugit('Lamar'), 'code' => '0005'],
            ['county_code' => '0037', 'name' => 'Bradley ', 'slug' => $this->slugit('Bradley '), 'code' => '0001'],
            ['county_code' => '0037', 'name' => 'Lewisville', 'slug' => $this->slugit('Lewisville'), 'code' => '0004'],
            ['county_code' => '0037', 'name' => 'Stamps', 'slug' => $this->slugit('Stamps'), 'code' => '0002'],
            ['county_code' => '0038', 'name' => 'Black Rock', 'slug' => $this->slugit('Black Rock'), 'code' => '0003'],
            ['county_code' => '0038', 'name' => 'Hoxie', 'slug' => $this->slugit('Hoxie'), 'code' => '0005'],
            ['county_code' => '0038', 'name' => 'Imboden', 'slug' => $this->slugit('Imboden'), 'code' => '0006'],
            ['county_code' => '0038', 'name' => 'Portia', 'slug' => $this->slugit('Portia'), 'code' => '0009'],
            ['county_code' => '0038', 'name' => 'Ravenden', 'slug' => $this->slugit('Ravenden'), 'code' => '0011'],
            ['county_code' => '0038', 'name' => 'Walnut Ridge', 'slug' => $this->slugit('Walnut Ridge'), 'code' => '0001'],
            ['county_code' => '0039', 'name' => 'Marianna', 'slug' => $this->slugit('Marianna'), 'code' => '0001'],
            ['county_code' => '0039', 'name' => 'Moro', 'slug' => $this->slugit('Moro'), 'code' => '0005'],
            ['county_code' => '0040', 'name' => 'Gould', 'slug' => $this->slugit('Gould'), 'code' => '0002'],
            ['county_code' => '0040', 'name' => 'Grady', 'slug' => $this->slugit('Grady'), 'code' => '0003'],
            ['county_code' => '0040', 'name' => 'Star City', 'slug' => $this->slugit('Star City'), 'code' => '0001'],
            ['county_code' => '0041', 'name' => 'Ashdown', 'slug' => $this->slugit('Ashdown'), 'code' => '0001'],
            ['county_code' => '0041', 'name' => 'Foreman', 'slug' => $this->slugit('Foreman'), 'code' => '0007'],
            ['county_code' => '0041', 'name' => 'Wilton', 'slug' => $this->slugit('Wilton'), 'code' => '0004'],
            ['county_code' => '0042', 'name' => 'Blue Mountain', 'slug' => $this->slugit('Blue Mountain'), 'code' => '0001'],
            ['county_code' => '0042', 'name' => 'Booneville', 'slug' => $this->slugit('Booneville'), 'code' => '0010'],
            ['county_code' => '0042', 'name' => 'Magazine', 'slug' => $this->slugit('Magazine'), 'code' => '0004'],
            ['county_code' => '0042', 'name' => 'Paris', 'slug' => $this->slugit('Paris'), 'code' => '0006'],
            ['county_code' => '0043', 'name' => 'Austin', 'slug' => $this->slugit('Austin'), 'code' => '0002'],
            ['county_code' => '0043', 'name' => 'Cabot', 'slug' => $this->slugit('Cabot'), 'code' => '0011'],
            ['county_code' => '0043', 'name' => 'Carlisle', 'slug' => $this->slugit('Carlisle'), 'code' => '0004'],
            ['county_code' => '0043', 'name' => 'England', 'slug' => $this->slugit('England'), 'code' => '0006'],
            ['county_code' => '0043', 'name' => 'Keo', 'slug' => $this->slugit('Keo'), 'code' => '0008'],
            ['county_code' => '0043', 'name' => 'Lonoke ', 'slug' => $this->slugit('Lonoke '), 'code' => '0009'],
            ['county_code' => '0043', 'name' => 'Ward', 'slug' => $this->slugit('Ward'), 'code' => '0010'],
            ['county_code' => '0044', 'name' => 'Huntsville', 'slug' => $this->slugit('Huntsville'), 'code' => '0001'],
            ['county_code' => '0045', 'name' => 'Bull Shoals', 'slug' => $this->slugit('Bull Shoals'), 'code' => '0001'],
            ['county_code' => '0045', 'name' => 'Flippin', 'slug' => $this->slugit('Flippin'), 'code' => '0002'],
            ['county_code' => '0045', 'name' => 'Pyatt', 'slug' => $this->slugit('Pyatt'), 'code' => '0003'],
            ['county_code' => '0045', 'name' => 'Summit', 'slug' => $this->slugit('Summit'), 'code' => '0004'],
            ['county_code' => '0045', 'name' => 'Yellville', 'slug' => $this->slugit('Yellville'), 'code' => '0005'],
            ['county_code' => '0046', 'name' => 'Fouke', 'slug' => $this->slugit('Fouke'), 'code' => '0002'],
            ['county_code' => '0046', 'name' => 'Garland ', 'slug' => $this->slugit('Garland '), 'code' => '0001'],
            ['county_code' => '0046', 'name' => 'Texarkana', 'slug' => $this->slugit('Texarkana'), 'code' => '0013'],
            ['county_code' => '0047', 'name' => 'Blytheville', 'slug' => $this->slugit('Blytheville'), 'code' => '0005'],
            ['county_code' => '0047', 'name' => 'Etowah', 'slug' => $this->slugit('Etowah'), 'code' => '0017'],
            ['county_code' => '0047', 'name' => 'Gosnell', 'slug' => $this->slugit('Gosnell'), 'code' => '0009'],
            ['county_code' => '0047', 'name' => 'Joiner', 'slug' => $this->slugit('Joiner'), 'code' => '0010'],
            ['county_code' => '0047', 'name' => 'Keiser', 'slug' => $this->slugit('Keiser'), 'code' => '0002'],
            ['county_code' => '0047', 'name' => 'Luxora', 'slug' => $this->slugit('Luxora'), 'code' => '0012'],
            ['county_code' => '0047', 'name' => 'Manila ', 'slug' => $this->slugit('Manila '), 'code' => '0013'],
            ['county_code' => '0047', 'name' => 'Osceola', 'slug' => $this->slugit('Osceola'), 'code' => '0001'],
            ['county_code' => '0048', 'name' => 'Brinkley', 'slug' => $this->slugit('Brinkley'), 'code' => '0002'],
            ['county_code' => '0048', 'name' => 'Clarendon', 'slug' => $this->slugit('Clarendon'), 'code' => '0001'],
            ['county_code' => '0048', 'name' => 'Holly Grove', 'slug' => $this->slugit('Holly Grove'), 'code' => '0003'],
            ['county_code' => '0048', 'name' => 'Roe', 'slug' => $this->slugit('Roe'), 'code' => '0004'],
            ['county_code' => '0049', 'name' => 'Mount Ida', 'slug' => $this->slugit('Mount Ida'), 'code' => '0005'],
            ['county_code' => '0049', 'name' => 'Norman', 'slug' => $this->slugit('Norman'), 'code' => '0003'],
            ['county_code' => '0050', 'name' => 'Prescott ', 'slug' => $this->slugit('Prescott '), 'code' => '0001'],
            ['county_code' => '0051', 'name' => 'Jasper', 'slug' => $this->slugit('Jasper'), 'code' => '0001'],
            ['county_code' => '0052', 'name' => 'Bearden', 'slug' => $this->slugit('Bearden'), 'code' => '0004'],
            ['county_code' => '0052', 'name' => 'Camden', 'slug' => $this->slugit('Camden'), 'code' => '0001'],
            ['county_code' => '0052', 'name' => 'Chidester', 'slug' => $this->slugit('Chidester'), 'code' => '0005'],
            ['county_code' => '0052', 'name' => 'East Camden', 'slug' => $this->slugit('East Camden'), 'code' => '0003'],
            ['county_code' => '0052', 'name' => 'Stephens', 'slug' => $this->slugit('Stephens'), 'code' => '0002'],
            ['county_code' => '0053', 'name' => 'Perryville', 'slug' => $this->slugit('Perryville'), 'code' => '0007'],
            ['county_code' => '0054', 'name' => 'Helena-West Helena ', 'slug' => $this->slugit('Helena-West Helena '), 'code' => '0007'],
            ['county_code' => '0054', 'name' => 'Marvell', 'slug' => $this->slugit('Marvell'), 'code' => '0005'],
            ['county_code' => '0055', 'name' => 'Delight', 'slug' => $this->slugit('Delight'), 'code' => '0003'],
            ['county_code' => '0055', 'name' => 'Glenwood', 'slug' => $this->slugit('Glenwood'), 'code' => '0004'],
            ['county_code' => '0055', 'name' => 'Murfreesboro', 'slug' => $this->slugit('Murfreesboro'), 'code' => '0005'],
            ['county_code' => '0056', 'name' => 'Harrisburg', 'slug' => $this->slugit('Harrisburg'), 'code' => '0003'],
            ['county_code' => '0056', 'name' => 'Lepanto', 'slug' => $this->slugit('Lepanto'), 'code' => '0001'],
            ['county_code' => '0056', 'name' => 'Marked Tree', 'slug' => $this->slugit('Marked Tree'), 'code' => '0004'],
            ['county_code' => '0056', 'name' => 'Trumann', 'slug' => $this->slugit('Trumann'), 'code' => '0005'],
            ['county_code' => '0056', 'name' => 'Tyronza', 'slug' => $this->slugit('Tyronza'), 'code' => '0006'],
            ['county_code' => '0056', 'name' => 'Waldenburg', 'slug' => $this->slugit('Waldenburg'), 'code' => '0009'],
            ['county_code' => '0056', 'name' => 'Weiner', 'slug' => $this->slugit('Weiner'), 'code' => '0008'],
            ['county_code' => '0057', 'name' => 'Cove', 'slug' => $this->slugit('Cove'), 'code' => '0002'],
            ['county_code' => '0057', 'name' => 'Hatfield', 'slug' => $this->slugit('Hatfield'), 'code' => '0004'],
            ['county_code' => '0057', 'name' => 'Mena', 'slug' => $this->slugit('Mena'), 'code' => '0001'],
            ['county_code' => '0057', 'name' => 'Vandervoort', 'slug' => $this->slugit('Vandervoort'), 'code' => '0005'],
            ['county_code' => '0057', 'name' => 'Wickes', 'slug' => $this->slugit('Wickes'), 'code' => '0007 '],
            ['county_code' => '0058', 'name' => 'Atkins', 'slug' => $this->slugit('Atkins'), 'code' => '0002'],
            ['county_code' => '0058', 'name' => 'Dover', 'slug' => $this->slugit('Dover'), 'code' => '0003'],
            ['county_code' => '0058', 'name' => 'Pottsville', 'slug' => $this->slugit('Pottsville'), 'code' => '0006'],
            ['county_code' => '0058', 'name' => 'Russellville', 'slug' => $this->slugit('Russellville'), 'code' => '0001'],
            ['county_code' => '0059', 'name' => 'Des Arc', 'slug' => $this->slugit('Des Arc'), 'code' => '0003'],
            ['county_code' => '0059', 'name' => 'Devalls Bluff', 'slug' => $this->slugit('Devalls Bluff'), 'code' => '0004'],
            ['county_code' => '0059', 'name' => 'Hazen', 'slug' => $this->slugit('Hazen'), 'code' => '0001'],
            ['county_code' => '0060', 'name' => 'Alexander ', 'slug' => $this->slugit('Alexander '), 'code' => '0002'],
            ['county_code' => '0060', 'name' => 'Jacksonville', 'slug' => $this->slugit('Jacksonville'), 'code' => '0004'],
            ['county_code' => '0060', 'name' => 'Little Rock', 'slug' => $this->slugit('Little Rock'), 'code' => '0005'],
            ['county_code' => '0060', 'name' => 'Maumelle', 'slug' => $this->slugit('Maumelle'), 'code' => '0006'],
            ['county_code' => '0060', 'name' => 'North Little Rock', 'slug' => $this->slugit('North Little Rock'), 'code' => '0001'],
            ['county_code' => '0060', 'name' => 'Sherwood', 'slug' => $this->slugit('Sherwood'), 'code' => '0007'],
            ['county_code' => '0061', 'name' => 'Maynard', 'slug' => $this->slugit('Maynard'), 'code' => '0002'],
            ['county_code' => '0061', 'name' => 'Pocahontas', 'slug' => $this->slugit('Pocahontas'), 'code' => '0004'],
            ['county_code' => '0062', 'name' => 'Bauxite', 'slug' => $this->slugit('Bauxite'), 'code' => '0004'],
            ['county_code' => '0062', 'name' => 'Benton ', 'slug' => $this->slugit('Benton '), 'code' => '0003'],
            ['county_code' => '0062', 'name' => 'Bryant', 'slug' => $this->slugit('Bryant'), 'code' => '0001'],
            ['county_code' => '0062', 'name' => 'Haskell', 'slug' => $this->slugit('Haskell'), 'code' => '0005'],
            ['county_code' => '0062', 'name' => 'Shannon Hills', 'slug' => $this->slugit('Shannon Hills'), 'code' => '0002'],
            ['county_code' => '0063', 'name' => 'Waldron', 'slug' => $this->slugit('Waldron'), 'code' => '0001'],
            ['county_code' => '0064', 'name' => 'Gilbert', 'slug' => $this->slugit('Gilbert'), 'code' => '0001'],
            ['county_code' => '0064', 'name' => 'Leslie', 'slug' => $this->slugit('Leslie'), 'code' => '0002'],
            ['county_code' => '0064', 'name' => 'Marshall', 'slug' => $this->slugit('Marshall'), 'code' => '0003'],
            ['county_code' => '0065', 'name' => 'Barling ', 'slug' => $this->slugit('Barling '), 'code' => '0004'],
            ['county_code' => '0065', 'name' => 'Bonanza', 'slug' => $this->slugit('Bonanza'), 'code' => '0006'],
            ['county_code' => '0065', 'name' => 'Fort Smith', 'slug' => $this->slugit('Fort Smith'), 'code' => '0001'],
            ['county_code' => '0065', 'name' => 'Greenwood', 'slug' => $this->slugit('Greenwood'), 'code' => '0005'],
            ['county_code' => '0065', 'name' => 'Hackett', 'slug' => $this->slugit('Hackett'), 'code' => '0009'],
            ['county_code' => '0065', 'name' => 'Hartford', 'slug' => $this->slugit('Hartford'), 'code' => '0010'],
            ['county_code' => '0065', 'name' => 'Huntington', 'slug' => $this->slugit('Huntington'), 'code' => '0002'],
            ['county_code' => '0065', 'name' => 'Mansfield', 'slug' => $this->slugit('Mansfield'), 'code' => '0003'],
            ['county_code' => '0066', 'name' => 'De Queen', 'slug' => $this->slugit('De Queen'), 'code' => '0001'],
            ['county_code' => '0066', 'name' => 'Gillham', 'slug' => $this->slugit('Gillham'), 'code' => '0003'],
            ['county_code' => '0067', 'name' => 'Ash Flat', 'slug' => $this->slugit('Ash Flat'), 'code' => '0002'],
            ['county_code' => '0067', 'name' => 'Cherokee Village', 'slug' => $this->slugit('Cherokee Village'), 'code' => '0008'],
            ['county_code' => '0067', 'name' => 'Hardy', 'slug' => $this->slugit('Hardy'), 'code' => '0001'],
            ['county_code' => '0067', 'name' => 'Highland', 'slug' => $this->slugit('Highland'), 'code' => '0009'],
            ['county_code' => '0068', 'name' => 'Forrest City', 'slug' => $this->slugit('Forrest City'), 'code' => '0002'],
            ['county_code' => '0068', 'name' => 'Hughes', 'slug' => $this->slugit('Hughes'), 'code' => '0001'],
            ['county_code' => '0068', 'name' => 'Madison ', 'slug' => $this->slugit('Madison '), 'code' => '0005'],
            ['county_code' => '0068', 'name' => 'Palestine', 'slug' => $this->slugit('Palestine'), 'code' => '0004'],
            ['county_code' => '0068', 'name' => 'Wheatley', 'slug' => $this->slugit('Wheatley'), 'code' => '0003'],
            ['county_code' => '0068', 'name' => 'Widener', 'slug' => $this->slugit('Widener'), 'code' => '0008'],
            ['county_code' => '0069', 'name' => 'Mountain View', 'slug' => $this->slugit('Mountain View'), 'code' => '0001'],
            ['county_code' => '0070', 'name' => 'El Dorado', 'slug' => $this->slugit('El Dorado'), 'code' => '0002'],
            ['county_code' => '0070', 'name' => 'Junction City', 'slug' => $this->slugit('Junction City'), 'code' => '0005'],
            ['county_code' => '0070', 'name' => 'Strong', 'slug' => $this->slugit('Strong'), 'code' => '0008'],
            ['county_code' => '0071', 'name' => 'Clinton', 'slug' => $this->slugit('Clinton'), 'code' => '0003'],
            ['county_code' => '0071', 'name' => 'Fairfield Bay', 'slug' => $this->slugit('Fairfield Bay'), 'code' => '0004'],
            ['county_code' => '0071', 'name' => 'Shirley', 'slug' => $this->slugit('Shirley'), 'code' => '0001'],
            ['county_code' => '0072', 'name' => 'Elkins', 'slug' => $this->slugit('Elkins'), 'code' => '0002'],
            ['county_code' => '0072', 'name' => 'Elm Springs', 'slug' => $this->slugit('Elm Springs'), 'code' => '0003'],
            ['county_code' => '0072', 'name' => 'Farmington', 'slug' => $this->slugit('Farmington'), 'code' => '0016'],
            ['county_code' => '0072', 'name' => 'Fayetteville', 'slug' => $this->slugit('Fayetteville'), 'code' => '0014'],
            ['county_code' => '0072', 'name' => 'Greenland', 'slug' => $this->slugit('Greenland'), 'code' => '0006'],
            ['county_code' => '0072', 'name' => 'Johnson ', 'slug' => $this->slugit('Johnson '), 'code' => '0007'],
            ['county_code' => '0072', 'name' => 'Lincoln', 'slug' => $this->slugit('Lincoln'), 'code' => '0015'],
            ['county_code' => '0072', 'name' => 'Prairie Grove', 'slug' => $this->slugit('Prairie Grove'), 'code' => '0009'],
            ['county_code' => '0072', 'name' => 'Springdale', 'slug' => $this->slugit('Springdale'), 'code' => '0010'],
            ['county_code' => '0072', 'name' => 'Tontitown', 'slug' => $this->slugit('Tontitown'), 'code' => '0011'],
            ['county_code' => '0072', 'name' => 'West Fork', 'slug' => $this->slugit('West Fork'), 'code' => '0012'],
            ['county_code' => '0073', 'name' => 'Bald Knob ', 'slug' => $this->slugit('Bald Knob '), 'code' => '0017'],
            ['county_code' => '0073', 'name' => 'Beebe', 'slug' => $this->slugit('Beebe'), 'code' => '0002'],
            ['county_code' => '0073', 'name' => 'Mcrae', 'slug' => $this->slugit('Mcrae'), 'code' => '0012'],
            ['county_code' => '0073', 'name' => 'Rose Bud', 'slug' => $this->slugit('Rose Bud'), 'code' => '0001'],
            ['county_code' => '0073', 'name' => 'Searcy ', 'slug' => $this->slugit('Searcy '), 'code' => '0015'],
            ['county_code' => '0074', 'name' => 'Augusta', 'slug' => $this->slugit('Augusta'), 'code' => '0002'],
            ['county_code' => '0074', 'name' => 'Cotton Plant', 'slug' => $this->slugit('Cotton Plant'), 'code' => '0001'],
            ['county_code' => '0074', 'name' => 'Mccrory', 'slug' => $this->slugit('Mccrory'), 'code' => '0004'],
            ['county_code' => '0074', 'name' => 'Patterson ', 'slug' => $this->slugit('Patterson '), 'code' => '0005'],
            ['county_code' => '0075', 'name' => 'Belleville', 'slug' => $this->slugit('Belleville'), 'code' => '0006'],
            ['county_code' => '0075', 'name' => 'Danville', 'slug' => $this->slugit('Danville'), 'code' => '0004'],
            ['county_code' => '0075', 'name' => 'Dardanelle', 'slug' => $this->slugit('Dardanelle'), 'code' => '0002'],
            ['county_code' => '0075', 'name' => 'Havana', 'slug' => $this->slugit('Havana'), 'code' => '0007'],
            ['county_code' => '0075', 'name' => 'Ola', 'slug' => $this->slugit('Ola'), 'code' => '0003'],
            ['county_code' => '0075', 'name' => 'Plainview', 'slug' => $this->slugit('Plainview'), 'code' => '0001']
        ];
    }

}
