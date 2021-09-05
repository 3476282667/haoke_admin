<?php

use Dcat\Admin\Admin;
use Dcat\Admin\Grid;
use Dcat\Admin\Form;
use Dcat\Admin\Grid\Filter;
use Dcat\Admin\Show;

/**
 * Dcat-admin - admin builder based on Laravel.
 * @author jqh <https://github.com/jqhph>
 *
 * Bootstraper for Admin.
 *
 * Here you can remove builtin form field:
 *
 * extend custom field:
 * Dcat\Admin\Form::extend('php', PHPEditor::class);
 * Dcat\Admin\Grid\Column::extend('php', PHPEditor::class);
 * Dcat\Admin\Grid\Filter::extend('php', PHPEditor::class);
 *
 * Or require js and css assets:
 * Admin::css('/packages/prettydocs/css/styles.css');
 * Admin::js('/packages/prettydocs/js/main.js');
 *
 */
$site_url = admin_setting('WebUrl');
$logo_mini = '<img src="' . $site_url . 'storage/' . admin_setting('logo') . '" width="35">';
$logo = $logo_mini . '&nbsp;&nbsp;' . admin_setting('WebName');
$name = admin_setting('WebName');

config([
    'admin.logo' => $logo,
    'admin.logo-mini' => $logo_mini,
    'admin.name' => $name,
    'admin.title' => $name,
    'admin.layout.dark_mode_switch' => true,
    'admin.layout.horizontal_menu' => admin_setting('horizontal_menu'),
    'admin.layout.sidebar_style' => admin_setting('sidebar_style')
]);
