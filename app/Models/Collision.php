<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collision extends Model
{
    //
    protected $fillable = ['performance'];
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

}
