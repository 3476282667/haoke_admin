<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\House;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class HouseController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new House(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('title');
            $grid->column('entire');
            $grid->column('price_num')->sortable();
            $grid->column('room_type_name');
            $grid->column('community');
            $grid->column('supporting');
            $grid->column('oriented_name');
            $grid->column('floor');
            $grid->column('area_name');
            $grid->column('tags');
            $grid->column('size')->sortable();
            $grid->column('user_id');
            $grid->column('createdAt')->sortable();
            $grid->column('updatedAt')->sortable();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
                $filter->like('title');
                $filter->like('area_name');
                $filter->like('community');
                $filter->like('supporting');
                $filter->like('oriented_name');
                $filter->between('size');

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
        return Show::make($id, new House(), function (Show $show) {
            $show->field('id');
            $show->field('title');
            $show->field('entire');
            $show->field('price_num');
            $show->field('room_type_name');
            $show->field('community');
            $show->field('supporting');
            $show->field('oriented_name');
            $show->field('floor');
            $show->field('area_name');
            $show->field('tags');
            $show->field('size');
            $show->field('user_id');
            $show->field('createdAt');
            $show->field('updatedAt');
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
        return Form::make(new House(), function (Form $form) {
            $form->display('id');
            $form->text('title');
            $form->text('entire');
            $form->text('price_num');
            $form->text('room_type_name');
            $form->text('community');
            $form->text('supporting');
            $form->text('oriented_name');
            $form->text('floor');
            $form->text('area_name');
            $form->text('tags');
            $form->text('size');
            $form->text('user_id');
            $form->text('createdAt');
            $form->text('updatedAt');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
