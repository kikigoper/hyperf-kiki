<?php

declare (strict_types=1);

namespace App\Model;

use Hyperf\DbConnection\Model\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property int $see_id 砍价id
 * @property string $user_name
 * @property string $current_price 当前价格
 * @property int $residue_num 砍价剩余次数
 */
class SeeAlsoUserList extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'see_also_user_list';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'user_id', 'see_id', 'user_name', 'current_price', 'residue_num'];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'user_id' => 'integer', 'see_id' => 'integer', 'residue_num' => 'integer'];

    public static function labels()
    {
        return [
            'id' => '',
            'user_id' => '用户id',
            'see_id' => '砍价id',
            'user_name' => '用户名',
            'current_price' => '当前价格',
            'residue_num' => '砍价剩余次数',
        ];
    }
}