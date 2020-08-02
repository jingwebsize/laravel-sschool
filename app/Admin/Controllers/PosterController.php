<?php

namespace App\Admin\Controllers;

use App\Poster;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Admin\Actions\Poster\Pass;

class PosterController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Poster';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Poster());
        $grid->column('id', __('Id'));
        $grid->model()->withCount(['comments','stars']);
        $grid->column('title', __('Title'))->link(function ($poster) {
            $link = url("poster/".$poster->id);
            return $link;
        });
        // $grid->column('abstract', __('Abstract'));
        // $grid->column('content', __('Content'));
        // $grid->column('imgurl', __('Imgurl'));
        // $grid->column('audiourl', __('Audiourl'))->width(500);
        // $grid->column('videourl', __('Videourl'))->width(500);
        // $grid->column('userid', __('Userid'));
        

        $grid->column('user.name', __('Username'));
        // $grid->column('flag', __('Flag'))->display(function ($flag,$column) {
        //     if ($flag == 0) {
        //         return '<span class="badge badge-danger">Off</span>';
        //     };
        //     $states = [
        //         2 => 'Pass',
        //     ];
        //     // 否则显示为editable
        //     return $column->radio($states);
        // })->filter();
        $grid->column('flag', __('Pass'))->action(Pass::class)->filter();
        
        // $grid->column('stars', 'Stars')->display(function ($stars){
        //     $count = count($stars);
        //     return "<span style='color:blue'>$count</span>";
        // });
        $grid->column('stars_count', 'Stars')->sortable();
        $grid->column('comments_count', 'Comments')->sortable();
        // $grid->column('created_at', __('Created at'));
        // $grid->column('updated_at', __('Updated at'));

        $grid->actions(function ($actions) {
        
            // 去掉查看
            $actions->disableView();
        });
        
        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Poster::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('Title'));
        // $show->field('abstract', __('Abstract'));
        // $show->field('content', __('Content'));
        $show->field('imgurl', __('Imgurl'));
        $show->field('audiourl', __('Audiourl'));
        $show->field('videourl', __('Videourl'));
        $show->field('userid', __('Userid'));
        $show->field('username', __('Username'));
        $show->field('flag', __('Flag'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Poster());

        $form->text('title', __('Title'));
        // $form->textarea('abstract', __('Abstract'));
        // $form->textarea('content', __('Content'));
        $form->text('imgurl', __('Imgurl'));
        $form->text('audiourl', __('Audiourl'));
        $form->textarea('videourl', __('Videourl'));
        $form->text('userid', __('Userid'));
        $form->text('username', __('Username'));
        // $form->switch('isvideo', __('Isvideo'));
        // $form->switch('flag', __('Flag'));
        $form->radio('isvideo', __('Isvideo'))->options(['0' => 'Music', '1'=> 'Video']);
        $form->radio('flag', __('Flag'))->options(['0' => 'User', '1'=> 'Submit', '2'=> 'Pass']);

        return $form;
    }
}
