<?php

declare (strict_types=1);
namespace App\Model;

use Hyperf\DbConnection\Model\Model;

/**
 * @property int $id 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 * @property string $name 
 * @property string $phone 
 * @property string $username 
 */
class User extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */

    public $timestamps = false; // 默认created_at 和 updated_at

    protected $casts = ['id' => 'integer', 'name' => 'string', 'phone' => 'string'];

    public function test()
    {
        return 666;
    }
}