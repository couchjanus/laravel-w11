<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Enums\StatusType;
use App\Post;

use Illuminate\Support\Facades\Redis;

class PostController extends Controller
{
    /**
     * Показать список всех posts.
     *
     * @return Response
     */
    public function index1()
    {
        $posts = Post::where('status', StatusType::Published)->orderBy('updated_at', 'desc')->simplePaginate(5);

        // $expiresAt = \Carbon\Carbon::now()->addMinutes(10);
           
        // $posts = \Cache::remember('posts', $expiresAt, function () {
        //     return Post::where('status', StatusType::Published)->orderBy('updated_at', 'desc')->simplePaginate(5);
        // });
        
        return view('blog.index', ['posts' => $posts, 'title'=>'Awesome Blog']);
    }


    public function index(Request $request){
        // Redis::flushAll();
        
        $page=1; //Default value

        if($request->get('page')){
            $page = $request->get('page');
        }
        
        $posts = Redis::get("posts:all:{$page}");
        // dump($posts);
        if(!$posts):
            $posts = Post::where('status', StatusType::Published)->orderBy('id', 'desc')->paginate(5);
            $postChunk = serialize($posts);
            Redis::set("posts:all:{$page}", $postChunk);
        else:
            $posts = unserialize($posts);
        endif;
        return view('blog.index')->with(compact('posts'))->withTitle('Awesome Blog');
    }
    
    // public function show(Post $blog)
    // {
    //     return view('blog.show', ['post' => $blog, 'hescomment'=>false]);
    // }

    // public function show(Post $post)
    // {
    //     return view('blog.show', ['post' => $post, 'hescomment'=>false]);
    // }

    public function show(Post $post)
    {
        return view('blog.show', ['post' => $post, 'hescomment'=>false]);
    }

    public function showFromCache($slug)
    {
        $expiresAt = \Carbon\Carbon::now()->addMinutes(10);
           
        $post = \Cache::remember($slug, $expiresAt, function () use ($slug) {
            return Post::whereSlug($slug)->firstOrFail();
        });

        return view('blog.show', ['post' => $post, 'hescomment'=>false]);
    }

    /**
     * PostsController, метод showBySlug:
     * Вначале мы проверяем, не является ли slug числом.
     * Часто slug внедряют в программу уже после того,
     * как был другой механизм построения пути.
     * Например, через числовые индексы.
     * Тогда может получится ситуация, что пользователь,
     * зайдя на сайт по старой ссылке, увидит 404 ошибку,
     * что такой страницы не существует.
     */
    public function showBySlug($slug)
    {
        if (is_numeric($slug)) {
       
            // Get post for slug.
            $post = Post::findOrFail($slug);
            return Redirect::to(route('blog.show', $post->slug), 301);
            // 301 редирект со старой страницы, на новую.   
           
        }
        // Get post for slug.
        $post = Post::whereSlug($slug)->firstOrFail();

        return view('blog.show', [
           'post' => $post,
           'hescomment' => false
           ]
        );
    }

    public function getTitle($id)
    {
        $title = DB::table('posts')->where('id', $id)->value('title');
        return $title;
    }

    public function getLatestPost()
    {
        $posts = DB::table('posts')->orderBy('id', 'desc')->get();
        return view('blog.index', ['posts' => $posts]);
    }

    public function latestPost() 
    {
        $post = DB::table('posts')
                ->latest()
                ->first();
        return view('blog.show', ['post' => $post]);
    }

    public function oldestPost()
    {
        $post = DB::table('posts')
            ->oldest()
            ->first();
        return view('blog.show', ['post' => $post]);
    }

