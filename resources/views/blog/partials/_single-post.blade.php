<h3 class="pb-3 mb-4 font-italic border-bottom">
    {{ $post->title }}
</h3> 

<!-- Date/Time -->
<p>Posted on {{ date('d F Y', strtotime($post->created_at)) }}</p>
<hr>
<!-- Post Content -->
<p class="lead">{{ $post->content }}</p>
