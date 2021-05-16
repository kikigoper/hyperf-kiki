<?php

declare (strict_types=1);
namespace App\Model;

use Hyperf\DbConnection\Model\Model;
/**
 * @property int $id 
 * @property int $goods_id 商品id
 * @property string $goods_name 商品名称
 * @property string $live_price 直播价
 * @property string $ori_price 原价
 * @property int $stock 库存
 * @property int $status 审核状态：1未通过、10通过
 * @property int $show_status 显示状态：1不显示、10显示
 */
class LiveGood extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'live_goods';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'goods_id', 'goods_name', 'live_price', 'ori_price', 'stock', 'status', 'show_status'];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'goods_id' => 'integer', 'stock' => 'integer', 'status' => 'integer', 'show_status' => 'integer'];

    public static function labels()
    {
        return ['id'=>'',
            'goods_id'=>'商品id',
            'goods_name'=>'商品名称',
            'live_price'=>'直播价',
            'ori_price'=>'原价',
            'stock'=>'库存',
            'status'=>'审核状态',
            'show_status'=>'显示状态',
        ];
    }
}