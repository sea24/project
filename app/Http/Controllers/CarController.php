<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class CarController extends Controller
{
    //
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 获取购物车信息
     */
    public function index(Product $product)
    {
        $products = "";
        $car['num'] = "";
        $car = $product->getCar();
        if (isset($car['product'])) {
            if (!empty(count($car['product']))) {
                $products = Product::whereIn('id', $car['product'])
                    ->select('id', 'name', 'price', 'market_price', 'groupimg as thumbnail', 'title')->get();
            } else {
                $products = "";
                $prodcut = "";
            }
        }

        return view('product.shopcar', ['goods'=>$products,'num'=>$car['num']]);
    }

    /**
     * @param Request $request
     * @return array
     * 添加购物车
     */

    public function create(Request $request)
    {
        if ($input = $request->post()) {
            $key = 'uid:'.Auth::id()."product_id".$input['id'];
            if (!Redis::EXISTS($key)) {
                $product['num'] = $input['num'];
                Redis::hmset($key, $product);
                $key1 = 'car_uid:'.Auth::id();
                Redis::sadd($key1, $input['id']);
                return ['code'=>0,'message'=>'添加成功'];
            } else {
                $redis = Redis::hGet($key, 'num');
                $num = $redis + $input['num'];
                Redis::hmset($key, 'num', $num);
                $redis2 = Redis::hGet($key, 'num');
                return ['code'=>0,'message'=>'添加成功'];
            }
        }
    }

    /**
     *购物车数据变更
     */
    public function edit($id, Request $request)
    {

        $input = $request->post();

        $key = 'uid:'.Auth::id()."product_id".$id;
        $redis = Redis::hGet($key, 'num');

        if ($input['operation']==1) {
            $num = $redis + 1;
        } else {
            $num = $redis - 1;
        }
        Redis::hmset($key, 'num', $num);
        return ['code'=>0,'message'=>'修改成功'];
    }
    public function destroy($id, Request $request)
    {
        $input = $request->all();
        $goods = $id;
        $key = 'uid:'.Auth::id()."product_id".$goods;

        $key1 = 'car_uid:'.Auth::id();
        $res = Redis::del($key);
        $res1 = Redis::SREM($key1, $goods);

        if ($res&&$res1) {
            return ['code'=>0,'message'=>'删除成功'];
        } else {
            return ['code'=>1,'message'=>'删除失败'];
        }
    }
}
