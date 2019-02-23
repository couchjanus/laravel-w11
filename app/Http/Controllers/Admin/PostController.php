<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\Category;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Enums\StatusType;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function index()
    {
        $posts = Post::paginate();
        $order = 'asc'; 
        $status = StatusType::toSelectArray();
        return view('admin.posts.index', compact('posts', 'status', 'order'));
    }

    public function getPostsByStatus(Request $request)
    {
        static $statusPost;
        $status = StatusType::toSelectArray();
        $statusPost = $request->status; 
        $posts = Post::status($statusPost)->paginate(5);
        return view('admin.posts.status', compact('posts', 'status', 'statusPost'));
    }

    public function sortPostsByDate(Request $request)
    {
        $status = StatusType::toSelectArray();
        $order = isset($request->order)?$request->order:'desc'; 
        $posts = Post::orderBy('updated_at', $order)->paginate();
        return view('admin.posts.index', compact('posts', 'status', 'order'));
    }

    public function getByIds($ids)
    {
        // return Post::find($ids);
        // return Post::findMany($ids);
        return Post::whereIn('id', $ids)->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all(); 
        $status = StatusType::toSelectArray(); 
        return view('admin.posts.create')->withStatus($status)->withCategories($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|unique:posts|max:255',
            'content' => 'required',
        ]);
        $post = Post::firstOrCreate(['title' => $request->title, 'content'=>$request->content, 'status'=>$request->status, 'category_id'=>$request->category_id, 'user_id'=>1]);
        session()->flash('message', 'Post has been added successfully!');
        session()->flash('type', 'success');
        return redirect(route('posts.index'));
        // return redirect(route('posts.index'))->with('success','Post has been added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        // dump($post);
        return view('admin.posts.show',compact('post'));
    }

    public function getFirstOrFail($id)
    {
        dump(Post::findOrFail($id));
        dump(Post::where('status', '>', 2)->firstOrFail());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::pluck('name', 'id'); 
        $status = StatusType::toSelectArray(); 
        return view('admin.posts.edit')->withPost($post)->withStatus($status)->withCategories($categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $post->updateOrCreate(['title' => $request->title, 'content'=>$request->content, 'status'=>$request->status, 'category_id'=>$request->category_id, 'user_id'=>1]);
        return redirect(route('posts.index'))->with('success',
        'Post has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')
                ->with('success','Post deleted successfully');
    }
}
