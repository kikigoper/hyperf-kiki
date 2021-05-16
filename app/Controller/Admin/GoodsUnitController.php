<?php 

declare(strict_types=1);
/**
 * 商品单位模块
 */

namespace App\Controller\Admin;

use App\Model\GoodsUnit;
use HPlus\Admin\Controller\AbstractAdminController;
use HPlus\Route\Annotation\AdminController;
use HPlus\UI\Form;
use HPlus\UI\Grid;

/**
 * @AdminController(prefix="goodsunit", tag="商品单位", ignore=true))
 */
class GoodsUnitController extends AbstractAdminController
{
	protected function grid()
	{
		$grid = new Grid(new GoodsUnit);
		$grid->dialogForm($this->form()->isDialog(),'700px',['单位添加','单位编辑']);
		//$grid->hidePage(); //隐藏分页
		//$grid->hideActions(); //隐藏操作
		$grid->selection(); //多选
		$grid->defaultSort('id', 'desc'); // 默认id倒序
		$grid->className('m-15');
		$grid->column('id', GoodsUnit::labels()['id']);
		$grid->column('unit_name', GoodsUnit::labels()['unit_name']);
        $grid->export(function (Grid\Exporters\CsvExporter $export) {
            $export->filename('信息导出.csv');
        });

		return $grid;
	}

	protected function form($isEdit = false)
	{
		$form = new Form(new GoodsUnit);
		$form->className('m-15');
		$form->setEdit($isEdit);
		$form->item('unit_name', GoodsUnit::labels()['unit_name']);

		return $form;
	}

}
