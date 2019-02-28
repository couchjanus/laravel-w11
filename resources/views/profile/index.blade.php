@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-3 mb-3">
                @include('profile.partials._menu')
            </div>
            <div class="col-sm-9">

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header bg-primary text-white">Profile Picture</div>
                            <div class="card-body">
                                <p class="text-center">
                                    <img class="img-responsive img-thumbnail"
                                         src="{{ 'https://www.gravatar.com/avatar/'.md5(Auth::user()->email).'.png?s=128&d=mm' }}"
                                         alt="Profile Picture"
                                    >
                                </p>
                            </div>
                            <div class="card-footer">
                                To update your profile picture, please visit <a href="https://www.gravatar.com" target="_blank">Gravatar <i class="fa fa-external-link"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header bg-primary text-white">Contact Information</div>
                            <div class="card-body">
                                <form action="{{ route('profile.info.store') }}" method="post">
                                    @csrf
                                    @method('put')

                                    <div class="form-group form-row">
                                        <label class="col-form-label col-md-3">Name</label>
                                        <div class="col-md-9">
                                            <input type="text" name="name" class="form-control"
                                                   value="{{ Auth::user()->name }}">
                                        </div>
                                    </div>
                                    <div class="form-group form-row">
                                        <label class="col-form-label col-md-3">Email Address</label>
                                        <div class="col-md-9">
                                            <input type="email" name="email" class="form-control"
                                                   value="{{ Auth::user()->email }}">
                                        </div>
                                    </div>
                                    <div class="form-group form-row">
                                        <label class="col-form-label col-md-3">First Name</label>
                                        <div class="col-md-9">
                                            <input type="text" name="first_name" class="form-control"
                                                   value="{{ Auth::user()->profile->first_name }}">
                                        </div>
                                    </div>
                                    <div class="form-group form-row">
                                        <label class="col-form-label col-md-3">Last Name</label>
                                        <div class="col-md-9">
                                            <input type="text" name="last_name" class="form-control"
                                                   value="{{ Auth::user()->profile->last_name }}">
                                        </div>
                                    </div>
                                    <div class="form-group form-row">
                                        <label class="col-form-label col-md-3">Location</label>
                                        <div class="col-md-9">
                                            <input type="text" name="location" class="form-control"
                                                   value="{{ Auth::user()->profile->location }}">
                                        </div>
                                    </div>
                                    <div class="form-group form-row">
                                        <label class="col-form-label col-md-3">Bio</label>
                                        <div class="col-md-9">
                                            <textarea name="bio" class="form-control">
                                                {{ Auth::user()->profile->bio }}
                                            </textarea>
                                        </div>
                                    </div>
                                    <div class="form-group form-row">
                                        <div class="col-md-9 offset-md-3">
                                            <button class="btn btn-primary btn-sm">Save Changes</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection