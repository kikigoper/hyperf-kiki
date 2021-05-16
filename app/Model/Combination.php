<?php

declare (strict_types=1);

namespace App\Model;

use Hyperf\DbConnection\Model\Model;

/**
 * @property int $id
 * @property int $product_id 商品id
 * @property int $mer_id 商户id
 * @property string $image 推荐图
 * @property string $images 轮播图
 * @property string $title 活动标题
 * @property string $attr 活动属性
 * @property int $people 参团人数
 * @property string $info 简介
 * @property string $price 价格
 * @property int $sort 排序
 * @property int $sales 销量
 * @property int $stock 库存
 * @property string $add_time 添加时间
 * @property int $is_host 推荐
 * @property int $is_show 产品状态
 * @property int $is_del
 * @property int $combination
 * @property int $mer_use 商户是否可用1可用0不可用
 * @property int $is_postage 是否包邮1是0否
 * @property string $postage 邮费
 * @property string $description 拼团内容
 * @property int $start_time 拼团开始时间
 * @property int $stop_time 拼团结束时间
 * @property int $effective_time 拼团订单有效时间
 * @property int $cost 拼图产品成本
 * @property int $browse 浏览量
 * @property string $unit_name 单位名
 */
class Combination extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'combination';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'product_id',
        'mer_id',
        'image',
        'images',
        'title',
        'attr',
        'people',
        'info',
        'price',
        'sort',
        'sales',
        'stock',
        'add_time',
        'is_host',
        'is_show',
        'is_del',
        'combination',
        'mer_use',
        'is_postage',
        'postage',
        'description',
        'start_time',
        'stop_time',
        'effective_time',
        'cost',
        'browse',
        'unit_name'
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'product_id' => 'integer',
        'mer_id' => 'integer',
        'people' => 'integer',
        'sort' => 'integer',
        'sales' => 'integer',
        'stock' => 'integer',
        'is_host' => 'integer',
        'is_show' => 'integer',
        'is_del' => 'integer',
        'combination' => 'integer',
        'mer_use' => 'integer',
        'is_postage' => 'integer',
        'start_time' => 'integer',
        'stop_time' => 'integer',
        'effective_time' => 'integer',
        'cost' => 'integer',
        'browse' => 'integer'
    ];

    public static function labels()
    {
        return [
            'id' => '',
            'product_id' => '商品id',
            'mer_id' => '商户id',
            'image' => '推荐图',
            'images' => '轮播图',
            'title' => '活动标题',
            'attr' => '活动属性',
            'people' => '参团人数',
            'info' => '简介',
            'price' => '价格',
            'sort' => '排序',
            'sales' => '销量',
            'stock' => '库存',
            'add_time' => '添加时间',
            'is_host' => '推荐',
            'is_show' => '产品状态',
            'is_del' => '是否删除',
            'combination' => '',
            'mer_use' => '商户是否可用',
            'is_postage' => '包邮',
            'postage' => '邮费',
            'description' => '拼团内容',
            'start_time' => '拼团开始时间',
            'stop_time' => '拼团结束时间',
            'effective_time' => '拼团订单有效时间',
            'cost' => '拼图产品成本',
            'browse' => '浏览量',
            'unit_name' => '单位名',
        ];
    }
}