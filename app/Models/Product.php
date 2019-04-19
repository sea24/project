<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class Product extends Model
{
    //
    protected $table = 'product';

    private $select =['market_price', 'id',
        'groupimg as thumbnail', 'market_price', 'title',
        'price', 'start_at', 'end_at', 'group_buy', 'category_id'];
    public function setGroupimgAttribute($value)
    {
        if (is_array($value)) {
            $this->attributes['groupimg'] = json_encode($value);
        }
    }

    public function getGroupimgAttribute($value)
    {
        return json_decode($value, true);
    }

    public function getThumbnailAttribute($value)
    {
        return asset('uploads') . '/' . json_decode($value, true)[0];
    }

    public function getCategoryAttribute($value)
    {
        return Category::where('id', $value)->value('name');
    }

    public function getCar()
    {
        $key1 = 'car_uid:' . Auth::id();

        $product_id = Redis::sMembers($key1);
        if (isset($product_id)) {
            if (!empty($product_id)) {
                for ($i = 0; $i < count($product_id); $i++) {
                    $key = 'uid:' . Auth::id() . "product_id" . $product_id[$i];
                    $procut = Redis::hGetAll($key);
                    $num[$product_id[$i]] = $procut['num'];
                    $product_ids[] = $product_id[$i];
                }
                return ['num' => $num, 'product' => $product_ids];
            }
        }
    }
    public function getClassProduct($where, $orderby)
    {
        return $this->where($where)->select($this->select)->orderBy($orderby[0],$orderby[1]);
    }
}
