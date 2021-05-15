<?php

declare (strict_types=1);

namespace App\Model;

use Hyperf\DbConnection\Model\Model;

/**
 * @property int $id 快递公司id
 * @property string $code 快递公司简称
 * @property string $name 快递公司全称
 * @property int $sort 排序
 * @property int $is_show 是否显示
 */
class Express extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'express';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'code', 'name', 'sort', 'is_show'];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'sort' => 'integer', 'is_show' => 'integer'];

    public static function labels()
    {
        return [
            'id' => '快递公司id',
            'code' => '快递公司简称',
            'name' => '快递公司全称',
            'sort' => '排序',
            'is_show' => '是否显示',
        ];
    }
}