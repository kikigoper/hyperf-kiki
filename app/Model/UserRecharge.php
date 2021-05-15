<?php

declare (strict_types=1);

namespace App\Model;

use Hyperf\DbConnection\Model\Model;

/**
 * @property int $id
 * @property int $uid 充值用户UID
 * @property string $order_id 订单号
 * @property string $price 充值金额
 * @property string $recharge_type 充值类型
 * @property int $paid 是否充值
 * @property int $pay_time 充值支付时间
 * @property int $add_time 充值时间
 * @property string $refund_price 退款金额
 */
class UserRecharge extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_recharge';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'uid', 'order_id', 'price', 'recharge_type', 'paid', 'pay_time', 'add_time', 'refund_price'];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'uid' => 'integer', 'paid' => 'integer', 'pay_time' => 'integer', 'add_time' => 'integer'];

    public static function labels()
    {
        return [
            'id' => '',
            'uid' => '充值用户UID',
            'order_id' => '订单号',
            'price' => '充值金额',
            'recharge_type' => '充值类型',
            'paid' => '是否充值',
            'pay_time' => '充值支付时间',
            'add_time' => '充值时间',
            'refund_price' => '退款金额',
        ];
    }
}