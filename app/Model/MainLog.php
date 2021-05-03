<?php

declare (strict_types=1);

namespace App\Model;

use Hyperf\DbConnection\Model\Model;

/**
 * @property int $id
 * @property string $en_key 英文索引
 * @property string $cn_key 中文索引
 * @property string $content 日志内容
 * @property int $created_at
 * @property int $updated_at
 */
class MainLog extends BaseModel
{
    /**
     * The table associated with the model.
     * @var string
     */
    protected $table = 'main_log';

    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = ['id', 'en_key', 'cn_key', 'content', 'created_at', 'updated_at'];
    /**
     * The attributes that should be cast to native types.
     * @var array
     */
    protected $casts = ['id' => 'integer'];

    public function labels()
    {
        return [
            'id' => 'id',
            'en_key' => '英文索引',
            'cn_key' => '中文索引',
            'content' => '内容',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }

    public function log($data)
    {
        try {
            if ($data) {
                if (!isset($data['en_key']) || empty($data['en_key'])) {
                    throw new \Exception('英文索引不能为空');
                }
            } else {
                throw new \Exception('数据不能为空');
            }
            if ($this->existInfo('en_key', $data['en_key'])) {
                throw new \Exception('英文索引已存在，请更换后重试');
            }
        } catch (\Throwable $e) {
            return [
                'errorMessage' => ',文件：' .
                    $e->getFile() . ',行：' .
                    $e->getLine() . ',出错信息：' .
                    $e->getMessage(),
            ];
        }
        return $this->saveInfo($data);
    }

    /**
     * 判断数据是否存在
     * @param $enKey
     * @return bool
     */
    public function existInfo($key, $value)
    {
        $data = $this->getInfo($key, $value);

        if ($data) {
            return true;
        }

        return false;
    }
}