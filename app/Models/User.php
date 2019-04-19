<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //
    protected $fillable = ['name','mobile','password'];
    protected $table = 'users';
    public function collection()
    {
        return $this->belongsToMany(Product::class, 'collection', 'user_id', 'product_id');
    }
    public function affect()
    {
        return $this->hasOne(UserAffect::class);
    }
    public function collision()
    {
        return $this->hasOne(Collision::class);
    }
    public function getCount()
    {

        return  UserAffect::where('f_id', $this->id)->count();
    }
    public function getteam()
    {
        return $this->belongsToMany(self::class, 'user_affects', 'f_id', 'user_id');
    }
    public function incomelog()
    {
        return $this->hasOne(IncomeLog::class, 'user_id');
    }
    public function incomeloglist()
    {
        return $this->hasMany(IncomeLog::class, 'user_id');
    }
}
