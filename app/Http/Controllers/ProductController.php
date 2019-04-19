<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    //
    private $product;
    private $page = 50;
    public function __construct(Product $product, Collection $collection)
    {

        $this->product = $product;
        $this->collection = $collection;
    }

    public function index($id)
    {
        if (Auth::check()) {
            $collection = $this->collection->where('user_id', Auth::id())->where('product_id', $id)->first();
        } else {
            $collection = '';
        }
        return view('product.index', [
            'product'=>$this->product->find($id),
            'collection'=>$collection
        ]);
    }

    /**
     *商品列表
     */
    public function classfiygoods(Product $product, $pid)
    {
        $datap = $this->product->getClassProduct(['category_id'=>$pid], ['id','desc'])->paginate($this->page);

        $pagenum = ceil(($datap->total())/$this->page);


        return view('product.classfiygoods', [
            'product'=>$datap,
            'page'=>$pagenum,
            'pid'=>$pid,
            'angel'=>2,
            'type'=>'id',
            'aord'=>'desc'
        ]);
    }
    /**
     *加载数据
     */
    public function loadclassfiy(Request $request, Product $product)
    {
        ;
        $input = $request->all();
        $res = $this->product->
        getClassProduct(['category_id'=>$input['pid']], [$input['type'], $input['aord']])->paginate($this->page);

        return view('product.ajaxProduct', ['res'=>$res]);
    }
    /**
     *模糊查询
     */
    public function searchgoods($input){

        $datap = $this->product->getClassProduct([['title', 'like', '%'.$input.'%']],['id','desc'])->paginate($this->page);

        $pagenum = ceil(($datap->total())/$this->page);

//        dd($datap);
        return view('product.classfiygoods', [
            'product'=>$datap,
            'page'=>$pagenum,
            'pid'=>1,
            'angel'=>2,
            'type'=>'id',
            'aord'=>'desc'
        ]);


    }

    /**
     *升序降序
     */
    public function aordp(Request $request, Product $product, $pid, $type, $aord, $angle)
    {
        $datap =  $this->product->getClassProduct(['category_id'=>$pid], [$type, $aord])->paginate($this->page);

        $pagenum = ceil(($datap->total())/$this->page);

        return view('product.classfiygoods', [
            'product'=>$datap,
            'page'=>$pagenum,
            'pid'=>$pid,
            'angel'=>$angle,
            'type'=>$type,
            'aord'=>$aord
        ]);
    }
}
