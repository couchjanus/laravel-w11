@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <span class="badge badge-pill badge-success">Success</span> {!! $message !!}
                        </div>
                    @endif
                    Send Me Order!

                    {!! Form::open(['method'=>'POST', 'route' => array('order.ship', 1)]) !!}
                
                    <div class="form-group row">
                        {!! Form::button('<span data-feather="save"></span>&nbsp;' . 'Send Order', array('class' => 'btn btn-success btn-flat margin-bottom-1 pull-right','type' => 'submit', )) !!}
                    </div>
                        
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
