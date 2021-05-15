<?php

declare (strict_types=1);

namespace App\Model;

use Hyperf\DbConnection\Model\Model;

/**
 * @property int $id 订单ID
 * @property string $order_id 订单号
 * @property int $uid 用户id
 * @property string $real_name 用户姓名
 * @property string $user_phone 用户电话
 * @property string $user_address 详细地址
 * @property string $cart_id 购物车id
 * @property string $freight_price 运费金额
 * @property int $total_num 订单商品总数
 * @property string $total_price 订单总价
 * @property string $total_postage 邮费
 * @property string $pay_price 实际支付金额
 * @property string $pay_postage 支付邮费
 * @property string $deduction_price 抵扣金额
 * @property int $coupon_id 优惠券id
 * @property string $coupon_price 优惠券金额
 * @property int $paid 支付状态
 * @property int $pay_time 支付时间
 * @property string $pay_type 支付方式
 * @property int $add_time 创建时间
 * @property int $status 订单状态（-1 : 申请退款 -2 : 退货成功 0：待发货；1：待收货；2：已收货；3：待评价；-1：已退款）
 * @property int $refund_status 0 未退款 1 申请中 2 已退款
 * @property string $refund_reason_wap_img 退款图片
 * @property string $refund_reason_wap_explain 退款用户说明
 * @property int $refund_reason_time 退款时间
 * @property string $refund_reason_wap 前台退款原因
 * @property string $refund_reason 不退款的理由
 * @property string $refund_price 退款金额
 * @property string $delivery_name 快递名称/送货人姓名
 * @property string $delivery_type 发货类型
 * @property string $delivery_id 快递单号/手机号
 * @property string $gain_integral 消费赚取积分
 * @property string $use_integral 使用积分
 * @property string $back_integral 给用户退了多少积分
 * @property string $mark 备注
 * @property int $is_del 是否删除
 * @property string $unique 唯一id(md5加密)类似id
 * @property string $remark 管理员备注
 * @property int $mer_id 商户ID
 * @property int $is_mer_check
 * @property int $combination_id 拼团产品id0一般产品
 * @property int $pink_id 拼团id 0没有拼团
 * @property string $cost 成本价
 * @property int $seckill_id 秒杀产品ID
 * @property int $bargain_id 砍价id
 * @property string $verify_code 核销码
 * @property int $store_id 门店id
 * @property int $shipping_type 配送方式 1=快递 ，2=门店自提
 * @property int $is_channel 支付渠道(0微信公众号1微信小程序)
 * @property int $is_remind 消息提醒
 * @property int $is_system_del 后台是否删除
 */
class Order extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'order';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'order_id',
        'uid',
        'real_name',
        'user_phone',
        'user_address',
        'cart_id',
        'freight_price',
        'total_num',
        'total_price',
        'total_postage',
        'pay_price',
        'pay_postage',
        'deduction_price',
        'coupon_id',
        'coupon_price',
        'paid',
        'pay_time',
        'pay_type',
        'add_time',
        'status',
        'refund_status',
        'refund_reason_wap_img',
        'refund_reason_wap_explain',
        'refund_reason_time',
        'refund_reason_wap',
        'refund_reason',
        'refund_price',
        'delivery_name',
        'delivery_type',
        'delivery_id',
        'gain_integral',
        'use_integral',
        'back_integral',
        'mark',
        'is_del',
        'unique',
        'remark',
        'mer_id',
        'is_mer_check',
        'combination_id',
        'pink_id',
        'cost',
        'seckill_id',
        'bargain_id',
        'verify_code',
        'store_id',
        'shipping_type',
        'is_channel',
        'is_remind',
        'is_system_del'
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'uid' => 'integer',
        'total_num' => 'integer',
        'coupon_id' => 'integer',
        'paid' => 'integer',
        'pay_time' => 'integer',
        'add_time' => 'integer',
        'status' => 'integer',
        'refund_status' => 'integer',
        'refund_reason_time' => 'integer',
        'is_del' => 'integer',
        'mer_id' => 'integer',
        'is_mer_check' => 'integer',
        'combination_id' => 'integer',
        'pink_id' => 'integer',
        'seckill_id' => 'integer',
        'bargain_id' => 'integer',
        'store_id' => 'integer',
        'shipping_type' => 'integer',
        'is_channel' => 'integer',
        'is_remind' => 'integer',
        'is_system_del' => 'integer'
    ];

    public static function labels()
    {
        return [
            'id' => '订单ID',
            'order_id' => '订单号',
            'uid' => '用户id',
            'real_name' => '用户姓名',
            'user_phone' => '用户电话',
            'user_address' => '详细地址',
            'cart_id' => '购物车id',
            'freight_price' => '运费金额',
            'total_num' => '订单商品总数',
            'total_price' => '订单总价',
            'total_postage' => '邮费',
            'pay_price' => '实际支付金额',
            'pay_postage' => '支付邮费',
            'deduction_price' => '抵扣金额',
            'coupon_id' => '优惠券id',
            'coupon_price' => '优惠券金额',
            'paid' => '支付状态',
            'pay_time' => '支付时间',
            'pay_type' => '支付方式',
            'add_time' => '创建时间',
            'status' => '订单状态',
            'refund_status' => '退款进度',
            'refund_reason_wap_img' => '退款图片',
            'refund_reason_wap_explain' => '退款用户说明',
            'refund_reason_time' => '退款时间',
            'refund_reason_wap' => '前台退款原因',
            'refund_reason' => '不退款的理由',
            'refund_price' => '退款金额',
            'delivery_name' => '快递名称/送货人姓名',
            'delivery_type' => '发货类型',
            'delivery_id' => '快递单号/手机号',
            'gain_integral' => '消费赚取积分',
            'use_integral' => '使用积分',
            'back_integral' => '给用户退了多少积分',
            'mark' => '备注',
            'is_del' => '是否删除',
            'unique' => '唯一id(md5加密)类似id',
            'remark' => '管理员备注',
            'mer_id' => '商户ID',
            'is_mer_check' => '',
            'combination_id' => '拼团产品id',
            'pink_id' => '拼团id',
            'cost' => '成本价',
            'seckill_id' => '秒杀产品ID',
            'bargain_id' => '砍价id',
            'verify_code' => '核销码',
            'store_id' => '门店id',
            'shipping_type' => '配送方式',
            'is_channel' => '支付渠道',
            'is_remind' => '消息提醒',
            'is_system_del' => '后台是否删除',
        ];
    }
}