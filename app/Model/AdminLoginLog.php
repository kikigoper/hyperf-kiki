<?php

declare (strict_types=1);
namespace App\Model;

use Hyperf\Database\Model\Events\Saving;

/**
 * @property int $id 
 * @property int $user_id 
 * @property string $user_name 
 * @property string $ip 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 */
class AdminLoginLog extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'admin_login_log';

    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','user_id','user_name','ip','created_at','updated_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'user_id' => 'integer'];

    public static function labels()
    {
        return [
            'id' => 'ID',
            'user_id' => '用户id',
            'user_name' => '用户名称',
            'ip' => 'ip',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }
}