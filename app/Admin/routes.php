<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('admin.home');
    $router->resource('students', UserController::class);
    $router->resource('posters', PosterController::class);
    $router->resource('comments', CommentController::class);
    $router->resource('summary', InfoController::class);
    $router->get('students/export', 'UsersController@export')->name('users.export');
    $router->get('students/import', 'UsersController@import')->name('users.import');
});
