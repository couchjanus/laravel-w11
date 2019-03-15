<div class="post-preview">
  <a href="{{  route('articles.show', $post->id) }}">
    <h2 class="post-title">{{$post->title}}</h2>
  </a>
  <p class="post-subtitle">{{$post->content}} </p>
    <p class="post-meta">Posted by  <a href="#">Janus </a>  {{ $post->created_at}}</p>
</div>
<hr>
