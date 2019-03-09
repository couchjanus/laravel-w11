<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Illuminate\Support\Facades\Gate;

class TestController extends Controller
{
        
    public function index()
    {
        $post = \App\Post::find(1);

        foreach ($post->comments as $comment) {
          dump($comment->body);
        }

        $comment = \App\Comment::find(1);

        $commentable = $comment->commentable;

        // dump($commentable);
        
        // Получить все статьи в блоге, имеющие хотя бы один комментарий...
        $posts = \App\Post::has('comments')->get();
        dump($posts);
        // Вы также можете указать оператор и число:
        // Получить все статьи в блоге, имеющие три и более комментариев...
        $posts = \App\Post::has('comments', '>=', 10)->get();
        dump($posts);

        $posts = \App\Post::whereDoesntHave('comments')->get();
        dump($posts);

        $posts = \App\Post::withCount('comments')->get();

        foreach ($posts as $post) {
            echo $post->comments_count;
        }
    }
}
