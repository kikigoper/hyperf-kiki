<?php

declare(strict_types=1);
/**
 * 商品模块
 */

namespace App\Controller\Admin;

use App\Model\Goods;
use App\Model\GoodsUnit;
use HPlus\Admin\Controller\AbstractAdminController;
use HPlus\Route\Annotation\AdminController;
use HPlus\UI\Components\Attrs\SelectOption;
use HPlus\UI\Components\Form\DatePicker;
use HPlus\UI\Components\Form\DateTimePicker;
use HPlus\UI\Components\Form\InputNumber;
use HPlus\UI\Components\Form\Radio;
use HPlus\UI\Components\Form\RadioGroup;
use HPlus\UI\Components\Form\Select;
use HPlus\UI\Components\Form\Upload;
use HPlus\UI\Components\Grid\Image;
use HPlus\UI\Components\Grid\Tag;
use HPlus\UI\Components\Widgets\Alert;
use HPlus\UI\Components\Widgets\Dialog;
use HPlus\UI\Components\Widgets\Html;
use HPlus\UI\Components\Widgets\Text;
use HPlus\UI\Form;
use HPlus\UI\Grid;
use HPlus\UI\Layout\Content;
use Hyperf\Di\Annotation\Inject;

/**
 * @AdminController(prefix="goods", tag="商品管理", ignore=true))
 */
class GoodsController extends AbstractAdminController
{
    /**
     * @Inject
     * @var GoodsUnit
     */
    protected $goodsUnit;


    protected function grid()
    {
        $grid = new Grid((new Goods));
        $grid->dialogForm($this->form()->isDialog(), '700px', ['商品发布', '商品编辑']); //添加弹窗
        //$grid->hidePage(); //隐藏分页
        //$grid->hideActions(); //隐藏操作
        $grid->selection(); // 多选
        $grid->quickSearch('goods_name');
        $grid->quickSearchPlaceholder("产品名称");
        $grid->filter(function (\HPlus\UI\Grid\Filter $filter) {
            // 在这里添加字段过滤器
            //$filter->equal("id", "商品id");
            $filter->between("created_at", "发布时间")->component(DateTimePicker::make()->type("datetimerange"));
            $filter->equal("status", "状态")->component(Select::make()->options(function () {
                $data = [];
                foreach (Goods::getStatusKey() as $key => $status) {
                    $data[] = [
                        'value' => $key,
                        'label' => $status,
                        'avatar' => '',
                        'desc' => '',
                    ];
                }
                return $data;
            }));
        });
        $grid->className('m-15');
        $grid->defaultSort('id', 'desc'); // 默认id倒序
        $grid->column('id', Goods::labels()['id'])->width('70px')->sortable();
        $grid->column('cate.title', '分类');
        $grid->column('goods_name', Goods::labels()['goods_name']);
        $grid->column('main_image', Goods::labels()['main_image'])->component(Image::make()->preview());
        //$grid->column('image', Goods::labels()['image']);
        //$grid->column('introduction', Goods::labels()['introduction']);
        //$grid->column('keywords', Goods::labels()['keywords']);
        //$grid->column('unit', Goods::labels()['unit']);
        $grid->column('sell_price', Goods::labels()['sell_price'])->component(Tag::make()->type('primary'));
        //$grid->column('market_price', Goods::labels()['market_price']);
        //$grid->column('cost_price', Goods::labels()['cost_price']);
        $grid->column('integral', Goods::labels()['integral']);
        $grid->column('carriage', Goods::labels()['carriage']);
        $grid->column('sales_volume', Goods::labels()['sales_volume'])->sortable();
        //$grid->column('virtual_sales_volume', Goods::labels()['virtual_sales_volume']);
        $grid->column('stock', Goods::labels()['stock'])->sortable()->customValue(function ($row, $value) {
            if ($value < Goods::$stockWarmValue) {
                return '<span class="el-tag el-tag--danger el-tag--mini el-tag--light" column-value="' . $value . '">' . $value . '</span>';
            } else {
                return '<span class="el-tag el-tag--primary el-tag--mini el-tag--light" column-value="' . $value . '">' . $value . '</span>';
            }
        });
        //$grid->column('sort', Goods::labels()['sort']);
        $grid->column('status', Goods::labels()['status'])->customValue(function ($row, $value) {
            return Goods::getStatusKey($value);
        })->component(Tag::make()->type(Goods::getStatusTag()));
        //$grid->column('like', Goods::labels()['like']);
        $grid->column('collect', Goods::labels()['collect']);
        //$grid->column('view', Goods::labels()['view']);
        //$grid->column('user_session', Goods::labels()['user_session']);
        //$grid->column('comment', Goods::labels()['comment']);
        $grid->column('is_ship', Goods::labels()['is_ship'])->customValue(function ($row, $value) {
            return Goods::$isShip[$value];
        });
        $grid->column('created_at', Goods::labels()['created_at'])->width('90px')->sortable();
        //$grid->column('updated_at', Goods::labels()['updated_at']);

        $grid->export(function (Grid\Exporters\CsvExporter $export) {
            $export->filename('商品信息导出.csv');
            #指定只能导出哪些列
            $export->only(Goods::ExportLabels());
        });

        return $grid;
    }

