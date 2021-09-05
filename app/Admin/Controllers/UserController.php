<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\User;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class UserController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new User(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('user_name');
            $grid->column('user_code');
            $grid->column('user_gender');
            $grid->column('user_id');
            $grid->column('user_pass');
            $grid->column('user_avatar');
            $grid->column('phone_cer');
            $grid->column('user_phone')->image(env('APP_URL') . '/storage/avatar');
            $grid->column('user_nick');
            $grid->column('user_lock');
            $grid->column('creation_time');
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();
            $grid->column('signature');

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');

            });
        });
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        return Show::make($id, new User(), function (Show $show) {
            $show->field('id');
            $show->field('user_name');
            $show->field('user_code');
            $show->field('user_gender');
            $show->field('user_id');
            $show->field('user_pass');
            $show->field('user_avatar');
            $show->field('phone_cer');
            $show->field('user_phone')->image(env('APP_URL') . '/storage/avatar');
            $show->field('user_nick');
            $show->field('user_lock');
            $show->field('creation_time');
            $show->field('createdAt');
            $show->field('updatedAt');
            $show->field('signature');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new User(), function (Form $form) {
            $form->display('id');
            $form->text('user_name');
            $form->text('user_code');
            $form->text('user_gender');
            $form->text('user_id');
            $form->text('user_pass');
            $form->text('user_avatar');
            $form->text('phone_cer');
            $form->image('user_phone')->disk('uploadAvatar');
            $form->text('user_nick');
            $form->text('user_lock');
            $form->text('creation_time');
            $form->text('createdAt');
            $form->text('updatedAt');
            $form->text('signature');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
