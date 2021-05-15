<?php

declare (strict_types=1);

namespace App\Model;

use Hyperf\DbConnection\Model\Model;

/**
 * @property int $id
 * @property string $content 详情
 * @property int $sort
 * @property string $created_at
 * @property string $updated_at
 */
class CustomSc extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'custom_sc';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'content', 'sort', 'created_at', 'updated_at'];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'sort' => 'integer'];

    public static function labels()
    {
        return [
            'id' => '',
            'content' => '详情',
            'sort' => '排序',
            'created_at' => '创建时间',
            'updated_at' => '',
        ];
    }
}