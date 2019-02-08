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
    dump(url()->current());
    dump(url()->full());
    dump(url()->previous());

    return 'Test Dump Server';
});

Route::get('test-dd', function () {
    $sampleArray = ['one', 'two', 'three'];
    Debugbar::info($sampleArray);

    Debugbar::info(url()->current());
    Debugbar::info(url()->full());
    Debugbar::info(url()->previous());

    Debugbar::error('Error!');
    Debugbar::warning('Watch out…');
    Debugbar::addMessage('Another message', 'mylabel');
    
    Debugbar::startMeasure('render','Time for rendering');
   
    Debugbar::stopMeasure('render');

    Debugbar::addMeasure('Count Time', LARAVEL_START, microtime(true));
    Debugbar::startMeasure('Count Time','Time for Laravel start');
    Debugbar::stopMeasure('Count Time');

    Debugbar::measure('My long operation', function() {
        // Do something…
        $total = 0;
        for ($i=0; $i<10000; $i++) {
            $total +=$i;
        }
        dump($total);
    });
    
    try {
        throw new Exception('foobar Exception');
    } catch (Exception $e) {
        Debugbar::addException($e);
    }
    return 'Test Debugbar Tools';
});

// Route::get('about', 'AboutController@index');
Route::get('about', 'AboutController')->name('about');
Route::get('contact-us', 'ContactController@index')->name('contact');

Route::get('admin', 'Admin\DashboardController@index');
// Route::get('dashboard', ['uses' => 'Admin\DashboardController@index', 'as' => 'admin']);

Route::get('blog', ['uses' => 'PostController@index', 'as' => 'blog']);

Route::get('blog/create', ['uses' => 'PostController@create', 'as' => 'create']);

Route::post('blog/create', ['uses' => 'PostController@store', 'as' => 'store']);

Route::get('blog/{id}', 
['uses' => 'PostController@show', 'as' => 'show']);


