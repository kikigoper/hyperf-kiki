<?php

declare(strict_types=1);

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
        $grid->dialogForm($this->form()->isDialog(),'700px',['添加','编辑']);
        //$grid->hidePage(); //隐藏分页
        //$grid->hideActions(); //隐藏操作
        $grid->selection(); //多选
        $grid->defaultSort('id', 'desc'); // 默认id倒序
        $grid->className('m-15');
        $grid->column('id', Order::labels()['id']);
        $grid->column('order_id', Order::labels()['order_id']);
        $grid->column('uid', Order::labels()['uid']);
        $grid->column('real_name', Order::labels()['real_name']);
        $grid->column('user_phone', Order::labels()['user_phone']);
        $grid->column('user_address', Order::labels()['user_address']);
        $grid->column('cart_id', Order::labels()['cart_id']);
        $grid->column('freight_price', Order::labels()['freight_price']);
        $grid->column('total_num', Order::labels()['total_num']);
        $grid->column('total_price', Order::labels()['total_price']);
        $grid->column('total_postage', Order::labels()['total_postage']);
        $grid->column('pay_price', Order::labels()['pay_price']);
        $grid->column('pay_postage', Order::labels()['pay_postage']);
        $grid->column('deduction_price', Order::labels()['deduction_price']);
        $grid->column('coupon_id', Order::labels()['coupon_id']);
        $grid->column('coupon_price', Order::labels()['coupon_price']);
        $grid->column('paid', Order::labels()['paid']);
        $grid->column('pay_time', Order::labels()['pay_time']);
        $grid->column('pay_type', Order::labels()['pay_type']);
        $grid->column('add_time', Order::labels()['add_time']);
        $grid->column('status', Order::labels()['status']);
        $grid->column('refund_status', Order::labels()['refund_status']);
        $grid->column('refund_reason_wap_img', Order::labels()['refund_reason_wap_img']);
        $grid->column('refund_reason_wap_explain', Order::labels()['refund_reason_wap_explain']);
        $grid->column('refund_reason_time', Order::labels()['refund_reason_time']);
        $grid->column('refund_reason_wap', Order::labels()['refund_reason_wap']);
        $grid->column('refund_reason', Order::labels()['refund_reason']);
        $grid->column('refund_price', Order::labels()['refund_price']);
        $grid->column('delivery_name', Order::labels()['delivery_name']);
        $grid->column('delivery_type', Order::labels()['delivery_type']);
        $grid->column('delivery_id', Order::labels()['delivery_id']);
        $grid->column('gain_integral', Order::labels()['gain_integral']);
        $grid->column('use_integral', Order::labels()['use_integral']);
        $grid->column('back_integral', Order::labels()['back_integral']);
        $grid->column('mark', Order::labels()['mark']);
        $grid->column('is_del', Order::labels()['is_del']);
        $grid->column('unique', Order::labels()['unique']);
        $grid->column('remark', Order::labels()['remark']);
        $grid->column('mer_id', Order::labels()['mer_id']);
        $grid->column('is_mer_check', Order::labels()['is_mer_check']);
        $grid->column('combination_id', Order::labels()['combination_id']);
        $grid->column('pink_id', Order::labels()['pink_id']);
        $grid->column('cost', Order::labels()['cost']);
        $grid->column('seckill_id', Order::labels()['seckill_id']);
        $grid->column('bargain_id', Order::labels()['bargain_id']);
        $grid->column('verify_code', Order::labels()['verify_code']);
        $grid->column('store_id', Order::labels()['store_id']);
        $grid->column('shipping_type', Order::labels()['shipping_type']);
        $grid->column('is_channel', Order::labels()['is_channel']);
        $grid->column('is_remind', Order::labels()['is_remind']);
        $grid->column('is_system_del', Order::labels()['is_system_del']);

        return $grid;
    }

    protected function form($isEdit = false)
    {
        $form = new Form(new Order);
        $form->className('m-15');
        $form->setEdit($isEdit);
        $form->item('id', Order::labels()['id']);
        $form->item('order_id', Order::labels()['order_id']);
        $form->item('uid', Order::labels()['uid']);
        $form->item('real_name', Order::labels()['real_name']);
        $form->item('user_phone', Order::labels()['user_phone']);
        $form->item('user_address', Order::labels()['user_address']);
        $form->item('cart_id', Order::labels()['cart_id']);
        $form->item('freight_price', Order::labels()['freight_price']);
        $form->item('total_num', Order::labels()['total_num']);
        $form->item('total_price', Order::labels()['total_price']);
        $form->item('total_postage', Order::labels()['total_postage']);
        $form->item('pay_price', Order::labels()['pay_price']);
        $form->item('pay_postage', Order::labels()['pay_postage']);
        $form->item('deduction_price', Order::labels()['deduction_price']);
        $form->item('coupon_id', Order::labels()['coupon_id']);
        $form->item('coupon_price', Order::labels()['coupon_price']);
        $form->item('paid', Order::labels()['paid']);
        $form->item('pay_time', Order::labels()['pay_time']);
        $form->item('pay_type', Order::labels()['pay_type']);
        $form->item('add_time', Order::labels()['add_time']);
        $form->item('status', Order::labels()['status']);
        $form->item('refund_status', Order::labels()['refund_status']);
        $form->item('refund_reason_wap_img', Order::labels()['refund_reason_wap_img']);
        $form->item('refund_reason_wap_explain', Order::labels()['refund_reason_wap_explain']);
        $form->item('refund_reason_time', Order::labels()['refund_reason_time']);
        $form->item('refund_reason_wap', Order::labels()['refund_reason_wap']);
        $form->item('refund_reason', Order::labels()['refund_reason']);
        $form->item('refund_price', Order::labels()['refund_price']);
        $form->item('delivery_name', Order::labels()['delivery_name']);
        $form->item('delivery_type', Order::labels()['delivery_type']);
        $form->item('delivery_id', Order::labels()['delivery_id']);
        $form->item('gain_integral', Order::labels()['gain_integral']);
        $form->item('use_integral', Order::labels()['use_integral']);
        $form->item('back_integral', Order::labels()['back_integral']);
        $form->item('mark', Order::labels()['mark']);
        $form->item('is_del', Order::labels()['is_del']);
        $form->item('unique', Order::labels()['unique']);
        $form->item('remark', Order::labels()['remark']);
        $form->item('mer_id', Order::labels()['mer_id']);
        $form->item('is_mer_check', Order::labels()['is_mer_check']);
        $form->item('combination_id', Order::labels()['combination_id']);
        $form->item('pink_id', Order::labels()['pink_id']);
        $form->item('cost', Order::labels()['cost']);
        $form->item('seckill_id', Order::labels()['seckill_id']);
        $form->item('bargain_id', Order::labels()['bargain_id']);
        $form->item('verify_code', Order::labels()['verify_code']);
        $form->item('store_id', Order::labels()['store_id']);
        $form->item('shipping_type', Order::labels()['shipping_type']);
        $form->item('is_channel', Order::labels()['is_channel']);
        $form->item('is_remind', Order::labels()['is_remind']);
        $form->item('is_system_del', Order::labels()['is_system_del']);

        return $form;
    }
}
