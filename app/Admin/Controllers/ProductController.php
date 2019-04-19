<?php

namespace App\Admin\Controllers;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Encore\Admin\Widgets\Box;

class ProductController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('商品列表')
            ->description('商品列表')
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('Detail')
            ->description('description')
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('Edit')
            ->description('description')
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('Create')
            ->description('description')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Product);
        
        $grid->filter( function ($filter) {
            // 在这里添加字段过滤器
            $filter->like('name', '商品名称');
            $filter->like('name', '商品标题');
        });
        $grid->id('ID')->sortable();
        $grid->name('商品名称')->sortable();
        $grid->title('商品标题')->sortable();
        $grid->groupimg('商品组图')->display(function ($text) {
            $img = "";
            foreach ($text as $item) {
                $img .="<img style='width:100px;' src='".asset('/uploads').'/'.$item."'>";
            }
            return $img;
        });
        $grid->price('商品价格')->sortable();
        $grid->market_price('市场价格')->sortable();
        $grid->group_buy('团购卷')->sortable();
        $grid->start_at('开始时间')->sortable();
        $grid->end_at('结束时间')->sortable();
//        $grid->category_id('商品类型')->display(function ($category_id){
//
//        });
        $grid->created_at('创建时间')->sortable();
        $grid->updated_at('修改时间')->sortable();
        $grid->actions(function (Grid\Displayers\Actions $actions) {
            $actions->disableView();
        });
        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $product = Product::findOrFail($id);
        $img ="";
        foreach ($product->groupimg as $products) {
            $img .= "<img style='width:100px;' src='".asset('/uploads').'/'.$products."'>";
        }

        $content =
        "
        <p class='text-right'>Left aligned text.</p>
        <div>商品名称:".$product->name."</div>    
        <div>商品标题:".$product->title."</div>
        <div>商品图片:".$img."</div>
        <div>商品价格:".$product->price."</div>
        <div>商品类型:".$product->type."</div>
        <div>商品创建时间:".$product->created_at."</div>
        <div>商品修改时间:".$product->updated_at."</div>
        ";
        $box = new Box('商品详情', $content);

        $box->removable();

        $box->collapsable();

        $box->style('info');

        $box->solid();

        return $box;



//        $show = new Show(Product::findOrFail($id));
//        $show->id('商品ID');
//        $show->name('商品名称');
//        $show->title('商品标题');
////        $show->groupimg('商品组图')->display(function ($img){
////            return "s";
////        });
//        $show->price('商品价格');
//        $show->type('商品类型');
//        $show->created_at('商品创建时间');
//        $show->updated_at('商品修改时间');
//
//
//        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Product);
        $form->text('name', '商品名称');
        $form->text('title', '商品标题');
        $form->select('category_id', '商品分类')->options('/api/category/0');
        $form->multipleImage('groupimg', '商品组图')->removable();
        $form->currency('price', '商品价格')->symbol('￥');
        $form->currency('market_price', '市场价格')->symbol('￥');
        $form->currency('group_buy', '团购卷')->symbol('￥');
        $form->number('stock', '商品库存')->default(1);
        $form->datetimeRange('start_at', 'end_at', '开始结束时间');

        $form->editor('content', '商品详情') ;

        $form->tools(function (Form\Tools $tools) {

            // 去掉`列表`按钮
            $tools->disableList();

            // 去掉`删除`按钮
            $tools->disableDelete();

            // 去掉`查看`按钮
            $tools->disableView();
        });
        $form->footer(function ($footer) {
            // 去掉`查看`checkbox
            $footer->disableViewCheck();

            // 去掉`继续编辑`checkbox
            $footer->disableEditingCheck();

            // 去掉`继续创建`checkbox
            $footer->disableCreatingCheck();
        });
        return $form;
    }
}
