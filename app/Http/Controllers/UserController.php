<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegister;
use App\Models\Collection;
use App\Models\Collision;
use App\Models\DistributionSetting;
use App\Models\IncomeLog;
use App\Models\Order;
use App\Models\OrderAssistants;
use App\Models\User;
use App\Models\Moneylog;
use App\Models\Extract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use SmsManager;
use Captcha;
use App\Models\Product;
use Gregwar\Captcha\CaptchaBuilder;
class UserController extends Controller
{
    //
    private $user;
    private $collection;
    private $moneylog;
    private $extract;
    private $order;
    public function __construct(User $user, Collection $collection, Moneylog $moneylog, Extract $extract, Order $order)
    {
        $this->user = $user;
        $this->collection = $collection;
        $this->moneylog = $moneylog;
        $this->extract = $extract;
        $this->order   = $order;
    }
    public function index(Product $product)
    {
        $datap = $product->select('market_price', 'id', 'groupimg as thumbnail', 'title', 'price')
            ->where([['category_id', '!=', 1], ['category_id', '!=', 3], ['category_id', '!=', 4]])
            ->paginate(10);
        $pagenum = ceil(($datap->total())/10);

        return view('user.index', [
            'user'=>Auth::user(),
            'product'=>$datap,
            'page'=>$pagenum
            ]);
    }
    // public function collection(){
    //     return view('user.collection');
    // }
    public function register(Request $request, $id = '')
    {
        if ($input = $request->all()) {
            if (isset($input['from'])) {

                unset($input['from']);
		unset($input['isappinstalled']);
            }

            if ($input) {
                $validator = Validator::make($request->all(), [
                    'mobile' => 'required|confirm_mobile_not_change|confirm_rule:mobile_required',
                    'code' => 'required|verify_code',
                    //more...
                ]);

                if ($validator->fails()) {
                    SmsManager::forgetState();

                    return ['code'=>1,'message'=>'验证码错误!'];
                    //验证失败后建议清空存储的发送状态，防止用户重复试错

                }
                if (User::where('mobile', $request->all()['mobile'])->first()) {
                    return ['code'=>1,'message'=>'该手机号已被注册'];
                }
                DB::beginTransaction();
                try {
                    $this->user->name = $request->all()['name'];
                    $this->user->mobile = $request->all()['mobile'];
                    $this->user->card = $request->all()['card'];
                    $this->user->money_integral ='-100';
                    $this->user->password = Hash::make($request->all()['password']);
                    if (!$father_user = $this->user->where('id', $request->all()['fid'])->first()) {
                        return ['code'=>1,'message'=>'上级ID错误'];
                    }

                    if ($this->user->save()) {
                        $user = $this->user->find($this->user->id);
                        if ($user->affect()->create(['f_id'=>$father_user->id])) {
//                        $distributionetting = new DistributionSetting();
//                        $distributionetting->givemoney($father_user->id);
                            $collision = Collision::where('user_id', $father_user->id)->first();
                            if ($collision) {
                                if (empty($collision->first_level)) {
                                    $collision->first_level  = $this->user->id;
                                } else {
                                    $collision->first_level = $collision->first_level.','.$this->user->id;
                                }
                                $collision->save();
                            }
                            $this->user->collision()->create(['user_id'=>$this->user->id]);
                            DB::commit();
                            return ['code'=>0,'message'=>'添加成功'];
                        }
                    }
                } catch (\Exception $e) {
                    Log::error($e);
                    DB::rollBack();
                    return ['code'=>1,'message'=>'注册失败'];
                }
            }
        }

        return view('user.register', ['id'=>$id]);
    }
    public function login(Request $request)
    {
         $input = $request->post();
        if ($input) {
            $validator = Validator::make($request->all(), [
                'mobile' => 'required',
                'password' => 'required',
            ], [
                'mobile.required' => '请填写手机号码',
                'password.required' => '请填写密码',
            ]);

            if ($validator->fails()) {
                return redirect('/user/login')->withErrors($validator)->withInput();
            }
             $user = User::where(['mobile'=>$input['mobile']])->first();
            if ($user) {
                if (Hash::check($input['password'], $user->password)) {
                    Auth::loginUsingId($user->id);
                    return redirect('/user');
                }
                // else {
                //     return "<script>alert('密码不正确');window.history.go(-1)</script>";
                // }
            }
            // else {
            //     return "<script>alert('账号不正确');window.history.go(-1)</script>";
            // }
        }
        return view('user.login');
    }
    public function comment()
    {
        $comment = [
          ['title'=>'这个很好吃真的完美','data'=>'2017-03-02'],
          ['title'=>'这个不好吃','data'=>'2017-01-02'],
          ['title'=>'这个不好吃','data'=>'2017-01-02'],
          ['title'=>'这个不好吃','data'=>'2017-01-02']
        ];
        return view('user.comment', compact('comment'));
    }
    public function loginout()
    {
        Auth::logout();
        return redirect('/');
    }
    public function action()
    {

        return view('user.action');
    }
    public function shoporder($type)
    {

        return view('user.shoporder', ['order'=>$this->order->myOrder($type), 'user'=>Auth::user(),
            'type'=>$type, 'type_name'=>$this->order->type_name]);
    }
    public function ajaxorder(Request $request)
    {
        $input = $request->all();
        $orders = $this->order->where('id', $input['id'])->first();
        DB::beginTransaction();
        try {
            if($orders->type == 1){
                $orders->status = 4;
                if ($orders->save()) {
                    $orders->orderassistants->product->stock += 1;
                        if ($orders->orderassistants->product->save()) {
                        DB::commit();
                        return ['code'=>1,'msg'=>'取消订单成功'];
                    }
                }
            }
        } catch (\Exception $e) {
            Log::error($e);
            DB::rollBack();
            return ['code'=>0,'msg'=>'取消订单失败'];
        }
    }
    public function isUser(Request $request)
    {
        $input = $request->all();
        $user = $this->user->where('mobile', $input['mobile'])->first();
        if (!$user) {
            return ['code'=>0,'msg'=>'此用户不存在!'];
        } else {
            return ['code'=>1,'msg'=>'此用户存在!'];

        }
    }
    public function findpassword(Request $request)
    {

        if ($request->all()) {
            $validator = Validator::make($request->all(), [
                'mobile' => 'required|confirm_mobile_not_change|confirm_rule:mobile_required',
                'code' => 'required|verify_code',
                'captcha' => 'required|captcha',

                //more...
            ], [
                'captcha.required' => '请填写验证码',
                'captcha.captcha' => '验证码错误',
                'code.verify_code' => '短信验证码错误',
            ]);

            if ($validator->fails()) {
                SmsManager::forgetState();
                return redirect('/findpassword')->withErrors($validator)->withInput();
            }
            $this->user = $this->user->where('mobile', $request->all()['mobile'])->first();
            $this->user->password = Hash::make($request->all()['password']);
            if ($this->user->save()) {
                return redirect('/user/login');
            }

        }
        return view('user.findpassword');
    }
    public function share()
    {
        return view('user.share');
    }
    public function message()
    {
        return view('user.message');
    }
    //积分转换
    public function transformrecive(Request $request)
    {
	
      // print_r($request);exit;
	 //var_dump($request->all()['id']);die;
        if ($request->all()) {
            $user = $this->user->where('id', $request->all()['id'])->first();
	
            if ($user->income_integral <= 0) {
		
                    return ['code'=>0,'msg'=>'收益积分需要大于0!'];
                    return false;
            }
	
            if ($user) {
		
                $income_integral = $user->income_integral;
                $money_integral  = $user->money_integral;
                $group_buy       = $user->group_buy;
                $user->money_integral +=$user->income_integral;

                $user->income_integral = 0;

                $sum =  $income_integral;
             
		  $incomelog =
                    [
                        'price'=>$income_integral,
                        'user_id'=>$user->id,
                        'type'=>IncomeLog::TYPE_CONVERSION,
                        'money_integral'=>$money_integral,
                        'income_integral'=>$income_integral,
                        'group_buy'=>$group_buy,
                        'sum'=>$sum,
                        'user_money_integral' =>$user->money_integral,
                        'user_income_integral'=>$user->income_integral,
                        'user_group_buy'=>$user->group_buy,
                        'calculation'=>IncomeLog::CALCULATION_REDUCE,
                        'order_id'=>0
                    ];
		//print_r($incomelog);die;
               // Log::channel('integralLog')->info('寄售'.json_encode($incomelog));




//                $data['income_integral'] = 0;
//                $data['money_integral'] = $user->money_integral + $user->income_integral;
//                $update = $this->user->where('id', $request->all()['id'])->update($data);
              
		 if ($user->save()) {
		   
                    $user->incomelog()->create(IncomeLog::createLog($incomelog));
                    return ['code'=>1,'msg'=>'收益积分转换成功'];
                } else {
                    return ['code'=>0,'msg'=>'收益积分转换失败!'];
                }
            } else {
                return ['code'=>0,'msg'=>'此用户不存在!'];
            }
            // print_r($user);exit;
        }
            $user = $this->user->find(Auth::id());
        return view('user.transformrecive', ['user'=>$user]);
    }
    //积分提现
    public function jifentomoney(Request $request)
    {
        $id = Auth::id();
        $user = $this->user->where('id',$id)->first();
        if($user->money_integral < 100){
            $actual_money = '0';
        }else{
            $extract = $this->extract->first()->toarray();
            // $actual_money = $user->money_integral-(($extract['poundage']/100)*$user->money_integral);
            $intval = intval($user->money_integral);
            $substr = substr($intval,-2);
            $actual_money = $intval-$substr;
        }
        $moneylog = $this->moneylog->where('user_id',$id)->orderby('id','desc')->get();
        if ($request->all()) {
            $user = $this->user->where('id', $request->all()['id'])->first();
            if(empty($request->all()['money'])){
                return ['code'=>0,'msg'=>'请输入要提现的佣金！'];
                return false;
            }
            if ($user->money_integral < 100) {
                return ['code'=>0,'msg'=>'现金积分需要大于100!'];
                return false;
            }
            if ($request->all()['money'] > $user->money_integral) {
                return ['code'=>0,'msg'=>'您的现金积分不足'];
                return false;
            }
            $substr = substr($request->all()['money'],-2);
            if ($substr != 00) {
                return ['code'=>0,'msg'=>'请输入整百!'];
                return false;
            }
            if ($user->bankname == '' || $user->bankaddress == '' || $user->banknum == '') {
                return ['code'=>0,'msg'=>'请去个人资料填写卡号等信息!'];
                return false;
            }
            if (!in_array(date("w"), $extract['weeks'])) {
                return ['code'=>0,'msg'=>'今天不能提现!'];
                return false;
            }
            $actual_money = $request->all()['money']-(($extract['poundage']/100)*$request->all()['money']);
            DB::beginTransaction();
            try {
                if ($user) {
                    $this->moneylog->money_integral = $request->all()['money'];
                    $this->moneylog->status = '0';
                    $this->moneylog->poundage = $extract['poundage'];
                    $this->moneylog->actual_money = $actual_money;
                    $this->moneylog->user_id = Auth::id();
                    $this->moneylog->bankname = $user->bankname;
                    $this->moneylog->bankadress = $user->bankaddress;
                    $this->moneylog->banknum = $user->banknum;
                    if ($this->moneylog->save()) {
                        $data['money_integral'] = $user->money_integral - $request->all()['money'];
                        $update = $this->user->where('id', $request->all()['id'])->update($data);
                        if ($update) {
                            DB::commit();
                            return ['code'=>1,'msg'=>'申请提现成功'];
                        }
                    }

                }
            } catch (\Exception $e) {
                Log::error($e);
                DB::rollBack();
                return ['code'=>0,'msg'=>'申请提现失败'];
            }
            // print_r($user);exit;
        }
        return view('user.jifentomoney', ['user'=>$user,'actual_money'=>$actual_money,'moneylog'=>$moneylog]);
    }
    public function exit()
    {
        return view('user.exit');
    }

