<?php

declare (strict_types=1);

namespace App\Model;

use Hyperf\DbConnection\Model\Model;

/**
 * @property int $id
 * @property int $goods_id 商品id
 * @property string $goods_name 商品名称
 * @property string $price 砍价价格
 * @property string $min_price 砍价最低价格
 * @property int $total_num 砍价次数（商品最多被砍的次数）
 * @property int $help_num 帮忙砍价人数
 * @property int $success_num 砍价成功人数
 * @property int $limit_num 限量
 * @property int $residue_num 剩余限量
 * @property int $status 活动状态 1未开始 10 进行中 11 已过期
 * @property string $end_time 结束时间
 * @property int $sale_status 上架状态：1下架 10上架
 */
class SeeAlso extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'see_also';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'goods_id', 'goods_name', 'price', 'min_price', 'total_num', 'help_num', 'success_num', 'limit_num', 'residue_num', 'status', 'end_time', 'sale_status'];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'goods_id' => 'integer',
        'total_num' => 'integer',
        'help_num' => 'integer',
        'success_num' => 'integer',
        'limit_num' => 'integer',
        'residue_num' => 'integer',
        'status' => 'integer',
        'sale_status' => 'integer'
    ];

    public static function labels()
    {
        return [
            'id' => '',
            'goods_id' => '商品id',
            'goods_name' => '商品名称',
            'price' => '砍价价格',
            'min_price' => '砍价最低价格',
            'total_num' => '砍价次数（商品最多被砍的次数）',
            'help_num' => '帮忙砍价人数',
            'success_num' => '砍价成功人数',
            'limit_num' => '限量',
            'residue_num' => '剩余限量',
            'status' => '活动状态 1未开始 10 进行中 11 已过期',
            'end_time' => '结束时间',
            'sale_status' => '上架状态：1下架 10上架',
        ];
    }
}