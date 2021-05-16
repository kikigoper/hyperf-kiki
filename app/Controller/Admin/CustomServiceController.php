<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Model\CustomService;
use HPlus\Admin\Controller\AbstractAdminController;
use HPlus\Route\Annotation\AdminController;
use HPlus\UI\Form;
use HPlus\UI\Grid;

/**
 * @AdminController(prefix="customservice", tag="客服列表", ignore=true))
 */
class CustomServiceController extends AbstractAdminController
{
    protected function grid()
    {
        $grid = new Grid(new CustomService);
        $grid->dialogForm($this->form()->isDialog(), '700px', ['添加', '编辑']);
        //$grid->hidePage(); //隐藏分页
        //$grid->hideActions(); //隐藏操作
        $grid->selection(); //多选
        $grid->defaultSort('id', 'desc'); // 默认id倒序
        $grid->className('m-15');
        $grid->column('id', CustomService::labels()['id']);
        $grid->column('wechat_name', CustomService::labels()['wechat_name']);
        $grid->column('image', CustomService::labels()['image']);
        $grid->column('name', CustomService::labels()['name']);
        $grid->column('status', CustomService::labels()['status']);
        $grid->column('created_at', CustomService::labels()['created_at']);
        $grid->column('updated_at', CustomService::labels()['updated_at']);
        $grid->export(function (Grid\Exporters\CsvExporter $export) {
            $export->filename('信息导出.csv');
        });

        return $grid;
    }

    protected function form($isEdit = false)
    {
        $form = new Form(new CustomService);
        $form->className('m-15');
        $form->setEdit($isEdit);
        $form->item('id', CustomService::labels()['id']);
        $form->item('wechat_name', CustomService::labels()['wechat_name']);
        $form->item('image', CustomService::labels()['image']);
        $form->item('name', CustomService::labels()['name']);
        $form->item('status', CustomService::labels()['status']);
        $form->item('created_at', CustomService::labels()['created_at']);
        $form->item('updated_at', CustomService::labels()['updated_at']);

        return $form;
    }
}
