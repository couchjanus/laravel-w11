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

Route::get('test', function () {

    $sampleArray = ['one', 'two', 'three'];
    dump($sampleArray);
    return 'Test Dump Server';
});

Route::get('test-dd', function () {
    $sampleArray = ['one', 'two', 'three'];
    Debugbar::info($sampleArray);
    Debugbar::error('Error!');
    Debugbar::warning('Watch out…');
    Debugbar::addMessage('Another message', 'mylabel');
    Debugbar::startMeasure('render','Time for rendering');
   
    Debugbar::stopMeasure('render');
    Debugbar::addMeasure('now', LARAVEL_START, microtime(true));
    Debugbar::startMeasure('now','Time for Larave start');
    Debugbar::measure('My long operation', function() {
        // Do something…
    });

    try {
        throw new Exception('foobar');
    } catch (Exception $e) {
        Debugbar::addException($e);
    }
    return 'Test Debugbar Tools';
});

// Route::get('about', 'AboutController@index');
Route::get('about', 'AboutController')->name('about');
Route::get('contact-us', 'ContactController@index')->name('contact');

// Route::get('admin', 'Admin\DashboardController@index');
Route::get('dashboard', ['uses' => 'Admin\DashboardController@index', 'as' => 'admin']);

Route::get('blog', ['uses' => 'PostController@index', 'as' => 'blog']);

Route::get('blog/create', ['uses' => 'PostController@create', 'as' => 'create']);

Route::post('blog/create', ['uses' => 'PostController@store', 'as' => 'store']);

Route::get('blog/{id}', 
['uses' => 'PostController@show', 'as' => 'show']);


