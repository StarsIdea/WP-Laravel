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
Auth::routes();
// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', 'MainController@recent')->name('rides');;
Route::get('/riders', 'MemberController@index');
Route::get('/horses', 'EquineController@horses');
Route::get('/events', 'EventController@events');
Route::get('/dashboard', 'AdminController@dashboard');
Route::get('/riders/view/{id}', 'MemberController@view');
Route::get('/horses/view/{id}', 'EquineController@view');
Route::get('/events/view/{id}', 'EventController@view');

Route::group(['prefix' => 'admin'], function () {
    
    Route::get('/ride', 'Admin\AdminRideController@list');
    Route::get('/ride/add', 'Admin\AdminRideController@create_update_form');
    Route::post('/ride/add', 'Admin\AdminRideController@create');
    Route::get('/ride/edit/{$id}', 'Admin\AdminRideController@create_update_form');
    Route::post('/ride/edit/{$id}', 'Admin\AdminRideController@update');
    Route::get('/ride/delete/{$id}', 'Admin\AdminRideController@delete');
    
    Route::get('/event_result', 'Admin\AdminEventResultController@list');
    Route::get('/event_result/add', 'Admin\AdminEventResultController@create_update_form');
    Route::post('/event_result/add', 'Admin\AdminEventResultController@create');
    Route::get('/event_result/edit/{$id}', 'Admin\AdminEventResultController@create_update_form');
    Route::post('/event_result/edit/{$id}', 'Admin\AdminEventResultController@update');
    Route::get('/event_result/delete/{$id}', 'Admin\AdminEventResultController@delete');
    
    Route::get('/member', 'Admin\AdminMemberController@list');
    Route::get('/member/add', 'Admin\AdminMemberController@create_update_form');
    Route::post('/member/add', 'Admin\AdminMemberController@create');
    Route::get('/member/edit/{$id}', 'Admin\AdminMemberController@create_update_form');
    Route::post('/member/edit/{$id}', 'Admin\AdminMemberController@update');
    Route::get('/member/delete/{$id}', 'Admin\AdminMemberController@delete');
    
    Route::get('/reclaim', 'Admin\AdminReclaimController@list');
    Route::get('/reclaim/add', 'Admin\AdminReclaimController@create_update_form');
    Route::post('/reclaim/add', 'Admin\AdminReclaimController@create');
    Route::get('/reclaim/edit/{$id}', 'Admin\AdminReclaimController@create_update_form');
    Route::post('/reclaim/edit/{$id}', 'Admin\AdminReclaimController@update');
    Route::get('/reclaim/delete/{$id}', 'Admin\AdminReclaimController@delete');
    
    Route::get('/equine', 'Admin\AdminEquineController@list');
    Route::get('/equine/add', 'Admin\AdminEquineController@create_update_form');
    Route::post('/equine/add', 'Admin\AdminEquineController@create');
    Route::get('/equine/edit/{$id}', 'Admin\AdminEquineController@create_update_form');
    Route::post('/equine/edit/{$id}', 'Admin\AdminEquineController@update');
    Route::get('/equine/delete/{$id}', 'Admin\AdminEquineController@delete');
    
    Route::get('/event_type', 'Admin\AdminEventTypeController@list');
    Route::get('/event_type/add', 'Admin\AdminEventTypeController@create_update_form');
    Route::post('/event_type/add', 'Admin\AdminEventTypeController@create');
    Route::get('/event_type/edit/{$id}', 'Admin\AdminEventTypeController@create_update_form');
    Route::post('/event_type/edit/{$id}', 'Admin\AdminEventTypeController@update');
    Route::get('/event_type/delete/{$id}', 'Admin\AdminEventTypeController@delete');
    
    Route::get('/member_type', 'Admin\AdminMemberTypeController@list');
    Route::get('/member_type/add', 'Admin\AdminMemberTypeController@create_update_form');
    Route::post('/member_type/add', 'Admin\AdminMemberTypeController@create');
    Route::get('/member_type/edit/{$id}', 'Admin\AdminMemberTypeController@create_update_form');
    Route::post('/member_type/edit/{$id}', 'Admin\AdminMemberTypeController@update');
    Route::get('/member_type/delete/{$id}', 'Admin\AdminMemberTypeController@delete');
    
    Route::get('/equine_sex', 'Admin\AdminEquineSexController@list');
    Route::get('/equine_sex/add', 'Admin\AdminEquineSexController@create_update_form');
    Route::post('/equine_sex/add', 'Admin\AdminEquineSexController@create');
    Route::get('/equine_sex/edit/{$id}', 'Admin\AdminEquineSexController@create_update_form');
    Route::post('/equine_sex/edit/{$id}', 'Admin\AdminEquineSexController@update');
    Route::get('/equine_sex/delete/{$id}', 'Admin\AdminEquineSexController@delete');
    
    Route::get('/federation', 'Admin\AdminFederationController@list');
    Route::get('/federation/add', 'Admin\AdminFederationController@create_update_form');
    Route::post('/federation/add', 'Admin\AdminFederationController@create');
    Route::get('/federation/edit/{$id}', 'Admin\AdminFederationController@create_update_form');
    Route::post('/federation/edit/{$id}', 'Admin\AdminFederationController@update');
    Route::get('/federation/delete/{$id}', 'Admin\AdminFederationController@delete');
});