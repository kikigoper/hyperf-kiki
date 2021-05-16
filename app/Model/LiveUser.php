<?php

declare (strict_types=1);

namespace App\Model;

use Hyperf\DbConnection\Model\Model;

/**
 * @property int $id
 * @property string $live_user_name 主播名称
 * @property string $live_wechat 主播微信号
 * @property string $live_phone 主播手机号
 * @property string $live_image 主播头像
 */
class LiveUser extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'live_user';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'live_user_name', 'live_wechat', 'live_phone', 'live_image'];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer'];

    public static function labels()
    {
        return [
            'id' => '',
            'live_user_name' => '主播名称',
            'live_wechat' => '主播微信号',
            'live_phone' => '主播手机号',
            'live_image' => '主播头像',
        ];
    }
}