<?php

declare (strict_types=1);

namespace App\Model;

use Hyperf\DbConnection\Model\Model;

/**
 * @property int $id ID
 * @property int $uid 用户ID
 * @property string $username 用户名
 * @property string $password 密码
 * @property string $salt 密码干扰字符
 * @property string $email 用户邮箱
 * @property string $mobile 用户手机
 * @property string $reg_time 注册时间
 * @property int $reg_ip 注册IP
 * @property string $last_login_time 最后登录时间
 * @property int $last_login_ip 最后登录IP
 * @property string $update_time 更新时间
 * @property int $tuid 推荐人uid
 * @property string $image 头像路径
 * @property int $score 当前积分
 * @property int $score_all 总积分
 * @property int $allowance api接口调用速率限制
 * @property int $allowance_updated_at api接口调用速率限制
 * @property int $status 用户状态 1正常 0禁用
 */
class User extends BaseModel
{
    /**
     * The table associated with the model.
     * @var string
     */
    protected $table = 'user';

    //public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'id',
        'uid',
        'username',
        'password',
        'salt',
        'email',
        'mobile',
        'reg_time',
        'reg_ip',
        'last_login_time',
        'last_login_ip',
        'update_time',
        'tuid',
        'image',
        'score',
        'score_all',
        'allowance',
        'allowance_updated_at',
        'status',
    ];
    /**
     * The attributes that should be cast to native types.
     * @var array
     */
    // 默认created_at 和 updated_at
    protected $casts = [
        'id' => 'integer',
        'uid' => 'integer',
        'reg_ip' => 'integer',
        'last_login_ip' => 'integer',
        'tuid' => 'integer',
        'score' => 'integer',
        'score_all' => 'integer',
        'allowance' => 'integer',
        'allowance_updated_at' => 'integer',
        'status' => 'integer',
    ];

    public static function labels()
    {
        return [
            'id' => 'ID',
            'uid' => '用户ID',
            'username' => '用户名',
            'password' => '密码',
            'salt' => '密码干扰字符',
            'email' => '用户邮箱',
            'mobile' => '用户手机',
            'reg_time' => '注册时间',
            'reg_ip' => '注册IP',
            'last_login_time' => '最后登录时间',
            'last_login_ip' => '最后登录IP',
            'update_time' => '更新时间',
            'tuid' => '推荐人uid',
            'image' => '头像路径',
            'score' => '当前积分',
            'score_all' => '总积分',
            'allowance' => 'api接口调用速率限制',
            'allowance_updated_at' => 'api接口调用速率限制时间',
            'status' => '状态',
        ];
    }
}