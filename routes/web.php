<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'CheckRole:Employee'], function () {
    Route::get('/employee/dashboard', 'EmployeeController@dashboard')->name('employees.dashboard');
    Route::get('/employee/viewProfile', 'EmployeeController@view')->name('employees.viewProfile');
    Route::get('/employee/editProfile', 'EmployeeController@editProfile')->name('employees.editProfile');
    Route::post('/employee/updateProfile', 'EmployeeController@updateProfile')->name('employees.updateProfile');
    Route::post('/employee/password', 'EmployeeController@password')->name('employees.password');

    Route::get('/donor/list', 'UserController@list')->name('users.list');
    Route::get('/donor/register', 'UserController@registration')->name('users.registerform');
    Route::post('/donor/register', 'UserController@postRegistration')->name('users.registration');
    Route::get('/donor/{id}/edit', 'UserController@edit')->name('users.edit');
    Route::post('/donor/update', 'UserController@update')->name('users.update');

    Route::get('/food/list', 'FoodController@list')->name('foods.list');
    Route::get('/food/create', 'FoodController@create')->name('foods.create');
    Route::post('/food/create', 'FoodController@createPost')->name('foods.createPost');
    Route::get('/food/{id}/edit', 'FoodController@edit')->name('foods.edit');
    Route::post('/food/update', 'FoodController@update')->name('foods.update');
    Route::get('/food/{id}/delete', 'FoodController@delete')->name('foods.delete');
});

Route::group(['middleware' => 'CheckRole:Admin'], function () {
    Route::get('/employee/register', 'EmployeeController@registration')->name('employees.registerform');
    Route::post('/employee/register', 'EmployeeController@postRegistration')->name('employees.registration');
    Route::get('/employee/list', 'EmployeeController@list')->name('employees.list');
    Route::get('/employee/{id}/editEmployee', 'EmployeeController@editEmployee')->name('employees.editEmployee');
    Route::post('/employee/updateEmployee', 'EmployeeController@updateEmployee')->name('employees.updateEmployee');
});

Route::get('/login', 'UserController@login')->name('users.loginForm');
Route::get('/logout', 'UserController@logout')->name('users.logout');

Route::post('/user/login', 'UserController@postLogin')->name('users.login');
Route::post('/employee/login', 'EmployeeController@postLogin')->name('employees.login');


