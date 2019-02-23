<h2 class="post-title">{{$post->title}} </h2>
<!-- Date/Time -->
<p>Posted on {{ date('d F Y', strtotime($post->created_at)) }}</p>

<hr>

<!-- Post Content -->
<p class="lead">{{ $post->content }}</p>

<span data-feather="tag"></span> {{ $post->visited }}
