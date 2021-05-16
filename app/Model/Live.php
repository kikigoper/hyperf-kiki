<?php

declare (strict_types=1);

namespace App\Model;

use Hyperf\DbConnection\Model\Model;

/**
 * @property int $id 直播间id
 * @property string $name 直播间名称
 * @property int $live_user_id 主播id
 * @property string $start_time 直播开始时间
 * @property string $end_time 直播结束时间
 * @property string $created_time 创建时间
 * @property string $updated_time
 * @property int $show_status 显示状态：1不显示、10显示
 * @property int $status 直播状态：1未开始、10直播中、11已结束
 * @property int $sort 排序
 */
class Live extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'live';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'name', 'live_user_id', 'start_time', 'end_time', 'created_time', 'updated_time', 'show_status', 'status', 'sort'];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'live_user_id' => 'integer', 'show_status' => 'integer', 'status' => 'integer', 'sort' => 'integer'];

    public static function labels()
    {
        return [
            'id' => '直播间id',
            'name' => '直播间名称',
            'live_user_id' => '主播id',
            'start_time' => '直播开始时间',
            'end_time' => '直播结束时间',
            'created_time' => '创建时间',
            'updated_time' => '',
            'show_status' => '显示状态',
            'status' => '直播状态',
            'sort' => '排序',
        ];
    }
}