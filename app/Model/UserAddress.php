<?php

declare (strict_types=1);

namespace App\Model;

use Hyperf\DbConnection\Model\Model;

/**
 * @property int $address_id 用户地址id
 * @property int $user_id 用户id
 * @property string $real_name 收货人姓名
 * @property string $phone 收货人电话
 * @property string $province 收货人所在省
 * @property string $city 收货人所在市
 * @property int $city_id 城市id
 * @property string $district 收货人所在区
 * @property string $detail 收货人详细地址
 * @property int $post_code 邮编
 * @property string $longitude 经度
 * @property string $latitude 纬度
 * @property int $is_default 是否默认
 * @property int $is_del 是否删除
 * @property string $created_at 添加时间
 * @property string $updated_at
 */
class UserAddress extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_address';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'address_id',
        'user_id',
        'real_name',
        'phone',
        'province',
        'city',
        'city_id',
        'district',
        'detail',
        'post_code',
        'longitude',
        'latitude',
        'is_default',
        'is_del',
        'created_at',
        'updated_at'
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['address_id' => 'integer', 'user_id' => 'integer', 'city_id' => 'integer', 'post_code' => 'integer', 'is_default' => 'integer', 'is_del' => 'integer'];

    public static function labels()
    {
        return [
            'id' => 'id',
            'address_id' => '用户地址id',
            'user_id' => '用户id',
            'real_name' => '收货人姓名',
            'phone' => '收货人电话',
            'province' => '收货人所在省',
            'city' => '收货人所在市',
            'city_id' => '城市id',
            'district' => '收货人所在区',
            'detail' => '收货人详细地址',
            'post_code' => '邮编',
            'longitude' => '经度',
            'latitude' => '纬度',
            'is_default' => '是否默认',
            'is_del' => '是否删除',
            'created_at' => '添加时间',
            'updated_at' => '',
        ];
    }
}