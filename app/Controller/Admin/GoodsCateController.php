<?php

declare(strict_types=1);

/**
 *商品分类模块
 */

namespace App\Controller\Admin;

use App\Model\GoodsCate;
use HPlus\Admin\Controller\AbstractAdminController;
use HPlus\Route\Annotation\AdminController;
use HPlus\UI\Components\Attrs\SelectOption;
use HPlus\UI\Components\Form\Select;
use HPlus\UI\Components\Widgets\Card;
use HPlus\UI\Components\Widgets\Html;
use HPlus\UI\Form;
use HPlus\UI\Grid;
use HPlus\UI\Layout\Content;
use Hyperf\Di\Annotation\Inject;

/**
 * @AdminController(prefix="goodscate", tag="商品分类", ignore=true))
 */
class GoodsCateController extends AbstractAdminController
{
    /**
     * @Inject
     * @var GoodsCate
     */
    protected $goodsCate;

    protected function grid()
    {
        $grid = new Grid(new GoodsCate);
        $grid->top(function (Content $top) {
            $top->body(Card::make()->content(Html::make()->html("我是头部内容")));
        });
        $grid->dialogForm($this->form()->isDialog(), '700px', ['添加', '编辑']);
        //$grid->hidePage(); //隐藏分页
        //$grid->hideActions(); //隐藏操作
        $grid->selection(); //多选
        $grid->defaultSort('id', 'asc'); // 默认id倒序
        $grid->model()->where('parent_id', 0);//设置查询条件
        $grid->tree();//启动树形表格
        $grid->rowKey('id');//设置rowKey，必须存在，默认为ID，如果你的Grid没有定义ID字段就要重新设置其他字段
        $grid->defaultExpandAll();//默认展开所有行
        $grid->className('m-15');
        $grid->column('id', GoodsCate::labels()['id'])->sortable();
        $grid->column('parent_id', GoodsCate::labels()['parent_id']);
        $grid->column('title', GoodsCate::labels()['title']);
        $grid->column('order', GoodsCate::labels()['order'])->sortable();
        $grid->column('status', GoodsCate::labels()['status'])->customValue(function ($raw, $value) {
            return GoodsCate::$status[$value] ?? '';
        });
        $grid->export(function (Grid\Exporters\CsvExporter $export) {
            $export->filename('信息导出.csv');
        });

        return $grid;
    }

    protected function form($isEdit = false)
    {
        /*@var Model $model */
        $form = new Form(new GoodsCate());
        $form->className('m-15');
        $form->setEdit($isEdit);
        $form->item('parent_id', GoodsCate::labels()['parent_id'])->component(Select::make()->options(function () {

            $data = [];
            //var_dump((new GoodsCate)->getTree());
            foreach ((new GoodsCate)->getTree() as $key => $status) {
                $data[] = [
                    'value' => $key,
                    'label' => $status,
                    'avatar' => '',
                    'desc' => '',
                ];
            }
            //var_dump($data);
            return $data;
        }));
        $form->item('title', GoodsCate::labels()['title']);
        $form->item('order', GoodsCate::labels()['order'])->defaultValue(0);
        $form->item('status', GoodsCate::labels()['status'])->defaultValue(10)->component(Select::make()->options(function () {
            $data = [];
            foreach (GoodsCate::$status as $key => $status) {
                $data[] = [
                    'value' => $key,
                    'label' => $status,
                    'avatar' => '',
                    'desc' => '',
                ];
            }
            return $data;
        }));

        return $form;
    }
}
