<?php

declare (strict_types=1);
namespace App\Model;

use Hyperf\DbConnection\Model\Model;
/**
 * @property int $id 
 * @property int $user_id 会员ID
 * @property string $order_no 订单单号
 * @property int $from_mid 推荐会员ID
 * @property int $price_total 待付金额统计
 * @property int $price_goods 商品费用统计
 * @property int $pay_state 支付状态(0未支付,1已支付)
 * @property string $pay_type 支付方式
 * @property int $pay_price 支付金额
 * @property string $pay_no 支付单号
 * @property string $pay_at 支付时间
 * @property int $delivery_type 邮寄方式
 * @property string $cancel_at 取消时间
 * @property string $cancel_desc 取消描述
 * @property int $type 相册类型 1 有边框 2 无边框
 * @property string $delivery_at 邮寄时间
 * @property string $refund_no 退款单号
 * @property string $refund_price 退款金额
 * @property string $out_transaction_id 退款单号
 * @property string $refund_desc 退款描述
 * @property int $out_state 发货状态(0未发货,1已发货,2已签收 3 异常)
 * @property string $express_at 发货时间
 * @property string $express_no 发货单号
 * @property string $express_company 物流公司
 * @property string $title 商品名称
 * @property int $goods_id 商品id
 * @property int $address_id 邮寄地址
 * @property string $transaction_id 第三方订单号
 * @property int $status 订单状态(0待支付,1待发货,2已发货,3已完成）
 * @property int $is_deleted 删除状态
 * @property string $create_at 创建时间
 * @property string $update_at 创建时间
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
    protected $fillable = ['id', 'user_id', 'order_no', 'from_mid', 'price_total', 'price_goods', 'pay_state', 'pay_type', 'pay_price', 'pay_no', 'pay_at', 'delivery_type', 'cancel_at', 'cancel_desc', 'type', 'delivery_at', 'refund_no', 'refund_price', 'out_transaction_id', 'refund_desc', 'out_state', 'express_at', 'express_no', 'express_company', 'title', 'goods_id', 'address_id', 'transaction_id', 'status', 'is_deleted', 'create_at', 'update_at'];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'user_id' => 'integer', 'from_mid' => 'integer', 'price_total' => 'integer', 'price_goods' => 'integer', 'pay_state' => 'integer', 'pay_price' => 'integer', 'delivery_type' => 'integer', 'type' => 'integer', 'out_state' => 'integer', 'goods_id' => 'integer', 'address_id' => 'integer', 'status' => 'integer', 'is_deleted' => 'integer'];
}