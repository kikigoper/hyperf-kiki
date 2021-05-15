<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Model\ProductReply;
use HPlus\Admin\Controller\AbstractAdminController;
use HPlus\Route\Annotation\AdminController;
use HPlus\UI\Form;
use HPlus\UI\Grid;

/**
 * @AdminController(prefix="productreply", tag="商品评价", ignore=true))
 */
class ProductReplyController extends AbstractAdminController
{
    protected function grid()
    {
        $grid = new Grid(new ProductReply);
        $grid->dialogForm($this->form()->isDialog(),'700px',['添加','编辑']);
        //$grid->hidePage(); //隐藏分页
        //$grid->hideActions(); //隐藏操作
        $grid->selection(); //多选
        $grid->defaultSort('id', 'desc'); // 默认id倒序
        $grid->className('m-15');
        $grid->column('id', ProductReply::labels()['id']);
        $grid->column('uid', ProductReply::labels()['uid']);
        $grid->column('oid', ProductReply::labels()['oid']);
        $grid->column('unique', ProductReply::labels()['unique']);
        $grid->column('product_id', ProductReply::labels()['product_id']);
        $grid->column('reply_type', ProductReply::labels()['reply_type']);
        $grid->column('product_score', ProductReply::labels()['product_score']);
        $grid->column('service_score', ProductReply::labels()['service_score']);
        $grid->column('comment', ProductReply::labels()['comment']);
        $grid->column('pics', ProductReply::labels()['pics']);
        $grid->column('add_time', ProductReply::labels()['add_time']);
        $grid->column('merchant_reply_content', ProductReply::labels()['merchant_reply_content']);
        $grid->column('merchant_reply_time', ProductReply::labels()['merchant_reply_time']);
        $grid->column('is_del', ProductReply::labels()['is_del']);
        $grid->column('is_reply', ProductReply::labels()['is_reply']);

        return $grid;
    }


    protected function form($isEdit = false)
    {
        $form = new Form(new ProductReply);
        $form->className('m-15');
        $form->setEdit($isEdit);
        $form->item('id', ProductReply::labels()['id']);
        $form->item('uid', ProductReply::labels()['uid']);
        $form->item('oid', ProductReply::labels()['oid']);
        $form->item('unique', ProductReply::labels()['unique']);
        $form->item('product_id', ProductReply::labels()['product_id']);
        $form->item('reply_type', ProductReply::labels()['reply_type']);
        $form->item('product_score', ProductReply::labels()['product_score']);
        $form->item('service_score', ProductReply::labels()['service_score']);
        $form->item('comment', ProductReply::labels()['comment']);
        $form->item('pics', ProductReply::labels()['pics']);
        $form->item('add_time', ProductReply::labels()['add_time']);
        $form->item('merchant_reply_content', ProductReply::labels()['merchant_reply_content']);
        $form->item('merchant_reply_time', ProductReply::labels()['merchant_reply_time']);
        $form->item('is_del', ProductReply::labels()['is_del']);
        $form->item('is_reply', ProductReply::labels()['is_reply']);

        return $form;
    }
}
