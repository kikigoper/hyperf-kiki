<?php

declare(strict_types=1);

/**
 * This file is part of Hyperf.plus
 * @link     https://www.hyperf.plus
 * @document https://doc.hyperf.plus
 * @contact  4213509@qq.com
 * @license  https://github.com/hyperf-plus/admin/blob/master/LICENSE
 */

namespace App\Controller\Admin;

use App\Model\MainLog;
use HPlus\Admin\Controller\AbstractAdminController;
use HPlus\Route\Annotation\AdminController;
use HPlus\UI\Form;
use HPlus\UI\Grid;

/**
 * @AdminController(prefix="mainlog", tag="主要日志", ignore=true))
 */
class MainLogController extends AbstractAdminController
{
    protected function grid()
    {
        $grid = new Grid(new MainLog);
        $grid->hideActions(); //隐藏操作
        $grid->toolbars(function (Grid\Toolbars $toolbars) {
            $toolbars->hideCreateButton();
        });
        $grid->className('m-15');
        $grid->column('id', MainLog::labels()['id'])->width(80);
        $grid->column('en_key', MainLog::labels()['en_key'])->width(100);
        $grid->column('cn_key', MainLog::labels()['cn_key'])->width(100);
        $grid->column('content', MainLog::labels()['content']);
        $grid->column('created_at', MainLog::labels()['created_at'])->width(180);
        $grid->column('updated_at', MainLog::labels()['updated_at'])->width(180);
        $grid->actions(function (Grid\Actions $actions) {
        });

        return $grid;
    }


    protected function form($isEdit = false)
    {
        $form = new Form(new MainLog);
        $form->className('m-15');
        $form->setEdit($isEdit);
        $form->item('id', MainLog::labels()['id']);
        $form->item('en_key', MainLog::labels()['en_key']);
        $form->item('cn_key', MainLog::labels()['cn_key']);
        $form->item('content', MainLog::labels()['content']);
        $form->item('created_at', MainLog::labels()['created_at']);
        $form->item('updated_at', MainLog::labels()['updated_at']);

        return $form;
    }
}
