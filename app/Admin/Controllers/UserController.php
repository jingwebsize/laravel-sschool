<?php

namespace App\Admin\Controllers;

use App\Extensions\UsersExport;
use App\Admin\Actions\Post\ImportUser;
use App\User;
use App\UserProfile;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Widgets\Table;

class UserController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Students';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        // $grid = new Grid(new User());
        // $grid->column('id', __('Id'));
        // $grid->column('name', __('用户名'))->sortable();
        // $grid->column('email', __('Email'));
        // // $grid->column('email_verified_at', __('Email verified at'));
        // // $grid->column('password', __('Password'));
        // // $grid->column('remember_token', __('Remember token'));
        // // $grid->column('created_at', __('Created at'));
        // // $grid->column('updated_at', __('Updated at'));

        // return $grid;
        $typearr = array('无','硕士','博士','硕博连读','博士后','青年教师');
        // $grid = new Grid(new UserProfile());
        $grid = new Grid(new User());
        // $grid->column('user.id', 'Id');
        // $grid->column('user.tel', '用户名(手机号)')->sortable();
        // $grid->column('user.email', 'Email');
        // $grid->column('name', '姓名');
        // $grid->column('school', '学校')->sortable();
        // $grid->column('tutor', '导师')->sortable();
        // $grid->column('type', '类别')->using($typearr)->filter();
        // $grid->column('url')->link();
        $grid->column('id', 'Id');
        $grid->column('name', 'Name');
        $grid->column('tel', 'Tel(Username)')->sortable();
        $grid->column('email', 'Email');
        $grid->column('profile', 'History')->display(function ($profile){
            $count = count($profile);
            return "<span style='color:blue'>$count</span>";
        })->modal('Detail',function ($model) {
            $firstone = $model->profile()->first()->only(['year', 'school', 'tutor','type','major']);
            $str ='';
            foreach ($firstone as $key=>$res){
                $key=ucfirst($key);
                $str.="<div class='mb-3'><label>$key:</label> $res</div>";
            }
            return "$str";
        });
        // $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->exporter(new UsersExport());
        $grid->tools(function (Grid\Tools $tools) {
            $tools->append(new ImportUser());
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
        $show = new Show(User::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('email', __('Email'));
        $show->field('email_verified_at', __('Email verified at'));
        $show->field('password', __('Password'));
        $show->field('remember_token', __('Remember token'));
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
        $form = new Form(new User());

        $form->text('name', __('Name'));
        $form->email('email', __('Email'));
        $form->datetime('email_verified_at', __('Email verified at'))->default(date('Y-m-d H:i:s'));
        $form->password('password', __('Password'));
        $form->text('remember_token', __('Remember token'));

        return $form;
    }
}
