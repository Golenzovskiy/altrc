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

Route::get('/', [
    'uses' => 'ProjectController@index',
]);

Route::get('create', [
    'uses' => 'ProjectController@create',
]);

Route::post('save', [
    'uses' => 'ProjectController@save',
]);

Route::post('filter', [
    'uses' => 'ProjectController@filter',
]);

Route::post('references/update', [
    'uses' => 'ReferencesController@update',
]);

Route::post('references/delete', [
    'uses' => 'ReferencesController@delete',
]);

Route::get('edit/{id}', [
    'uses' => 'ProjectController@edit',
]);

Route::post('edit/{id}', [
    'uses' => 'ProjectController@edit',
]);