@extends('layouts.blog')

@section('title')
  @parent
  Blog Post Title
@endsection

@section('content')
  

  {{-- @foreach ($posts as $post)
  <div class="blog-post">
  <h2 class="blog-post-title">{{$post->title}}</h2>
  <p class="blog-post-meta">{{$post->created_at}}</p>
  <a class="button" href="/blog/{{$post->id}}">Read More</a>
  </div>
  <!-- /.blog-post -->
  @endforeach --}}

  {{-- @if (count($posts) > 0)
    @foreach ($posts as $post)
        @include('blog.partials._post')
    @endforeach
  @else
    @include('blog.partials._post-none')
  @endif --}}

  
  {{-- @forelse($posts as $post)
    @include('blog.partials._post')
  @empty
    @include('blog.partials._post-none')
  @endforelse --}}

  @each('blog.partials._post', 
    $posts, 
    'post', 
    'blog.partials._post-none'
  )

  {{-- {{ $posts->links() }} --}}

  {{-- {{ $posts->onEachSide(2)->links() }} --}}
  
@endsection
