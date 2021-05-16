<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Model\SeeAlso;
use HPlus\Admin\Controller\AbstractAdminController;
use HPlus\Route\Annotation\AdminController;
use HPlus\UI\Form;
use HPlus\UI\Grid;

/**
 * @AdminController(prefix="seealso", tag="砍价管理", ignore=true))
 */
class SeeAlsoController extends AbstractAdminController
{
    protected function grid()
    {
        $grid = new Grid(new SeeAlso);
        $grid->dialogForm($this->form()->isDialog(), '700px', ['添加', '编辑']);
        //$grid->hidePage(); //隐藏分页
        //$grid->hideActions(); //隐藏操作
        $grid->selection(); //多选
        $grid->defaultSort('id', 'desc'); // 默认id倒序
        $grid->className('m-15');
        $grid->column('id', SeeAlso::labels()['id']);
        $grid->column('goods_id', SeeAlso::labels()['goods_id']);
        $grid->column('goods_name', SeeAlso::labels()['goods_name']);
        $grid->column('price', SeeAlso::labels()['price']);
        $grid->column('min_price', SeeAlso::labels()['min_price']);
        $grid->column('total_num', SeeAlso::labels()['total_num']);
        $grid->column('help_num', SeeAlso::labels()['help_num']);
        $grid->column('success_num', SeeAlso::labels()['success_num']);
        $grid->column('limit_num', SeeAlso::labels()['limit_num']);
        $grid->column('residue_num', SeeAlso::labels()['residue_num']);
        $grid->column('status', SeeAlso::labels()['status']);
        $grid->column('end_time', SeeAlso::labels()['end_time']);
        $grid->column('sale_status', SeeAlso::labels()['sale_status']);

        return $grid;
    }

    protected function form($isEdit = false)
    {
        $form = new Form(new SeeAlso);
        $form->className('m-15');
        $form->setEdit($isEdit);
        $form->item('id', SeeAlso::labels()['id']);
        $form->item('goods_id', SeeAlso::labels()['goods_id']);
        $form->item('goods_name', SeeAlso::labels()['goods_name']);
        $form->item('price', SeeAlso::labels()['price']);
        $form->item('min_price', SeeAlso::labels()['min_price']);
        $form->item('total_num', SeeAlso::labels()['total_num']);
        $form->item('help_num', SeeAlso::labels()['help_num']);
        $form->item('success_num', SeeAlso::labels()['success_num']);
        $form->item('limit_num', SeeAlso::labels()['limit_num']);
        $form->item('residue_num', SeeAlso::labels()['residue_num']);
        $form->item('status', SeeAlso::labels()['status']);
        $form->item('end_time', SeeAlso::labels()['end_time']);
        $form->item('sale_status', SeeAlso::labels()['sale_status']);

        return $form;
    }
}
