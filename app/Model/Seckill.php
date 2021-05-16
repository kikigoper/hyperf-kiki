<?php

declare (strict_types=1);
namespace App\Model;

use Hyperf\DbConnection\Model\Model;
/**
 * @property int $id 商品秒杀产品表id
 * @property int $product_id 商品id
 * @property string $image 推荐图
 * @property string $images 轮播图
 * @property string $title 活动标题
 * @property string $info 简介
 * @property string $price 价格
 * @property string $cost 成本
 * @property string $ot_price 原价
 * @property string $give_integral 返多少积分
 * @property int $sort 排序
 * @property int $stock 库存
 * @property int $sales 销量
 * @property string $unit_name 单位名
 * @property string $postage 邮费
 * @property string $description 内容
 * @property string $start_time 开始时间
 * @property string $stop_time 结束时间
 * @property string $add_time 添加时间
 * @property int $status 产品状态
 * @property int $is_postage 是否包邮
 * @property int $is_hot 热门推荐
 * @property int $is_del 删除 0未删除1已删除
 * @property int $num 最多秒杀几个
 * @property int $is_show 显示
 */
class Seckill extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'seckill';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'product_id', 'image', 'images', 'title', 'info', 'price', 'cost', 'ot_price', 'give_integral', 'sort', 'stock', 'sales', 'unit_name', 'postage', 'description', 'start_time', 'stop_time', 'add_time', 'status', 'is_postage', 'is_hot', 'is_del', 'num', 'is_show'];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'product_id' => 'integer', 'sort' => 'integer', 'stock' => 'integer', 'sales' => 'integer', 'status' => 'integer', 'is_postage' => 'integer', 'is_hot' => 'integer', 'is_del' => 'integer', 'num' => 'integer', 'is_show' => 'integer'];

    public static function labels()
    {
        return ['id'=>'商品秒杀产品表id',
            'product_id'=>'商品id',
            'image'=>'推荐图',
            'images'=>'轮播图',
            'title'=>'活动标题',
            'info'=>'简介',
            'price'=>'价格',
            'cost'=>'成本',
            'ot_price'=>'原价',
            'give_integral'=>'返多少积分',
            'sort'=>'排序',
            'stock'=>'库存',
            'sales'=>'销量',
            'unit_name'=>'单位名',
            'postage'=>'邮费',
            'description'=>'内容',
            'start_time'=>'开始时间',
            'stop_time'=>'结束时间',
            'add_time'=>'添加时间',
            'status'=>'产品状态',
            'is_postage'=>'是否包邮',
            'is_hot'=>'热门推荐',
            'is_del'=>'删除 0未删除1已删除',
            'num'=>'最多秒杀几个',
            'is_show'=>'显示',
        ];
    }
}