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
    <main class="py-4">
        @include('layouts.partials._flash')
        @yield('content')
    </main>
@endsection

@section('footer')
       @include('layouts.partials.frontend._footer') 
@endsection

{{--Scripts--}}
@section('scripts')
    
   
@endsection
