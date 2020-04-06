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

Route::resource('categories','CategoriesController');
Route::resource('cities','CitiesController');
Route::resource('ads','AdsController');
Route::resource('editor','CKEditorController');
Route::resource('pages', 'PagesController');
//Route::get('pages/{}', 'PagesController@show');


Auth::routes();


Route::get('ads/{id}/upload', 'GalleriesController@uploadForm');
Route::post('ads/{id}', 'GalleriesController@uploadSubmit');
Route::get('ads/photos/{id}', 'GalleriesController@show');
Route::delete('ads/photos/{id}', 'GalleriesController@destroy');

Route::get('/home', 'HomeController@index')->name('home');
