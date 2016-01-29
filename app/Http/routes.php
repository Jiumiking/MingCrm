<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return redirect('/home');
});
// Authentication routes...
Route::auth();

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => 'permission'], function () {
    Route::get('home',['as'=>'home','uses'=>'HomeController@index']);
    /**增删改查**/
    Route::resource('user','UserController');
    Route::resource('role','RoleController');
    /**用户**/
    Route::get('user/changePassword/{id}',['as'=>'user.changePassword','uses'=>'UserController@changePassword']);
    Route::post('user/changePassword/{id}',['as'=>'user.storePassword','uses'=>'UserController@storePassword']);
    Route::get('user/changePersonalPassword',['as'=>'user.changePersonalPassword','uses'=>'UserController@changePersonalPassword']);
    Route::post('user/changePersonalPassword',['as'=>'user.storePersonalPassword','uses'=>'UserController@storePersonalPassword']);
    Route::get('user/checkPersonalPassword',['as'=>'user.checkPersonalPassword','uses'=>'UserController@checkPersonalPassword']);
    Route::get('user/uniqueUsername',['as'=>'user.uniqueUsername','uses'=>'UserController@uniqueUsername']);
    Route::get('user/uniqueMobile',['as'=>'user.uniqueMobile','uses'=>'UserController@uniqueMobile']);
    Route::get('user/uniqueEmail',['as'=>'user.uniqueEmail','uses'=>'UserController@uniqueEmail']);
    /**角色**/
    Route::get('role/editPermission/{id}',['as'=>'role.editPermission','uses'=>'RoleController@editPermission']);
    Route::post('role/storePermission/{role}',['as'=>'role.storePermission','uses'=>'RoleController@storePermission']);

});
