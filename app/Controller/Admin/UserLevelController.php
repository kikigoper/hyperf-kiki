<?php 

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Model\UserLevel;
use HPlus\Admin\Controller\AbstractAdminController;
use HPlus\Route\Annotation\AdminController;
use HPlus\UI\Form;
use HPlus\UI\Grid;

/**
 * @AdminController(prefix="userlevel", tag="用户分组", ignore=true))
 */
class UserLevelController extends AbstractAdminController
{
	protected function grid()
	{
		$grid = new Grid(new UserLevel);
		$grid->dialogForm($this->form()->isDialog(),'700px',['添加','编辑']);
		//$grid->hidePage(); //隐藏分页
		//$grid->hideActions(); //隐藏操作
		$grid->selection(); //多选
		$grid->defaultSort('id', 'desc'); // 默认id倒序
		$grid->className('m-15');
		$grid->column('id', UserLevel::labels()['id']);
		$grid->column('uid', UserLevel::labels()['uid']);
		$grid->column('level_id', UserLevel::labels()['level_id']);
		$grid->column('grade', UserLevel::labels()['grade']);
		$grid->column('valid_time', UserLevel::labels()['valid_time']);
		$grid->column('is_forever', UserLevel::labels()['is_forever']);
		$grid->column('mer_id', UserLevel::labels()['mer_id']);
		$grid->column('status', UserLevel::labels()['status']);
		$grid->column('mark', UserLevel::labels()['mark']);
		$grid->column('remind', UserLevel::labels()['remind']);
		$grid->column('is_del', UserLevel::labels()['is_del']);
		$grid->column('add_time', UserLevel::labels()['add_time']);
		$grid->column('discount', UserLevel::labels()['discount']);
        $grid->export(function (Grid\Exporters\CsvExporter $export) {
            $export->filename('信息导出.csv');
        });

		return $grid;
	}

	protected function form($isEdit = false)
	{
		$form = new Form(new UserLevel);
		$form->className('m-15');
		$form->setEdit($isEdit);
		$form->item('id', UserLevel::labels()['id']);
		$form->item('uid', UserLevel::labels()['uid']);
		$form->item('level_id', UserLevel::labels()['level_id']);
		$form->item('grade', UserLevel::labels()['grade']);
		$form->item('valid_time', UserLevel::labels()['valid_time']);
		$form->item('is_forever', UserLevel::labels()['is_forever']);
		$form->item('mer_id', UserLevel::labels()['mer_id']);
		$form->item('status', UserLevel::labels()['status']);
		$form->item('mark', UserLevel::labels()['mark']);
		$form->item('remind', UserLevel::labels()['remind']);
		$form->item('is_del', UserLevel::labels()['is_del']);
		$form->item('add_time', UserLevel::labels()['add_time']);
		$form->item('discount', UserLevel::labels()['discount']);

		return $form;
	}
}
