@extends('layouts.blog')

@section('title')
  {{$post->title}}
@endsection

@section('content')
    @unless ($post)
      @alert(['type' => 'danger'])
        You are not allowed to access this resource now!
      @endalert
    @endunless

    <div class="blog-main">
      @includeIf('blog.partials._single-post', ['post' => $post])
      @includeWhen($hescomment, 'blog.partials._comments', ['some' => 'data'])
    </div>
@endsection