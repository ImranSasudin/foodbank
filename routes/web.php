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
    return view('login');
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

    Route::get('/campaign/list', 'CampaignController@list')->name('campaigns.list');
    Route::get('/campaign/create', 'CampaignController@create')->name('campaigns.create');
    Route::post('/campaign/create', 'CampaignController@createPost')->name('campaigns.createPost');
    Route::get('/campaign/{id}/edit', 'CampaignController@edit')->name('campaigns.edit');
    Route::post('/campaign/update', 'CampaignController@update')->name('campaigns.update');
    Route::get('/campaign/{id}/delete', 'CampaignController@delete')->name('campaigns.delete');
    Route::get('/campaign/{id}/updateStatus', 'CampaignController@updateStatus')->name('campaigns.updateStatus');

    Route::get('/donation/listDonation', 'DonationController@listDonation')->name('donations.listDonation');
    Route::get('/donation/{id}/updateDonation', 'DonationController@updateDonation')->name('donations.updateDonation');
});

Route::group(['middleware' => 'CheckRole:Admin'], function () {
    Route::get('/employee/register', 'EmployeeController@registration')->name('employees.registerform');
    Route::post('/employee/register', 'EmployeeController@postRegistration')->name('employees.registration');
    Route::get('/employee/list', 'EmployeeController@list')->name('employees.list');
    Route::get('/employee/{id}/editEmployee', 'EmployeeController@editEmployee')->name('employees.editEmployee');
    Route::post('/employee/updateEmployee', 'EmployeeController@updateEmployee')->name('employees.updateEmployee');
});

Route::group(['middleware' => 'CheckRole:User'], function () {
    Route::get('/user/dashboard', 'UserController@dashboard')->name('users.dashboard');
    Route::get('/user/viewProfile', 'UserController@view')->name('users.viewProfile');
    Route::post('/user/password', 'UserController@password')->name('users.password');

    Route::get('/user/donate', 'DonationController@donate')->name('donations.create');
    Route::post('/user/donate', 'DonationController@donatePost')->name('donations.createPost');
    Route::get('/user/list', 'DonationController@list')->name('donations.list');
});

Route::get('/login', 'UserController@login')->name('users.loginForm');
Route::get('/logout', 'UserController@logout')->name('users.logout');

Route::post('/user/login', 'UserController@postLogin')->name('users.login');
Route::post('/employee/login', 'EmployeeController@postLogin')->name('employees.login');


