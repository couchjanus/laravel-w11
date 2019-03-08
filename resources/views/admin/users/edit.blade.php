@extends('layouts.admin')

@section('content')

  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit User</h1>
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

  <div class="table-responsive">
    <form action="{{ route('users.update',['id' => $user->id]) }}" method="post" enctype="multipart/form-data" class="form-horizontal">
      @csrf @method("PUT")
      <div class="card-body">
              <div class="form-group row">
                <label class="col-2 col-form-label" for="title">User Name:</label>
                <div class="col-10">
                  <input type="text" id="name" name="name" class="form-control" value="{{ $user->name }}">
                  <span class="help-block">Enter User Name</span>
                </div>
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
                    @foreach($roles as $key => $value)
                        <option value="{{ $key }}" @if($user->roles)
                        {{ ($user->roles->pluck('id')->contains($key)) ? 'selected':'' }}
                        @endif  />
                          {{ $value }}
                        </option>
                    @endforeach
                </select>
              </div>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Submit</button>
              <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> Reset</button>
      </div>
    </form>
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