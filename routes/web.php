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

// Auth::routes();

Auth::routes(['register'=>false]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('pdf_export', 'PdfController@index');

Route::get('xml_export/{id}', 'XMLController@index');

Route::get('/{vue_capture?}', function () {
    return view('layouts.master');
})->where('vue_capture', '[\/\w\.-]*')->middleware('auth');

Route::get('/clientsxml', function(){
    $clients = App\addPatient::all();
    return response()->xml(['clients'=>$clients->toArray()]);
});
