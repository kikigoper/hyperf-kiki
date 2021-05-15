<?php

declare (strict_types=1);

namespace App\Model;

use Hyperf\DbConnection\Model\Model;

/**
 * @property int $id
 * @property string $wechat_name 微信名称
 * @property string $image 客服头像
 * @property string $name 客服名称
 * @property int $status 账号状态 1关闭10开启
 * @property string $created_at
 * @property string $updated_at
 */
class CustomService extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'custom_service';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'wechat_name', 'image', 'name', 'status', 'created_at', 'updated_at'];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'status' => 'integer'];

    public static function labels()
    {
        return [
            'id' => '',
            'wechat_name' => '微信名称',
            'image' => '客服头像',
            'name' => '客服名称',
            'status' => '账号状态',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }
}