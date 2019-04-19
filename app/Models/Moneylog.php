<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Moneylog extends Model
{
    //
    protected $table = 'money_log';
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
