<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Model\Express;
use HPlus\Admin\Controller\AbstractAdminController;
use HPlus\Route\Annotation\AdminController;
use HPlus\UI\Form;
use HPlus\UI\Grid;

/**
 * @AdminController(prefix="express", tag="物流公司", ignore=true))
 */
class ExpressController extends AbstractAdminController
{
    protected function grid()
    {
        $grid = new Grid(new Express);
        $grid->dialogForm($this->form()->isDialog(), '700px', ['添加', '编辑']);
        //$grid->hidePage(); //隐藏分页
        //$grid->hideActions(); //隐藏操作
        $grid->selection(); //多选
        $grid->defaultSort('id', 'desc'); // 默认id倒序
        $grid->className('m-15');
        $grid->column('id', Express::labels()['id']);
        $grid->column('code', Express::labels()['code']);
        $grid->column('name', Express::labels()['name']);
        $grid->column('sort', Express::labels()['sort']);
        $grid->column('is_show', Express::labels()['is_show']);

        return $grid;
    }


    protected function form($isEdit = false)
    {
        $form = new Form(new Express);
        $form->className('m-15');
        $form->setEdit($isEdit);
        $form->item('id', Express::labels()['id']);
        $form->item('code', Express::labels()['code']);
        $form->item('name', Express::labels()['name']);
        $form->item('sort', Express::labels()['sort']);
        $form->item('is_show', Express::labels()['is_show']);

        return $form;
    }
}
