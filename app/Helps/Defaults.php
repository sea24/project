<?php
/**
 * Created by PhpStorm.
 * User: awake
 * Date: 2019/3/22
 * Time: 16:22
 */

namespace App\Helps;


use App\Models\Custom;
use Illuminate\Database\Eloquent\Model;

class Defaults extends Model
{
    public static function getSetting()
    {
        return collect(Custom::find(2));
    }
}