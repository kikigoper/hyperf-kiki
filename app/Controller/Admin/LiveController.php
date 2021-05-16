<?php 

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Model\Live;
use HPlus\Admin\Controller\AbstractAdminController;
use HPlus\Route\Annotation\AdminController;
use HPlus\UI\Form;
use HPlus\UI\Grid;

/**
 * @AdminController(prefix="live", tag="直播间", ignore=true))
 */
class LiveController extends AbstractAdminController
{
	protected function grid()
	{
		$grid = new Grid(new Live);
		$grid->dialogForm($this->form()->isDialog(),'700px',['添加','编辑']);
		//$grid->hidePage(); //隐藏分页
		//$grid->hideActions(); //隐藏操作
		$grid->selection(); //多选
		$grid->defaultSort('id', 'desc'); // 默认id倒序
		$grid->className('m-15');
		$grid->column('id', Live::labels()['id']);
		$grid->column('name', Live::labels()['name']);
		$grid->column('live_user_id', Live::labels()['live_user_id']);
		$grid->column('start_time', Live::labels()['start_time']);
		$grid->column('end_time', Live::labels()['end_time']);
		$grid->column('created_time', Live::labels()['created_time']);
		$grid->column('updated_time', Live::labels()['updated_time']);
		$grid->column('show_status', Live::labels()['show_status']);
		$grid->column('status', Live::labels()['status']);
		$grid->column('sort', Live::labels()['sort']);

		return $grid;
	}

	protected function form($isEdit = false)
	{
		$form = new Form(new Live);
		$form->className('m-15');
		$form->setEdit($isEdit);
		$form->item('id', Live::labels()['id']);
		$form->item('name', Live::labels()['name']);
		$form->item('live_user_id', Live::labels()['live_user_id']);
		$form->item('start_time', Live::labels()['start_time']);
		$form->item('end_time', Live::labels()['end_time']);
		$form->item('created_time', Live::labels()['created_time']);
		$form->item('updated_time', Live::labels()['updated_time']);
		$form->item('show_status', Live::labels()['show_status']);
		$form->item('status', Live::labels()['status']);
		$form->item('sort', Live::labels()['sort']);

		return $form;
	}
}