    /**
     *个人信息显示
     */
    public function personinfo()
    {
        $uid = Auth::id();
        $person = User::where('id', $uid)->first();
//            dd($person);
        return view('user.person', ['person'=>$person]);
    }

    /**
     *数据更改
     */
    public function uploadimg(Request $request)
    {
        $uid = Auth::id();
        $input = $request->all();
        $update['sex'] = $input['gender'];
        $update['name'] = $input['realName'];
        $update['avatr_img'] = $input['headImg'];
        $update['mobile'] = $input['nickName'];
        $update['bankname'] = $input['bankName'];
        $update['bankaddress'] = $input['openAddr'];
        $update['banknum'] = $input['bankCard'];
        $update['updated_at'] = date('Y-m-d H:i:s');
        $res = User::where('id', $uid)->update($update);

        if (!empty($res)) {
            return ['code'=>1,'msg'=>'修改成功'];
        } else {
            return ['code'=>0,'msg'=>'修改失败'];
        }
    }

    public function shopmessage($id)
    {
        $orderassistants = OrderAssistants::where(['order_id'=>$id])->select('pid', 'num')->get();
        if ($orderassistants) {
            foreach ($orderassistants as $item) {
                $num[$item->pid] = $item->num;
            }
        }

        return view('user.shopmessage', ['order'=>$this->order->find($id), 'num'=>$num]);
    }
    public function myteam()
    {
        $user = $this->user->find(Auth::id());
        return view('user.myteam', ['user'=>$user]);
    }
    public function jifenzhuanhuan(Request $request)
    {
        if ($input = $request->all()) {
            $id = $input['id'];
            $order = $this->order->where('id', $id)->with('user')->first();
            if ($order->type==1&&$order->status=='待发货') {
                DB::beginTransaction();
                try {
                    $order->status = 3;
                    $order->user->activity_integral += $order->huodong_price;
                    $order->save();
                    $order->user->save();
                    DB::commit();
                    return ['code'=>1, 'message'=>'转换成功'];
                } catch (\Exception $e) {
                    DB::rollBack();
                    Log::error($e);
                    return ['code'=>0, 'message'=>'转换失败'];
                }
            }
        }
    }
}
