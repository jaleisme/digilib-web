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
    return redirect('home/');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/books/viewlists','BooksController@viewlists');
Route::get('/books/lend/{id}','BooksController@lend');


Route::group(['middleware' => ['auth', 'checkRole:admin']], function(){
    Route::get('/books','BooksController@index');
//Controller Buku
Route::get('/books/add','BooksController@add');
Route::post('/books/store','BooksController@store');
Route::get('/books/edit/{id}','BooksController@edit');
Route::post('/books/update','BooksController@update');
Route::get('/books/delete/{id}','BooksController@delete');
Route::get('/books/detail/{id}','BooksController@detail');

//Siswa
Route::get('/siswa','SiswaController@index');
Route::get('/siswa/add','SiswaController@add');
Route::post('/siswa/store','SiswaController@store');
Route::get('/siswa/edit/{id}','SiswaController@edit');
Route::post('/siswa/update','SiswaController@update');
Route::get('/siswa/delete/{id}','SiswaController@delete');
// Route::get('/books/detail/{id}','BooksController@detail');

Route::get('/peminjaman','PeminjamanController@index');
// Route::get('/books/add','BooksController@add');
Route::post('/peminjaman/store','PeminjamanController@store');
Route::get('/peminjaman/kembalikan/{id}','PeminjamanController@kembalikan');
Route::get('/peminjaman/checkDeadline','PeminjamanController@checkDeadline');
// Route::get('/books/edit/{id}','BooksController@edit');
// Route::post('/books/update','BooksController@update');
// Route::get('/books/delete/{id}','BooksController@delete');
// Route::get('/books/detail/{id}','BooksController@detail');
});