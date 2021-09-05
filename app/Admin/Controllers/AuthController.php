<?php

namespace App\Admin\Controllers;

use Dcat\Admin\Http\Controllers\AuthController as BaseAuthController;
use Dcat\Admin\Layout\Content;

class AuthController extends BaseAuthController
{
    protected $view = 'admin.login.login';

    public function getLogin(Content $content)
    {

        if (admin_setting('logintheme') === 'simple') {
            $this->view = 'admin::pages.login';
        }

        return $content->full()->body(view($this->view));
    }
}
