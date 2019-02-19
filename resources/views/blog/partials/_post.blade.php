<div class="post-preview">
  <a href="{{  route('blog.show', $post->slug) }}">
    <h2 class="post-title">{{$post->title}} </h2>
  </a>
  
  <p class="post-trunc">{{str_limit($post->content,50)}}</p>
  
  <p class="post-meta">Posted by  <a href="#">Janus </a>  {{$post->created_at}}</p>
  <a href="{!! route('blog.show', $post->slug) !!}"
    class="btn btn-info">Continue reading
  </a>
  <hr>
</div>
