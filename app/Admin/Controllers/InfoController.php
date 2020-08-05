<?php

namespace App\Admin\Controllers;

use App\UserInfo;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class InfoController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '学员总结';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new UserInfo());
        $grid->model()->withCount(['zans']);

        $grid->column('id', __('Id'));
        $grid->column('userid', '用户ID');
        $grid->column('name', '姓名');
        $grid->column('house','学员组别')->filter();
        $grid->column('url', 'word版')->link(function ($info) {
            $link = url("userfile/".$info->url);
            return $link;
        });
        $grid->column('file', 'pdf版')->link(function ($info) {
            $link = url("userfile/".$info->file);
            return $link;
        });
        $grid->column('zans_count', '点赞数')->sortable();
        $grid->column('created_at', __('Created at'));

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
        $show = new Show(UserInfo::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('userid', __('Userid'));
        $show->field('year', __('Year'));
        $show->field('name', __('Name'));
        $show->field('house', __('House'));
        $show->field('tcolor', __('Tcolor'));
        $show->field('tsize', __('Tsize'));
        $show->field('url', __('Url'));
        $show->field('remark', __('Remark'));
        $show->field('file', __('File'));
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
        $form = new Form(new UserInfo());

        $form->text('userid', __('Userid'));
        $form->text('year', __('Year'));
        $form->text('name', __('Name'));
        $form->switch('house', __('House'));
        $form->switch('tcolor', __('Tcolor'));
        $form->switch('tsize', __('Tsize'));
        $form->url('url', __('Url'));
        $form->text('remark', __('Remark'));
        $form->file('file', __('File'));

        return $form;
    }
}
