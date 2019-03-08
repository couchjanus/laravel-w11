@extends('layouts.admin')

@section('content')

  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h1 class="h2">Add New User</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
      <div class="btn-group mr-2">
        <a href="{{ route('users.index') }}" title="All users">
            <button class="btn btn-sm btn-outline-success"><span data-feather="arrow-left"></span>
                 Go Back</button>
        </a>
        <button class="btn btn-sm btn-outline-secondary">Export</button>
      </div>

      <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
        <span data-feather="calendar"></span>
        This week
      </button>
    </div>
  </div>

  <div class="table-responsive col-12">
    @if (Session::get('errors') != Null)
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{  $errors->first() }}
            </div>
    @endif
   
    {!! Form::open(['route' => 'users.store']) !!}
      <div class="form-group has-feedback row {{ $errors->has('name') ? ' has-error ' : '' }}">
          {!! Form::label('name', 'User Name', array('class' => 'col-3 control-label')); !!}
          {!! Form::text('name', NULL, array('id' => 'name', 'class' => 'form-control col-9', 'placeholder' => 'User Name')) !!}
          <label class="input-group-addon" for="name"><i class="fa fa-fw-user" aria-hidden="true"></i></label>
          
          @if ($errors->has('name'))
          <span class="help-block">
            <strong>{{ $errors->first('name') }}</strong>
          </span>
          @endif
      </div>

      <div class="form-group has-feedback row {{ $errors->has('email') ? ' has-error ' : '' }}">
        {!! Form::label('email', 'User Email', array('class' => 'col-3 control-label')); !!}
              
        {!! Form::text('email', NULL, array('id' => 'email', 'class' => 'form-control col-9', 'placeholder' => 'User email')) !!}
        <label class="input-group-addon" for="email"><i class="fa fa-fw {{ trans('forms.create_user_icon_email') }}" aria-hidden="true"></i></label>
              
        @if ($errors->has('email'))
          <span class="help-block">
            <strong>{{ $errors->first('email') }}</strong>
          </span>
        @endif
      </div>
            
      <div class="form-group has-feedback row {{ $errors->has('password') ? ' has-error ' : '' }}">
        {!! Form::label('password', 'Password', array('class' => 'col-3 control-label')); !!}
              
        {!! Form::password('password', array('id' => 'password', 'class' => 'form-control col-9', 'placeholder' => 'password')) !!}
        <label class="input-group-addon" for="password"><i class="fa fa-fw" aria-hidden="true"></i></label>
        @if ($errors->has('password'))
                  <span class="help-block">
                      <strong>{{ $errors->first('password') }}</strong>
                  </span>
        @endif
      </div>

      <div class="form-group has-feedback row {{ $errors->has('password_confirmation') ? ' has-error ' : '' }}">
        {!! Form::label('password_confirmation', 'Password Confirmation', array('class' => 'col-3 control-label')); !!}
        {!! Form::password('password_confirmation', array('id' => 'password_confirmation', 'class' => 'form-control col-9', 'placeholder' => 'password confirmation')) !!}
        <label class="input-group-addon" for="password_confirmation"><i class="fa fa-fw" aria-hidden="true"></i></label>
              
        @if ($errors->has('password_confirmation'))
          <span class="help-block">
            <strong>{{ $errors->first('password_confirmation') }}</strong>
          </span>
        @endif
      </div>

      <div class="form-group">
        <label for="selectall-role" class= 'control-label'>Select roles</label>
        <button type="button" class="btn btn-primary btn-xs" id="selectbtn-role">
            Select all
        </button>
        <button type="button" class="btn btn-primary btn-xs" id="deselectbtn-role">
            Deselect all
        </button>
        <select name="role[]" class="form-control select2" multiple='multiple' id='selectall-role'>
            @foreach($roles as $role)
                <option value="{{$role->id}}">{{ $role->name}}</option>
            @endforeach
        </select>
      </div>
      
      <div class="form-group row">
        {!! Form::button('<span data-feather="save"></span>&nbsp;' . 'Create User', array('class' => 'btn btn-success btn-flat margin-bottom-1 pull-right','type' => 'submit', )) !!}
      </div>
          
    {!! Form::close() !!}

  </div>
@endsection
@section('scripts')
    @parent
    <script>
        $("#selectbtn-role").click(function(){
            $("#selectall-role > option").prop("selected","selected");
            $("#selectall-role").trigger("change");
        });
        $("#deselectbtn-role").click(function(){
            $("#selectall-role > option").prop("selected","");
            $("#selectall-role").trigger("change");
        });

        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>
@endsection