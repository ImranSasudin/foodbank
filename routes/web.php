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

Route::group(['middleware' => 'CheckRole:Admin'], function () {
    Route::get('/employee/register', 'EmployeeController@registration')->name('employees.registerform');
    Route::post('/employee/register', 'EmployeeController@postRegistration')->name('employees.registration');
});

Route::group(['middleware' => 'CheckRole:Employee'], function () {
    Route::get('/employee/dashboard', 'EmployeeController@dashboard')->name('employees.dashboard');
    Route::get('/employee/viewProfile', 'EmployeeController@view')->name('employees.viewProfile');
    Route::get('/employee/editProfile', 'EmployeeController@editProfile')->name('employees.editProfile');
    Route::post('/employee/updateProfile', 'EmployeeController@updateProfile')->name('employees.updateProfile');
});

Route::get('/login', 'UserController@login')->name('users.loginForm');

Route::post('/user/login', 'UserController@postLogin')->name('users.login');
Route::post('/employee/login', 'EmployeeController@postLogin')->name('employees.login');

Route::get('/logout', 'UserController@logout')->name('users.logout');
Route::get('/logout', 'UserController@logout')->name('users.logout');
