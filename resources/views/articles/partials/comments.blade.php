<hr>
    @foreach ($post->comments as $comment)
        {{--  <strong>{{ $comment->creator($comment->creator_id)->name }}</strong>   --}}

        <strong>{{ $comment->creator->name }}</strong> 
        <p>{{ $comment->body }}</p>
    @endforeach  
