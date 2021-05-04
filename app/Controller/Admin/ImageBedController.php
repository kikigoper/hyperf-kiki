<?php

declare(strict_types=1);

/**
 *图床管理
 */

namespace App\Controller\Admin;

use App\Model\ImageBed;
use HPlus\Admin\Controller\AbstractAdminController;
use HPlus\Route\Annotation\AdminController;
use HPlus\UI\Form;
use HPlus\UI\Grid;

/**
 * @AdminController(prefix="imagebed", tag="", ignore=true))
 */
class ImageBedController extends AbstractAdminController
{
    protected function grid()
    {
        $grid = new Grid(new ImageBed);
        $grid->dialogForm($this->form()->isDialog(), '700px', ['添加', '编辑']);
        //$grid->hidePage(); //隐藏分页
        //$grid->hideActions(); //隐藏操作
        $grid->selection(); //多选
        $grid->defaultSort('id', 'desc'); // 默认id倒序
        $grid->className('m-15');
        $grid->column('id', ImageBed::labels()['id']);
        $grid->column('title', ImageBed::labels()['title']);
        $grid->column('image', ImageBed::labels()['image']);

        return $grid;
    }

    protected function form($isEdit = false)
    {
        $form = new Form(new ImageBed);
        $form->className('m-15');
        $form->setEdit($isEdit);
        //$form->item('id', ImageBed::labels()['id']);
        $form->item('title', ImageBed::labels()['title']);
        $form->item('image', ImageBed::labels()['image']);

        return $form;
    }
}
