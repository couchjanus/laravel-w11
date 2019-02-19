@extends('layouts.blog')

@section('title')
  @parent
  {{ $title }}
@endsection

@section('content')
<h2>{{ $title }}</h2>
  @each('blog.partials._post', 
    $posts, 
    'post', 
    'blog.partials._post-none'
  )

  {{ $posts->links() }}
@endsection
