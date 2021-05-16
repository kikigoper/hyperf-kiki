<?php 

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Model\SeeAlsoUserList;
use HPlus\Admin\Controller\AbstractAdminController;
use HPlus\Route\Annotation\AdminController;
use HPlus\UI\Form;
use HPlus\UI\Grid;

/**
 * @AdminController(prefix="seealsouserlist", tag="砍价用户", ignore=true))
 */
class SeeAlsoUserListController extends AbstractAdminController
{
	protected function grid()
	{
		$grid = new Grid(new SeeAlsoUserList);
		$grid->dialogForm($this->form()->isDialog(),'700px',['添加','编辑']);
		//$grid->hidePage(); //隐藏分页
		//$grid->hideActions(); //隐藏操作
		$grid->selection(); //多选
		$grid->defaultSort('id', 'desc'); // 默认id倒序
		$grid->className('m-15');
		$grid->column('id', SeeAlsoUserList::labels()['id']);
		$grid->column('user_id', SeeAlsoUserList::labels()['user_id']);
		$grid->column('see_id', SeeAlsoUserList::labels()['see_id']);
		$grid->column('user_name', SeeAlsoUserList::labels()['user_name']);
		$grid->column('current_price', SeeAlsoUserList::labels()['current_price']);
		$grid->column('residue_num', SeeAlsoUserList::labels()['residue_num']);

		return $grid;
	}


	protected function form($isEdit = false)
	{
		$form = new Form(new SeeAlsoUserList);
		$form->className('m-15');
		$form->setEdit($isEdit);
		$form->item('id', SeeAlsoUserList::labels()['id']);
		$form->item('user_id', SeeAlsoUserList::labels()['user_id']);
		$form->item('see_id', SeeAlsoUserList::labels()['see_id']);
		$form->item('user_name', SeeAlsoUserList::labels()['user_name']);
		$form->item('current_price', SeeAlsoUserList::labels()['current_price']);
		$form->item('residue_num', SeeAlsoUserList::labels()['residue_num']);

		return $form;
	}
}
