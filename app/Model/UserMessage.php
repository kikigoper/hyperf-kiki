<?php

declare (strict_types=1);

namespace App\Model;

use Hyperf\DbConnection\Model\Model;

/**
 * @property int $id
 * @property string $nickname 昵称
 * @property string $content 内容
 * @property string $remark 备注
 * @property int $status 1未处理、10已处理
 * @property string $created_at
 * @property string $updated_at
 */
class UserMessage extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_message';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'nickname', 'content', 'remark', 'status', 'created_at', 'updated_at'];
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
            'nickname' => '昵称',
            'content' => '内容',
            'remark' => '备注',
            'status' => '处理进度',
            'created_at' => '创建时间',
//            'updated_at' => '',
        ];
    }
}