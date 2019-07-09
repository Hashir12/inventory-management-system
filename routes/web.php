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

Route::get('/', [
    'uses' => 'userController@index',
    'as' => 'index'
])->middleware('guest');


Route::post('signup', 'userController@usersignup');

Route::post('recoverPassword', 'userController@recover');

Route::post('resetPass', 'userController@reset');

Route::get('/reset', function () {
    return view('resetPassword');
});

Route::get('login', 'userController@userlogin')->middleware('guest');

Route::group(['middleware' => 'auth'], function () {

    Route::get('userprofile', 'userController@profile');

    Route::get('inventory', function () {
        return view('user.userProfile');
    });

    Route::post('changeStatus', 'RecordController@changeStatus');

    Route::post('addRecord', 'RecordController@addRecord');

    Route::get('fetchData', 'RecordController@fetchData');

    Route::post('saleitem', 'BillController@saleItem');

    Route::post('additem', 'RecordController@addItem');

    Route::post('lessitem', 'RecordController@lessItem');

    Route::post('test', 'TestController@test');

    Route::get('relation', 'SaleRecordController@index');

    Route::post('update', 'RecordController@update');

    Route::post('zeroRecord', 'RecordController@records');

    Route::get('customers', 'SaleRecordController@index');

    Route::get('fetchUsers', 'UserController@fetchUsers');

    Route::post('userRole', 'UserController@userRole');

    Route::post('usershop', 'UserController@usershop');

    Route::post('searchById', 'saleRecordController@searchById');

    Route::post('deleteUser', 'UserController@delete');

    Route::post('active', 'RecordController@activerecord');

    Route::post('recordData', 'SaleRecordController@recordData');

    Route::post('orderBy', 'RecordController@orderBy');

    Route::post('monthSale', 'BillController@monthlySale');

});

Route::get('userLogout', 'userController@logout');
