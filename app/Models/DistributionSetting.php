<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class DistributionSetting extends Model
{
    //
    protected $table = 'distribution_setting';
    public function givemoney($user_id, $price, $oder_id)
    {
//        Log::info('三级分销'.$user_id);

        $distribution_setting = $this->first();
        $firsts = (($distribution_setting->firsts/100) * $price);
        $secondary = (($distribution_setting->secondary/100) * $price);
        $third = (($distribution_setting->third/100) * $price);
        if ($distribution_setting->firsts!=0) {
            $chind = UserAffect::where('user_id', $user_id)->value('f_id');
            if ($chind) {
                $user = User::find($chind);
                $income_integral = $user->income_integral;
                $money_integral  = $user->money_integral;
                $group_buy       = $user->group_buy;

                $user->income_integral += $firsts;
                $user->save();



                $sum = $firsts;
                $incomelogfirst =
                    [
                        'price'=>$firsts,
                        'user_id'=>$user->id,
                        'type'=>IncomeLog::TYPE_FIRST,
                        'money_integral'=>$money_integral,
                        'income_integral'=>$income_integral,
                        'group_buy'=>$group_buy,
                        'sum'=>$sum,
                        'user_money_integral' =>$user->money_integral,
                        'user_income_integral'=>$user->income_integral,
                        'user_group_buy'=>$user->group_buy,
                        'calculation'=>IncomeLog::CALCULATION_ADD,
                        'order_id'=>$oder_id,
                        'subordinate'=>$user_id
                    ];
                Log::channel('integralLog')->info('一级分销'.json_encode($incomelogfirst));
                $user->incomelog()->create(IncomeLog::createLog($incomelogfirst));



                $affect_secondary = UserAffect::query()
                    ->where('user_id', $user->id)
                    ->with('user')->first();
                if ($affect_secondary) {
                    if ($distribution_setting->secondary!=0) {
                        $income_integral = $affect_secondary->user->income_integral;
                        $money_integral  = $affect_secondary->user->money_integral;
                        $group_buy       = $affect_secondary->user->group_buy;


                        $affect_secondary->user->income_integral += $secondary;
                        $affect_secondary->user->save();


                        $sum = $secondary;
                        $incomelogsecond =
                            [
                                'price'=>$secondary,
                                'user_id'=>$affect_secondary->user->id,
                                'type'=>IncomeLog::TYPE_SECONDARY,
                                'money_integral'=>$money_integral,
                                'income_integral'=>$income_integral,
                                'group_buy'=>$group_buy,
                                'sum'=>$sum,
                                'user_money_integral' =>$affect_secondary->user->money_integral,
                                'user_income_integral'=>$affect_secondary->user->income_integral,
                                'user_group_buy'=>$affect_secondary->user->group_buy,
                                'calculation'=>IncomeLog::CALCULATION_ADD,
                                'order_id'=>$oder_id,
                                'subordinate'=>$user_id
                            ];

                        Log::channel('integralLog')->info('二级分销'.json_encode($incomelogsecond));

                        $affect_secondary->user->incomelog()->create(IncomeLog::createLog($incomelogsecond));


                        $affect_third = UserAffect::query()
                            ->where('user_id', $affect_secondary->user->id)
                            ->with('user')->first();
                        if ($affect_third) {
                            if ($distribution_setting->third!=0) {
                                $income_integral = $affect_third->user->income_integral;
                                $money_integral  = $affect_third->user->money_integral;
                                $group_buy       = $affect_third->user->group_buy;

                                $affect_third->user->income_integral += $third;
                                $affect_third->user->save();

                                $sum = $third;
                                $incomelogthird =
                                    [
                                        'price'=>$secondary,
                                        'user_id'=>$affect_third->user->id,
                                        'type'=>IncomeLog::TYPE_THIRD,
                                        'money_integral'=>$money_integral,
                                        'income_integral'=>$income_integral,
                                        'group_buy'=>$group_buy,
                                        'sum'=>$sum,
                                        'user_money_integral' =>$affect_third->user->money_integral,
                                        'user_income_integral'=>$affect_third->user->income_integral,
                                        'user_group_buy'=>$affect_third->user->group_buy,
                                        'calculation'=>IncomeLog::CALCULATION_ADD,
                                        'order_id'=>$oder_id,
                                        'subordinate'=>$user_id
                                    ];
                                Log::channel('integralLog')->info('三级分销'.json_encode($incomelogthird));

                                $affect_third->user->incomelog()->create(IncomeLog::createLog($incomelogthird));

                            }

                        }
                    }
                }
            }
        }
    }
}
