<?php
use Illuminate\Support\Facades\Redis;
use Illuminate\Http\Request;
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

Route::get('test', 'WidgetTestController@index');
Route::get('about', 'AboutController')->name('about');
Route::get('contact-us', 'ContactController@index')->name('contact');


Route::prefix('blog')->group(function () {
    Route::get('', 'PostController@index')->name('blog.index');
    Route::get('{post}','PostController@showFromCache')->name('blog.show'); 
    Route::get('category/{id}', 'PostController@getPostsByCategory')->name('blog.category');
});

// Route::get('blog','PostController@index')->name('blog.index'); 
// Route::get('blog/{post}','PostController@showFromCache')->name('blog.show'); 
// Route::get('blog/category/{id}', 'PostController@getPostsByCategory')->name('blog.category');

// Route::get('blog/{blog}', function (App\Post $blog) {
//     return view('blog.show', ['post' => $blog, 'hescomment'=>false]);
// });

// Route::get('blog/{slug}','PostController@showBySlug')->name('blog.show'); 

// Route::get('admin', 'Admin\DashboardController@index');
// Route::get('dashboard', ['uses' => 'Admin\DashboardController@index', 'as' => 'admin']);

// Route::get('admin/status', 'Admin\PostController@getPostsByStatus')->name('posts.status');
// Route::get('admin/sort', 'Admin\PostController@sortPostsByDate')->name('posts.sort');
// Route::post('/restore/{id}', 'Admin\UserController@restore')->name('users.restore');

// Route::delete('/userdestroy/{id}', 'Admin\UserController@userDestroy')->name('user.force.destroy');

// Route::delete('/userdestroy/{user}', 'Admin\UserController@userDestroy')->name('user.force.destroy');

Route::prefix('admin')->group(function () {
    Route::get('', 'Admin\DashboardController@index');
    Route::get('trashed', 'Admin\UserController@trashed')->name('users.trashed');
    Route::delete('user-destroy/{id}', 'Admin\UserController@userDestroy')->name('user.force.destroy');
    Route::get('test/{id}', 'Admin\PostController@getFirstOrFail');
    Route::get('status', 'Admin\PostController@getPostsByStatus')->name('posts.status');
    Route::get('sort', 'Admin\PostController@sortPostsByDate')->name('posts.sort');
    Route::post('restore/{id}', 'Admin\UserController@restore')->name('users.restore');
    
    Route::resource('posts', 'Admin\PostController');
    Route::resource('users', 'Admin\UserController');
    Route::resource('tags', 'Admin\TagController');
    Route::resource('categories', 'Admin\CategoryController');
    
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

// Только проверенные пользователи могут войти ..
Route::middleware('web')->group(function () {
  Route::middleware('auth')->middleware('verified')->prefix('profile')->group(function () {
      Route::get('', 'ProfileController@index')
          ->name('profile');
      Route::put('information', 'ProfileController@store')
          ->name('profile.info.store');
      Route::get('security', 'ProfileController@showPasswordForm')
          ->name('profile.security');
      Route::put('security', 'ProfileController@storePassword')
          ->name('profile.security.store');
  });
});

// Route::get('/reminder', function () {
//     return new App\Mail\Reminder();
// });

// Route::get('/reminder', function () {
//     return new App\Mail\Reminder(storage_path('/app/public/logo.png'));
// });

Route::get('/reminder', function () {
    return new App\Mail\Reminder(public_path('/images/cat.jpg'), 'Blahamuha');
});

// Route::get('/order', function () {
//     return new App\Mail\OrderShipped();
// });


// Route::get('/order', function () {
//     $invoice = 'Your Invoice Send';
//     return (new App\Mail\OrderShipped($invoice))->render();
// });


Route::get('/order', function () {
    $invoice = App\Order::find(1);
    // return (new App\Mail\OrderShipped($invoice))->render();
    return new App\Mail\OrderShipped($invoice);
});

Route::get('ship', 
   ['as' => 'order.index', 'uses' => 'OrderController@index']);

Route::post('ship/{id}', 
   ['as' => 'order.ship', 'uses' => 'OrderController@ship']);


Route::get('/feedback', 'FeedbackController@create');
Route::post('/feedback/create', 'FeedbackController@store');

Route::get('/feedbacks', 'Admin\FeedbackController@index')->name('feedbacks.index');
Route::get('/feedbacks/delete/{id}', 'Admin\FeedbackController@destroy');
   
// Socialite Register Routes
   
// Route::get('social/{provider}', 'Auth\SocialController@redirect')->name('social.redirect');
// Route::get('social/{provider}/callback', 'Auth\SocialController@callback')->name('social.callback');
   