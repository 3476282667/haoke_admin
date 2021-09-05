<?php

namespace App\Admin\Metrics\Examples;

use Carbon\Carbon;
use Dcat\Admin\Widgets\Metrics\Card;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserCard extends Card
{
    /**
     * 卡片底部内容.
     *
     * @var string|Renderable|\Closure
     */
    protected $footer;

    /**
     * 初始化卡片.
     */
    protected function init()
    {
        parent::init();

        $this->title('用户数量');
        $this->dropdown([
            '7' => '最近一周',
            '30' => '最近一个月',
            '365' => '最近一年',
        ]);
    }

    public function handle(Request $request)
    {
        switch ($request->get('option')) {
            case '365':
                $data = DB::table('users')
                    ->where('created_at', '>', Carbon::now()->subDay(365))
                    ->count();
                $this->content($data);
                break;
            case '30':
                $data = DB::table('users')
                    ->where('created_at', '>', Carbon::now()->subDay(30))
                    ->count();
                $this->content($data);
                break;
            case '7':
            default:
            $data = DB::table('users')
                ->where('created_at', '>', Carbon::now()->subDay(7))
                ->count();
            $this->content($data);
        }
    }

    /**
     * @param int $percent
     *
     * @return $this
     */
    public function up($percent)
    {
        return $this->footer(
            "<i class=\"feather icon-trending-up text-success\"></i> {$percent}% Increase"
        );
    }

    /**
     * @param int $percent
     *
     * @return $this
     */
    public function down($percent)
    {
        return $this->footer(
            "<i class=\"feather icon-trending-down text-danger\"></i> {$percent}% Decrease"
        );
    }

    /**
     * 设置卡片底部内容.
     *
     * @param string|Renderable|\Closure $footer
     *
     * @return $this
     */
    public function footer($footer)
    {
        $this->footer = $footer;

        return $this;
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

    /**
     * 渲染卡片底部内容.
     *
     * @return string
     */
    public function renderFooter()
    {
        return $this->toString($this->footer);
    }
}
