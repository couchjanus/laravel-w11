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

Route::get('test', 'HomeController@showRequest');

Route::get('about', 'AboutController')->name('about');
Route::get('contact-us', 'ContactController@index')->name('contact');

Route::get('/test-cache', function () {
    // if (Cache::has('key')) {
    //     $item = \Cache::get('key');
    //     dump($item);
    // } else {
    //     echo "Not Key yet...";
    // }

    // $value = Cache::get('key', function () {
    //     return \DB::table('posts')->get();
    // });

    $minutes = 1;

    // Cache::put('posts', \DB::table('posts')->get(), $minutes);

    $expiresAt = \Carbon\Carbon::now()->addMinutes(10);
    // Cache::put('posts', \DB::table('posts')->get(), $expiresAt);
    
    // Cache::add('posts', \DB::table('posts')->get(), $expiresAt);
    // Cache::forever('posts', \DB::table('posts')->get());

    // $value = Cache::pull('posts');

    // Cache::forget('posts');

    // Cache::flush();
    
    $value = cache('posts');
    // cache(['posts' => \DB::table('posts')->get()], $minutes);

       
    // $value = Cache::remember('posts', $minutes, function () {
    //     return \DB::table('posts')->get();
    // });

    // $value = Cache::rememberForever('posts', function() {
    //     return \DB::table('posts')->get();
    // });
    
    dump($value);

});

  
 
Route::get('/test-redis', function () {

    return Cache::remember('posts.all', 60 * 60 * 24, function () {
        return \App\Post::all();
    });
    // redis has posts.all key exists 
    // posts found then it will return all post without touching the database
    // if ($posts = Redis::get('posts.all')) {
    //     return json_decode($posts);
    // }

    if ($posts = Redis::command('get',['posts.all'])) {
        return json_decode($posts);
    }
     
    // get all post
    $posts = \App\Post::all();
 
    // store into redis
    Redis::set('posts.all', $posts);
 
    // return all posts
    // dump($posts);
    // return $posts;
    
    
    // store data into redis for next 24 hours
    Redis::setex('posts.all', 60 * 60 * 24, $posts);

    // return all posts
    return $posts;
});


Route::get('redis-login', function() {
  return view('redis.login');
});

Route::post('redis-login', function(Request $request) {
  $redis = Redis::connection();
  $redis->hset('user', 'email', $request->get('email'));
  $redis->hset('user', 'name', $request->get('name'));
  return redirect(route('r-view'));
})->name('r-login');

Route::get('redis-view', function() {
  $redis = Redis::connection();
  $name = $redis->hget('user', 'name');
  $email = $redis->hget('user', 'email');
  echo 'Hello ' . $name . '. Your email is ' . $email;
  dump($redis->hgetall('user'));
})->name('r-view');



Route::get('blog','PostController@index')->name('blog.index'); 
// Route::get('blog/{post}','PostController@show')->name('blog.show'); 
Route::get('blog/{post}','PostController@showFromCache')->name('blog.show'); 

// Route::get('blog/{blog}', function (App\Post $blog) {
//     return view('blog.show', ['post' => $blog, 'hescomment'=>false]);
// });

// Route::get('blog/{slug}','PostController@showBySlug')->name('blog.show'); 

// Route::get('admin', 'Admin\DashboardController@index');
// Route::get('dashboard', ['uses' => 'Admin\DashboardController@index', 'as' => 'admin']);

// Зарегистрировать маршрут контроллера ресурса:
// Route::resource('posts', 'Admin\PostController');

Route::prefix('admin')->group(function () {
    Route::get('', 'Admin\DashboardController@index');
    Route::get('test/{id}', 'Admin\PostController@getFirstOrFail');
    Route::resource('posts', 'Admin\PostController');
    Route::resource('users', 'Admin\UserController');
    Route::resource('categories', 'Admin\CategoryController');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
