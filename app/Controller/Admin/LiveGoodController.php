<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Model\LiveGood;
use HPlus\Admin\Controller\AbstractAdminController;
use HPlus\Route\Annotation\AdminController;
use HPlus\UI\Form;
use HPlus\UI\Grid;

/**
 * @AdminController(prefix="livegood", tag="直播商品", ignore=true))
 */
class LiveGoodController extends AbstractAdminController
{
    protected function grid()
    {
        $grid = new Grid(new LiveGood);
        $grid->dialogForm($this->form()->isDialog(), '700px', ['添加', '编辑']);
        //$grid->hidePage(); //隐藏分页
        //$grid->hideActions(); //隐藏操作
        $grid->selection(); //多选
        $grid->defaultSort('id', 'desc'); // 默认id倒序
        $grid->className('m-15');
        $grid->column('id', LiveGood::labels()['id']);
        $grid->column('goods_id', LiveGood::labels()['goods_id']);
        $grid->column('goods_name', LiveGood::labels()['goods_name']);
        $grid->column('live_price', LiveGood::labels()['live_price']);
        $grid->column('ori_price', LiveGood::labels()['ori_price']);
        $grid->column('stock', LiveGood::labels()['stock']);
        $grid->column('status', LiveGood::labels()['status']);
        $grid->column('show_status', LiveGood::labels()['show_status']);
        $grid->export(function (Grid\Exporters\CsvExporter $export) {
            $export->filename('信息导出.csv');
        });

        return $grid;
    }

    protected function form($isEdit = false)
    {
        $form = new Form(new LiveGood);
        $form->className('m-15');
        $form->setEdit($isEdit);
        $form->item('id', LiveGood::labels()['id']);
        $form->item('goods_id', LiveGood::labels()['goods_id']);
        $form->item('goods_name', LiveGood::labels()['goods_name']);
        $form->item('live_price', LiveGood::labels()['live_price']);
        $form->item('ori_price', LiveGood::labels()['ori_price']);
        $form->item('stock', LiveGood::labels()['stock']);
        $form->item('status', LiveGood::labels()['status']);
        $form->item('show_status', LiveGood::labels()['show_status']);

        return $form;
    }
}
