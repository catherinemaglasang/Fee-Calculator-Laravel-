<?php

namespace Thirty98\Http\Controllers\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Types extends Model
{
	use SoftDeletes;

    // Laravel auto update timestamp feature.
    public $timestamps = true;

    // Set database for this model.
    protected $table = 'types';

    // Set primary key.
    protected $primaryKey = 'id';
    
    // Used for softdeleting.
    protected $dates = ['deleted_at'];

    // Set fillable fields.
    protected $fillable = [];

    public static function getByCode($stateCode)
    {
        $sql = "
                SELECT
                  c.id AS `category_id`,
                  c.name AS `category`,
                  t.id AS `type_id`,
                  t.name AS `type`
                FROM
                  categories c
                  INNER JOIN categories_types ct
                    ON c.id = ct.category_id
                  INNER JOIN types t
                    ON t.id = ct.type_id
                  INNER JOIN fees_states fs
                    ON fs.category_type_id = ct.id
                    AND fs.state_id =
                    (SELECT
                      id
                    FROM
                      states
                    WHERE CODE = :stateCode)
                GROUP BY t.name
                ORDER BY fs.order_no
        ";

        $result = DB::select(DB::raw($sql), array(
            'stateCode' => $stateCode
        ));

        return $result;
    }

}

#END OF PHP