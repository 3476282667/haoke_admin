<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Area;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class AreaController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Area(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('city');
            $grid->column('city_name');
            $grid->column('area');
            $grid->column('area_name');
            $grid->column('street');
            $grid->column('street_name');
            $grid->column('community');
            $grid->column('community_name');
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
                $filter->like('city_name');
                $filter->like('area_name');
                $filter->like('street_name');
                $filter->like('community_name');

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
        return Show::make($id, new Area(), function (Show $show) {
            $show->field('id');
            $show->field('city');
            $show->field('city_name');
            $show->field('area');
            $show->field('area_name');
            $show->field('street');
            $show->field('street_name');
            $show->field('community');
            $show->field('community_name');
            $show->field('created_at');
            $show->field('updated_at');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Area(), function (Form $form) {
            $form->display('id');
            $form->text('city');
            $form->text('city_name');
            $form->text('area');
            $form->text('area_name');
            $form->text('street');
            $form->text('street_name');
            $form->text('community');
            $form->text('community_name');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
