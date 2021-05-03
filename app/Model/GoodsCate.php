<?php

declare (strict_types=1);
namespace App\Model;

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
        $data = $this->listInfo()->toArray();
        $array = $this->getTreeData($data);
        $result = [];
        foreach ($array as $value) {
            $result[$value['id']] = str_repeat('一一', $value['level']).'|-'.$value['title'];
        }

        return $result;
    }

    //    return $result;
    //}

//$array = getTree($array);
    public function getTreeData($array, $pid =0, $level = 0)
    {
        //声明静态数组,避免递归调用时,多次声明导致数组覆盖
        static $list = [];
        foreach ($array as $key => $value){
            //第一次遍历,找到父节点为根节点的节点 也就是pid=0的节点
            if ($value['parent_id'] == $pid){
                //父节点为根节点的节点,级别为0，也就是第一级
                $value['level'] = $level;
                //把数组放到list中
                $list[] = $value;
                //把这个节点从数组中移除,减少后续递归消耗
                unset($array[$key]);
                //开始递归,查找父ID为该节点ID的节点,级别则为原级别+1
                $this->getTreeData($array, $value['id'], $level+1);

            }
        }
        return $list;
    }


    //public function allNodes(): array
    //{
    //    $orderColumn = DB::connection()->getQueryGrammar()->wrap($this->orderColumn);
    //    $byOrder = 'ROOT ASC,' . $orderColumn;
    //    $query = static::query();
    //    return $query->selectRaw('*, ' . $orderColumn . ' ROOT')->orderByRaw($byOrder)->get()->toArray();
    //}
}