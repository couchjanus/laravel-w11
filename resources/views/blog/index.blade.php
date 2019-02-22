@extends('layouts.blog')

@section('title')
  @parent
  Blog Post Title
@endsection

@section('content')
  @each('blog.partials._post', 
    $posts, 
    'post', 
    'blog.partials._post-none'
  )

  {{ $posts->links() }} 
@endsection
