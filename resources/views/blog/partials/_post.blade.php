<div class="post-preview">
  <a href="{{  route('blog.show', $post->slug) }}">
    <h2 class="post-title">{{$post->title}}</h2>
  </a>
  <h3 class="post-subtitle"> Problems look mighty small from 150 miles up </h3>
    <p class="post-meta">Posted by  <a href="#">Janus </a>  {{ $post->created_at}}</p>
    <a href="{{ route('blog.category', $post->category_id) }}"><span data-feather="list"></span> {{ $post->category->name }}</a> <span data-feather="message-circle"></span> {{ $post->comments_count }}
</div>
<hr>
