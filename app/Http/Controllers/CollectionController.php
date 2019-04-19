<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Collection;
use App\Models\User;
class CollectionController extends Controller
{
    //
    public $product;
    public $collection;
    public $id;
    public function __construct(Product $product, Collection $collection)
    {
        $this->product = $product;
        $this->collection = $collection;
    }

    public function index()
    {
        $user = User::where('id', Auth::id())->first();
        return view('user.collection', compact('user'));
    }
    public function create(Request $request)
    {
        $input = $request->post();
        $collection = $this->collection->where('product_id', $input['id'])->first();
        if ($collection) {
            $this->id = $collection->id;
            if ($this->delete()) {
                return ['status'=>1,'msg'=>'取消收藏'];
            }
        } else {
            $product_id = $this->product->where('id', $input['id'])->first();
            if ($product_id) {
                $this->collection->user_id = Auth::id();
                $this->collection->product_id = $product_id->id;
                if ($this->collection->save()) {
                    return ['status'=>1,'msg'=>'已加入收藏'];
                }
            } else {
                return ['status'=>0,'msg'=>'找不到该订单'];
            }
        }
    }
    public function delete()
    {
        return $this->collection->destroy($this->id);
    }
}
