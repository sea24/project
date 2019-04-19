<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\DistributionSetting;
use App\Models\IncomeLog;
use App\Models\IntegralLog;
use App\Models\Order;
use App\Models\OrderAssistants;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class OrdersController extends Controller
{
    private $product;
    private $user_address;
    private $order;
    private $user;
    private $integralLog;
    //
    private $selects = [
        'id',
        'name',
        'price',
        'stock' ,
        'market_price',
        'groupimg as thumbnail',
        'category_id',
        'title',
        'market_price',
        'group_buy'];
    public function __construct(Product $product, Address $address, Order $order, User $user, IntegralLog $integralLog)
    {
        $this->product      = $product;
        $this->order        = $order;
        $this->user_address = $address;
        $this->user         = $user;
        $this->integralLog  = $integralLog;
    }

//    public function laji(Request $request){
//        exit;
//        $input = $request->all();
//        if ($input){
//            if ($input['laji']  == '长白山野生山参'){
//
//                $arr =  [161,72,58,15,39,25,89,172,64,216,6,115,26,85,10,110,113,18,14,77,13,31,52,218,158,575,619,453,457,12,496,604,600,317];
//                $arrkong1=[];
//                DB::beginTransaction();
//                try{
//                    for($i = 0;$i<count($arr);$i++){
//                        //获取地址
//                        $address =$this->user_address->where('user_id',$arr[$i])->select('province', 'id',
//                            'real_name', 'mobile', 'address','city', 'area')->first();
//
//                        $insrt['user_id'] = $arr[$i];
//                        $insrt['shop_id'] = 0;
//                        $insrt['province'] = $address->province;
//                        $insrt['city'] = $address->city;
//                        $insrt['area'] = $address->area;
//                        $insrt['address'] = $address->address;
//                        $insrt['express_code'] = 0;
//                        $insrt['express'] = 0;
//                        $insrt['real_name'] = $address->real_name;
//                        $insrt['mobile'] = $address->mobile;
//                        $insrt['type'] = 1;
//                        $insrt['huodong_price'] = 4980;
//                        $insrt['price'] = 5976;
//                        $insrt['group_buy'] = 996;
//                        $insrt['payment_type'] = 0;
//                        $insrt['pay_status'] = 1;
//                        $insrt['order_sn'] = time();
//                        $insrt['shop_ordersn'] = 0;
//                        $insrt['status'] = 3;
//                        $insrt['created_at'] = date('2019-04-15 10:01:12',time());
//                        $insrt['updated_at'] = date('2019-04-15 10:01:12',time());
//
//                        $idinsert =   Order::insertGetId($insrt);
//
//                        if ($idinsert){
//
//                            $insertfubiao['order_id'] = $idinsert;
//                            $insertfubiao['pid'] = 14;
//                            $insertfubiao['num'] = 1;
//                            $insertfubiao['created_at'] = date('2019-04-15 10:01:12',time());
//                            $insertfubiao['updated_at'] = date('2019-04-15 10:01:12',time());
//                            $fu = OrderAssistants::insert($insertfubiao);
//
//                        }
//                    }
//
//                    DB::commit();
//                    return view('Order.test');
//                }catch (\Exception $e) {
//                    array_push($arrkong1,$arr[$i]);
//                    dd($arrkong1);
//                    DB::rollBack();
//
//                }
//
//            }
//            if ($input['laji']  == '负离子空气净化器'){
//                $arr = [169,128,234];
//                $arrkong2=[];
//                DB::beginTransaction();
//                try{
//
//                    for($i = 0;$i<count($arr);$i++){
//                        //获取地址
//                        $address =$this->user_address->where('user_id',$arr[$i])->select('province', 'id',
//                            'real_name', 'mobile', 'address','city', 'area')->first();
//
//                        $insrt['user_id'] = $arr[$i];
//                        $insrt['shop_id'] = 0;
//                        $insrt['province'] = $address->province;
//                        $insrt['city'] = $address->city;
//                        $insrt['area'] = $address->area;
//                        $insrt['address'] = $address->address;
//                        $insrt['express_code'] = 0;
//                        $insrt['express'] = 0;
//                        $insrt['real_name'] = $address->real_name;
//                        $insrt['mobile'] = $address->mobile;
//                        $insrt['type'] = 1;
//                        $insrt['huodong_price'] = 3980;
//                        $insrt['price'] = 4776;
//                        $insrt['group_buy'] = 796;
//                        $insrt['payment_type'] = 0;
//                        $insrt['pay_status'] = 1;
//                        $insrt['order_sn'] = time();
//                        $insrt['shop_ordersn'] = 0;
//                        $insrt['status'] = 3;
//                        $insrt['created_at'] = date('2019-04-15 10:01:12',time());
//                        $insrt['updated_at'] = date('2019-04-15 10:01:12',time());
//
//
//                        $idinsert =   Order::insertGetId($insrt);
//
//                        if ($idinsert){
//
//                            $insertfubiao['order_id'] = $idinsert;
//                            $insertfubiao['pid'] = 13;
//                            $insertfubiao['num'] = 1;
//                            $insertfubiao['created_at'] = date('2019-04-15 10:01:12',time());
//                            $insertfubiao['updated_at'] = date('2019-04-15 10:01:12',time());
//                            $fu = OrderAssistants::insert($insertfubiao);
//
//                        }
//                    }
//
//                    DB::commit();
//                    return view('Order.test');
//                }catch (\Exception $e) {
//                    array_push($arrkong2,$arr[$i]);
//                    dd($arrkong2);
//                    DB::rollBack();
//
//                }
//
//            }
//            if ($input['laji']  == '南红玉手链'){
//                $arr = [53,84,376];
//                $arrkong3=[];
//                DB::beginTransaction();
//                try{
//
//                    for($i = 0;$i<count($arr);$i++){
//                        //获取地址
//                        $address =$this->user_address->where('user_id',$arr[$i])->select('province', 'id',
//                            'real_name', 'mobile', 'address','city', 'area')->first();
//
//                        $insrt['user_id'] = $arr[$i];
//                        $insrt['shop_id'] = 0;
//                        $insrt['province'] = $address->province;
//                        $insrt['city'] = $address->city;
//                        $insrt['area'] = $address->area;
//                        $insrt['address'] = $address->address;
//                        $insrt['express_code'] = 0;
//                        $insrt['express'] = 0;
//                        $insrt['real_name'] = $address->real_name;
//                        $insrt['mobile'] = $address->mobile;
//                        $insrt['type'] = 1;
//                        $insrt['huodong_price'] = 2980;
//                        $insrt['price'] = 3576;
//                        $insrt['group_buy'] = 596;
//                        $insrt['payment_type'] = 0;
//                        $insrt['pay_status'] = 1;
//                        $insrt['order_sn'] = time();
//                        $insrt['shop_ordersn'] = 0;
//                        $insrt['status'] = 3;
//                        $insrt['created_at'] = date('2019-04-15 10:01:12',time());
//                        $insrt['updated_at'] = date('2019-04-15 10:01:12',time());
//
//
//                        $idinsert =   Order::insertGetId($insrt);
//
//                        if ($idinsert){
//
//                            $insertfubiao['order_id'] = $idinsert;
//                            $insertfubiao['pid'] = 12;
//                            $insertfubiao['num'] = 1;
//                            $insertfubiao['created_at'] = date('2019-04-15 10:01:12',time());
//                            $insertfubiao['updated_at'] = date('2019-04-15 10:01:12',time());
//                            $fu = OrderAssistants::insert($insertfubiao);
//
//                        }
//                    }
//
//                    DB::commit();
//                    return view('Order.test');
//                }catch (\Exception $e) {
//                    array_push($arrkong3,$arr[$i]);
//                    dd($arrkong3);
//                    DB::rollBack();
//
//                }
//
//            }
//            if ($input['laji']  == '野生黑枸杞'){
//                $arr = [95];
//                $arrkong4=[];
//                DB::beginTransaction();
//                try{
//
//                    for($i = 0;$i<count($arr);$i++){
//                        //获取地址
//                        $address =$this->user_address->where('user_id',$arr[$i])->select('province', 'id',
//                            'real_name', 'mobile', 'address','city', 'area')->first();
//
//                        $insrt['user_id'] = $arr[$i];
//                        $insrt['shop_id'] = 0;
//                        $insrt['province'] = $address->province;
//                        $insrt['city'] = $address->city;
//                        $insrt['area'] = $address->area;
//                        $insrt['address'] = $address->address;
//                        $insrt['express_code'] = 0;
//                        $insrt['express'] = 0;
//                        $insrt['real_name'] = $address->real_name;
//                        $insrt['mobile'] = $address->mobile;
//                        $insrt['type'] = 1;
//                        $insrt['huodong_price'] = 1980;
//                        $insrt['price'] = 2376;
//                        $insrt['group_buy'] = 396;
//                        $insrt['payment_type'] = 0;
//                        $insrt['pay_status'] = 1;
//                        $insrt['order_sn'] = time();
//                        $insrt['shop_ordersn'] = 0;
//                        $insrt['status'] = 3;
//                        $insrt['created_at'] = date('2019-04-15 10:01:12',time());
//                        $insrt['updated_at'] = date('2019-04-15 10:01:12',time());
//
//
//                        $idinsert =   Order::insertGetId($insrt);
//
//                        if ($idinsert){
//
//                            $insertfubiao['order_id'] = $idinsert;
//                            $insertfubiao['pid'] = 2;
//                            $insertfubiao['num'] = 1;
//                            $insertfubiao['created_at'] = date('2019-04-15 10:01:12',time());
//                            $insertfubiao['updated_at'] = date('2019-04-15 10:01:12',time());
//                            $fu = OrderAssistants::insert($insertfubiao);
//
//                        }
//                    }
//
//                    DB::commit();
//                    return view('Order.test');
//                }catch (\Exception $e) {
//                    array_push($arrkong4,$arr[$i]);
//                    DB::rollBack();
//
//                }
//
//            }
//            if ($input['laji']  == '女皇贡菊'){
//                $arr = [395,209,27,444,224,145,179,32,146,174,175,555,338,602,97,612,245,307];
//                $arrkong5=[];
//                DB::beginTransaction();
//                try{
//
//                    for($i = 0;$i<count($arr);$i++){
//                        //获取地址
//                        $address =$this->user_address->where('user_id',$arr[$i])->select('province', 'id',
//                            'real_name', 'mobile', 'address','city', 'area')->first();
//
//                        $insrt['user_id'] = $arr[$i];
//                        $insrt['shop_id'] = 0;
//                        $insrt['province'] = $address->province;
//                        $insrt['city'] = $address->city;
//                        $insrt['area'] = $address->area;
//                        $insrt['address'] = $address->address;
//                        $insrt['express_code'] = 0;
//                        $insrt['express'] = 0;
//                        $insrt['real_name'] = $address->real_name;
//                        $insrt['mobile'] = $address->mobile;
//                        $insrt['type'] = 1;
//                        $insrt['huodong_price'] = 980;
//                        $insrt['price'] = 1176;
//                        $insrt['group_buy'] = 196;
//                        $insrt['payment_type'] = 0;
//                        $insrt['pay_status'] = 1;
//                        $insrt['order_sn'] = time();
//                        $insrt['shop_ordersn'] = 0;
//                        $insrt['status'] = 3;
//                        $insrt['created_at'] = date('2019-04-15 10:01:12',time());
//                        $insrt['updated_at'] = date('2019-04-15 10:01:12',time());
//
//
//                        $idinsert =   Order::insertGetId($insrt);
//
//                        if ($idinsert){
//
//                            $insertfubiao['order_id'] = $idinsert;
//                            $insertfubiao['pid'] = 1;
//                            $insertfubiao['num'] = 1;
//                            $insertfubiao['created_at'] = date('2019-04-15 10:01:12',time());
//                            $insertfubiao['updated_at'] = date('2019-04-15 10:01:12',time());
//                            $fu = OrderAssistants::insert($insertfubiao);
//
//                        }
//                    }
//
//                    DB::commit();
//                    return view('Order.test');
//                }catch (\Exception $e) {
//                    array_push($arrkong5,$arr[$i]);
//                    dd($arrkong5);
//                    DB::rollBack();
//
//                }
//
//            }
//        }else{
//            return view('Order.test');
//        }
//    }
    public function laji(Request $request){
        exit;
        $input = $request->all();
        if ($input){
            if ($input['laji']  == '长白山野生山参'){

                $arr =  [161,72,58,15,39,25,89,172,64,216,6,115,26,85,10,110,113,18,14,77,13,31,52,218,158,575,619,453,457,12,496,604,600,317];
                $arrkong1=[];
                DB::beginTransaction();
                try{
                    for($i = 0;$i<count($arr);$i++){
                        $money_integral = User::where('id',$arr[$i])->first()->money_integral;
                        $income_integral = User::where('id',$arr[$i])->first()->income_integral;
                        $group_buy = User::where('id',$arr[$i])->first()->group_buy;
                        $incrementjifen = User::where('id',$arr[$i])->increment('income_integral',7432);

                       if ($incrementjifen){
                           $xinzeng['user_id'] = $arr[$i];
                           $xinzeng['type'] = 'jishou';
                           $xinzeng['calculation'] = 'add';
                           $xinzeng['price'] = 7432;
                           $xinzeng['money_integral'] = User::where('id',$arr[$i])->first()->money_integral;
                           $xinzeng['income_integral'] = User::where('id',$arr[$i])->first()->income_integral;
                           $xinzeng['group_buy'] = User::where('id',$arr[$i])->first()->group_buy;
                           $xinzeng['original_money_integral'] = $money_integral;
                           $xinzeng['original_income_integral'] = $income_integral;
                           $xinzeng['original_group_buy'] = $group_buy;
                           $xinzeng['description'] = '用户'.$arr[$i].'从团购专区得到的收益7432';
                           $xinzeng['created_at'] = date('Y-m-d H:i:s',time());
                           $xinzeng['updated_at'] = date('Y-m-d H:i:s',time());

                           $res = DB::table('income_logs')->insert($xinzeng);

                        }
                    }

                    DB::commit();
                    return view('Order.test');
                }catch (\Exception $e) {
                    array_push($arrkong1,$arr[$i]);
                    dd($e);
                    DB::rollBack();

                }

            }
            if ($input['laji']  == '负离子空气净化器'){
                $arr = [169,128,234];
                $arrkong2=[];
                DB::beginTransaction();
                try{

                    for($i = 0;$i<count($arr);$i++){
                        $money_integral = User::where('id',$arr[$i])->first()->money_integral;
                        $income_integral = User::where('id',$arr[$i])->first()->income_integral;
                        $group_buy = User::where('id',$arr[$i])->first()->group_buy;
                        $incrementjifen = User::where('id',$arr[$i])->increment('income_integral',5790);

                        if ($incrementjifen){
                            $xinzeng['user_id'] = $arr[$i];
                            $xinzeng['type'] = 'jishou';
                            $xinzeng['calculation'] = 'add';
                            $xinzeng['price'] = 5790;
                            $xinzeng['money_integral'] = User::where('id',$arr[$i])->first()->money_integral;
                            $xinzeng['income_integral'] = User::where('id',$arr[$i])->first()->income_integral;
                            $xinzeng['group_buy'] = User::where('id',$arr[$i])->first()->group_buy;
                            $xinzeng['original_money_integral'] = $money_integral;
                            $xinzeng['original_income_integral'] = $income_integral;
                            $xinzeng['original_group_buy'] = $group_buy;
                            $xinzeng['description'] = '用户'.$arr[$i].'从团购专区得到的收益7432';
                            $xinzeng['created_at'] = date('Y-m-d H:i:s',time());
                            $xinzeng['updated_at'] = date('Y-m-d H:i:s',time());

                            $res = DB::table('income_logs')->insert($xinzeng);

                        }
                    }

                    DB::commit();
                    return view('Order.test');
                }catch (\Exception $e) {
                    array_push($arrkong2,$arr[$i]);
                    dd($arrkong2);
                    DB::rollBack();

                }

            }
            if ($input['laji']  == '南红玉手链'){
                $arr = [53,84,376];
                $arrkong3=[];
                DB::beginTransaction();
                try{

                    for($i = 0;$i<count($arr);$i++) {
                        //获取地址
                        $money_integral = User::where('id', $arr[$i])->first()->money_integral;
                        $income_integral = User::where('id', $arr[$i])->first()->income_integral;
                        $group_buy = User::where('id', $arr[$i])->first()->group_buy;
                        $incrementjifen = User::where('id', $arr[$i])->increment('income_integral', 4288);

                        if ($incrementjifen) {
                            $xinzeng['user_id'] = $arr[$i];
                            $xinzeng['type'] = 'jishou';
                            $xinzeng['calculation'] = 'add';
                            $xinzeng['price'] = 4288;
                            $xinzeng['money_integral'] = User::where('id', $arr[$i])->first()->money_integral;
                            $xinzeng['income_integral'] = User::where('id', $arr[$i])->first()->income_integral;
                            $xinzeng['group_buy'] = User::where('id', $arr[$i])->first()->group_buy;
                            $xinzeng['original_money_integral'] = $money_integral;
                            $xinzeng['original_income_integral'] = $income_integral;
                            $xinzeng['original_group_buy'] = $group_buy;
                            $xinzeng['description'] = '用户' . $arr[$i] . '从团购专区得到的收益7432';
                            $xinzeng['created_at'] = date('Y-m-d H:i:s', time());
                            $xinzeng['updated_at'] = date('Y-m-d H:i:s', time());

                            $res = DB::table('income_logs')->insert($xinzeng);

                        }
                    }
                    DB::commit();
                    return view('Order.test');
                }catch (\Exception $e) {
                    array_push($arrkong3,$arr[$i]);
                    dd($arrkong3);
                    DB::rollBack();

                }

            }
            if ($input['laji']  == '野生黑枸杞'){
                $arr = [95];
                $arrkong4=[];
                DB::beginTransaction();
                try{
                    for($i = 0;$i<count($arr);$i++){
                        $money_integral = User::where('id', $arr[$i])->first()->money_integral;
                        $income_integral = User::where('id', $arr[$i])->first()->income_integral;
                        $group_buy = User::where('id', $arr[$i])->first()->group_buy;
                        $incrementjifen =  User::where('id',$arr[$i])->increment('income_integral',2836);
                        if ($incrementjifen) {
                            $xinzeng['user_id'] = $arr[$i];
                            $xinzeng['type'] = 'jishou';
                            $xinzeng['calculation'] = 'add';
                            $xinzeng['price'] = 2836;
                            $xinzeng['money_integral'] = User::where('id', $arr[$i])->first()->money_integral;
                            $xinzeng['income_integral'] = User::where('id', $arr[$i])->first()->income_integral;
                            $xinzeng['group_buy'] = User::where('id', $arr[$i])->first()->group_buy;
                            $xinzeng['original_money_integral'] = $money_integral;
                            $xinzeng['original_income_integral'] = $income_integral;
                            $xinzeng['original_group_buy'] = $group_buy;
                            $xinzeng['description'] = '用户' . $arr[$i] . '从团购专区得到的收益7432';
                            $xinzeng['created_at'] = date('Y-m-d H:i:s', time());
                            $xinzeng['updated_at'] = date('Y-m-d H:i:s', time());

                            $res = DB::table('income_logs')->insert($xinzeng);

                        }
                    }

                    DB::commit();
                    return view('Order.test');
                }catch (\Exception $e) {
                    array_push($arrkong4,$arr[$i]);
                    DB::rollBack();

                }

            }
            if ($input['laji']  == '女皇贡菊'){
                $arr = [395,209,27,444,224,145,179,32,146,174,175,555,338,602,97,612,245,307];
                $arrkong5=[];
                DB::beginTransaction();
                try{

                    for($i = 0;$i<count($arr);$i++) {
                        //获取地址
                        $money_integral = User::where('id', $arr[$i])->first()->money_integral;
                        $income_integral = User::where('id', $arr[$i])->first()->income_integral;
                        $group_buy = User::where('id', $arr[$i])->first()->group_buy;
                        $res1 = User::where('id', $arr[$i])->increment('income_integral', 1384);

                        if ($res1){
                        $xinzeng['user_id'] = $arr[$i];
                        $xinzeng['type'] = 'jishou';
                        $xinzeng['calculation'] = 'add';
                        $xinzeng['price'] = 1384;
                        $xinzeng['money_integral'] = User::where('id', $arr[$i])->first()->money_integral;
                        $xinzeng['income_integral'] = User::where('id', $arr[$i])->first()->income_integral;
                        $xinzeng['group_buy'] = User::where('id', $arr[$i])->first()->group_buy;
                        $xinzeng['original_money_integral'] = $money_integral;
                        $xinzeng['original_income_integral'] = $income_integral;
                        $xinzeng['original_group_buy'] = $group_buy;
                        $xinzeng['description'] = '用户' . $arr[$i] . '从团购专区得到的收益7432';
                        $xinzeng['created_at'] = date('Y-m-d H:i:s', time());
                        $xinzeng['updated_at'] = date('Y-m-d H:i:s', time());

                        $res = DB::table('income_logs')->insert($xinzeng);
                        }
                    }

                    DB::commit();
                    return view('Order.test');
                }catch (\Exception $e) {
                    array_push($arrkong5,$arr[$i]);
                    dd($arrkong5);
                    DB::rollBack();

                }
            }

        }else{
            return view('Order.test');
        }
    }

    /**
     *
     */
    public function bujifen(){

    }
    public function create(Request $request)
    {
        $input = $request->all();
        if ($input) {
            if ($input['type']=='buy') {
                $num = [$input['id']=>$input['nums']];
                $id  = collect($input['id']);
            } else {
                $car  = $this->product->getCar();
                $id   = $car['product'];
                $num  = $car['num'];
            }
            $product = $this->product->whereIn('id', $id)
                ->select($this->selects)->get();
            $sum = 0;
            $group_buy = 0;
            $order_type = 0;
            $huodong_price = 0;
            foreach ($product as $products) {
                if ($products->category_id == 1) {
                    if ($num[$products->id] > $products->stock) {
                        return ['code'=>1, 'message'=>'库存不足'];
                    }
                    $order_type = 1;
                    $num[$products->id] = 1;
                    $sum +=($products->price*$num[$products->id]) + ($products->group_buy*$num[$products->id]);
                    $group_buy +=($products->group_buy*$num[$products->id]);
                    $huodong_price = $products->price*$num[$products->id];
                } elseif ($products->category_id == 3) {
                    $sum +=($products->price*$num[$products->id]);
                    $group_buy +=($products->group_buy*$num[$products->id]);
                    $order_type = 2;
                } elseif ($products->category_id == 4) {
                    $sum +=($products->price*$num[$products->id]);
                } else {
                    $sum +=($products->price*$num[$products->id]);
                }
            }
            $oid = 0;
            $shop_id = 0;
            if (isset($input['oid'])) {
                $shoporder = $this->order->where('order_sn', $input['oid'])->first();
                if ($shoporder) {
                        $order_type =4;
                        $sum = $shoporder->price;
                        $shop_id = $shoporder->user_id;
                        $oid = $input['oid'];
                }
            }
            $select = ['province', 'id',
                       'real_name', 'mobile', 'address',
                       'city', 'area'];
            $address = $this->user_address->getDefault($select, $input['address_id']);
            if ($this->order->where('order_sn', $input['order_sn'])->first()) {
                return ['code'=>1,'message'=>'请勿重复下单'];
            }
            return $this->order->
                createOrder($id, $num, $address, $sum, $input['order_sn'], $group_buy, $order_type, $shop_id, $oid, $huodong_price);
        }
    }
    public function showorder($id)
    {

        $order = $this->order->where('pay_status', 0)->find($id);

        if (!$order) {
            return redirect(route('order.shoporder', ['type'=>'all']));
        }
        return view('Order.create', ['order'=>$order]);
    }
    public function update($id)
    {
        if ($order = $this->order->where(['id'=>$id, 'user_id'=>Auth::id()])->select('id' ,'type', 'pay_status', 'status' ,'pay_status' , 'price as prices', 'group_buy', 'huodong_price', 'shop_ordersn', 'shop_id')->first()) {
            if ($this->order->where(['id'=>$id, 'pay_status'=>1])->first()) {
                return ['code'=>1, 'message'=>'该订单已经支付过'];
            }
            DB::beginTransaction();
            try {
                $user = Auth::user();
                if ($order->type==2) {
                    if ($user->group_buy < $order->group_buy) {
                        return ['code'=>1,'message'=>'您的团购卷不足'];
                    }
                } else {
                    if ($user->money_integral < $order->prices) {
                        return ['code'=>1,'message'=>'您的现金积分不足'];
                    }
                }

                $order->pay_status = 1;
                $order->status     = 1;
                if ($order->save()) {
                    if ($order->type==1) {
                        Log::info($order);
                        $user->money_integral -=$order->prices;
                        $user->group_buy +=$order->group_buy;
                        $user->performance += $order->huodong_price;
                        $this->integralLog->createLog($user->id, 1, 2, 1, $order->prices);

                        $distributionetting = new DistributionSetting();
                        $distributionetting->givemoney($user->id, $order->huodong_price, $order->id);
                        $this->integralLog->createLog($user->id, 2, 1, 2, $order->prices);

                        $this->order->givePerformance($user->id, $order->huodong_price);


                        $this->integralLog->createLog($user->id, 3, 1, 3, $order->group_buy);
                    } elseif ($order->type==2) {
                        $user->group_buy -=$order->group_buy;
                        $this->integralLog->createLog($user->id, 3, 2, 3, $order->group_buy);

                    } else {
                        $user->money_integral -=$order->prices;

                    }
                    $user->save();
                    if ($order->type==4) {
                        $shop_order = $this->order->where('order_sn', $order->shop_ordersn)->first();
                        $shop_order->status = 3;
                        $shop_order->save();

                        $shop_user = $this->user->find($order->shop_id);

                        $income_integral = $shop_user->income_integral;
                        $money_integral = $shop_user->money_integral;
                        $group_buy = $shop_user->group_buy;

                        $shop_user->income_integral = $order->prices - ($order->prices * 0.2);
                        $shop_user->save();
                        $shop_user->incomelog()->create([
                            'price'=>$income_integral,
                            'money_integral'=>$money_integral,
                            'income_integral'=>$income_integral,
                            'group_buy'=>$group_buy,
                            'original_money_integral' =>$shop_user->money_integral,
                            'original_income_integral'=>$shop_user->income_integral,
                            'original_group_buy'=>$shop_user->group_buy,
                            'calculation'=>IncomeLog::CALCULATION_ADD,
                            'description'=>'用户：'.$shop_user->id.'根据寄售订单'.
                                $shop_order->id.'播送收益商品原价:'.$order->prices.'的0.2为'.
                                $order->prices - ($order->prices * 0.2)
                        ]);
                    }
                    $this->order->collision();
                    DB::commit();
                    return ['code'=>0,'message'=>'付款成功'];
//                    return ['code'=>1,'message'=>'付款失败请稍后重试'];

                }
            } catch (\Exception $e) {
                DB::rollBack();
                Log::error('order:'.$e);
                return ['code'=>1,'message'=>'付款失败请稍后重试'];
            }
        } else {
            return ['code'=>1,'message'=>'订单失效'];
        }
    }
    public function show($id, Request $request)
    {

        if ($input   = $request->all()) {
                $ids = $id;
            if ($input['type']=='buy') {
                $num = [$id=>$input['num']];
                $id  = collect($id);
            } else {
                $car  = $this->product->getCar();
                $id   = $car['product'];
                $num  = $car['num'];
            }
            $product = $this->product->whereIn('id', $id)
                ->select($this->selects)
                ->get();
            $sum = 0;

            foreach ($product as $products) {
                if ($products->category_id==1) {
                    if ($num[$products->id] > $products->stock) {
                        return "<script>alert('库存不足');window.history.go(-1)</script>";
                    }
                    $sum +=($products->price*$num[$products->id]);
                } else {
                    $sum +=($products->price*$num[$products->id]);
                }
            }
            $oid = 0;
            if (isset($input['oid'])) {
                $sums = $this->order->where('order_sn', $input['oid'])->value('price');
                if (!empty($sums)) {
                    $sum = $sums;
                    $oid = $input['oid'];
                }
            }
            if (!$product) {
                return '商品已删除';
            }
            $aid = 0;
            if (isset($input['aid'])) {
                $aid = $input['aid'];
            }
            $select = ['province as provinces', 'id',
                'real_name', 'mobile', 'address',
                'city as citys', 'area as areas'];

            $address_id = 0;
            $address = $this->user_address->getDefault($select, $aid);
            if ($address) {
                $address_id = $address->id;
            }
            if ($product[0]->category_id ==3) {
                $sum =($product[0]->group_buy*$num[$product[0]->id]);
            }
            $order_sn =date('YmdHs', time()).Auth::id();
            return view('Order.show', ['product'=>$product,'num'=>$num,'order_sn'=>$order_sn,'sum'=>$sum,
                'address'=>$address,
                'address_id'=>$address_id,
                'type'=>$input['type'],
                'id'=>$ids,
                'oid'=>$oid,
                'nums'=>$input['num']
            ]);
        }
    }
    public function ordersend($type)
    {

        return view('Order.ordersend', ['order'=>$this->order
            ->send($type)->get(), 'user'=>Auth::user(),
            'type'=>$type, 'type_name'=>$this->order->type_name]);
    }
    public function consignment(Request $request)
    {
        if ($order = $this->order->where(['user_id'=>Auth::id(), 'id'=>$request->all()['id']])->first()) {
                $order->type = 3;
            if ($order->save()) {
                return ['code'=>0, 'message'=>'成功'];
            }
                return ['code'=>1, 'message'=>'失败'];
        }
    }
}
