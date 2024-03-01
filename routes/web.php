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

//EVERYONE HAS ACCESS HERE
Route::get('/home', 'HomeController@index');
Route::get('/searchData', 'HomeController@searchData');


Auth::routes();

Route::middleware(['role:Admin'])->group(function (){
//  =====> DASHBOARD <=====
    Route::get('/dashboard', 'DashboardController@index');

//  =====> USERS <=====
    Route::get('/users', 'UserController@index');
    Route::get('/add-users', 'UserController@create');
    Route::post('store-users', 'UserController@store');
    Route::get('edit-users/{id}', 'UserController@edit');
    Route::put('update-users/{id}', 'UserController@update');
    Route::delete('delete-users/{id}', 'UserController@delete');

//  =====> AUTHORS <=====
    Route::get('/author/create', 'AuthorController@create');
    Route::post('/authors', 'AuthorController@store');
    Route::delete('/delete-author/{id}', 'AuthorController@delete');

//  =====> PUBLISHED BOOKS <=====
    Route::get('publish/create', 'PublishBooksController@create');
    Route::post('published_books', 'PublishBooksController@store');
    Route::delete('/delete_published_book/{id}', 'PublishBooksController@delete');
});

Route::middleware(['role:Admin,Editor'])->group(function () {
//  =====> EDIT AUTHORS <=====
    Route::get('/author', 'AuthorController@index');
    Route::get('/author/edit/{id}', 'AuthorController@edit');
    Route::put('/update-author/{id}', 'AuthorController@update');

//  =====> EDIT PUBLISHED BOOKS <=====
    Route::get('/published_book', 'PublishBooksController@index');
    Route::get('/published_book/edit/{id}', 'PublishBooksController@edit');
    Route::put('/update_published_book/{id}', 'PublishBooksController@update');

//  =====> CHANGE THE STATUS OF A PUBLISHED BOOK <=====
    Route::put('/booksStatus/{id}', 'HomeController@update');

});



