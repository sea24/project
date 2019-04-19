<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderAssistants extends Model
{
    //
    protected $fillable = ['pid','num'];
    protected $table = 'ordersauxiliarys';

    public function product()
    {
        return $this->hasOne(Product::class,'id','pid');
    }
}
