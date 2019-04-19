<?php

namespace App\Admin\Controllers;

use App\Models\Collision;
use \App\Models\User;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\MessageBag;

class UsersController extends Controller
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
            ->header('用户管理')
            ->description('用户列表')
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
            ->header('用户管理')
            ->description('用户修改')
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
        $grid = new Grid(new User);
        $grid->filter(function($filter){
            // 在这里添加字段过滤器
            $filter->like('name', '名称');
            $filter->like('molile', '手机号');
        });
        $grid->id('Id')->sortable();
        $grid->name('名称')->sortable();
        $grid->mobile('手机号')->sortable();
        $grid->money_integral('现金积分')->sortable();
        $grid->income_integral('收益积分')->sortable();
        $grid->group_buy('团购卷')->sortable();
        $grid->performance('业绩')->sortable();
        $grid->bankname('银行卡名称');
        $grid->bankaddress('银行卡地址');
        $grid->banknum('银行卡号');
        $grid->activity_integral('活动积分')->sortable();
        $grid->created_at('注册时间')->sortable();
//        $grid->disableCreateButton();
        $grid->disableRowSelector();

        $grid->actions(function (Grid\Displayers\Actions $actions) {
            $actions->disableView();
            $actions->disableDelete();
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
        $show = new Show(User::findOrFail($id));

        $show->id('Id');
        $show->name('用户名');
        $show->mobile('手机号');
        $show->created_at('注册时间');

        return $show;
    }
    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new User);

        $form->text('name', '用户名');
        $form->mobile('mobile', '手机号');
        $form->password('password', '密码')->placeholder('修改用户密码');
        $form->html('用户密码属于个人隐私，请尽量不要修改', $label = 'ps：');
        $form->text('affect.f_id', '推荐人ID')->default(0);
        $form->currency('money_integral', '现金积分')->symbol('￥');
        $form->currency('income_integral', '收益积分')->symbol('￥');
        $form->currency('group_buy', '团购卷')->symbol('￥');
        $form->currency('activity_integral', '活动积分')->symbol('￥');
        $form->text('bankname', '银行卡名');
        $form->text('bankaddress', '银行卡地址');
        $form->text('banknum', '银行卡号');
        $form->saving(function (Form $form) {
            //...
            if (!$form->model()->id) {
                if (User::where('mobile', $form->mobile)->first()) {
                    $error = new MessageBag([
                        'title'   => 'error',
                        'message' => '手机号已存在',
                    ]);
                    return back()->with(compact('error'));
                }
            } else {
                if ($form->model()->id!=1) {
                    if (!User::where('id', $form->affect['f_id'])->first()) {
                        $error = new MessageBag([
                            'title'   => 'error',
                            'message' => '找不到此会员',
                        ]);

                        return back()->with(compact('error'));
                    }
                }
            }
        });

        $form->saved(function (Form $form) {
            //...
            $fid = $form->affect['f_id'];
            $id =  $form->model()->id;
            if ($fid!=$id) {
                $collision = Collision::where('first_level', 'like', '%,'.$id.',%')
                    ->orWhere('first_level', 'like', '%,'.$id.'%')
                    ->orWhere('first_level', 'like', '%'.$id.'%')
                    ->first();
                if ($collision) {
                    foreach (explode(',', $collision->first_level) as $item) {
                        if ($item != $id) {
                            $first_level[] = $item;
                        }
                    }
                    if (isset($first_level)) {
                        $first_level = implode(',', $first_level);
                    } else {
                        $first_level = "";
                    }
                    $collision->first_level = $first_level;
                    $collision->save();
                    if ($collision_update = Collision::where('user_id', $fid)->first()) {
                        if (empty($collision_update->first_level)) {
                            $collision_update->first_level = $id;
                        } else {
                            $collision_update->first_level = $collision_update->first_level . ',' . $id;
                        }
                        $collision_update->save();
                    }
                }
            }
            $collision = Collision::where('first_level', 'like', '%,'.$id.',%')
                ->orWhere('first_level', 'like', '%,'.$id.'%')
                ->orWhere('first_level', 'like', '%'.$id.'%')
                ->first();
            if (!$collision) {
                $father = Collision::where('user_id', $fid)->first();
                if ($father) {
                    if (empty($father->first_level)) {
                        $father->first_level  =$id;
                    } else {
                        $father->first_level = $father->first_level.','.$id;
                    }
                    $father->save();
                }
            }
            if (!Collision::where('user_id', $id)->first()) {
                $collision_update = new Collision();
                $collision_update->user_id = $id;
                $collision_update->save();
            }
        });
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
        $form->saving(function (Form $form) {
            if ($form->password && $form->model()->password != $form->password) {
                $form->password = Hash::make($form->password);
            }
        });
        return $form;
    }
}
