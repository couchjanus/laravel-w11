<h2 class="post-title">{{$post->title}} </h2>
<!-- Date/Time -->
<p>Posted on {{ date('d F Y', strtotime($post->created_at)) }}</p>

<hr>

<!-- Post Content -->
<p class="lead">{{ $post->content }}</p>

<span data-feather="tag"></span> {{ $post->visited }}


<a href="{{ route('blog.category', $post->category_id) }}"><span data-feather="list"></span> {{ $post->category->name }}</a>