<?php
namespace App\Http\Models;

use DB;
use Spr\Base\Models\Helper;
use Illuminate\Database\Eloquent\Model;
use Spr\Base\Response\Response;
use lang;
use Config;
use Cache;
/**
*
*/
class Promotion extends Model
{

    protected $table = "promotion";


    public function getDataByCode($code) {

        $where = [
            [
                'fields' => 'code',
                'operator' => '=',
                'value' => $code,
            ]
        ];
        $results = Helper::select($this->table, $where );
        return $results;
    }
}