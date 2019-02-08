@extends('layouts.blog')

@section('title')
  Blog Post Title
@endsection

@section('content')

    @unless (Auth::check())
        <h2>Вы не вошли в систему.</h2>
    @endunless

    <div class="post-preview">
        <h2 class="post-title">
          {{$post->title}}
        </h2>
        <blockquote>
          <p>{{$post->content}}</p>
        </blockquote>
      <p class="post-meta">Posted by
        <a href="#">Janus </a>
        {{$post->created_at}}</p>
    </div>

    <!-- Blog Entries Column -->

          {{-- <div class="col-md-8 blog-main">
            <h3 class="pb-3 mb-4 font-italic border-bottom">
              {{ $post->title }}
            </h3> --}}

          

                        {{-- @component('alert')
                        <strong>Whoops!</strong> Something went wrong!
                        @endcomponent --}}

                        {{-- @component('alert-danger')
                        @slot('title')
                            Forbidden
                        @endslot

                        You are not allowed to access this resource!
                        @endcomponent --}}


                        {{-- @alert(['type' => 'danger'])
                            You are not allowed to access this resource now!
                        @endalert --}}


            {{-- @includeIf('blog.partials._single-post', ['post' => $post])

            @includeWhen($hescomment, 'blog.partials._comments', ['some' => 'data'])
          </div> --}}
          <!-- /.blog-main -->


@endsection