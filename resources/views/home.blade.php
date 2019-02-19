@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h2>Welcome back {{ Auth::user()->name }}!</h2> </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="flash-message">
                        @foreach (['danger', 'success'] as $message)
                            @if(Session::has($message))
                                <p class="alert alert-{{ $message }}">{{ Session::get($message) }}</p>
                            @endif
                        @endforeach
                    </div>

                    You are logged in!
                    @if(Session::has('username'))
                        <p class="alert alert">{{ Session::get('username') }} | {{ Session::get('email') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
