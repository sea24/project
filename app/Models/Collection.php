<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    //
    protected $table='collection';
    protected $fillable = ['performance'];
    public function products()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
