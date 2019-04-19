<?php

namespace App\Admin\Controllers;

use \App\Models\IncomeLog;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class IncomeLogsController extends Controller
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
            ->header('收益转积分列表')
            ->body($this->grid());
    }

//    /**
//     * Show interface.
//     *
//     * @param mixed $id
//     * @param Content $content
//     * @return Content
//     */
//    public function show($id, Content $content)
//    {
//        return $content
//            ->header('Detail')
//            ->description('description')
//            ->body($this->detail($id));
//    }

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
        $grid = new Grid(new IncomeLog);

        $grid->id('Id');
        $grid->user_id('用户id');
//        $grid->type('类型')->dispaly(function ($value) {
//            return IncomeLog::$typeMap[$value];
//        });
        $grid->column('user.name', '用户姓名');
        $grid->price('积分数量');
//        $grid->balances('Balances');
        $grid->created_at('转换时间');
        $grid->filter( function($filter) {
            // 去掉默认的id过滤器
            $filter->disableIdFilter();
            // 在这里添加字段过滤器
            $filter->equal('user_id', '用户id');
        });
        $grid->actions(function (Grid\Displayers\Actions $actions) {
            $actions->disableView();
            $actions->disableEdit();
            $actions->disableDelete();
        });
//        $grid->updated_at('修改时间');
        $grid->disableCreateButton();
        $grid->disableRowSelector();
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
        $show = new Show(IncomeLog::findOrFail($id));

        $show->id('Id');
        $show->user_id('User id');
        $show->type('Type');
        $show->price('Price');
        $show->balances('Balances');
        $show->created_at('Created at');
        $show->updated_at('Updated at');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new IncomeLog);

        $form->number('user_id', 'User id');
        $form->text('type', 'Type')->default('conversion');
        $form->decimal('price', 'Price');
        $form->decimal('balances', 'Balances');

        return $form;
    }
}
