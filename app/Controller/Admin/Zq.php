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

use App\Model\Zq as ModelZq;
use HPlus\Admin\Controller\AbstractAdminController;
use HPlus\Route\Annotation\AdminController;
use HPlus\UI\Form;
use HPlus\UI\Grid;

/**
 * @AdminController(prefix="zq", tag="钟琪测试", ignore=true))
 */
class Zq extends AbstractAdminController
{
	protected function grid()
	{
		$grid = new Grid(new ModelZq);
		//$grid->hidePage(); 隐藏分页
		//$grid->hideActions(); 隐藏操作
		$grid->className('m-15');
		$grid->column('id', '');
		$grid->column('created_at', '');
		$grid->column('updated_at', '');
		$grid->column('name', '');
		$grid->column('phone', '');
		$grid->column('username', '');

		return $grid;
	}


	protected function form($isEdit = false)
	{
		$form = new Form(new ModelZq);
		$form->className('m-15');
		$form->setEdit($isEdit);
		$form->item('id', '');
		$form->item('created_at', '');
		$form->item('updated_at', '');
		$form->item('name', '');
		$form->item('phone', '');
		$form->item('username', '');

		return $form;
	}
}
