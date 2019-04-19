<?php

namespace App\Models;

use Encore\Admin\Form\Field\Select;
use Illuminate\Database\Eloquent\Model;

class IncomeLog extends Model
{
    //
    protected $fillable      = [
        'type', 'calculation', 'price',
        'money_integral', 'group_buy', 'income_integral',
        'original_money_integral', 'original_income_integral', 'original_group_buy',
        'description'

    ];
    const TYPE_CONVERSION    = 'conversion';
    const TYPE_FIRST         = 'first';
    const TYPE_SECONDARY     = 'secondary';
    const TYPE_THIRD         = 'third';
    const TYPE_JISHOU        = 'jishou';




    const CALCULATION_ADD    = 'add';
    const CALCULATION_REDUCE = 'reduce';

    public static $calculationMap = [
      self::CALCULATION_ADD    => '+',
      self::CALCULATION_REDUCE => '-'
    ];
    public static $typeMap = [
        self::TYPE_CONVERSION =>'会员积分转现金',
        self::TYPE_FIRST =>'一级分销会员',
        self::TYPE_SECONDARY =>'二级分销会员',
        self::TYPE_THIRD=>'三级分销会员',
        self::TYPE_JISHOU =>'寄售收益'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public static function createLog($data)
    {
        return [
                 'price'=>$data['sum'],
                 'money_integral'=>$data['money_integral'],
                 'type'=>$data['type'],
                 'income_integral'=>$data['income_integral'],
                 'group_buy'=>$data['group_buy'],
                 'original_money_integral' =>$data['user_money_integral'],
                 'original_income_integral'=>$data['user_income_integral'],
                 'original_group_buy'=>$data['user_group_buy'],
                 'calculation'=>$data['calculation'],
                 'description'=>self::logMessage($data['type'], $data)
            ];
    }
    public static function logMessage($types, $data)
    {
        switch ($types) {
            case self::TYPE_JISHOU:
                return '用户：'.$data['user_id'].'根据寄售订单'.$data['order_id'].'播送收益商品原价'.$data['price'].'的0.2为'.$data['sum'];
            break;
            case self::TYPE_CONVERSION:
                return '用户：'.$data['user_id'].'收益积分转现金积分'.$data['price'];
            break;
            case self::TYPE_FIRST:
                return '用户:'.$data['user_id'].
                    '的'.self::$typeMap[self::TYPE_FIRST].$data['subordinate'].
                    '购买活动订单'.$data['order_id'].'获得'.$data['sum'];
            break;
            case self::TYPE_SECONDARY:
                return '用户:'.$data['user_id'].
                    '的'.self::$typeMap[self::TYPE_SECONDARY].$data['subordinate'].
                    '购买活动订单'.$data['order_id'].'获得'.$data['sum'];
                break;
            case self::TYPE_THIRD:
                return '用户:'.$data['user_id'].
                    '的'.self::$typeMap[self::TYPE_THIRD].$data['subordinate'].
                    '购买活动订单'.$data['order_id'].'获得'.$data['sum'];
                break;
        }
    }
}
