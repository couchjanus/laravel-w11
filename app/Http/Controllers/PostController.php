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
        $posts = DB::select('select * from posts');
        dump($posts);
        return view('blog.index', ['posts' => $posts, 'title'=>'Awesome Blog']);
        
    }

    public function show($id)
    {
        $post = DB::select("select * from posts where id = :id", ['id' => $id]);
        dump($post);
        return view('blog.show', ['post' => $post]);
    }

    public function create()
    {
        return view('blog.create', ['title'=>'Awesome Blog']);
        
    }

    public function store(Request $request)
    {
        DB::insert('insert into posts (title, content)
        values (?, ?)', [$request['title'], $request['content']]);
    }

    public function update(Request $request, $id)
    {
        $sql = "UPDATE posts SET title= ? content= ? WHERE id= ?";
        DB::update($sql, array($request['title'], $request['content'], 'id' => $id));

    }

    public function destroy($id)
    {
        $deleted = DB::delete('delete from posts');
    }


}