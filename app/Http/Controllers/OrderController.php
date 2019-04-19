<?php

namespace App\Admin\Controllers;

use App\Models\China;
use App\Models\Order;
use App\Http\Controllers\Controller;
use App\Models\OrderAssistants;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\New_;

class OrderController extends Controller
{
    use HasResourceActions;

    private $order;
    public function __construct(Order $order)
    {
        $this->order  = $order;
    }
    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('订单')
            ->description('订单列表')
            ->body($this->grid());
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
            ->body($this->form($id)->edit($id));
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
        $grid = new Grid(new Order);

        $grid->id('订单ID');
        $grid->user_id('用户Id');
        $grid->real_name('真实姓名');
        $grid->mobile('手机号');
        $grid->price('价格');
        $grid->column('chinap.Name', '省');
        $grid->column('chinac.Name', '市');
        $grid->column('chinaa.Name', '县');
        $grid->address('地址');
        $grid->express('快递');
        $grid->express_code('运单号');
        $grid->pay_status('付款状态')->display(function ($val) {
            $order = new Order();
            if (!empty($val)) {
                return $order->pay_statuss[$val];

            }
//            echo $val;
        });
        $grid->order_sn('订单号');
        $grid->status('订单状态');
        $grid->created_at('下单时间');
//        $grid->actions(function (Grid\Displayers\Actions $actions) {
//            $actions->disableDelete();
//        });
        $grid->filter( function($filter) {
            // 去掉默认的id过滤器
            $filter->disableIdFilter();
            // 在这里添加字段过滤器
            $filter->equal('user_id', '用户id');
            $order = new Order();
            $filter->equal('status', '订单状态')->select($order->statuss);
            $filter->equal('type', '订单类型')->select($order->typess);
        });
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

        $res = DB::table('product')
            ->join('ordersauxiliarys', 'product.id', 'ordersauxiliarys.pid')
            ->where('ordersauxiliarys.order_id', $id)->get();

        return $res;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form($id = 0)
    {

        $form = new Form(new Order);
        $order = Order::find($id);

        $form->select('province', '省')->options('/getProvince/1/'.$order['province'])
            ->load('city', '/getChild/'.$order['city']);
//        $form->html($order['provincename'], 'ps:省');
        $form->select('city', '市')->load('area', '/getChild/'.$order['area']);
//        $form->html($order['cityname'], 'ps:市');
        $form->select('area', '县');
//        $form->html($order['areaname'], 'ps:县');

        $form->text('address', '详细地址')->rules('required');
        $form->text('express', '快递')->rules('required');
        $form->text('express_code', '运单号')->rules('required');
        $form->text('real_name', '收货人姓名')->rules('required');
        $form->mobile('mobile', '手机号')->rules('required');
        $form->decimal('price', '价格')->rules('required');
        $order = new Order();
        $form->select('pay_status', '支付状态')->options($order->pay_statuss)->rules('required');
        $form->select('status', '订单状态')->options($order->statuss)->rules('required');

        //保存后回调
        $form->saved(function (Form $form) {
            //...
            if ($form->province && $form->model()->province != $form->province) {
                $form->province = $form->province;
            }
            if ($form->city && $form->model()->city != $form->city) {
                $form->city = $form->city;
            }
            if ($form->area && $form->model()->area != $form->area) {
                $form->area = 0;
            } else {
                $form->area = 0;
            }
        });

        return $form;
    }
    public function getchina($type, $id)
    {
        if ($type=='father') {
             $province = collect(DB::table('china')
                 ->where('pid', 0)
                 ->select('Id as id', 'Name as text')->get())->toArray();
             return $province;
        } else {
            $city = collect(DB::table('china')
                ->where('pid', $id)
                ->select('Id as id', 'Name as text')->get())->toArray();
            $city[0] = DB::table('china')->where('Id', $id)->value('Name');
            return $city;
        }
    }

}