    protected function form($isEdit = false)
    {
        $form = new Form(new Goods);
        $form->className('m-15');
        $form->setEdit($isEdit);
        //$form->item('id', Goods::labels()['id']);
        $form->item('cate_id', Goods::labels()['cate_id']);
        $form->item('goods_name', Goods::labels()['goods_name'])->required();
        //$form->item('main_image', Goods::labels()['main_image']);
        $form->item('main_image', Goods::labels()['main_image'])->Component(function () {
            return Upload::make()->image()->drag()->uniqueName();
        })->required();
        $form->item('image', Goods::labels()['image'])->Component(function () {
            return Upload::make()->image()->drag()->multiple()->uniqueName()->limit(6);
        });
        //$form->item('image', Goods::labels()['image']);
        //$form->item('introduction', Goods::labels()['introduction']);
        $form->item('keywords', Goods::labels()['keywords']);
        $form->item('unit', Goods::labels()['unit'])->component(Select::make()->options(function () {
            $goodsUnitData = $this->goodsUnit->pluck('unit_name', 'id');
            if ($goodsUnitData) {
                foreach ($goodsUnitData as $key => $status) {
                    $data[] = [
                        'value' => $key,
                        'label' => $status,
                    ];
                }
                return $data;
            }
            return [];
        }));
        $form->item('sell_price', Goods::labels()['sell_price'])->component(InputNumber::make());
        $form->item('market_price', Goods::labels()['market_price'])->component(InputNumber::make());
        $form->item('cost_price', Goods::labels()['cost_price'])->component(InputNumber::make());
        $form->item('integral', Goods::labels()['integral'])->component(function () {
            foreach (Goods::$integral as $k => $v) {
                $integralData[] = Radio::make($k, $v);
            }
            return RadioGroup::make(Goods::$defaultIntegral, $integralData);
        });
        $form->item('carriage', Goods::labels()['carriage'])->component(InputNumber::make());
        $form->item('sales_volume', Goods::labels()['sales_volume'])->component(InputNumber::make());
        //$form->item('virtual_sales_volume', Goods::labels()['virtual_sales_volume']);
        $form->item('stock', Goods::labels()['stock']);
        //$form->item('sort', Goods::labels()['sort']);
        //$form->item('status', Goods::labels()['status']);
        //$form->item('like', Goods::labels()['like']);
        //$form->item('collect', Goods::labels()['collect']);
        //$form->item('view', Goods::labels()['view']);
        //$form->item('user_session', Goods::labels()['user_session']);
        //$form->item('is_ship', Goods::labels()['is_ship']);
        $form->item('is_ship', Goods::labels()['is_ship'])->defaultValue(10)->component(Select::make()->options(function () {
            $data = [];
            foreach (Goods::$isShip as $key => $status) {
                $data[] = [
                    'value' => $key,
                    'label' => $status,
                ];
            }
            return $data;
        }));
        $form->item('status', Goods::labels()['status'])->defaultValue(10)->component(Select::make()->options(function () {
            $data = [];
            foreach (Goods::getStatusKey() as $key => $status) {
                $data[] = [
                    'value' => $key,
                    'label' => $status,
                ];
            }
            return $data;
        }));
        //$form->item('created_at', Goods::labels()['created_at']);
        //$form->item('updated_at', Goods::labels()['updated_at']);
        return $form;
    }
}
