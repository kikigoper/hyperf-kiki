<?php

declare (strict_types=1);

namespace App\Model;

use Hyperf\DbConnection\Model\Model;

/**
 * @property int $id 评论ID
 * @property int $uid 用户ID
 * @property int $oid 订单ID
 * @property string $unique 唯一id
 * @property int $product_id 产品id
 * @property string $reply_type 某种商品类型(普通商品、秒杀商品）
 * @property int $product_score 商品分数
 * @property int $service_score 服务分数
 * @property string $comment 评论内容
 * @property string $pics 评论图片
 * @property int $add_time 评论时间
 * @property string $merchant_reply_content 管理员回复内容
 * @property int $merchant_reply_time 管理员回复时间
 * @property int $is_del 0未删除1已删除
 * @property int $is_reply 0未回复1已回复
 */
class ProductReply extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product_reply';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'uid',
        'oid',
        'unique',
        'product_id',
        'reply_type',
        'product_score',
        'service_score',
        'comment',
        'pics',
        'add_time',
        'merchant_reply_content',
        'merchant_reply_time',
        'is_del',
        'is_reply'
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'uid' => 'integer',
        'oid' => 'integer',
        'product_id' => 'integer',
        'product_score' => 'integer',
        'service_score' => 'integer',
        'add_time' => 'integer',
        'merchant_reply_time' => 'integer',
        'is_del' => 'integer',
        'is_reply' => 'integer'
    ];

    public static function labels()
    {
        return [
            'id' => '评论ID',
            'uid' => '用户ID',
            'oid' => '订单ID',
            'unique' => '唯一id',
            'product_id' => '产品id',
            'reply_type' => '商品类型',
            'product_score' => '商品分数',
            'service_score' => '服务分数',
            'comment' => '评论内容',
            'pics' => '评论图片',
            'add_time' => '评论时间',
            'merchant_reply_content' => '管理员回复内容',
            'merchant_reply_time' => '管理员回复时间',
            'is_del' => '是否删除',
            'is_reply' => '是否回复',
        ];
    }
}