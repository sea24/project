<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $table ='category';
    public function getiocAttribute($ioc)
    {
        return env('APP_URL').'/uploads'.'/'.$ioc;
    }
    public function chind()
    {
        return $this->hasOne(Category::class, 'pid', 'id');
    }
    public function product()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
    public function getCategory()
    {
        return $this->where('pid', 0)->with(['chind' => function ($chind) {
            return $chind->with('chind');
        }])->get();
    }
}
