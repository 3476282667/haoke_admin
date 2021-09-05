<?php

namespace App\Admin\Forms;

use Dcat\Admin\Widgets\Form;

class Setting extends Form
{
    /**
     * Handle the form request.
     *
     * @param array $input
     *
     * @return mixed
     */
    public function handle(array $input)
    {
        admin_setting($input);
        // return $this->response()->error('Your error message.');

        return $this
            ->response()
            ->success('设置成功')
            ->refresh();
    }

    /**
     * Build a form here.
     */
    public function form()
    {
        $this->confirm('您确定要提交设置吗部分', '设置提交之后需要重新刷新一下浏览器才能生效');

        $this->text('WebName', '网站名称')
            ->default(admin_setting('WebName', '好客租房管理系统'));

        $this->url('WebUrl', '网站地址')
            ->default(admin_setting('WebUrl', 'http://localhost'))
            ->help('正确填写网址, 并且必须以 / 结尾,否则会导致LOGO无法显示');

        $this->image('logo', 'LOGO')
            ->accept('jpg, png, gif, jpeg')
            ->maxSize(512)
            ->required()
            ->autoUpload()
            ->help('大小不要超过512K');

        $this->radio('horizontal_menu', '菜单位置')
            ->options([0 => '侧栏', 1 => '顶栏'])
            ->default(admin_setting('horizontal_menu', 0));

        $this->radio('sidebar_style', '侧栏颜色')
            ->options(['light' => '白色', 'dark' => '黑色', 'primary' => '彩色'])
            ->default(admin_setting('sidebar_style', ' dark'));

        $this->radio('logintheme', '登录页样式')
            ->options(['bigpicture' => '大图', 'simple' => '简单']);

        $this->image('logobg', '登陆页背景图')
            ->accept('jpg, png, gif, jpeg')
            ->maxsize(1024)
            ->autoupload()
            ->help('大小不要超过512K, 仅在登录页为大图模式下生效');
    }

    /**
     * The data of the form.
     *
     * @return array
     */
    public function default(): array
    {
        return [
            'logo' => admin_setting('logo', public_path(' /static/img/logo.png')),
            'color' => admin_setting('color', 'green'),
            'body_class' => admin_setting('body_class', 'sidebar-separate'),
            'sidebar_style' => admin_setting('sidebar_style', 'light'),
            'logintheme' => admin_setting('logintheme', ' bigpicture'),
            'logobg' => admin_setting('logobg'),
            'horizontal_menu' => admin_setting('horizontal_menu', 0),
            'style_type' => admin_setting('style_type', 1)
        ];
    }
}
