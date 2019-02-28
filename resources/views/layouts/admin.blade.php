@extends('layouts.master')

@section('styles')
    <!-- Custom styles for this template -->
    <link href="/css/dashboard.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />    
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
            @include('layouts.partials._flash')
            @yield('content')
        </main>
        </div><!-- /.row -->
    </div>
@endsection

{{--Scripts--}}
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
@endsection
