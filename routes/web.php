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

// des URI book/1, book/2 le paramètre {id} est paramètre variable
// récupérer par la méthode show
Route::get('show/{id}', 'FrontController@show')->name('show_book');
Route::get('author/{id}', 'FrontController@showAuthor')->name('show_book_author');

// $_GET['id']
Route::get('genre/{id}', 'FrontController@showGenre')->name('show_book_genre');

// page index 
Route::get('/', 'FrontController@index')->name('home');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

// On connecte l'ensemble des routes à nos actions du controller de resource BookController
Route::resource('book', 'BookController')->middleware('auth');
