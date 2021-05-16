<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Model\UserRecharge;
use HPlus\Admin\Controller\AbstractAdminController;
use HPlus\Route\Annotation\AdminController;
use HPlus\UI\Form;
use HPlus\UI\Grid;

/**
 * @AdminController(prefix="userrecharge", tag="用户充值", ignore=true))
 */
class UserRechargeController extends AbstractAdminController
{
    protected function grid()
    {
        $grid = new Grid(new UserRecharge);
        $grid->dialogForm($this->form()->isDialog(), '700px', ['添加', '编辑']);
        //$grid->hidePage(); //隐藏分页
        //$grid->hideActions(); //隐藏操作
        $grid->selection(); //多选
        $grid->defaultSort('id', 'desc'); // 默认id倒序
        $grid->className('m-15');
        $grid->column('id', UserRecharge::labels()['id']);
        $grid->column('uid', UserRecharge::labels()['uid']);
        $grid->column('order_id', UserRecharge::labels()['order_id']);
        $grid->column('price', UserRecharge::labels()['price']);
        $grid->column('recharge_type', UserRecharge::labels()['recharge_type']);
        $grid->column('paid', UserRecharge::labels()['paid']);
        $grid->column('pay_time', UserRecharge::labels()['pay_time']);
        $grid->column('add_time', UserRecharge::labels()['add_time']);
        $grid->column('refund_price', UserRecharge::labels()['refund_price']);
        $grid->export(function (Grid\Exporters\CsvExporter $export) {
            $export->filename('信息导出.csv');
        });

        return $grid;
    }

    protected function form($isEdit = false)
    {
        $form = new Form(new UserRecharge);
        $form->className('m-15');
        $form->setEdit($isEdit);
        $form->item('id', UserRecharge::labels()['id']);
        $form->item('uid', UserRecharge::labels()['uid']);
        $form->item('order_id', UserRecharge::labels()['order_id']);
        $form->item('price', UserRecharge::labels()['price']);
        $form->item('recharge_type', UserRecharge::labels()['recharge_type']);
        $form->item('paid', UserRecharge::labels()['paid']);
        $form->item('pay_time', UserRecharge::labels()['pay_time']);
        $form->item('add_time', UserRecharge::labels()['add_time']);
        $form->item('refund_price', UserRecharge::labels()['refund_price']);

        return $form;
    }
}
