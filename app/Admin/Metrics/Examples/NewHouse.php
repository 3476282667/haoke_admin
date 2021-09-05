<?php

namespace App\Admin\Metrics\Examples;

use Carbon\Carbon;
use Dcat\Admin\Widgets\Metrics\Card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewHouse extends Card
{
    public function init()
    {
        parent::init();
        $this->title('昨日新增房源');
    }

    public function handle(Request $request)
    {
        $data = DB::table('houses')->where('createdAt', '>', Carbon::yesterday())->count();
        $this->content($data);
    }

    /**
     * 渲染卡片内容.
     *
     * @return string
     */
    public function renderContent()
    {
        $content = parent::renderContent();

        return <<<HTML
<div class="d-flex justify-content-between align-items-center mt-1" style="margin-bottom: 2px">
    <h2 class="ml-1 font-lg-1">{$content}</h2>
</div>
HTML;
    }

}
