<?php

use App\Applicant;
use App\Events\ApplicationStatusChanged;

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

Auth::routes();



Route::group(['middleware' => 'auth'], function () {

    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('/application','ApplicantController');
    Route::resource('/inspection','InspectionController');
    Route::resource('/paid','PaidController');
    Route::resource('/user','UserController',['except'=>['create','show']]);
    Route::patch('application/{id}/for_inspection/','ApplicantController@forInspection')->name('applicant.forinspection');
    Route::patch('application/{id}/declined/','ApplicantController@applicantDeclined')->name('applicant.decline');
    Route::patch('application/{id}/paid/','ApplicantController@applicantPaid')->name('applicant.paid');
    Route::post('/user/profile','UserProfileController@changePass')->name('change.password');
    Route::get('/user/profile','UserProfileController@index')->name('profile.index');
    Route::patch('admin/users/{id}/in_active/','UserController@inActive')->name('user.inactive');
    Route::patch('admin/users/{id}/is_active/','UserController@isActive')->name('user.active');
    Route::patch('admin/users/{id}/password/','UserController@userChangedPassword')->name('user.gernerate-password');
});

Route::get('/fire',function(){
    $id = Applicant::find(1);
    event(new ApplicationStatusChanged($id));
    return 'Fired';
});