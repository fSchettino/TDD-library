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

Route::post('/books', 'BooksController@store');
Route::put('/books/{book}-{slug}', 'BooksController@update');
Route::delete('/books/{book}-{slug}', 'BooksController@destroy');

Route::post('/checkout/{book}', 'CheckoutBookController@store');
Route::post('/checkin/{book}', 'CheckinBookController@store');

Route::post('/authors', 'AuthorsController@store');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
