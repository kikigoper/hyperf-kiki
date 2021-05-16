<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Model\Seckill;
use HPlus\Admin\Controller\AbstractAdminController;
use HPlus\Route\Annotation\AdminController;
use HPlus\UI\Form;
use HPlus\UI\Grid;

/**
 * @AdminController(prefix="seckill", tag="秒杀管理", ignore=true))
 */
class SeckillController extends AbstractAdminController
{
    protected function grid()
    {
        $grid = new Grid(new Seckill);
        $grid->dialogForm($this->form()->isDialog(), '700px', ['添加', '编辑']);
        //$grid->hidePage(); //隐藏分页
        //$grid->hideActions(); //隐藏操作
        $grid->selection(); //多选
        $grid->defaultSort('id', 'desc'); // 默认id倒序
        $grid->className('m-15');
        $grid->column('id', Seckill::labels()['id']);
        $grid->column('product_id', Seckill::labels()['product_id']);
        $grid->column('image', Seckill::labels()['image']);
        $grid->column('images', Seckill::labels()['images']);
        $grid->column('title', Seckill::labels()['title']);
        $grid->column('info', Seckill::labels()['info']);
        $grid->column('price', Seckill::labels()['price']);
        $grid->column('cost', Seckill::labels()['cost']);
        $grid->column('ot_price', Seckill::labels()['ot_price']);
        $grid->column('give_integral', Seckill::labels()['give_integral']);
        $grid->column('sort', Seckill::labels()['sort']);
        $grid->column('stock', Seckill::labels()['stock']);
        $grid->column('sales', Seckill::labels()['sales']);
        $grid->column('unit_name', Seckill::labels()['unit_name']);
        $grid->column('postage', Seckill::labels()['postage']);
        $grid->column('description', Seckill::labels()['description']);
        $grid->column('start_time', Seckill::labels()['start_time']);
        $grid->column('stop_time', Seckill::labels()['stop_time']);
        $grid->column('add_time', Seckill::labels()['add_time']);
        $grid->column('status', Seckill::labels()['status']);
        $grid->column('is_postage', Seckill::labels()['is_postage']);
        $grid->column('is_hot', Seckill::labels()['is_hot']);
        $grid->column('is_del', Seckill::labels()['is_del']);
        $grid->column('num', Seckill::labels()['num']);
        $grid->column('is_show', Seckill::labels()['is_show']);

        return $grid;
    }

    protected function form($isEdit = false)
    {
        $form = new Form(new Seckill);
        $form->className('m-15');
        $form->setEdit($isEdit);
        $form->item('id', Seckill::labels()['id']);
        $form->item('product_id', Seckill::labels()['product_id']);
        $form->item('image', Seckill::labels()['image']);
        $form->item('images', Seckill::labels()['images']);
        $form->item('title', Seckill::labels()['title']);
        $form->item('info', Seckill::labels()['info']);
        $form->item('price', Seckill::labels()['price']);
        $form->item('cost', Seckill::labels()['cost']);
        $form->item('ot_price', Seckill::labels()['ot_price']);
        $form->item('give_integral', Seckill::labels()['give_integral']);
        $form->item('sort', Seckill::labels()['sort']);
        $form->item('stock', Seckill::labels()['stock']);
        $form->item('sales', Seckill::labels()['sales']);
        $form->item('unit_name', Seckill::labels()['unit_name']);
        $form->item('postage', Seckill::labels()['postage']);
        $form->item('description', Seckill::labels()['description']);
        $form->item('start_time', Seckill::labels()['start_time']);
        $form->item('stop_time', Seckill::labels()['stop_time']);
        $form->item('add_time', Seckill::labels()['add_time']);
        $form->item('status', Seckill::labels()['status']);
        $form->item('is_postage', Seckill::labels()['is_postage']);
        $form->item('is_hot', Seckill::labels()['is_hot']);
        $form->item('is_del', Seckill::labels()['is_del']);
        $form->item('num', Seckill::labels()['num']);
        $form->item('is_show', Seckill::labels()['is_show']);

        return $form;
    }
}
