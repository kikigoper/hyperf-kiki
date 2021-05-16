<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Model\UserAddress;
use HPlus\Admin\Controller\AbstractAdminController;
use HPlus\Route\Annotation\AdminController;
use HPlus\UI\Form;
use HPlus\UI\Grid;

/**
 * @AdminController(prefix="useraddress", tag="用户地址", ignore=true))
 */
class UserAddressController extends AbstractAdminController
{
    protected function grid()
    {
        $grid = new Grid(new UserAddress);
        $grid->dialogForm($this->form()->isDialog(), '700px', ['添加', '编辑']);
        //$grid->hidePage(); //隐藏分页
        //$grid->hideActions(); //隐藏操作
        $grid->selection(); //多选
        $grid->defaultSort('id', 'desc'); // 默认id倒序
        $grid->className('m-15');
        $grid->column('address_id', UserAddress::labels()['address_id']);
        $grid->column('user_id', UserAddress::labels()['user_id']);
        $grid->column('real_name', UserAddress::labels()['real_name']);
        $grid->column('phone', UserAddress::labels()['phone']);
        $grid->column('province', UserAddress::labels()['province']);
        $grid->column('city', UserAddress::labels()['city']);
        $grid->column('city_id', UserAddress::labels()['city_id']);
        $grid->column('district', UserAddress::labels()['district']);
        $grid->column('detail', UserAddress::labels()['detail']);
        $grid->column('post_code', UserAddress::labels()['post_code']);
        $grid->column('longitude', UserAddress::labels()['longitude']);
        $grid->column('latitude', UserAddress::labels()['latitude']);
        $grid->column('is_default', UserAddress::labels()['is_default']);
        $grid->column('is_del', UserAddress::labels()['is_del']);
        $grid->column('created_at', UserAddress::labels()['created_at']);
        $grid->column('updated_at', UserAddress::labels()['updated_at']);

        return $grid;
    }

    protected function form($isEdit = false)
    {
        $form = new Form(new UserAddress);
        $form->className('m-15');
        $form->setEdit($isEdit);
        $form->item('address_id', UserAddress::labels()['address_id']);
        $form->item('user_id', UserAddress::labels()['user_id']);
        $form->item('real_name', UserAddress::labels()['real_name']);
        $form->item('phone', UserAddress::labels()['phone']);
        $form->item('province', UserAddress::labels()['province']);
        $form->item('city', UserAddress::labels()['city']);
        $form->item('city_id', UserAddress::labels()['city_id']);
        $form->item('district', UserAddress::labels()['district']);
        $form->item('detail', UserAddress::labels()['detail']);
        $form->item('post_code', UserAddress::labels()['post_code']);
        $form->item('longitude', UserAddress::labels()['longitude']);
        $form->item('latitude', UserAddress::labels()['latitude']);
        $form->item('is_default', UserAddress::labels()['is_default']);
        $form->item('is_del', UserAddress::labels()['is_del']);
        $form->item('created_at', UserAddress::labels()['created_at']);
        $form->item('updated_at', UserAddress::labels()['updated_at']);

        return $form;
    }
}
