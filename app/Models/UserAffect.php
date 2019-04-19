<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAffect extends Model
{
    //
    protected $fillable = ['f_id'];
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'f_id');
    }

}
