<?php 

declare(strict_types=1);

/**
 *商品分类模块
 */

namespace App\Controller\Admin;

use App\Model\GoodsCate;
use HPlus\Admin\Controller\AbstractAdminController;
use HPlus\Route\Annotation\AdminController;
use HPlus\UI\Components\Attrs\SelectOption;
use HPlus\UI\Components\Form\Select;
use HPlus\UI\Form;
use HPlus\UI\Grid;
use Hyperf\Di\Annotation\Inject;

/**
 * @AdminController(prefix="goodscate", tag="", ignore=true))
 */
class GoodsCateController extends AbstractAdminController
{
    /**
     * @Inject
     * @var GoodsCate
     */
    protected $goodsCate;

	protected function grid()
	{
		$grid = new Grid(new GoodsCate);
		$grid->dialogForm($this->form()->isDialog(),'700px',['创建标题','编辑标题']);
		//$grid->hidePage(); //隐藏分页
		//$grid->hideActions(); //隐藏操作
		$grid->selection(); //多选
		$grid->defaultSort('id', 'asc'); // 默认id倒序
		$grid->className('m-15');
		$grid->column('id', GoodsCate::labels()['id'])->sortable();
		$grid->column('parent_id', GoodsCate::labels()['parent_id']);
		$grid->column('title', GoodsCate::labels()['title']);
		$grid->column('order', GoodsCate::labels()['order'])->sortable();
		$grid->column('status', GoodsCate::labels()['status']);

		return $grid;
	}

	protected function form($isEdit = false)
	{
        /*@var Model $model */
		$form = new Form(new GoodsCate());
		$form->className('m-15');
		$form->setEdit($isEdit);
        $form->item('parent_id', GoodsCate::labels()['parent_id'])->component(Select::make()->options(function () {

            $data = [];
            //var_dump((new GoodsCate)->getTree());
            foreach ((new GoodsCate)->getTree() as $key => $status) {
                $data[] = [
                    'value' => $key,
                    'label' => $status,
                    'avatar' => '',
                    'desc' => '',
                ];
            }
            //var_dump($data);
            return $data;
        }));
		$form->item('title', GoodsCate::labels()['title']);
		$form->item('order', GoodsCate::labels()['order'])->defaultValue(0);
        $form->item('status', GoodsCate::labels()['status'])->defaultValue(10)->component(Select::make()->options(function () {
            $data = [];
            foreach (GoodsCate::$status as $key => $status) {
                $data[] = [
                    'value' => $key,
                    'label' => $status,
                    'avatar' => '',
                    'desc' => '',
                ];
            }
            return $data;
        }));

		return $form;
	}
}
