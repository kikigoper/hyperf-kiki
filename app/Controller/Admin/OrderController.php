<?php

declare(strict_types=1);

/**
 *模块管理
 */

namespace App\Controller\Admin;

use App\Model\Order;
use HPlus\Admin\Controller\AbstractAdminController;
use HPlus\Route\Annotation\AdminController;
use HPlus\UI\Form;
use HPlus\UI\Grid;

/**
 * @AdminController(prefix="order", tag="订单管理", ignore=true))
 */
class OrderController extends AbstractAdminController
{
    protected function grid()
    {
        $grid = new Grid(new Order);
        $grid->dialogForm($this->form()->isDialog(), '700px', ['创建标题', '编辑标题']);
        //$grid->toolbars(function (Grid\Toolbars $toolbars) {
        //    $toolbars->hideCreateButton();
        //});
        //$grid->hidePage(); //隐藏分页
        //$grid->hideActions(); //隐藏操作
        $grid->selection(); //多选
        $grid->defaultSort('id', 'desc'); // 默认id倒序
        $grid->className('m-15');
        $grid->column('id', Order::labels()['id']);
        $grid->column('user_id', Order::labels()['user_id']);
        $grid->column('order_no', Order::labels()['order_no']);
        $grid->column('title', Order::labels()['title']);
        $grid->column('goods_id', Order::labels()['goods_id']);
        //$grid->column('from_mid', Order::labels()['from_mid']);
        //$grid->column('price_total', Order::labels()['price_total']);
        //$grid->column('price_goods', Order::labels()['price_goods']);
        $grid->column('status', Order::labels()['status']);
        $grid->column('pay_status', Order::labels()['pay_status']);
        $grid->column('pay_price', Order::labels()['pay_price']);
        $grid->column('pay_type', Order::labels()['pay_type']);
        $grid->column('pay_no', Order::labels()['pay_no']);
        $grid->column('pay_at', Order::labels()['pay_at']);
        $grid->column('delivery_type', Order::labels()['delivery_type']);
        //$grid->column('cancel_at', Order::labels()['cancel_at']);
        //$grid->column('cancel_desc', Order::labels()['cancel_desc']);
        //$grid->column('type', Order::labels()['type']);
        $grid->column('delivery_at', Order::labels()['delivery_at']);
        //$grid->column('refund_no', Order::labels()['refund_no']);
        //$grid->column('refund_price', Order::labels()['refund_price']);
        //$grid->column('refund_desc', Order::labels()['refund_desc']);
        //$grid->column('out_transaction_id', Order::labels()['out_transaction_id']);
        //$grid->column('out_status', Order::labels()['out_status']);
        $grid->column('express_at', Order::labels()['express_at']);
        $grid->column('express_no', Order::labels()['express_no']);
        $grid->column('express_company', Order::labels()['express_company']);
        $grid->column('address_id', Order::labels()['address_id']);
        //$grid->column('transaction_id', Order::labels()['transaction_id']);
        //$grid->column('is_deleted', Order::labels()['is_deleted']);
        $grid->column('create_at', Order::labels()['create_at']);
        //$grid->column('update_at', Order::labels()['update_at']);
        $grid->export(function (Grid\Exporters\CsvExporter $export) {
            $export->filename('订单信息导出.csv');
        });

        return $grid;
    }

    protected function form($isEdit = false)
    {
        $form = new Form(new Order);
        $form->className('m-15');
        $form->setEdit($isEdit);
        $form->item('id', Order::labels()['id']);
        $form->item('user_id', Order::labels()['user_id']);
        $form->item('order_no', Order::labels()['order_no']);
        $form->item('from_mid', Order::labels()['from_mid']);
        $form->item('price_total', Order::labels()['price_total']);
        $form->item('price_goods', Order::labels()['price_goods']);
        $form->item('pay_status', Order::labels()['pay_status']);
        $form->item('pay_type', Order::labels()['pay_type']);
        $form->item('pay_price', Order::labels()['pay_price']);
        $form->item('pay_no', Order::labels()['pay_no']);
        $form->item('pay_at', Order::labels()['pay_at']);
        $form->item('delivery_type', Order::labels()['delivery_type']);
        $form->item('cancel_at', Order::labels()['cancel_at']);
        $form->item('cancel_desc', Order::labels()['cancel_desc']);
        $form->item('type', Order::labels()['type']);
        $form->item('delivery_at', Order::labels()['delivery_at']);
        $form->item('refund_no', Order::labels()['refund_no']);
        $form->item('refund_price', Order::labels()['refund_price']);
        $form->item('out_transaction_id', Order::labels()['out_transaction_id']);
        $form->item('refund_desc', Order::labels()['refund_desc']);
        $form->item('out_status', Order::labels()['out_status']);
        $form->item('express_at', Order::labels()['express_at']);
        $form->item('express_no', Order::labels()['express_no']);
        $form->item('express_company', Order::labels()['express_company']);
        $form->item('title', Order::labels()['title']);
        $form->item('goods_id', Order::labels()['goods_id']);
        $form->item('address_id', Order::labels()['address_id']);
        $form->item('transaction_id', Order::labels()['transaction_id']);
        $form->item('status', Order::labels()['status']);
        $form->item('is_deleted', Order::labels()['is_deleted']);
        $form->item('create_at', Order::labels()['create_at']);
        $form->item('update_at', Order::labels()['update_at']);

        return $form;
    }
}
