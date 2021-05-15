<?php

declare(strict_types=1);

/**
 *优惠券模块管理
 */

namespace App\Controller\Admin;

use App\Model\Coupon;
use HPlus\Admin\Controller\AbstractAdminController;
use HPlus\Route\Annotation\AdminController;
use HPlus\UI\Form;
use HPlus\UI\Grid;

/**
 * @AdminController(prefix="coupon", tag="优惠券", ignore=true))
 */
class CouponController extends AbstractAdminController
{
    protected function grid()
    {
        $grid = new Grid(new Coupon);
        $grid->dialogForm($this->form()->isDialog(), '700px', ['添加', '编辑']);
        //$grid->hidePage(); //隐藏分页
        //$grid->hideActions(); //隐藏操作
        $grid->selection(); //多选
        $grid->defaultSort('id', 'desc'); // 默认id倒序
        $grid->className('m-15');
        $grid->column('id', Coupon::labels()['id']);
        $grid->column('title', Coupon::labels()['title']);
        $grid->column('icon', Coupon::labels()['icon']);
        //$grid->column('used', Coupon::labels()['used']);
        $grid->column('type', Coupon::labels()['type']);
        //$grid->column('with_special', Coupon::labels()['with_special']);
        $grid->column('with_sn', Coupon::labels()['with_sn']);
        $grid->column('with_amount', Coupon::labels()['with_amount']);
        $grid->column('used_amount', Coupon::labels()['used_amount']);
        $grid->column('quota', Coupon::labels()['quota']);
        $grid->column('take_count', Coupon::labels()['take_count']);
        $grid->column('used_count', Coupon::labels()['used_count']);
        $grid->column('start_time', Coupon::labels()['start_time']);
        $grid->column('end_time', Coupon::labels()['end_time']);
        $grid->column('valid_type', Coupon::labels()['valid_type']);
        $grid->column('valid_start_time', Coupon::labels()['valid_start_time']);
        $grid->column('valid_end_time', Coupon::labels()['valid_end_time']);
        $grid->column('valid_days', Coupon::labels()['valid_days']);
        $grid->column('get_type', Coupon::labels()['get_type']);
        $grid->column('status', Coupon::labels()['status']);
        $grid->column('create_user', Coupon::labels()['create_user']);
        $grid->column('create_time', Coupon::labels()['create_time']);
        //$grid->column('update_user', Coupon::labels()['update_user']);
        //$grid->column('update_time', Coupon::labels()['update_time']);
        $grid->export(function (Grid\Exporters\CsvExporter $export) {
            $export->filename('优惠券信息导出.csv');
        });

        return $grid;
    }


    protected function form($isEdit = false)
    {
        $form = new Form(new Coupon);
        $form->className('m-15');
        $form->setEdit($isEdit);
        //$form->item('id', Coupon::labels()['id']);
        $form->item('title', Coupon::labels()['title']);
        $form->item('icon', Coupon::labels()['icon']);
        $form->item('used', Coupon::labels()['used']);
        $form->item('type', Coupon::labels()['type']);
        $form->item('with_special', Coupon::labels()['with_special']);
        $form->item('with_sn', Coupon::labels()['with_sn']);
        $form->item('with_amount', Coupon::labels()['with_amount']);
        $form->item('used_amount', Coupon::labels()['used_amount']);
        $form->item('quota', Coupon::labels()['quota']);
        $form->item('take_count', Coupon::labels()['take_count']);
        $form->item('used_count', Coupon::labels()['used_count']);
        $form->item('start_time', Coupon::labels()['start_time']);
        $form->item('end_time', Coupon::labels()['end_time']);
        $form->item('valid_type', Coupon::labels()['valid_type']);
        $form->item('valid_start_time', Coupon::labels()['valid_start_time']);
        $form->item('valid_end_time', Coupon::labels()['valid_end_time']);
        $form->item('valid_days', Coupon::labels()['valid_days']);
        $form->item('get_type', Coupon::labels()['get_type']);
        $form->item('status', Coupon::labels()['status']);
        $form->item('create_user', Coupon::labels()['create_user']);
        $form->item('create_time', Coupon::labels()['create_time']);
        $form->item('update_user', Coupon::labels()['update_user']);
        $form->item('update_time', Coupon::labels()['update_time']);

        return $form;
    }
}
