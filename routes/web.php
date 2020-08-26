<?php


define('paginations',10);

Route::group(['namespace'=>'Pages'],function (){
Route::get('/', 'PageController@index' );
Route::get('/about', 'PageController@about' );
Route::get('/services', 'PageController@services' );

});

Route::group(['namespace'=>'posts' ],function () {
    Route::get('/posts', 'PostController@index')->name('posts.index');

    Route::get('/posts/create', 'PostController@create')->name('posts.create');
    Route::post('/posts', 'PostController@store')->name('posts.store');
    Route::get('/posts/{id}', 'PostController@show')->name('posts.show');

    Route::get('/posts/{id}/edit', 'PostController@edit')->name('posts.edit');
    Route::put('/posts/{id}', 'PostController@update')->name('posts.update');

    Route::DELETE('/posts/{id}', 'PostController@delete')->name('posts.destroy');

});

Auth::Routes();

route::get('/dashboard','DashBoardController@index')->name('dashboard');
