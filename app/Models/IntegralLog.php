<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IntegralLog extends Model
{
    //
    public function createLog($user_id, $type, $operation, $difference, $price)
    {
        $this->user_id      = $user_id;
        $this->type         = $type;
        $this->operation    = $operation;
        $this->difference   = $difference;
        $this->price        = $price;
        $this->save();
    }
}
