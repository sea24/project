<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class AddressController extends Controller
{
    //
    public $address;
    public function __construct(Address $address)
    {
        $this->address = $address;
    }
    public function index(Request $request)
    {
        return view('user.address.index', ['gets'=>$request->all(),
            'user_address'=>$this->address->where('user_id', Auth::id())->get()]);
    }
    public function create(Request $request)
    {
        $input ="";

        if ($request->post()) {
            if (isset($request->post()['status'])) {
                $validator = Validator::make($request->all(), [
                    'real_name' => 'required',
                    'mobile' => 'required',
                    'province' => 'required',
                    'city' => 'required',
                    'address' => 'required',
                    //more...
                ], [
                    'real_name.required' => '请填写收货人姓名',
                    'mobile.required' => '请填写手机号',
                    'province.required' => '请选择省',
                    'city.required' => '请选择市',
                    'address.required' => '请填写详细地址',
                ]);

                if ($validator->fails()) {
                    return redirect('/user/address/create')->withErrors($validator)->withInput();
                }
            }
            $input = $request->post();
            if (isset($request->post()['status'])) {
                foreach ($request->post() as $key => $item) {
                    if ($key!='num'&&$key!='id'&&$key!='type'&&$key!='oid') {
                        $this->address->$key = $item;
                    }
                }
                if ($request->post()['status']) {
                    $this->address->update(['status'=>0]);
                }
                if (!isset($input['oid'])) {
                    $input['oid'] = 0;
                }
                $this->address->user_id = Auth::id();
                if ($this->address->save()) {
                    if (isset($request->post()['id'])) {
                        return redirect('/user/address?nums='.
                            $input['num'].'&id='.$input['id'].'&type='.$input['type'].'&oid='.$input['oid']);
                    } else {
                        return redirect('/user/address');
                    }
                }
            }
        }
            return view('user.address.create', ['address'=>$this->address,'gets'=>$input]);
    }
    public function edit($id, Request $request)
    {
        if ($request->post()) {
            $address = $this->address->find($id);
            foreach ($request->post() as $key => $item) {
                $address->$key = $item;
            }
            if ($address->save()) {
                return redirect('/user/address');
            }
        }
        return view('user.address.create', ['address'=>$this->address->find($id)]);
    }
    public function update($id)
    {
        $address = $this->address->find($id);
        if ($address) {
            $address->status = 1;
            if ($address->save()) {
                $update =$this->address->where(['user_id'=>Auth::id()])
                    ->where('id', '!=', $address->id)->update(['status'=>0]);
                if ($update) {
                    return ['code'=>0,'message'=>'成功'];
                }
            }
        }
    }
    public function destroy($id)
    {
        if ($this->address->destroy($id)) {
            return ['code'=>1,'message'=>'删除成功'];
        } else {
            return ['code'=>0,'message'=>'删除失败'];
        }
    }

    /**
     *默认地址
     */
    public function defaultmoren(Request $request){

       $input = $request->all();

       $aid = $input['aid'];
       $statusadd = $input['status'];

       if ($statusadd == 1){
           $status['status'] = 0;
           $status['updated_at'] = date('Y-m-d H:i:s',time());
       }else{
           $numst['status'] = 0;
           $numst['updated_at'] = date('Y-m-d H:i:s',time());
           $user = Auth::id();
           $resid = Address::where('user_id',$user)->update($numst);

           $status['status'] = 1;
           $status['updated_at'] = date('Y-m-d H:i:s',time());
       }
       $res = Address::where('id',$aid)->update($status);
       if ($res){

           return ['code'=>1,'message'=>'修改成功'];

       }else{
           return ['code'=>0,'message'=>'修改失败'];
       }
    }
}
