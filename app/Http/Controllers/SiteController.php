<?php

namespace App\Http\Controllers;

use App\Models\Advertising;
use App\Models\Banner;
use App\Models\Bulletin;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

use Illuminate\Pagination\PaginationServiceProvider;

use Illuminate\Support\Facades\Auth;


class SiteController extends Controller
{
    //
    public function index(Banner $banner, Category $category, Bulletin $bulletin, Product $product)
    {

        $datap = $product->select('market_price', 'id', 'groupimg as thumbnail', 'title', 'price')
            ->where([['category_id', '!=', 1], ['category_id', '!=', 3], ['category_id', '!=', 4]])
            ->paginate(10);


        $pagenum = ceil(($datap->total())/101);

        return view('Site.index', [
            'banner'=>$banner->get(),
            'categorys'=>collect($category->where('pid', 0)->orderby('order', 'desc')->limit(8)->get()),
            'bulletins'=>$bulletin->orderby('created_at', 'desc')->first(),
            'product'=>$datap,
            'page'=>$pagenum
        ]);
    }

    /**
     *加载数据
     */
    public function loaddata(Request $request, Product $product)
    {
        $input = $request->all();
        $res = $product->select('id', 'groupimg as thumbnail', 'market_price', 'title', 'price')->paginate(10);
        return $res;
    }
}
