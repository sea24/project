<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advertising extends Model
{
    //
    protected $table='advertising';
    public function getPicAttribute($value)
    {
        return env('APP_URL').'/uploads'.'/'.$value;
    }
}
