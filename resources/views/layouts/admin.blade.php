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
            @include('layouts.partials._flash')
            @yield('content')
        </main>
        </div><!-- /.row -->
    </div>
@endsection

{{--Scripts--}}
@section('scripts')
    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
        feather.replace()
    </script>
    <script src="{{ asset('js/app.js') }}" ></script>
@endsection
