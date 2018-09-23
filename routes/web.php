<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

$router->middleware('web')->group(function ($router) {
    $router->get('/denied', 'Auth\LoginController@accessDenied')->name('login.denied');

    $router->middleware(['guest'])->group(function ($router) {
        $router->get('login', 'Auth\LoginController@login')->name('login');
        $router->get('oauth/bitbucket', 'Auth\LoginController@loginWithBitbucket');
    });

    $router->middleware(['auth'])->group(function ($router) {
        $router->get('/logout', 'Auth\LoginController@logout');
        $router->get('/', 'HomeController@index')->name('home');

        $router->resource('/categories', 'CategoryController');
        $router->get('/categories/select/{category}', 'CategoryController@select')->name('categories.select');

        $router->resource('/pages', 'PageController')->except('show');
        $router->get('/p/{categorySlug}/{chapterSlug}/{pageSlug}', 'PageController@show')->name('pages.show');

        $router->resource('/chapters', 'ChapterController');

        // $router->get('/p/{categorySlug}/{chapterSlug}', 'ChapterController@show')->name('chapters.show');
        // $router->get('/p/{categorySlug}/', 'CategoryController@show')->name('categories.show');
    });
});
