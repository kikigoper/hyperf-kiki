<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Model\LiveUser;
use HPlus\Admin\Controller\AbstractAdminController;
use HPlus\Route\Annotation\AdminController;
use HPlus\UI\Form;
use HPlus\UI\Grid;

/**
 * @AdminController(prefix="liveuser", tag="主播管理", ignore=true))
 */
class LiveUserController extends AbstractAdminController
{
    protected function grid()
    {
        $grid = new Grid(new LiveUser);
        $grid->dialogForm($this->form()->isDialog(), '700px', ['添加', '编辑']);
        //$grid->hidePage(); //隐藏分页
        //$grid->hideActions(); //隐藏操作
        $grid->selection(); //多选
        $grid->defaultSort('id', 'desc'); // 默认id倒序
        $grid->className('m-15');
        $grid->column('id', LiveUser::labels()['id']);
        $grid->column('live_user_name', LiveUser::labels()['live_user_name']);
        $grid->column('live_wechat', LiveUser::labels()['live_wechat']);
        $grid->column('live_phone', LiveUser::labels()['live_phone']);
        $grid->column('live_image', LiveUser::labels()['live_image']);
        $grid->export(function (Grid\Exporters\CsvExporter $export) {
            $export->filename('信息导出.csv');
        });

        return $grid;
    }

    protected function form($isEdit = false)
    {
        $form = new Form(new LiveUser);
        $form->className('m-15');
        $form->setEdit($isEdit);
        $form->item('id', LiveUser::labels()['id']);
        $form->item('live_user_name', LiveUser::labels()['live_user_name']);
        $form->item('live_wechat', LiveUser::labels()['live_wechat']);
        $form->item('live_phone', LiveUser::labels()['live_phone']);
        $form->item('live_image', LiveUser::labels()['live_image']);

        return $form;
    }
}
