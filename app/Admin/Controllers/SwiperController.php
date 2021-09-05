<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Swiper;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class SwiperController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Swiper(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('img_name')->image(env('APP_URL') . '/storage/images/swiper');
            $grid->column('alt');

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
        return Show::make($id, new Swiper(), function (Show $show) {
            $show->field('id');
            $show->field('img_name')->image(env('APP_URL') . '/storage/images/swiper');
            $show->field('alt');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Swiper(), function (Form $form) {
            $form->display('id');
            $form->image('img_name')->disk('uploadSwiper');
            $form->text('alt');
        });
    }
}
