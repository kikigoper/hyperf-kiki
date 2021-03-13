<?php

declare (strict_types=1);
namespace App\Model;

use Hyperf\ModelCache\Cacheable;
use Hyperf\ModelCache\CacheableInterface;
use Hyperf\Scout\Searchable;
/**
 * @property int $id 
 * @property int $created_at 
 * @property int $updated_at 
 * @property string $name 
 * @property string $phone 
 * @property string $username 
 */
//class Zq extends Model implements CacheableInterface
class Zq extends BaseModel
{
    /**
     * 模型缓存
     */
    //    use Cacheable;
    /**
     * es索引
     */
    //    use Searchable;
    public function searchableAs()
    {
        return 'item_product';
    }
    public function toSearchableArray()
    {
        $array = $this->toArray();
        // Customize array...
        return $array;
    }
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'zq';
    public $timestamps = false;
    // 默认created_at 和 updated_at
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
    protected $casts = ['id' => 'integer', 'created_at' => 'integer', 'updated_at' => 'integer'];
    //    public function user()
    //    {
    //        return $this->hasOne(User::class, 'id', 'user_id');
    //    }
    //
    //    public function users()
    //    {
    //        return $this->hasMany(User::class, 'id', 'user_id');
    //    }
}