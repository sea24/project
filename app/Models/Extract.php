<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Extract extends Model
{
    //
    public $weeks = [
        '星期日',
        '星期一',
        '星期二',
        '星期三',
        '星期四',
        '星期五',
        '星期六'
    ];
    protected $table = 'extract';
    public function setWeeksAttribute($value)
    {
        if (is_array($value)) {
            $this->attributes['weeks'] = json_encode($value);
        }
    }
    public function getWeeksAttribute($value)
    {
        return json_decode($value, true);
    }
}
