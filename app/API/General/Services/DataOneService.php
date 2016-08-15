<?php

namespace Thirty98\API\General\Services;

use Thirty98\API\General\Models\DataOne;
use Illuminate\Support\Facades\DB;

class DataOneService
{
    protected $model;
    
    public function __construct(DataOne $model)
    {
        $this->model = $model;
    }
    
    /**
     * Get vehicle details by VIN
     * 
     * @param string $vin
     * @return Model
     */
    public function getVehicleInfo($vin)
    {
        return $this->model->where('vin_pattern', $this->getVinPattern($vin))->get();
    }
    
    /**
     * 
     * @param string $vin
     * @return string
     */
    public function getVinPattern($vin)
    {
        return substr($vin, 0, 8) . substr($vin, 9, 2);
    }
    
    public function getVehicleCategory($type)
    {
        if (!$type = DB::table('types')->where('name', strtolower($type))->first()) {
            return "";
        }
        
        if (!$type_category = DB::table('categories_types')->where('type_id', $type->id)->first()) {
            return "";
        }
        
        if (!$category = DB::table('categories')->where('id', $type_category->category_id)->first()) {
            return "";
        }
        
        return $category->name;
    }
}
