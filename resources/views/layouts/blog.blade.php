@extends('layouts.master')

@section('title')
   Blog Post Title
@endsection

@section('styles')
    <!-- Custom styles for this template -->
    
@endsection

@section('navigation')
    @include('layouts.partials.frontend._navigation')
@endsection

{{--Page--}}

@section('page')

    <main role="main" class="container">
        <div class="row">
            <div class="col-md-8 blog-main">
                @yield('content')
            </div><!-- /.blog-main -->
            
            @include('layouts.partials.frontend._aside')
        </div><!-- /.row -->
    </main><!-- /.container -->
@endsection

@section('footer')
       @include('layouts.partials.frontend._footer') 
@endsection

{{--Scripts--}}
@section('scripts')
   
@endsection
