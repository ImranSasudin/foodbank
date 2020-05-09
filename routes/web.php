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

Route::get('/employee/register', 'EmployeeController@registration')->name('employees.registerform');
Route::post('/employee/register', 'EmployeeController@postRegistration')->name('employees.registration');

Route::get('/login', 'UserController@login')->name('users.loginForm');

Route::post('/user/login', 'UserController@postLogin')->name('users.login');
Route::post('/employee/login', 'EmployeeController@postLogin')->name('employees.login');

Route::get('/logout', 'UserController@logout')->name('users.logout');
Route::get('/logout', 'UserController@logout')->name('users.logout');
