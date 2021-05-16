<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Model\CustomSc;
use HPlus\Admin\Controller\AbstractAdminController;
use HPlus\Route\Annotation\AdminController;
use HPlus\UI\Form;
use HPlus\UI\Grid;

/**
 * @AdminController(prefix="customsc", tag="客服话术", ignore=true))
 */
class CustomScController extends AbstractAdminController
{
    protected function grid()
    {
        $grid = new Grid(new CustomSc);
        $grid->dialogForm($this->form()->isDialog(), '700px', ['添加', '编辑']);
        //$grid->hidePage(); //隐藏分页
        //$grid->hideActions(); //隐藏操作
        $grid->selection(); //多选
        $grid->defaultSort('id', 'desc'); // 默认id倒序
        $grid->className('m-15');
        $grid->column('id', CustomSc::labels()['id']);
        $grid->column('content', CustomSc::labels()['content']);
        $grid->column('sort', CustomSc::labels()['sort']);
        $grid->column('created_at', CustomSc::labels()['created_at']);
        $grid->column('updated_at', CustomSc::labels()['updated_at']);
        $grid->export(function (Grid\Exporters\CsvExporter $export) {
            $export->filename('信息导出.csv');
        });

        return $grid;
    }

    protected function form($isEdit = false)
    {
        $form = new Form(new CustomSc);
        $form->className('m-15');
        $form->setEdit($isEdit);
        $form->item('id', CustomSc::labels()['id']);
        $form->item('content', CustomSc::labels()['content']);
        $form->item('sort', CustomSc::labels()['sort']);
        $form->item('created_at', CustomSc::labels()['created_at']);
        $form->item('updated_at', CustomSc::labels()['updated_at']);

        return $form;
    }
}
