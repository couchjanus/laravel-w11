@extends('layouts.master')

@section('styles')
    <!-- Custom styles for this template -->
    <link href="/css/dashboard.css" rel="stylesheet">
@endsection

@section('navigation')
    @include('layouts.partials.backend._navigation')
@endsection

{{--Page--}}

@section('page')
    <div class="container-fluid">
        <div class="row">
            @include('layouts.partials.backend._sidebar')
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
            @include('layouts.partials.backend._header')
            @yield('content')
        </main>
        </div><!-- /.row -->
    </div>
@endsection

{{--Scripts--}}
@section('scripts')
   
@endsection
