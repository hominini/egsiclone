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



Auth::routes(['register' => false, 'verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function() {
    Route::get('/', function () {
        return view('admin.home');
    });
    Route::get('/admin', function () {
        return view('admin.home');
    });
    Route::resource('roles','RoleController');
    Route::resource('users','UserController');
    Route::resource('products','ProductController');
    Route::resource('institutions','InstitutionsController');
    Route::resource('milestones','MilestoneController');
    Route::resource('fulfillments','FulfillmentController');
    Route::get('categories', 'CategoryController@index');
    Route::resource('fulfillment_activities','FulfillmentActivityController');
    Route::get('assessment', 'AssessmentController@index')->name('assessment.index');
});

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

