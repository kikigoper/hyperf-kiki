<?php

declare (strict_types=1);

namespace App\Model;

use Hyperf\DbConnection\Model\Model;

/**
 * @property int $id 商品id
 * @property int $cate_id 分类id
 * @property string $goods_name 产品名称
 * @property string $main_image 产品图片
 * @property string $image 轮播图
 * @property string $introduction 简介
 * @property string $keywords 关键字
 * @property int $unit 单位
 * @property string $sell_price 售价
 * @property string $market_price 市场价
 * @property string $cost_price 成本价
 * @property int $integral 积分
 * @property string $carriage 运费
 * @property int $sales_volume 销量
 * @property int $virtual_sales_volume 虚拟销量
 * @property int $stock 库存
 * @property int $sort 排序
 * @property int $status 状态：1下架；2上架
 * @property int $like 点赞数
 * @property int $collect 收藏
 * @property int $view 浏览量
 * @property int $user_session 访问量
 * @property int $comment 评论
 * @property int $is_ship 是否包邮
 * @property int $created_at 创建时间
 * @property int $updated_at 更新时间
 */
class Goods extends BaseModel
{
    /**
     * The table associated with the model.
     * @var string
     */
    protected $table = 'goods';
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'id',
        'cate_id',
        'goods_name',
        'main_image',
        'image',
        'introduction',
        'keywords',
        'unit',
        'sell_price',
        'market_price',
        'cost_price',
        'integral',
        'carriage',
        'sales_volume',
        'virtual_sales_volume',
        'stock',
        'sort',
        'status',
        'like',
        'collect',
        'view',
        'user_session',
        'comment',
        'is_ship',
        'created_at',
        'updated_at',
    ];
    /**
     * The attributes that should be cast to native types.
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'cate_id' => 'integer',
        'unit' => 'integer',
        'integral' => 'integer',
        'sales_volume' => 'integer',
        'virtual_sales_volume' => 'integer',
        'stock' => 'integer',
        'sort' => 'integer',
        'status' => 'integer',
        'like' => 'integer',
        'collect' => 'integer',
        'view' => 'integer',
        'user_session' => 'integer',
        'comment' => 'integer',
        'is_ship' => 'integer',
        'created_at' => 'integer',
        'updated_at' => 'integer',
    ];

    public static function labels()
    {
        return [
            'id' => '商品id',
            'cate_id' => '分类id',
            'goods_name' => '产品名称',
            'main_image' => '产品图片',
            'image' => '轮播图',
            'introduction' => '简介',
            'keywords' => '关键字',
            'unit' => '单位',
            'sell_price' => '售价',
            'market_price' => '市场价',
            'cost_price' => '成本价',
            'integral' => '积分',
            'carriage' => '运费',
            'sales_volume' => '销量',
            'virtual_sales_volume' => '虚拟销量',
            'stock' => '库存',
            'sort' => '排序',
            'status' => '状态',
            'like' => '点赞数',
            'collect' => '收藏',
            'view' => '浏览量',
            'user_session' => '访问量',
            'comment' => '评论',
            'is_ship' => '是否包邮',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }
}