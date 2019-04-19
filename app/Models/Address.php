<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Address extends Model
{
    //
    protected $table='user_address';
    public function getProvincesAttribute($value)
    {
        return DB::table('china')->where('id', $value)->value('name');
    }
    public function getCitysAttribute($value)
    {
        return DB::table('china')->where('id', $value)->value('name');
    }
    public function getAreasAttribute($value)
    {
        return DB::table('china')->where('id', $value)->value('name');
    }
    public function getDefault($select, $id = 0)
    {
        if (!$id) {
            $where = ['status'=> 1, 'user_id'=>Auth::id()];
        } else {
            $where = ['id'=> $id, 'user_id'=>Auth::id()];
        }

        return $this->where($where)
            ->select($select)
            ->first();
    }
}
