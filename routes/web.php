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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/read', 'HomeController@read');
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/editConstraint', 'ConstraintController@editConstraint');
Route::post('/editDepartment', 'ConstraintController@editDepartment');
Route::post('/addDepartment', 'ConstraintController@addDepartment');
Route::get('/deleteDepartment/{id}', 'ConstraintController@deleteDepartment')->name('deleteDepartment');
Route::post('/editEmployeeDepartment', 'ConstraintController@editEmployeeDepartment');
Route::get('/setting', 'HomeController@setting')->name('setting');
Route::post('/home', 'HomeController@employeeFilter')->name('employeeFilter');
Route::get('/employee', 'HomeController@attendedEmployee')->name('attendedEmployee');
Route::post('/createEmployee', 'HomeController@createEmployee')->name('createEmployee');
Route::get('/employeeList', 'HomeController@employeeList')->name('employeeList');
Route::post('/deleteEmployee', 'HomeController@deleteEmployee')->name('deleteEmployee');
Route::get('/generelReport', 'HomeController@generelReport')->name('generelReport');
Route::get('/mainReport','reportController@mainReport')->name('mainReport');
Route::post('/filterEmployeeReport','reportController@filterEmployeeReport')->name('filterEmployeeReport');
Route::get('/employeeReport','reportController@employeeReport')->name('employeeReport');
Route::post('/generalRepotfilter', 'HomeController@generalRepotfilter')->name('generalRepotfilter');
Route::get('/adminLogin', 'Auth\LoginController@showLoginform')->name('adminLogin');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
Route::post('/attend', 'Auth\LoginController@attend')->name('attend');
Route::get('getImport','ExcelController@getImport');
Route::get('getData','ExcelController@getImport');
Route::post('postImport','ExcelController@postImport');
Route::post('importXL','HomeController@importXL');
Route::get('exportXL/{type}','HomeController@exportXL');
Route::get('collection','HomeController@collection');
