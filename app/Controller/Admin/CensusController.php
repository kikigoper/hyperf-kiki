<?php

declare(strict_types=1);

/**
 *模块管理
 */

namespace App\Controller\Admin;

use App\Model\Census;
use HPlus\Admin\Controller\AbstractAdminController;
use HPlus\UI\Form;
use HPlus\UI\Grid;
use HPlus\Route\Annotation\ApiController;
use HPlus\Route\Annotation\GetApi;
use HPlus\Route\Annotation\PostApi;
use HPlus\UI\Components\Antv\Area;
use HPlus\UI\Components\Antv\Column;
use HPlus\UI\Components\Antv\Funnel;
use HPlus\UI\Components\Antv\Line;
use HPlus\UI\Components\Antv\Pie;
use HPlus\UI\Components\Antv\StepLine;
use HPlus\UI\Components\Widgets\Alert;
use HPlus\UI\Components\Widgets\Card;
use HPlus\UI\Layout\Content;
use HPlus\UI\Layout\Row;
use Hyperf\Di\Annotation\Inject;
use HPlus\Route\Annotation\AdminController;


/**
 * @AdminController(prefix="Census", tag="", ignore=true))
 */
class CensusController extends AbstractAdminController
{
    protected function grid()
    {
        $grid = new Grid(new Census);
        $grid->dialogForm($this->form()->isDialog(), '700px', ['添加', '编辑']);
        //$grid->hidePage(); //隐藏分页
        //$grid->hideActions(); //隐藏操作
        $grid->selection(); //多选
        $grid->defaultSort('id', 'desc'); // 默认id倒序
        $grid->className('m-15');
        $grid->column('id', Census::labels()['id']);
        $grid->column('title', Census::labels()['title']);

        return $grid;
    }

    protected function form($isEdit = false)
    {
        $form = new Form(new Census);
        $form->className('m-15');
        $form->setEdit($isEdit);
        $form->item('id', Census::labels()['id']);
        $form->item('title', Census::labels()['title']);

        return $form;
    }

