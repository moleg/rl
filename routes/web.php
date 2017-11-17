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


    Route::get('/','StudentController@index')->name("index");
    Route::post('/registerstudent','StudentController@register');
    Route::post('/cityjson',function (){

        $citylist = File::get("city.json");
        return response($citylist);
    });



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/{name}', 'HomeController@name')->name('name');
Route::delete('home/delete/{id}', 'HomeController@delete')->name('delete');
Route::post('home/update','HomeController@update')->name('update');
Route::post('home/getmarks','HomeController@GetMarks')->name('get_marks');
Route::post('home/updatemarks','HomeController@UpdateMarks')->name('get_marks');
