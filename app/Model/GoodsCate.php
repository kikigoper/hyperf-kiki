<?php

declare (strict_types=1);
namespace App\Model;

use App\Common\Tool\Tree;
use Hyperf\DbConnection\Model\Model;
use HPlus\Admin\Traits\ModelTree;
use Hyperf\DbConnection\Db;
use Hyperf\Utils\Arr;
use Hyperf\Utils\Str;


/**
 * @property int $id 产品id
 * @property int $pid 父级id
 * @property string $cate_name 分类名称
 * @property int $sort 排序
 * @property int $status 状态:1关闭，10开启
 */
class GoodsCate extends BaseModel
{
    //AdminBuilder,
    use ModelTree {
        ModelTree::boot as treeBoot;
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'goods_cate';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'parent_id', 'title', 'order', 'status'];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'parent_id' => 'integer', 'title' => 'string', 'status' => 'integer'];

    //public function children()
    //{
    //    return $this->hasMany(get_class($this), 'parent_id')->orderBy('order')->with('children');
    //}

    //public function allChildren()
    //{
    //    return $this->children()->with('allChildren');
    //}

    public static function labels()
    {
        return [
            'id' => 'id',
            'parent_id' => '父级分类',
            'title' => '分类名称',
            'order' => '排序',
            'status' => '状态',
        ];
    }

    public function getTree()
    {
        $data = $this->listInfo('status',[10])->toArray();
        return Tree::getTree($data);
    }
}