    public function getPostsByWere()
    {
        $posts = DB::table('posts')
            ->where('id', '>=', 100)
            ->get();

        // $posts = DB::table('posts')
        //     ->where('id', '<>', 100)
        //     ->get();

        // $posts = DB::table('posts')
        //     ->where('title', 'like', 'T%')
        //     ->get();

        // $posts = DB::table('posts')->where([
        //     ['status', '=', '1'],
        //     ['id', '>', '100'],
        // ])->get();

        // $posts = DB::table('posts')
        //     ->where('id', '>', 100)
        //     ->orWhere('status', true)
        //     ->get();

        // $posts = DB::table('posts')
        //     ->whereBetween('id', [1, 100])->get();

        // $posts = DB::table('posts')
        //     ->whereNotBetween('id', [1, 100])
        //     ->get();
        
        // $posts = DB::table('posts')
        //     ->whereIn('category_id', [1, 2, 3])
        //     ->get();
        
        // $posts = DB::table('posts')
        //     ->whereNotIn('category_id', [1, 2, 3])
        //     ->get();
        
        // $posts = DB::table('posts')
        //     ->whereNull('updated_at')
        //     ->get();
 
        // $posts = DB::table('posts')
        //     ->whereNotNull('updated_at')
        //     ->get();
 
        // $posts = DB::table('posts')
        //     ->whereDate('created_at', '2018-05-17')
        //     ->get();
 
        // $posts = DB::table('posts')
        //     ->whereMonth('created_at', '05')
        //     ->get();
 
        // $posts = DB::table('posts')
        //     ->whereDay('created_at', '18')
        //     ->get();
            
        // $posts = DB::table('posts')
        //     ->whereYear('created_at', '2018')
        //     ->get();
 
        // $posts = DB::table('posts')
        //     ->whereColumn('updated_at', '>', 'created_at')
        //     ->get();
        
        return view('blog.index', ['posts' => $posts]);
    }

    public function takeLatestPosts() {
        $posts = DB::table('posts')->orderBy('id', 'desc')->take(5)->get();
 
        return view('blog.index', ['posts' => $posts]);
    }

    public function skipAndGetLatestPosts() {
        $posts = DB::table('posts')->orderBy('id', 'desc')->skip(10)->take(5)->get();
        return view('blog.index', ['posts' => $posts]);
    }

    public function getLomitLatestPosts() {
        $posts = DB::table('posts')
                ->offset(10)
                ->limit(5)
                ->get();
        return view('blog.index', ['posts' => $posts]);
    }

    public function create()
    {
        return view('blog.create', ['title'=>'Awesome Blog']);
    }

    public function store(Request $request)
    {
        // DB::insert('insert into posts (title, content') `values (?, ?)', [$request['title'], $request['content']]);

        // DB::table('posts')
        //     ->insert(['content' => $request['content'], 'title'=>$request['title'], 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()]);
            
        $id = DB::table('posts')
        ->insertGetId(['content' => $request['content'], 'title'=>$request['title'], 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()]);
        dump($id);

        // DB::table('posts')->insert(
        //     ['title' => 'The query builder also provides an insert method', 'content' => 'The query builder also provides an insert method for inserting records into the database table. The insert method accepts an array of column names and values']
        // );
        
        // dump($request);

        // DB::table('posts')->insert(
        //     ['title' => 'You may even insert several records', 'content' => 'You may even insert several records into the table with a single call to insert by passing an array of arrays. Each array represents a row to be inserted into the table'],
        //     ['title' => 'The query builder also provides an insert method', 'content' => 'The query builder also provides an insert method for inserting records into the database table. The insert method accepts an array of column names and values']
        // );

        // Auto-Incrementing IDs

        // $id = DB::table('posts')->insertGetId(
        //     ['title' => 'Auto-Incrementing IDs', 'content' => 'If the table has an auto-incrementing id, use the insertGetId method to insert a record and then retrieve the ID', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()]
        // );

        // dump($id);
    }

    public function update(Request $request, $id)
    {
        // $sql = "UPDATE posts SET title= ? content= ? WHERE id= ?";
        // DB::update($sql, array($request['title'], $request['content'], 'id' => $id));

        DB::table('posts')
            ->where('id', 10)
            ->update(['content' => 'Of course, in addition to inserting records into the database, the query builder can also update existing records using the update method. The update method, like the insert method, accepts an array of column and value pairs containing the columns to be updated. You may constrain the update query using where clauses:']);

        // DB::table('posts')
        //     ->where('id', $id)
        //     ->update(['content' => $request['content'], 'title'=>$request['title']]);
    }

    public function destroy($id)
    {
        // $deleted = DB::delete('delete from posts');
        DB::table('posts')
            ->where('id', $id)
            ->delete();
        
        // DB::table('posts')->delete();
        // DB::table('posts')->where('id', '>', 100)->delete();

        // If you wish to truncate the entire table, which will remove all rows and reset the auto-incrementing ID to zero, you may use the truncate method:
        // DB::table('posts')->truncate();
    }

}