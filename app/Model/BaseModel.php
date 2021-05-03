<?php

declare (strict_types=1);
namespace App\Model;

use Hyperf\DbConnection\Model\Model;
use Hyperf\Database\Model\Events\Creating;
use Hyperf\Database\Model\Events\Updating;
use Hyperf\Di\Annotation\Inject;

/**
 * 模型基类
 * Class BaseModel
 * @package App\Model
 */
class BaseModel extends Model
{
    public $timestamps = false; // 默认created_at 和 updated_at

    //protected $dateFormat = 'U';

    /**
     * 增加时回调($fillable参数要设置值并且timestamps为true)
     * @param Saving $event
     */
    public function creating(Creating $event)
    {
        if ($this->timestamps) {
            //$this->setCreatedAt(time());
            //$this->setUpdatedAt(time());
            $this->setCreatedAt(date('Y-m-d H:i:s'));
            $this->setUpdatedAt(date('Y-m-d H:i:s'));
        }
    }

    /**
     * 更新时回调($fillable参数要设置值并且timestamps为true)
     * @param Updating $event
     */
    public function updating(Updating $event)
    {
        if ($this->timestamps) {
            //$this->setUpdatedAt(time());
            $this->setUpdatedAt(date('Y-m-d H:i:s'));
        }
    }

    /**
     * 显示增加时间
     * @param $value
     * @return false|string
     */
    public function getCreatedAtAttribute($value)
    {
        //return $value;
        if (is_string($value)) {
            return $value ? date('Y-m-d H:i', strtotime($value)) : '';
        }
    }

    /**
     * 显示更新时间
     * @param $value
     * @return false|string
     */
    public function getUpdatedAtAttribute($value)
    {
        //return $value;
        if (is_string($value)) {
            return $value ? date('Y-m-d H:i', strtotime($value)) : '';
        }
    }

    /**
     * 获取单行数据
     * @param $field 字段
     * @param $value 字段值
     * @return \Hyperf\Database\Model\Builder|\Hyperf\Database\Model\Model|null|object
     */
    public function getInfo($field,$value)
    {
        return $this->query()->where($field,$value)->first();
    }

    /**
     * 获取多行数据
     * @param $field
     * @param $value
     * @return \Hyperf\Database\Model\Builder[]|\Hyperf\Database\Model\Collection
     */
    public function listInfo($field = '',$value = '')
    {
        if (empty($field) || empty($value)) {
            return $this->query()->get();
        } else {
            return $this->query()->whereIn($field, $value)->get();
        }
    }

    /**
     * 保存数据
     * @param $data
     * @return BaseModel|\Hyperf\Database\Model\Model
     */
    public function saveInfo($data)
    {
        return $this->create($data);
    }

    /**
     * 更新数据
     * @param $field
     * @param $value
     * @param $data
     * @return int
     */
    public function updateInfo($field,$value,$data)
    {
        return $this->query()->where($field, $value)->update($data);
    }

    /**
     * 删除数据
     * @param $field
     * @param $value
     * @return int|mixed
     */
    public function deleteInfo($field,$value)
    {
        if (is_array($field)) {
            return $this->query()->whereIn($field, $value)->delete();
        } else {
            return $this->query()->where($field,$value)->delete();
        }
    }
}