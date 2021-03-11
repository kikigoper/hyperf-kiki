<?php

declare (strict_types=1);
namespace App\Model;

use Hyperf\DbConnection\Model\Model;

/**
 * 模型基类
 * Class BaseModel
 * @package App\Model
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

    public function saveInfo($data)
    {
        return self::create($data);
    }

    public function updateInfo($field,$value,$data)
    {
        return self::query()->where($field, $value)->update($data);
    }

    public function deleteInfo($field,$value)
    {
        if (is_array($field)) {
            return self::query()->whereIn($field, $value)->delete();
        } else {
            return self::query()->where($field,$value)->delete();
        }
    }
}