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

$router->get('/categories', 'Api\CategoryController@index');
$router->get('/chapters', 'Api\ChapterController@index');

$router->resource('/drafts', 'Api\PageDraftController');
