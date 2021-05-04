<?php

declare(strict_types=1);

/**
 *模块管理
 */

namespace App\Controller\Admin;

use App\Model\User;
use HPlus\Admin\Controller\AbstractAdminController;
use HPlus\Route\Annotation\AdminController;
use HPlus\UI\Form;
use HPlus\UI\Grid;

/**
 * @AdminController(prefix="user", tag="", ignore=true))
 */
class UserController extends AbstractAdminController
{
    protected function grid()
    {
        $grid = new Grid(new User);
        $grid->dialogForm($this->form()->isDialog(), '700px', ['添加', '编辑']);
        //$grid->hidePage(); //隐藏分页
        //$grid->hideActions(); //隐藏操作
        $grid->selection(); //多选
        $grid->defaultSort('uid', 'desc'); // 默认uid倒序
        $grid->className('m-15');
        $grid->column('uid', User::labels()['uid']);
        $grid->column('username', User::labels()['username']);
        //$grid->column('password', User::labels()['password']);
        //$grid->column('salt', User::labels()['salt']);
        $grid->column('mobile', User::labels()['mobile']);
        $grid->column('email', User::labels()['email']);
        $grid->column('reg_time', User::labels()['reg_time']);
        $grid->column('reg_ip', User::labels()['reg_ip']);
        $grid->column('last_login_time', User::labels()['last_login_time']);
        $grid->column('last_login_ip', User::labels()['last_login_ip']);
        $grid->column('update_time', User::labels()['update_time']);
        $grid->column('tuid', User::labels()['tuid']);
        $grid->column('image', User::labels()['image']);
        $grid->column('score', User::labels()['score']);
        $grid->column('score_all', User::labels()['score_all']);
        $grid->column('allowance', User::labels()['allowance']);
        $grid->column('allowance_updated_at', User::labels()['allowance_updated_at']);
        $grid->column('status', User::labels()['status']);
        $grid->export(function (Grid\Exporters\CsvExporter $export) {
            $export->filename('用户信息导出.csv');
        });

        return $grid;
    }

    protected function form($isEdit = false)
    {
        $form = new Form(new User);
        $form->className('m-15');
        $form->setEdit($isEdit);
        $form->item('uid', User::labels()['uid']);
        $form->item('username', User::labels()['username']);
        $form->item('password', User::labels()['password']);
        $form->item('salt', User::labels()['salt']);
        $form->item('email', User::labels()['email']);
        $form->item('mobile', User::labels()['mobile']);
        $form->item('reg_time', User::labels()['reg_time']);
        $form->item('reg_ip', User::labels()['reg_ip']);
        $form->item('last_login_time', User::labels()['last_login_time']);
        $form->item('last_login_ip', User::labels()['last_login_ip']);
        $form->item('update_time', User::labels()['update_time']);
        $form->item('tuid', User::labels()['tuid']);
        $form->item('image', User::labels()['image']);
        $form->item('score', User::labels()['score']);
        $form->item('score_all', User::labels()['score_all']);
        $form->item('allowance', User::labels()['allowance']);
        $form->item('allowance_updated_at', User::labels()['allowance_updated_at']);
        $form->item('status', User::labels()['status']);

        return $form;
    }
}