    /**
     * @GetApi
     */
    public function main()
    {
        $content = new Content();
        $content->className('m-10')
            ->row(function (Row $row) {
                $row->gutter(10);
                $row->className('mt-10');
                $row->column(12, Alert::make('', '欢迎来到云平台统计')->showIcon()->closable(false)->type('success'));
                //$row->column(12, Alert::make('你好，同学！！', '欢迎使用 hyperf-plus-admin')->showIcon()->closable(false)->type('error'));
                //$row->column(12, Alert::make('你好，同学！！', '欢迎使用 hyperf-plus-admin')->showIcon()->closable(false)->type('warning'));
                //$row->column(12, Alert::make('你好，同学！！', '欢迎使用 hyperf-plus-admin')->showIcon()->closable(false)->type('info'));
            })
            ->row(function (Row $row) {
                $row->gutter(10);
                $row->column(12,
                    Card::make()->bodyStyle(['padding' => '0'])->content(
                        Funnel::make()->data(
                            [
                                ['stage' => '触达次数', 'times' => rand(1, 100), 'uv' => rand(1, 1000), 'conversionUV' => rand(1, 1000)],
                                ['stage' => '响应次数', 'times' => rand(1, 100), 'uv' => rand(1, 1000), 'conversionUV' => rand(1, 1000)],
                                ['stage' => '分享次数', 'times' => rand(1, 100), 'uv' => rand(1, 1000), 'conversionUV' => rand(1, 1000)],
                                ['stage' => '测试', 'times' => rand(1, 100), 'uv' => rand(1, 1000), 'conversionUV' => rand(1, 1000)],
                                ['stage' => '测试33', 'times' => rand(1, 100), 'uv' => rand(1, 1000), 'conversionUV' => rand(1, 1000)],
                            ]
                        )
                            ->config([
                                "xField" => 'stage',
                                "yField" => 'times',
                                "legend" => false,
                                "conversionTag" => false,
                                "interactions" => [
                                    [
                                        "type" => 'element-active',
                                    ]
                                ],
                                "tooltip" => [
                                    "follow" => true,
                                    "enterable" => true,
                                    "offset" => 5,
                                ]
                            ])
                    )
                );
                $row->column(12,
                    Card::make()->bodyStyle(['padding' => '0'])->content(
                        Pie::make()->data([
                            ['type' => '分类1', 'value' => rand(1, 100)],
                            ['type' => '分类2', 'value' => rand(1, 100)],
                            ['type' => '分类3', 'value' => rand(1, 100)],
                            ['type' => '分类4', 'value' => rand(1, 100)],
                            ['type' => '分类5', 'value' => rand(1, 100)],
                        ])->config([
                            "appendPadding" => 10,
                            "angleField" => 'value',
                            "colorField" => 'type'
                        ]))
                );
            })->row(function (Row $row) {
                $row->gutter(10)->className('mt-10');
                $row->column(12, Card::make()->bodyStyle(['padding' => '0'])
                    ->content(

                        Line::make()
                            ->data(function () {
                                $data = collect();
                                for ($year = 2010; $year <= 2020; ++$year) {
                                    $data->push([
                                        'year' => (string)$year,
                                        'type' => '小红',
                                        'value' => rand(100, 1000),
                                    ]);
                                    $data->push([
                                        'year' => (string)$year,
                                        'type' => '小白',
                                        'value' => rand(100, 1000),
                                    ]);
                                }
                                return $data;
                            })
                            ->config(function () {
                                return [
                                    'title' => [
                                        'visible' => true,
                                        'text' => '商品统计',
                                    ],
                                    'description' => [
                                        'visible' => true,
                                        'text' => '他们最常用于表现趋势和关系，而不是传达特定的值。',
                                    ],
                                    'seriesField' => 'type',
                                    'smooth' => true,
                                    'xField' => 'year',
                                    'yField' => 'value',
                                ];
                            })
                    ));
                $row->column(12, Card::make()->bodyStyle(['padding' => '0'])->content(
                    Area::make()
                        ->data(function () {
                            $data = collect();
                            for ($year = 2010; $year <= 2020; ++$year) {
                                $data->push([
                                    'year' => (string)$year,
                                    'type' => '订单留存',
                                    'value' => rand(100, 1000),
                                ]);
                                $data->push([
                                    'year' => (string)$year,
                                    'type' => '订单成交',
                                    'value' => rand(100, 1000),
                                ]);
                            }
                            return $data;
                        })
                        ->config(function () {
                            return [
                                'title' => [
                                    'visible' => true,
                                    'text' => '订单统计',
                                ],
                                'description' => [
                                    'visible' => true,
                                    'text' => '他们最常用于表现趋势和关系，而不是传达特定的值。',
                                ],
                                'seriesField' => 'type',
                                'smooth' => false,
                                'xField' => 'year',
                                'yField' => 'value',
                            ];
                        })
                ));
            })->row(function (Row $row) {
                $row->gutter(10)->className('mt-10');
                $row->column(12, Card::make()->bodyStyle(['padding' => '0'])->content(
                    StepLine::make()
                        ->data(function () {
                            $data = collect();
                            for ($year = 2010; $year <= 2020; ++$year) {
                                $data->push([
                                    'year' => (string)$year,
                                    'type' => '小红面积',
                                    'value' => rand(100, 1000),
                                ]);
                            }
                            return $data;
                        })
                        ->config(function () {
                            return [
                                'title' => [
                                    'visible' => true,
                                    'text' => '财务管理',
                                ],
                                'description' => [
                                    'visible' => true,
                                    'text' => '阶梯线图用于表示连续时间跨度内的数据',
                                ],
                                'smooth' => false,
                                'xField' => 'year',
                                'yField' => 'value',
                            ];
                        })
                ));
                $row->column(12, Card::make()->bodyStyle(['padding' => '0'])->content(
                    Column::make()
                        ->data(function () {
                            $data = collect();
                            for ($year = 2010; $year <= 2020; ++$year) {
                                $data->push([
                                    'year' => (string)$year,
                                    'type' => '小红面积',
                                    'value' => rand(100, 1000),
                                ]);
                            }
                            return $data;
                        })
                        ->config(function () {
                            return [
                                'title' => [
                                    'visible' => true,
                                    'text' => '用户管理',
                                ],
                                'description' => [
                                    'visible' => true,
                                    'text' => '条形图即是横向柱状图，相比基础柱状图，条形图的分类文本可以横向排布，因此适合用于分类较多的场景',
                                ],
                                'smooth' => false,
                                'xField' => 'year',
                                'yField' => 'value',
                            ];
                        })
                ));
            });
        return $content;
    }
}
