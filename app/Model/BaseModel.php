<?php

declare (strict_types=1);
namespace App\Model;

use Hyperf\DbConnection\Model\Model;
use Hyperf\Database\Model\Events\Creating;
use Hyperf\Database\Model\Events\Updating;

/**
 * 模型基类
 * Class BaseModel
 * @package App\Model
 */
class BaseModel extends Model
{
    public $timestamps = false; // 默认created_at 和 updated_at

    protected $dateFormat = 'U';

    /**
     * 增加时回调($fillable参数要设置值并且timestamps为true)
     * @Interface saving
     * @param Saving $event
     */
    public function creating(Creating $event)
    {
        if ($this->timestamps) {
            $this->setCreatedAt(time());
            $this->setUpdatedAt(time());
        }
    }

    /**
     * 更新时回调($fillable参数要设置值并且timestamps为true)
     * @Interface updating
     * @param Updating $event
     */
    public function updating(Updating $event)
    {
        if ($this->timestamps) {
            $this->setUpdatedAt(time());
        }
    }

    /**
     * 获取单行数据
     * @Interface getInfo
     * @param $field 字段
     * @param $value 字段值
     * @return \Hyperf\Database\Model\Builder|\Hyperf\Database\Model\Model|null|object
     */
    public static function getInfo($field,$value)
    {
        return self::query()->where($field,$value)->first();
    }

    /**
     * 获取多行数据
     * @Interface listInfo
     * @param $field
     * @param $value
     * @return \Hyperf\Database\Model\Builder[]|\Hyperf\Database\Model\Collection
     */
    public static function listInfo($field,$value)
    {
        return self::query()->whereIn($field,$value)->get();
    }

    /**
     * 保存数据
     * @Interface saveInfo
     * @param $data
     * @return BaseModel|\Hyperf\Database\Model\Model
     */
    public function saveInfo($data)
    {
        return self::create($data);
    }

    /**
     * 更新数据
     * @Interface updateInfo
     * @param $field
     * @param $value
     * @param $data
     * @return int
     */
    public function updateInfo($field,$value,$data)
    {
        return self::query()->where($field, $value)->update($data);
    }

    /**
     * 删除数据
     * @Interface deleteInfo
     * @param $field
     * @param $value
     * @return int|mixed
     */
    public function deleteInfo($field,$value)
    {
        if (is_array($field)) {
            return self::query()->whereIn($field, $value)->delete();
        } else {
            return self::query()->where($field,$value)->delete();
        }
    }
}