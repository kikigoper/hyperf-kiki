<?php 

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Model\UserMessage;
use HPlus\Admin\Controller\AbstractAdminController;
use HPlus\Route\Annotation\AdminController;
use HPlus\UI\Form;
use HPlus\UI\Grid;

/**
 * @AdminController(prefix="usermessage", tag="用户留言", ignore=true))
 */
class UserMessageController extends AbstractAdminController
{
	protected function grid()
	{
		$grid = new Grid(new UserMessage);
		$grid->dialogForm($this->form()->isDialog(),'700px',['添加','编辑']);
		//$grid->hidePage(); //隐藏分页
		//$grid->hideActions(); //隐藏操作
		$grid->selection(); //多选
		$grid->defaultSort('id', 'desc'); // 默认id倒序
		$grid->className('m-15');
		$grid->column('id', UserMessage::labels()['id']);
		$grid->column('nickname', UserMessage::labels()['nickname']);
		$grid->column('content', UserMessage::labels()['content']);
		$grid->column('remark', UserMessage::labels()['remark']);
		$grid->column('status', UserMessage::labels()['status']);
		$grid->column('created_at', UserMessage::labels()['created_at']);
		$grid->column('updated_at', UserMessage::labels()['updated_at']);

		return $grid;
	}

	protected function form($isEdit = false)
	{
		$form = new Form(new UserMessage);
		$form->className('m-15');
		$form->setEdit($isEdit);
		$form->item('id', UserMessage::labels()['id']);
		$form->item('nickname', UserMessage::labels()['nickname']);
		$form->item('content', UserMessage::labels()['content']);
		$form->item('remark', UserMessage::labels()['remark']);
		$form->item('status', UserMessage::labels()['status']);
		$form->item('created_at', UserMessage::labels()['created_at']);
		$form->item('updated_at', UserMessage::labels()['updated_at']);

		return $form;
	}
}
