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

Route::get('test', 'Admin\PostController@testIds');

Route::get('about', 'AboutController')->name('about');
Route::get('contact-us', 'ContactController@index')->name('contact');

// Route::get('blog', ['uses' => 'PostController@index', 'as' => 'blog']);
// Route::get('blog/create', ['uses' => 'PostController@create', 'as' => 'create']);
// Route::post('blog/create', ['uses' => 'PostController@store', 'as' => 'store']);
// Route::get('blog/{id}', 
// ['uses' => 'PostController@show', 'as' => 'show']);

// Route::resource(
//         'blog', 'PostController', [
//             'only' => [
//                 'index', 'show'
//             ]
//         ]
//     );

Route::resource(
        'blog', 'PostController', [
            'except' => [
                'create', 'store', 'update', 'destroy'
            ]
        ]
    );
 

// Route::get('admin', 'Admin\DashboardController@index');
// Route::get('dashboard', ['uses' => 'Admin\DashboardController@index', 'as' => 'admin']);

// Зарегистрировать маршрут контроллера ресурса:
// Route::resource('posts', 'Admin\PostController');

Route::prefix('admin')->group(function () {
    Route::get('', 'Admin\DashboardController@index');
    Route::get('test/{id}', 'Admin\PostController@getFirstOrFail');
    Route::resource('posts', 'Admin\PostController');
    Route::resource('categories', 'Admin\CategoryController');
});
