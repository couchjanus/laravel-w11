@extends('layouts.app')

@section('head')
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script>
        function onSubmit(token) {
            document.getElementById("feedback-form").submit();
        }
    </script>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                @if (Session::get('errors') != Null)
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        {{  $errors->first() }}
                    </div>
                @endif
                
                @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                @endif
            </div>
        </div>
    
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h2>Feedback Form</h2>
                </div>
                
                <div class="card-body">
                    
                    <form action="{{ action('FeedbackController@store') }}" method="post" id='feedback-form'>

                        {{ csrf_field()  }}

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input class="form-control" id="name" type="text" name="name" placeholder="Name" required>
                            <div class="invalid-feedback">
                                @if($errors->has('name'))
                                    <p class="help-block">
                                        {{ $errors->first('name') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input class="form-control" id="email" type="email" name="email" placeholder="Email" required>
                            <div class="invalid-feedback">
                                    @if($errors->has('email'))
                                        <p class="help-block">
                                            {{ $errors->first('email') }}
                                        </p>
                                    @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea class="form-control" id="message" row="3" name='message' placeholder="Message"></textarea>
                            <div class="invalid-feedback">
                                    @if($errors->has('message'))
                                        <p class="help-block">
                                            {{ $errors->first('message') }}
                                        </p>
                                    @endif
                            </div>
                        </div>
                        <div class="form-group float-left">
                            <div class="g-recaptcha" id="feedback-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY')  }}"></div>
                            @if ($errors->has('g-recaptcha-response'))
                                <span class="invalid-feedback" style="display: block;">
                                    <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                </span>
                            @endif

                        </div>
                        <div class="form-group float-right btn-feedback-block">
                            <button type="submit" class="btn btn-outline-primary btn-lg" data-callback='onSubmit'>Leave feedback</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
