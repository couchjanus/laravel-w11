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

Route::get('/hello', function() {
   return 'Hello World';
});

Route::match(['get', 'post'], '/foobar', function () {
    return 'Hello FooBar!';
});

Route::any('foomar', function () {
    return 'Hello Foomar!';
});

Route::get('bar', function () {
    return 'Hello Bar!';
})->name('bar');

Route::get('barab', [function () {
    return 'Hello Bar!';
}, 'as' => 'barz']);


Route::get('/hey', function() {
    return view('hello');
});
 
Route::get('hell', function() {
    return view('greeting');
});   
 
Route::get('/ole', function() {
    return view('hello.greeting', ['name' => 'Janus']);
});
 
Route::get('/oleole', function() {
    return view('hello/greeting', ['name' => 'Ole Janus']);
});
 
Route::get('/heyYou', function() {
    if (view()->exists('hello/greeting')) {
        return view('hello/greeting', ['name' => 'Hey U Janus! Whatsapp?']);
    }
});

Route::get('/bazuka', function() {
    return view('hello/bazuka', ['name' => 'Hey U Janus! Whatsapp?', 'title' => 'Bazuka Page', 'fooUrl'=>'heyYou']);
});
