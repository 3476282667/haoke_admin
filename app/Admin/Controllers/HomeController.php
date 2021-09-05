<?php

namespace App\Admin\Controllers;

use App\Admin\Metrics\Examples;
use App\Admin\Widgets\Charts\MyBar;
use App\Http\Controllers\Controller;
use Dcat\Admin\Http\Controllers\Dashboard;
use Dcat\Admin\Layout\Column;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Layout\Row;
use Dcat\Admin\Widgets\Card;

class HomeController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->header('仪表板')
            ->description('数据')
            ->body(function (Row $row) {
                $row->column(6, function (Column $column) {
//                    $column->row(Dashboard::title());
                    $column->row(function (Row $row) {
                        $row->column(6, new Examples\UserCard());
                        $row->column(6, new Examples\HouseCard());
                    });
                    $column->row(view('admin.personal'));
                });

                $row->column(6, function (Column $column) {
                    $column->row(function (Row $row) {
                        $row->column(6, new Examples\NewUser());
                        $row->column(6, new Examples\NewHouse());
                    });

                    $column->row(
                        Card::make('热门城市房源数量', MyBar::make())
                    );
                });
            });
    }
}
