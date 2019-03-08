<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Enums\StatusType;
use App\Post;
use Gate;

use App\Http\Requests\PostUpdateFormRequest;

use Illuminate\Support\Facades\Redis;

class PostController extends Controller
{
    /**
     * Показать список всех posts.
     *
     * @return Response
     */
    public function index()
    {
        $posts = Post::where('status', StatusType::Published)->orderBy('updated_at', 'desc')->simplePaginate(5);
        return view('blog.index', ['posts' => $posts, 'title'=>'Awesome Blog']);
    }


    
    public function getPostsByCategory($categoryId) 
    {
        $posts = \App\Category::find($categoryId)
            ->posts()
            ->where('status', StatusType::Published)
            ->orderBy('updated_at', 'desc')
            ->paginate(5);
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

        $post->update(['visited'=>$post->visited+1]);

        return view('blog.show', ['post' => $post, 'hescomment'=>false]);
    }

    public function showById($id)
    {
        $post =Post::where('id', $id)->first();
        return view('blog.show', ['post' => $post, 'hescomment'=>true]);
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
        $post->update(['visited'=>$post->visited+1]);

        $post = Post::whereSlug($slug)->firstOrFail();
        
        return view('blog.show', [
           'post' => $post,
           'hescomment' => false
           ]
        );
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

    public function list()
    {
        $posts = Post::latest()->where('user_id', \Auth::id())->paginate(5);
        // $this->authorize('view', $post);
        return view('profile.list',compact('posts'));
    }

    public function edit(Post $post)
    {
        if (Gate::allows('update-post', $post)) {
        echo 'Allowed Edit Post';
        } else {
        echo 'Not Allowed Edit Post ';
        }
        exit;
    }


    public function view(Post $post)
    {
        $user = \Auth::user();
        if ($this->authorize('view', $post)) {
        echo "Current logged in user is allowed to update the Post: {$post->title}";
        } else {
        echo 'Not Authorized.';
        }

        // if ($user->can('view', $post)) {
        //   echo "Current logged in user is allowed to update the Post: {$post->title}";
        // } else {
        //   echo 'Not Authorized.';
        // }
    }
  
    public function create()
    {
        $user = \Auth::user();
        if ($user->can('create', Post::class)) {
            echo 'Current user now can create new posts!.';
        } else {
            echo 'You can not create post';
        }

        // if ($this->authorize('create', Post::class)) {
        //     echo 'Current logged in user is allowed to create new posts.';
        // } else {
        //     echo 'You can not create post';
        // }
        // exit;
    }

    public function update(PostUpdateFormRequest $request, Post $post)
    {
        echo "Current logged in user is allowed to update the Post: {$post->title}";
        // get current logged in user
        // $user = \Auth::user();
        // if ($user->can('update', $post)) {
        //     echo "Current logged in user is allowed to update the Post: {$post->id}";
        // } else {
        //     echo 'Not Authorized.';
        // }
    }
    
    public function delete()
    {
        // get current logged in user
        $user = Auth::user();
        // load post
        $post = Post::find(1);
        if ($user->can('delete', $post)) {
        echo "Current logged in user is allowed to delete the Post: {$post->id}";
        } else {
        echo 'Not Authorized.';
        }
    }
    
}