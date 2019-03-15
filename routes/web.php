<?php
use Illuminate\Support\Facades\Redis;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Input;
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

Route::get('about', 'AboutController')->name('about');
Route::get('contact-us', 'ContactController@index')->name('contact');


Route::get('test', 'TestController@index');

Route::get('articles', 'ArticleController@index')->name('articles.index');
Route::get('articles/{id}','ArticleController@show')->name('articles.show'); 

Route::prefix('blog')->group(function () {
    Route::get('', 'PostController@index')->name('blog.index');
    Route::get('{post}','PostController@show')->name('blog.show'); 
    Route::get('category/{id}', 'PostController@getPostsByCategory')->name('blog.category');
});

Route::prefix('admin')->group(function () {
    Route::get('', 'Admin\DashboardController@index');
    Route::get('trashed', 'Admin\UserController@trashed')->name('users.trashed');
    Route::delete('user-destroy/{id}', 'Admin\UserController@userDestroy')->name('user.force.destroy');
    Route::get('test/{id}', 'Admin\PostController@getFirstOrFail');
    Route::get('status', 'Admin\PostController@getPostsByStatus')->name('posts.status');
    Route::get('sort', 'Admin\PostController@sortPostsByDate')->name('posts.sort');
    Route::post('restore/{id}', 'Admin\UserController@restore')->name('users.restore');
    
    Route::resource('posts', 'Admin\PostController');
    Route::resource('roles', 'Admin\RoleController');
    Route::resource('permissions', 'Admin\PermissionController');
    Route::resource('users', 'Admin\UserController');
    Route::resource('tags', 'Admin\TagController');
    Route::resource('categories', 'Admin\CategoryController');

    Route::any('users/search',function(){
      $q = Input::get ( 'q' );
      $users = User::where('name','LIKE','%'.$q.'%')->orWhere('email','LIKE','%'.$q.'%')->paginate();
      if(count($users) > 0) {
          return view('admin.users.index')->withUsers($users)->withQuery($q);
      } else {
            return redirect(route('users.index'))->withType('warning')->withMessage('No Details found. Try to search again !');
      }
    });
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

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
    Route::get('list', 'PostController@list')
          ->name('profile.post.list');
    Route::get('create', 'PostController@create')
          ->name('profile.post.create');
    Route::get('show/{post}', 'PostController@view')
          ->name('profile.post.show');
    Route::get('edit/{post}', 'PostController@edit')
          ->name('profile.post.edit');
    Route::put('update/{post}', 'PostController@update')
          ->name('profile.post.update');
  });
});

Route::get('/feedback', 'FeedbackController@create');
Route::post('/feedback/create', 'FeedbackController@store');

Route::get('/feedbacks', 'Admin\FeedbackController@index')->name('feedbacks.index');
Route::get('/feedbacks/delete/{id}', 'Admin\FeedbackController@destroy');
   
// Socialite Register Routes
   
// Route::get('social/{provider}', 'Auth\SocialController@redirect')->name('social.redirect');
// Route::get('social/{provider}/callback', 'Auth\SocialController@callback')->name('social.callback');

use \App\Repositories\ElasticsearchArticleRepositoryInterface;

Route::get('/search', function (ElasticsearchArticleRepositoryInterface $repository) {
   
   $articles = $repository->search((string) request('q'));

//    dump($articles);
   return view('articles.index', [
       'posts' => $articles,
       'title' => 'Awesome Blog'
   ]);
});