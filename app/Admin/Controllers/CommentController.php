<?php

namespace App\Admin\Controllers;

use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Laravelista\Comments\Comment;

class CommentController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Laravelista\Comments\Comment';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Comment());

        $grid->column('id', __('Id'));
        $grid->model()->orderBy('created_at','desc');
        $grid->column('commenter_id', __('Commenter id'));
        // $grid->column('commenter_type', __('Commenter type'));
        // $grid->column('guest_name', __('Guest name'));
        // $grid->column('guest_email', __('Guest email'));
        // $grid->column('commentable_type', __('Commentable type'));
        $grid->column('commentable_id', __('Commentable id'));
        $grid->column('comment', __('Comment'));
        // $grid->column('approved', __('Approved'));
        $grid->column('child_id', __('Child id'));
        // $grid->column('deleted_at', __('Deleted at'));
        $grid->column('created_at', __('Created at'));
        // $grid->column('updated_at', __('Updated at'));

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
        $show = new Show(Comment::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('commenter_id', __('Commenter id'));
        $show->field('commenter_type', __('Commenter type'));
        $show->field('guest_name', __('Guest name'));
        $show->field('guest_email', __('Guest email'));
        $show->field('commentable_type', __('Commentable type'));
        $show->field('commentable_id', __('Commentable id'));
        $show->field('comment', __('Comment'));
        $show->field('approved', __('Approved'));
        $show->field('child_id', __('Child id'));
        $show->field('deleted_at', __('Deleted at'));
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
        $form = new Form(new Comment());

        $form->text('commenter_id', __('Commenter id'));
        $form->text('commenter_type', __('Commenter type'));
        $form->text('guest_name', __('Guest name'));
        $form->text('guest_email', __('Guest email'));
        $form->text('commentable_type', __('Commentable type'));
        $form->text('commentable_id', __('Commentable id'));
        $form->textarea('comment', __('Comment'));
        $form->switch('approved', __('Approved'))->default(1);
        $form->number('child_id', __('Child id'));

        return $form;
    }
}
