<?php

declare (strict_types=1);

namespace App\Model;

use Hyperf\DbConnection\Model\Model;

/**
 * @property int $id ID
 * @property string $title 优惠券标题（有图片则显示图片）：无门槛50元优惠券 | 单品最高减2000元
 * @property string $icon 图片
 * @property int $used 可用于：10店铺优惠券 11新人店铺券  20商品优惠券  30类目优惠券  60平台优惠券 61新人平台券
 * @property int $type 1满减券 2叠加满减券 3无门槛券（需要限制大小）
 * @property int $with_special 1可用于特价商品 2不能  默认不能(商品优惠卷除外)
 * @property string $with_sn 店铺或商品流水号
 * @property int $with_amount 满多少金额
 * @property int $used_amount 用券金额
 * @property int $quota 配额：发券数量
 * @property int $take_count 已领取的优惠券数量
 * @property int $used_count 已使用的优惠券数量
 * @property string $start_time 发放开始时间
 * @property string $end_time 发放结束时间
 * @property int $valid_type 时效:1绝对时效（领取后XXX-XXX时间段有效）  2相对时效（领取后N天有效）
 * @property string $valid_start_time 使用开始时间
 * @property string $valid_end_time 使用结束时间
 * @property int $valid_days 自领取之日起有效天数
 * @property int $status 1生效 2失效 3已结束
 * @property int $create_user
 * @property string $create_time 创建时间
 * @property int $update_user
 * @property string $update_time 修改时间
 */
class Coupon extends BaseModel
{
    /**
     * The table associated with the model.
     * @var string
     */
    protected $table = 'coupon';
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'id',
        'title',
        'icon',
        'used',
        'type',
        'with_special',
        'with_sn',
        'with_amount',
        'used_amount',
        'quota',
        'take_count',
        'used_count',
        'start_time',
        'end_time',
        'valid_type',
        'valid_start_time',
        'valid_end_time',
        'valid_days',
        'status',
        'create_user',
        'create_time',
        'update_user',
        'update_time',
    ];
    /**
     * The attributes that should be cast to native types.
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'used' => 'integer',
        'type' => 'integer',
        'with_special' => 'integer',
        'with_amount' => 'integer',
        'used_amount' => 'integer',
        'quota' => 'integer',
        'take_count' => 'integer',
        'used_count' => 'integer',
        'valid_type' => 'integer',
        'valid_days' => 'integer',
        'status' => 'integer',
        'create_user' => 'integer',
        'update_user' => 'integer',
    ];

    public static function labels()
    {
        return [
            'id' => 'id',
            'title' => '优惠券标题',
            'icon' => '图片',
            'used' => '用途',
            'type' => '类型',
            'with_special' => '可用于特价商品',
            'with_sn' => '商品id',
            'with_amount' => '满多少金额',
            'used_amount' => '用券金额',
            'quota' => '发券数量',
            'take_count' => '已领数量',
            'used_count' => '已用数量',
            'start_time' => '发放开始时间',
            'end_time' => '发放结束时间',
            'valid_type' => '失效类型',
            'valid_start_time' => '使用开始时间',
            'valid_end_time' => '使用结束时间',
            'valid_days' => '自领取之日起有效天数',
            'status' => '状态',
            'create_user' => '创建人',
            'create_time' => '创建时间',
            'update_user' => '更新人',
            'update_time' => '更新时间',
        ];
    }
}