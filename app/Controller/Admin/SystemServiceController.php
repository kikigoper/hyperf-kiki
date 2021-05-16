<?php 

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Model\SystemService;
use HPlus\Admin\Controller\AbstractAdminController;
use HPlus\Route\Annotation\AdminController;
use HPlus\UI\Form;
use HPlus\UI\Grid;

/**
 * @AdminController(prefix="systemservice", tag="系统服务", ignore=true))
 */
class SystemServiceController extends AbstractAdminController
{
	protected function grid()
	{
		$grid = new Grid(new SystemService);
		$grid->dialogForm($this->form()->isDialog(),'700px',['添加','编辑']);
		//$grid->hidePage(); //隐藏分页
		//$grid->hideActions(); //隐藏操作
		$grid->selection(); //多选
		$grid->defaultSort('id', 'desc'); // 默认id倒序
		$grid->className('m-15');
		$grid->column('id', SystemService::labels()['id']);
		$grid->column('type', SystemService::labels()['type']);
		$grid->column('value', SystemService::labels()['value']);
        $grid->export(function (Grid\Exporters\CsvExporter $export) {
            $export->filename('信息导出.csv');
        });

		return $grid;
	}

	protected function form($isEdit = false)
	{
		$form = new Form(new SystemService);
		$form->className('m-15');
		$form->setEdit($isEdit);
		$form->item('id', SystemService::labels()['id']);
		$form->item('type', SystemService::labels()['type']);
		$form->item('value', SystemService::labels()['value']);

		return $form;
	}
}
