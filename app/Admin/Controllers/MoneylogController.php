<?php

namespace App\Admin\Controllers;

use App\Models\Moneylog;
use App\Models\User;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class MoneylogController extends Controller
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
            ->header('现金提现列表')
            ->description('现金提现日志')
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
            ->header('审核')
            ->description('审核')
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
            ->header('审核')
            ->description('审核')
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
        $grid = new Grid(new Moneylog);

        $grid->id('ID')->sortable();
        $grid->user_id('用户id')->sortable();
        $grid->column( 'user.name', '用户姓名');
        $grid->bankname('银行名称')->sortable();
        $grid->bankadress('银行地址')->sortable();
        $grid->banknum('银行卡号')->sortable();
        $grid->money_integral('提现积分')->sortable();
        $grid->poundage('利率')->sortable();
        $grid->actual_money('实际到账')->sortable();
        $grid->status('状态')->display(function ($status) {
            switch ($status){
                case 0: $status ='<span class="label label-primary">审核中</span>';
                    break;
                case 1: $status ='<span class="label label-success">审核通过</span>';
                    break;
                case 2: $status ='<span class="label label-primary1"style="background-color: red;">审核不通过</span>';
                break;
            }
            return $status;
        })->sortable();
        $grid->created_at('提现时间')->sortable();
        $grid->updated_at('审核时间')->sortable();
        $grid->disableCreateButton();
        $grid->disableRowSelector();
        $grid->actions(function (Grid\Displayers\Actions $actions) {
            $actions->disableView();
            $actions->disableDelete();
        });
        $grid->filter( function($filter) {
            // 去掉默认的id过滤器
            $filter->disableIdFilter();
            // 在这里添加字段过滤器
            $filter->equal('user_id', '用户id');
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
        $show = new Show(Moneylog::findOrFail($id));

        $show->id('Id');
        $show->money_integral('提现积分');
        $show->poundage('利率');
        $show->actual_money('实际到账');
        $show->created_at('申请时间');
        $show->updated_at('审核时间');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Moneylog);

        $form->select('status','审核')->options([0 => '审核中', 1 => '审核通过', 2 => '审核不通过']);
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
