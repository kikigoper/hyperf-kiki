<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Model\Combination;
use HPlus\Admin\Controller\AbstractAdminController;
use HPlus\Route\Annotation\AdminController;
use HPlus\UI\Form;
use HPlus\UI\Grid;

/**
 * @AdminController(prefix="combination", tag="拼团管理", ignore=true))
 */
class CombinationController extends AbstractAdminController
{
    protected function grid()
    {
        $grid = new Grid(new Combination);
        $grid->dialogForm($this->form()->isDialog(), '700px', ['添加', '编辑']);
        //$grid->hidePage(); //隐藏分页
        //$grid->hideActions(); //隐藏操作
        $grid->selection(); //多选
        $grid->defaultSort('id', 'desc'); // 默认id倒序
        $grid->className('m-15');
        $grid->column('id', Combination::labels()['id']);
        $grid->column('product_id', Combination::labels()['product_id']);
        $grid->column('mer_id', Combination::labels()['mer_id']);
        $grid->column('image', Combination::labels()['image']);
        $grid->column('images', Combination::labels()['images']);
        $grid->column('title', Combination::labels()['title']);
        $grid->column('attr', Combination::labels()['attr']);
        $grid->column('people', Combination::labels()['people']);
        $grid->column('info', Combination::labels()['info']);
        $grid->column('price', Combination::labels()['price']);
        $grid->column('sort', Combination::labels()['sort']);
        $grid->column('sales', Combination::labels()['sales']);
        $grid->column('stock', Combination::labels()['stock']);
        $grid->column('add_time', Combination::labels()['add_time']);
        $grid->column('is_host', Combination::labels()['is_host']);
        $grid->column('is_show', Combination::labels()['is_show']);
        $grid->column('is_del', Combination::labels()['is_del']);
//        $grid->column('combination', Combination::labels()['combination']);
        $grid->column('mer_use', Combination::labels()['mer_use']);
        $grid->column('is_postage', Combination::labels()['is_postage']);
        $grid->column('postage', Combination::labels()['postage']);
        $grid->column('description', Combination::labels()['description']);
        $grid->column('start_time', Combination::labels()['start_time']);
        $grid->column('stop_time', Combination::labels()['stop_time']);
        $grid->column('effective_time', Combination::labels()['effective_time']);
        $grid->column('cost', Combination::labels()['cost']);
        $grid->column('browse', Combination::labels()['browse']);
        $grid->column('unit_name', Combination::labels()['unit_name']);

        return $grid;
    }

    protected function form($isEdit = false)
    {
        $form = new Form(new Combination);
        $form->className('m-15');
        $form->setEdit($isEdit);
        $form->item('id', Combination::labels()['id']);
        $form->item('product_id', Combination::labels()['product_id']);
        $form->item('mer_id', Combination::labels()['mer_id']);
        $form->item('image', Combination::labels()['image']);
        $form->item('images', Combination::labels()['images']);
        $form->item('title', Combination::labels()['title']);
        $form->item('attr', Combination::labels()['attr']);
        $form->item('people', Combination::labels()['people']);
        $form->item('info', Combination::labels()['info']);
        $form->item('price', Combination::labels()['price']);
        $form->item('sort', Combination::labels()['sort']);
        $form->item('sales', Combination::labels()['sales']);
        $form->item('stock', Combination::labels()['stock']);
        $form->item('add_time', Combination::labels()['add_time']);
        $form->item('is_host', Combination::labels()['is_host']);
        $form->item('is_show', Combination::labels()['is_show']);
        $form->item('is_del', Combination::labels()['is_del']);
//        $form->item('combination', Combination::labels()['combination']);
        $form->item('mer_use', Combination::labels()['mer_use']);
        $form->item('is_postage', Combination::labels()['is_postage']);
        $form->item('postage', Combination::labels()['postage']);
        $form->item('description', Combination::labels()['description']);
        $form->item('start_time', Combination::labels()['start_time']);
        $form->item('stop_time', Combination::labels()['stop_time']);
        $form->item('effective_time', Combination::labels()['effective_time']);
        $form->item('cost', Combination::labels()['cost']);
        $form->item('browse', Combination::labels()['browse']);
        $form->item('unit_name', Combination::labels()['unit_name']);

        return $form;
    }
}
