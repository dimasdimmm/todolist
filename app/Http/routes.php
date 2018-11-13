<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/todolist', 'TodoController@listTodo')->name('list_todo');
Route::post('/todolist', 'TodoController@saveListTodo')->name('list_todo_post');
Route::post('/todolist_delete', 'TodoController@deleteListTodo')->name('list_todo_delete');
