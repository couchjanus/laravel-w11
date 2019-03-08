@extends('layouts.admin')

@section('content')
<div class="container-fluid">
  <div class="animate fadeIn">
    <div class="col-md-9">
      <div class="panel panel-default">
        <div class="panel-heading"><h2>Edit role</h2></div>
          <div class="panel-body">

            <a href="{{ route('roles.index') }}" class="btn btn-success btn-sm" title="All roles">
                <i class="fa fa-arrow-left" aria-hidden="true"></i> Go Back
            </a>
            <br/>
            <br/>
            <div class="table-responsive">
              <form action="{{ route('roles.update',['id' => $role->id]) }}" method="post">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="card">
                    <div class="card-block">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input name="name" class="form-control" type="text" value="{{ $role->name }}" required>
                        </div>
                        <div class="form-group">
                          <label for="description">Description</label>
                          <input name="description" class="form-control" type="text" value="{{ $role->description }}">
                        </div>
                        <div class="form-group">
                          <label for="selectall-permission" class= 'control-label'>Select permissions</label>
                          <button type="button" class="btn btn-primary btn-xs" id="selectbtn-permission">
                              Select all
                          </button>
                          <button type="button" class="btn btn-primary btn-xs" id="deselectbtn-permission">
                              Deselect all
                          </button>
                          <select name="permission[]" class="form-control select2" multiple='multiple' id='selectall-permission'>
                              @foreach($permissions as $key => $value)
                                  <option value="{{ $key }}" {{ ($role->permissions()->pluck('id')->contains($key)) ? 'selected':'' }}  />
                                    {{ $value }}
                                  </option>
                              @endforeach
                          </select>

                          <p class="help-block"></p>
                          @if($errors->has('permission'))
                              <p class="help-block">
                                  {{ $errors->first('permission') }}
                              </p>
                          @endif
                        </div>
                    </div>
                    <div class="card-footer text-muted">
                        <div class="pull-right">
                            <button type="submit" class="btn btn-primary">Save</button>
                    </div>
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
@section('scripts')
    @parent
    <script>
        $("#selectbtn-permission").click(function(){
            $("#selectall-permission > option").prop("selected","selected");
            $("#selectall-permission").trigger("change");
        });
        $("#deselectbtn-permission").click(function(){
            $("#selectall-permission > option").prop("selected","");
            $("#selectall-permission").trigger("change");
        });

        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>
@endsection