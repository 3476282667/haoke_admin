<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\City;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class CityController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new City(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('name');
            $grid->column('code');
            $grid->column('type');
            $grid->column('superior');
            $grid->column('createdAt');
            $grid->column('updatedAt');

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
                $filter->equal('name');
                $filter->equal('superior');

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
        return Show::make($id, new City(), function (Show $show) {
            $show->field('id');
            $show->field('name');
            $show->field('code');
            $show->field('type');
            $show->field('superior');
            $show->field('createdAt');
            $show->field('updatedAt');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new City(), function (Form $form) {
            $form->display('id');
            $form->text('name');
            $form->text('code');
            $form->text('type');
            $form->text('superior');
            $form->text('createdAt');
            $form->text('updatedAt');
        });
    }
}
