<?php
/**
 * Created by PhpStorm.
 * User: Qi
 * Date: 2021/5/4
 */

namespace App\Common\Tool;

use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Contract\RequestInterface;

class Tree
{
    /**
     * @Inject
     * @var RequestInterface
     */
    protected $request;

    public static $list = [];

    /**
     * 获取树形结构数据
     * @param $data 结果集(数组)
     * @return array
     * id、ttle、parent_id字段必须
     */
    public static function getTree($data)
    {
        $array = self::getTreeData($data);
        $result = [];
        foreach ($array as $value) {
            $result[$value['id']] = str_repeat('一一', $value['level']) . $value['title'];
        }

        return $result;
    }

    public static function getTreeData($array, $pid = 0, $level = 0)
    {
        //声明静态数组,避免递归调用时,多次声明导致数组覆盖
        //static $list = [];
        foreach ($array as $key => $value) {
            //第一次遍历,找到父节点为根节点的节点 也就是pid=0的节点
            if ($value['parent_id'] == $pid) {
                //父节点为根节点的节点,级别为0，也就是第一级
                $value['level'] = $level;
                //把数组放到list中
                self::$list[] = $value;
                //把这个节点从数组中移除,减少后续递归消耗
                unset($array[$key]);
                //开始递归,查找父ID为该节点ID的节点,级别则为原级别+1
                self::getTreeData($array, $value['id'], $level + 1);

            }
        }

        return self::$list;
    }

    public function __destruct()
    {
        self::$list = null;
    }
}