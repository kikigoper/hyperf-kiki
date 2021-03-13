<?php 

declare(strict_types=1);

/**
 * This file is part of Hyperf.plus
 *
 * @link     https://www.hyperf.plus
 * @document https://doc.hyperf.plus
 * @contact  4213509@qq.com
 * @license  https://github.com/hyperf-plus/admin/blob/master/LICENSE
 */

namespace App\Controller\Admin;

use App\Model\AdminLoginLog;
use HPlus\Admin\Controller\AbstractAdminController;
use HPlus\Route\Annotation\AdminController;
use HPlus\UI\Form;
use HPlus\UI\Grid;

/**
 * @AdminController(prefix="adminloginlog", tag="", ignore=true))
 */
class AdminLoginLogController extends AbstractAdminController
{
	protected function grid()
	{
		$grid = new Grid(new AdminLoginLog);
		$grid->dialogForm($this->form()->isDialog(),'700px',['创建标题','编辑标题']);
		//$grid->hidePage(); 隐藏分页
		//$grid->hideActions(); 隐藏操作
		$grid->className('m-15');
		$grid->column('id', AdminLoginLog::labels()['id']);
		$grid->column('user_id', AdminLoginLog::labels()['user_id']);
		$grid->column('user_name', AdminLoginLog::labels()['user_name']);
		$grid->column('ip', AdminLoginLog::labels()['ip']);
		$grid->column('created_at', AdminLoginLog::labels()['created_at']);
		$grid->column('updated_at', AdminLoginLog::labels()['updated_at']);

		return $grid;
	}


	protected function form($isEdit = false)
	{
		$form = new Form(new AdminLoginLog);
		$form->className('m-15');
		$form->setEdit($isEdit);
		$form->item('id', AdminLoginLog::labels()['id']);
		$form->item('user_id', AdminLoginLog::labels()['user_id']);
		$form->item('user_name', AdminLoginLog::labels()['user_name']);
		$form->item('ip', AdminLoginLog::labels()['ip']);
		return $form;
	}
}
