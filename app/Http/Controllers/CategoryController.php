<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public $category;
    public $product;
    public function __construct(Category $category, Product $product)
    {
        $this->category = $category;
        $this->product  = $product;
    }
    public function get_product($id)
    {
        $product = $this->product->select('groupimg as thumbnail', 'title', 'price')->where('category_id', $id)->get();
        if ($product->isEmpty()) {
            return ['code'=>001,'message'=>'暂无商品'];
        } else {
            return ['code'=>000,'message'=>'ojbk','data'=>$product];
        }
    }

    public function index()
    {
// 第一级分类
        $category = $this->category->where('pid', 0)->get();

        foreach ($category as $value) {
            $str[] = $value->id;
        }
// 第二级分类
        $chind  = $this->category->where('pid', $category[0]->id)->orderBy('order','desc')->get();
        $pid  = $this->category->where('id', $category[0]->id)->get();
        return view('category.category', ['category'=>$category,
        'chind'=>$chind,
        'pid'=>$pid
        ]);
    }
    public function create(Request $request)
    {
        $input = $request->post();
        $category = $this->category->where('pid', $input['id'])->get();
        return ['status'=>1,'category'=>$category];
    }
    public function shoplist()
    {
        return view('category.shoplist');
    }

    /**
     *点击请求二级分类
     */
    public function childclassfiy(Request $request){
        $input = $request->all();

        $chind = $this->category->where('pid', $input['pid'])->get();

        return $chind;
    }
}
