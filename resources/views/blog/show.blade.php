@extends('layouts.blog')

@section('title')
  Blog Post Title
@endsection

@section('content')
  <div class="col blog-main">
    <h3 class="pb-3 mb-4 font-italic border-bottom">
      {{ $post->title }}
    </h3>

    @includeIf('blog.partials._single-post', ['post' => $post])
    @includeWhen($hescomment, 'blog.partials._comments', ['some' => 'data'])
  </div>
@endsection