<?php

declare (strict_types=1);

namespace App\Model;

use Hyperf\DbConnection\Model\Model;

/**
 * @property int $id
 * @property int $uid 用户uid
 * @property int $level_id 等级vip
 * @property int $grade 会员等级
 * @property int $valid_time 过期时间
 * @property int $is_forever 是否永久
 * @property int $mer_id 商户id
 * @property int $status 0:禁止,1:正常
 * @property string $mark 备注
 * @property int $remind 是否已通知
 * @property int $is_del 是否删除,0=未删除,1=删除
 * @property int $add_time 添加时间
 * @property int $discount 享受折扣
 */
class UserLevel extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_level';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'uid', 'level_id', 'grade', 'valid_time', 'is_forever', 'mer_id', 'status', 'mark', 'remind', 'is_del', 'add_time', 'discount'];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'uid' => 'integer',
        'level_id' => 'integer',
        'grade' => 'integer',
        'valid_time' => 'integer',
        'is_forever' => 'integer',
        'mer_id' => 'integer',
        'status' => 'integer',
        'remind' => 'integer',
        'is_del' => 'integer',
        'add_time' => 'integer',
        'discount' => 'integer'
    ];

    public static function labels()
    {
        return ['id'=>'',
            'uid'=>'用户uid',
            'level_id'=>'等级vip',
            'grade'=>'会员等级',
            'valid_time'=>'过期时间',
            'is_forever'=>'是否永久',
            'mer_id'=>'商户id',
            'status'=>'状态',
            'mark'=>'备注',
            'remind'=>'是否已通知',
            'is_del'=>'是否删除',
            'add_time'=>'添加时间',
            'discount'=>'享受折扣',
        ];
    }
}