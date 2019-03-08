@extends('layouts.admin')

@section('content')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h2 class="h2">Add New Role</h2>
    <div class="btn-toolbar mb-2 mb-md-0">
      <div class="btn-group mr-2">
          <a href="{{ route('roles.index') }}" class="btn btn-success btn-sm" title="All roles">
              <span data-feather="arrow-left"></span>  Go Back
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
    <form action="{{ route('roles.store') }}" method="post">
      @csrf
      <div class="card">
        <div class="card-block">
                      <div class="form-group">
                        <label for="name">Name</label>
                        <input name="name" class="form-control" type="text" placeholder="Enter name" required>
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
                            @foreach($permissions as $permission)
                                <option value="{{$permission->id}}">{{ $permission->name}}</option>
                            @endforeach
                        </select>
                      </div>
        </div>
        <div class="card-footer text-muted">
                      <button type="submit" class="btn btn-primary btn-sm pull-right"><span data-feather="save"></span> Save</button>
        </div>
      </div>
    </form>
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