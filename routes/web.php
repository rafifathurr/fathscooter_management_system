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


// ALL CONTROLLERS

Route::get('/', function () {
    return view('auth.login');
});

Route::namespace('App\Http\Controllers')->group(function (){

    Route::namespace('login')->prefix('auth')->name('login.')->group(function () {
        Route::get('/login', 'LoginController@index')->name('index');
        Route::post('/login', 'LoginController@authenticate')->name('authenticate');
        Route::post('/logout', 'LoginController@logout')->name('logout');
    });

    Route::namespace('forgot')->prefix('auth')->name('forgot.')->group(function () {
        Route::get('/forgot', 'ForgotControllers@index')->name('index');
        Route::post('/forgot', 'ForgotControllers@updatepass')->name('updatepass');
    });

});

Route::namespace('App\Http\Controllers')->group(function (){
    Route::middleware('auth:admin')->prefix('admin')->name('admin.')->group(function () {
        // ROUTE TO DASHBOARD CONTROLLERS
        Route::namespace('dashboard')->name('dashboard.')->group(function () {
            Route::get('/dashboard-admin', 'DashboardControllers@index')->name('index');
        });

        // ROUTE TO ORDER CONTROLLERS
        Route::namespace('order')->prefix('order')->name('order.')->group(function () {
            Route::get('/', 'OrderControllers@index')->name('index');
            Route::get('create/{type}', 'OrderControllers@create')->name('create');
            Route::post('store', 'OrderControllers@store')->name('store');
            Route::get('getDetailProds', 'OrderControllers@getDetailProds')->name('getDetailProds');
            Route::get('detail/{id}', 'OrderControllers@detail')->name('detail');
            Route::get('edit/{id}', 'OrderControllers@edit')->name('edit');
            Route::post('update', 'OrderControllers@update')->name('update');
            Route::post('delete', 'OrderControllers@delete')->name('delete');
            Route::post('getMonth', 'OrderControllers@getMonth')->name('getMonth');
            Route::post('export', 'OrderControllers@export')->name('export');
        });

        // ROUTE TO PRODUCT CONTROLLERS
        Route::namespace('product')->prefix('product')->name('product.')->group(function () {
            Route::get('/', 'ProductControllers@index')->name('index');
            Route::get('create', 'ProductControllers@create')->name('create');
            Route::post('store', 'ProductControllers@store')->name('store');
            Route::get('detail/{id}', 'ProductControllers@detail')->name('detail');
            Route::get('edit/{id}', 'ProductControllers@edit')->name('edit');
            Route::post('update', 'ProductControllers@update')->name('update');
            Route::post('delete', 'ProductControllers@delete')->name('delete');
        });

        // ROUTE TO SOURCE PAYMENT CONTROLLERS
        Route::namespace('source_payment')->prefix('source-payment')->name('source_payment.')->group(function () {
            Route::get('/', 'SourceControllers@index')->name('index');
            Route::get('create', 'SourceControllers@create')->name('create');
            Route::post('store', 'SourceControllers@store')->name('store');
            Route::get('detail/{id}', 'SourceControllers@detail')->name('detail');
            Route::get('edit/{id}', 'SourceControllers@edit')->name('edit');
            Route::post('update', 'SourceControllers@update')->name('update');
            Route::post('delete', 'SourceControllers@delete')->name('delete');
        });

        // ROUTE TO SUPPLIER CONTROLLERS
        Route::namespace('supplier')->prefix('supplier')->name('supplier.')->group(function () {
            Route::get('/', 'SupplierControllers@index')->name('index');
            Route::get('create', 'SupplierControllers@create')->name('create');
            Route::post('store', 'SupplierControllers@store')->name('store');
            Route::get('detail/{id}', 'SupplierControllers@detail')->name('detail');
            Route::get('edit/{id}', 'SupplierControllers@edit')->name('edit');
            Route::post('update', 'SupplierControllers@update')->name('update');
            Route::post('delete', 'SupplierControllers@delete')->name('delete');
        });

        // ROUTE TO CATEGORY CONTROLLERS
        Route::namespace('category')->prefix('category')->name('category.')->group(function () {
            Route::get('/', 'CategoryControllers@index')->name('index');
            Route::get('create', 'CategoryControllers@create')->name('create');
            Route::post('store', 'CategoryControllers@store')->name('store');
            Route::get('detail/{id}', 'CategoryControllers@detail')->name('detail');
            Route::get('edit/{id}', 'CategoryControllers@edit')->name('edit');
            Route::post('update', 'CategoryControllers@update')->name('update');
            Route::post('delete', 'CategoryControllers@delete')->name('delete');
        });

        // ROUTE TO USERS CONTROLLERS
        Route::namespace('users')->prefix('users')->name('users.')->group(function () {
            Route::get('/', 'UsersControllers@index')->name('index');
            Route::get('create', 'UsersControllers@create')->name('create');
            Route::post('store', 'UsersControllers@store')->name('store');
            Route::get('detail/{id}', 'UsersControllers@detail')->name('detail');
            Route::get('edit/{id}', 'UsersControllers@edit')->name('edit');
            Route::post('update', 'UsersControllers@update')->name('update');
            Route::post('delete', 'UsersControllers@delete')->name('delete');
        });

        // ROUTE TO USER ROLES CONTROLLERS
        Route::namespace('role')->prefix('role')->name('role.')->group(function () {
            Route::get('/', 'RoleControllers@index')->name('index');
            Route::get('create', 'RoleControllers@create')->name('create');
            Route::post('store', 'RoleControllers@store')->name('store');
            Route::get('detail/{id}', 'RoleControllers@detail')->name('detail');
            Route::get('edit/{id}', 'RoleControllers@edit')->name('edit');
            Route::post('update', 'RoleControllers@update')->name('update');
            Route::post('delete', 'RoleControllers@delete')->name('delete');
        });
    });
    
    Route::middleware('auth:user')->prefix('user')->name('user.')->group(function () {

         // ROUTE TO DASHBOARD CONTROLLERS
         Route::namespace('dashboard')->name('dashboard.')->group(function () {
            Route::get('/dashboard-user', 'DashboardControllers@index')->name('index');
        });

        // ROUTE TO ORDER CONTROLLERS
        Route::namespace('order')->prefix('order')->name('order.')->group(function () {
            Route::get('/', 'OrderControllers@index')->name('index');
            Route::get('create', 'OrderControllers@create')->name('create');
            Route::post('store', 'OrderControllers@store')->name('store');
            Route::get('getDetailProds', 'OrderControllers@getDetailProds')->name('getDetailProds');
            Route::get('detail/{id}', 'OrderControllers@detail')->name('detail');
            Route::get('edit/{id}', 'OrderControllers@edit')->name('edit');
            Route::post('update', 'OrderControllers@update')->name('update');
            Route::post('delete', 'OrderControllers@delete')->name('delete');
        });

        // ROUTE TO PRODUCT CONTROLLERS
        Route::namespace('product')->prefix('product')->name('product.')->group(function () {
            Route::get('/', 'ProductControllers@index')->name('index');
            Route::get('create', 'ProductControllers@create')->name('create');
            Route::post('store', 'ProductControllers@store')->name('store');
            Route::get('detail/{id}', 'ProductControllers@detail')->name('detail');
            Route::get('edit/{id}', 'ProductControllers@edit')->name('edit');
            Route::post('update', 'ProductControllers@update')->name('update');
            Route::post('delete', 'ProductControllers@delete')->name('delete');
        });
    });
});


