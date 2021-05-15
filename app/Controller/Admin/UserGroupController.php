<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Model\UserGroup;
use HPlus\Admin\Controller\AbstractAdminController;
use HPlus\Route\Annotation\AdminController;
use HPlus\UI\Form;
use HPlus\UI\Grid;

/**
 * @AdminController(prefix="usergroup", tag="用户分组", ignore=true))
 */
class UserGroupController extends AbstractAdminController
{
    protected function grid()
    {
        $grid = new Grid(new UserGroup);
        $grid->dialogForm($this->form()->isDialog(), '700px', ['添加', '编辑']);
        //$grid->hidePage(); //隐藏分页
        //$grid->hideActions(); //隐藏操作
        $grid->selection(); //多选
        $grid->defaultSort('id', 'desc'); // 默认id倒序
        $grid->className('m-15');
        $grid->column('id', UserGroup::labels()['id']);
        $grid->column('group_name', UserGroup::labels()['group_name']);

        return $grid;
    }


    protected function form($isEdit = false)
    {
        $form = new Form(new UserGroup);
        $form->className('m-15');
        $form->setEdit($isEdit);
        $form->item('id', UserGroup::labels()['id']);
        $form->item('group_name', UserGroup::labels()['group_name']);

        return $form;
    }
}
