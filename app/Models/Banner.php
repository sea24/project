<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    //
    protected $table='banner';
    public function getPicAttribute($pic)
    {
        return env('APP_URL').'/uploads'.'/'.$pic;
    }
}
