<?php

namespace App\Admin\Controllers;

use App\Models\Custom;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class CustomController extends Controller
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

        $key = 'bgcustom:';
        $resr = Redis::del($key);
        $res = Custom::where('id', 2)->first();
        $arr['imgurl'] = $res->imgurl;
        $arr['title'] = $res['title'];
        $arr['logo'] = $res['logo'];
        $resr = Redis::hmset($key, $arr);

        return $content
            ->header('自定义菜单')
            ->description('自定义菜单')
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
            ->header('自定义')
            ->description('自定义')
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
        $content
            ->header('Edit')
            ->description('description')
            ->body($this->form()->edit($id));

        return $content;
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
        $grid = new Grid(new Custom);
        $grid->id('ID')->sortable();
        $grid->title('自定义标题')->sortable();
        $grid->imgurl('背景路径')->display(function ($text) {
            $img = "";
            $img .="<img style='width:50px;height:40px;' src='".'/uploads'.'/'.$text."'>";
            return $img;
        })->sortable();
        $grid->logo('公司logo')->display(function ($text) {
            $img = "";
            $img .="<img style='width:50px;height:40px;' src='".'/uploads'.'/'.$text."'>";
            return $img;
        })->sortable();
        $grid->type('类型')->display(function ($val){
            if($val==0){
                return "<span class='label label-success'>后台登入背景</span>";
            }else if($val==1){
                return "<span class='label label-success'>分享背景</span>";
            }
        })->sortable();
        $grid->created_at('创建时间')->sortable();

        $grid->disableExport();
        $grid->disableFilter();
        $grid->disableRowSelector();
        $grid->disablePagination();
        $grid->actions(function (Grid\Displayers\Actions $actions) {
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
        $show = new Show(Custom::findOrFail($id));
        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {

        $form = new Form(new Custom);
        $form->text('title', '公司标题')->default('薪樾网络');
        $form->image('imgurl', '自定义背景(此处只能上传png)')->uniqueName();
        $form->image('logo', '自定义logo(此处只能上传png)')->uniqueName();
        $directors = [
            0  => '后台登入背景',
            1 => '分享背景',
        ];
        $form->select('type','类型')->options($directors);

        return $form;
    }
   

}
