<?php

namespace App\Admin\Widgets\Charts;

use Dcat\Admin\Admin;
use Dcat\Admin\Widgets\ApexCharts\Chart;
use Illuminate\Support\Facades\DB;

class MyBar extends Chart
{
    public function __construct($containerSelector = null, $options = [])
    {
        parent::__construct($containerSelector, $options);

        $this->setUpOptions();
    }

    /**
     * 初始化图表配置
     */
    protected function setUpOptions()
    {
        $color = Admin::color();

        $colors = [$color->primary(), $color->primaryDarker()];

        $this->options([
            'colors' => $colors,
            'chart' => [
                'type' => 'bar',
                'height' => 400,
            ],

            'grid' => [
                'row' => [
                    'colors' => ['#e5e5e5', 'transparent'],
                    'opacity' => 0.5
                ],
                'column' => [
                    'colors' => ['#f8f8f8', 'transparent'],
                ],
                'xaxis' => [
                    'lines' => [
                        'show' => true,
                    ]
                ]
            ],

            'plotOptions' => [
                'bar' => [
                    'horizontal' => false,
                    'dataLabels' => [
                        'position' => 'top',
                    ],
                ]
            ],
            'dataLabels' => [
                'enabled' => true,
                'offsetX' => -6,
                'style' => [
                    'fontSize' => '12px',
                    'colors' => ['#fff'],
                ]
            ],
            'stroke' => [
                'show' => true,
                'width' => 1,
                'margin' => 10,
                'colors' => ['#fff']
            ],
            'xaxis' => [
                'categories' => [],
            ],
        ]);
    }

    /**
     * 处理图表数据
     */
    protected function buildData()
    {
// 执行你的数据查询逻辑
        $sz = DB::table('houses')
            ->where('area_name', 'LIKE', '深圳%')
            ->count();
        $sh = DB::table('houses')
            ->where('area_name', 'LIKE', '上海%')
            ->count();
        $gz = DB::table('houses')
            ->where('area_name', 'LIKE', '广州%')
            ->count();
        $bj = DB::table('houses')
            ->where('area_name', 'LIKE', '北京%')
            ->count();
        $categories = ['深圳', '上海', '广州', '北京'];

        $this->withData([['data' => [$sz, $sh, $gz, $bj]]]);
        $this->withCategories($categories);
    }

    /**
     * 设置图表数据
     *
     * @param array $data
     *
     * @return $this
     */
    public function withData(array $data)
    {
        return $this->option('series', $data);
    }

    /**
     * 设置图表类别.
     *
     * @param array $data
     *
     * @return $this
     */
    public function withCategories(array $data)
    {
        return $this->option('xaxis.categories', $data);
    }

    /**
     * 渲染图表
     *
     * @return string
     */
    public function render()
    {
        $this->buildData();

        return parent::render();
    }
}
