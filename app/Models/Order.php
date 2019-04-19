<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Order extends Model
{
    //
    private $fid = 0;
    public $pay_statuss = [
         '待支付',
         '已支付'
    ];
    public $statuss = [
        '待支付',
        '待发货',
        '已发货',
        '已完成',
        '已取消',
        '申请退款',
        '已退款',

    ];
    public $typess = [
        '普通订单',
        '活动订单',
        '团购订单',
        '寄卖订单'
    ];
    public $type_name = [
        'all'=>'全部',
        'wait'=>'待支付',
        'ship'=>'待发货',
        'rightship'=>'已发货',
        'ok'=>'已完成',
        'cancel'=>'已取消',
        'refund'=>'申请退款',
        'rightRefund'=>'已退款',
    ];
    private $filters = [
        'wait'=>['status'=>0,'pay_status'=>0],
        'ship'=>['status'=>1,'pay_status'=>1],
        'rightship'=>['status'=>2,'pay_status'=>1],
        'ok'=>['status'=>3,'pay_status'=>1],
        'cancel'=>['status'=>4,'pay_status'=>1],
        'refund'=>['status'=>5,'pay_status'=>1],
        'rightRefund'=>['status'=>6,'pay_status'=>1],
    ];
    public function myOrder($type)
    {
        $order = $this->where('user_id', Auth::id());
        if ($type!='all') {
            $order->where($this->filters[$type]);
        }
        return $order->where([['type', '!=', 2] , ['type', '!=' , 3]])->orderby('created_at', 'desc')->get();
    }
    public function createOrder($productIds, $nums, $address, $sum, $orderSn, $group_buy, $order_type, $shop_id, $oid, $huodong_price)
    {
        DB::beginTransaction();
        try {
            $this->user_id = Auth::id();
            $this->province = $address->province;
            $this->city = $address->city;
            $this->shop_id = $shop_id;
            $this->shop_ordersn = $oid;
            $this->area = $address->area;
            $this->real_name = $address->real_name;
            $this->mobile = $address->mobile;
            $this->type = $order_type;
            $this->address = $address->address;
            $this->huodong_price = $huodong_price;
            $this->express = 0;
            $this->express_code = 0;

//            $this->price  = $sum;
            $this->price  = $sum;
            $this->group_buy   = $group_buy;

            $this->payment_type   = 0;
            $this->pay_status   = 0;
            $this->order_sn   = $orderSn;
            $this->save();
            foreach ($productIds as $item) {
                $ordersAssistant[] = ['pid'=>$item,'num'=>$nums[$item]];
            }
            $product = Product::whereIn('id', $productIds)->get();
            foreach ($product as $products) {
                if ($products->category_id==1) {
                    $products->stock -=1;
                    $products->save();
                }
            }
            $this->ordersAssistant()->createMany($ordersAssistant);
            DB::commit();
            return ['code'=>1,'id'=>$this->id];

        } catch (\Exception $e) {
            Log::error($e);
            DB::rollBack();
            return ['code'=>0,'message'=>'添加订单失败'];
        }
    }
    public function givePerformance($userId, $Performance)
    {
        $father_id =UserAffect::where('user_id', $userId)->value('f_id');
        if ($father_id) {
            $user = User::find($father_id);
            if ($user) {
                $user->performance += $Performance;
                $user->save();

                $collision = Collision::where('user_id', $user->id)->first();
                Log::info($collision);
                $collision->performance +=$Performance;
                $collision->save();
                $this->givePerformance($user->id, $Performance);
            }
        }
    }
    public function collision()
    {
        $collision = Collision::select('user_id', 'first_level')->get();
        $integralLog = new IntegralLog();
        $CollisionSetting = CollisionSetting::first();
        foreach ($collision as $item) {
            if (!empty($item->first_level)) {
                $ids = explode(',', $item->first_level);
                $oneuser = User::whereIn('id', $ids)->where('performance', '>=', $CollisionSetting->impact1)->first();
                if ($oneuser) {
                    $twouser = User::whereIn('id', $ids)->where('id', '!=', $oneuser->id)->sum('performance');
                    if ($twouser >= $CollisionSetting->impact2) {
                        $father = User::find($item->user_id);
                        if ($father) {
                            if ($father->performance >=($CollisionSetting->impact1+$CollisionSetting->impact2)) {
                                $father->performance     -= ($CollisionSetting->impact1+$CollisionSetting->impact2);
//                                $father->income_integral += ($CollisionSetting->impact1+$CollisionSetting->impact2);
                                $father->save();
                                $sendlog = new SendLog();
                                $sendlog->user_id = $father->id;
                                $sendlog->save();
                                $integralLog->createLog($father->id, 1, 1, 2, 150);
                            }

                        }
                    }
                }

            }
        }
    }
    public function getStatusAttribute($value)
    {
        return $this->statuss[$value];
    }
    public function ordersAssistant()
    {
        return $this->hasMany(OrderAssistants::class);
    }
    public function getProvinceNameAttribute($value)
    {
        return DB::table('china')->where('id', $value)->value('name');
    }
    public function getCityNameAttribute($value)
    {
        return DB::table('china')->where('id', $value)->value('name');
    }
    public function getAreaNameAttribute($value)
    {
        return DB::table('china')->where('id', $value)->value('name');
    }
//
    public function chinap()
    {
        return $this->hasOne(China::class, 'Id', 'province');
    }
    public function chinac()
    {
        return $this->hasOne(China::class, 'Id', 'city');
    }
    public function chinaa()
    {
        return $this->hasOne(China::class, 'Id', 'area');
    }
    public function orderassistants()
    {
        return $this->hasOne(OrderAssistants::class,'order_id','id');
    }

    public function product()
    {
            return $this->belongsToMany(Product::class, 'ordersauxiliarys', 'order_id', 'pid');
    }
    public function sends()
    {
        $shop_user = User::find($this->user_id);
//        $shop_user->performance = $this->price;
        $income_integral = $shop_user->income_integral;
        $money_integral = $shop_user->money_integral;
        $group_buy = $shop_user->group_buy;
        $CollisionSetting = CollisionSetting::first();
        $shop_user->income_integral += $this->price - ($this->price * 0.2);
        $shop_user->save();


        $sum =  $this->price - ($this->price * 0.2);
        $incomelog =
            [
                'price'=>$this->price,
                'sum'=>$sum,
                'user_id'=>$shop_user->id,
                'type'=>IncomeLog::TYPE_JISHOU,
                'money_integral'=>$money_integral,
                'income_integral'=>$income_integral,
                'group_buy'=>$group_buy,

                'user_money_integral' =>$shop_user->money_integral,
                'user_income_integral'=>$shop_user->income_integral,
                'user_group_buy'=>$shop_user->group_buy,
                'calculation'=>IncomeLog::CALCULATION_ADD,
                'order_id'=>$this->id
            ];
        Log::channel('integralLog')->info('寄售'.json_encode($incomelog));

        $shop_user->incomelog()->create(IncomeLog::createLog($incomelog));
        $this->givePerformance($this->shop_id, $this->price);
        $this->collision();
        $this->status = 3;
        $this->type = 4;
        $this->save();
    }
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function send($type)
    {
        $order = $this->where('pay_status', '1');
        if ($type=='my') {
            $order->where(['user_id'=>Auth::id(), 'type'=>2]);
        } else {
            $order->where(['user_id'=>Auth::id(),'type'=>'3', 'pay_status'=>1, 'status'=>1]);
        }
        return  $order->orderby('updated_at', 'desc');
    }
    public function getPriceAttribute($value)
    {
        if ($this->type==2) {
            return $this->group_buy;
        }
        return $value;
    }
}
