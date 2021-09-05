<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Dcat\Admin\Grid\Column;
use Dcat\Admin\Layout\Content;
use App\Admin\Forms\Setting;
use Dcat\Admin\Widgets\Card;

class SettingsController extends Controller
{
    public function index(Content $content)
    {
        return $content->title('网站设置')
            ->description('修改管理系统外观')
            ->body(new Card(new Setting()));
    }
}
