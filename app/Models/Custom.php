<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Custom extends Model
{
    //

    protected $table ='custom';
//    public function setImgurlAttribute($image)
//    {
//        if (is_array($image)) {
//            $this->attributes['imgurl'] = json_encode($image);
//        }
//    }
//
//    public function getImgurlAttribute($image)
//    {
//        return json_decode($image, true);
//    }
}
