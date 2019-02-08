<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class PostController extends Controller
{
    /**
     * Показать список всех posts.
     *
     * @return Response
     */
    public function index()
    {
        //     $posts = DB::select('select * from posts');
        // $posts = DB::table('posts')->get();
        $posts = DB::table('posts')->paginate(10);
        // $posts = DB::table('posts')->simplePaginate(10);
        
        // dump($posts);
        // foreach ($posts as $post) {
        //     dump($post->title);
        // }
       
        return view('blog.index', ['posts' => $posts, 'title'=>'Awesome Blog']);
    }
  

    public function show($id)
    {
        // $post = DB::select("select * from posts where id = :id", ['id' => $id]);
        $post = DB::table('posts')->where('id', $id)->first();
        dump($post);
        // return view('blog.show', ['post' => $post]);
        // return view('blog.show', ['post' => $post, 'hescomment'=>true]);
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