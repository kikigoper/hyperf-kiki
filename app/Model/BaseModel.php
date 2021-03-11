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
class BaseModel extends Model
{
    public $timestamps = false; // 默认created_at 和 updated_at

    public static function getInfo($field,$value)
    {
        return self::query()->where($field,$value)->first();
    }

    public static function listInfo($field,$value)
    {
        return self::query()->whereIn($field,$value)->get();
    }

}