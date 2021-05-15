<?php

declare (strict_types=1);
namespace App\Model;

use Hyperf\DbConnection\Model\Model;
/**
 * @property int $id 
 * @property int $type 服务名称：1mysql、2redis、3rabbitmq、4es
 * @property string $value 服务配置：json格式
 */
class SystemService extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'system_service';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'type', 'value'];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'type' => 'integer'];

    public static function labels()
    {
        return ['id'=>'',
            'type'=>'服务名称',
            'value'=>'服务配置',
        ];
    }
}