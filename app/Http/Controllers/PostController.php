<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Post;

class PostController extends Controller
{
    /**
     * Показать список всех posts.
     *
     * @return Response
     */
    public function index()
    {
        $posts = DB::table('posts')->simplePaginate(10);
        return view('blog.index', ['posts' => $posts, 'title'=>'Awesome Blog']);
    }

    public function showById($id)
    {
        $post =Post::where('id', $id)->first();
        dump($post);
        // return view('blog.show', ['post' => $post, 'hescomment'=>true]);
    }

    public function show(Post $blog)
    {
        // dump($blog);
        $blog->update(['visited'=>$blog->visited+1]);
        return view('blog.show', ['post' => $blog, 'hescomment'=>true]);
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
}