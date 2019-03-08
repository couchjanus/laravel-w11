@extends('layouts.admin')

@section('content')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h2 class="h2">Permissions</h2>
    <div class="btn-toolbar mb-2 mb-md-0">
      <div class="btn-group mr-2">
        <a href="{{ route('permissions.create') }}" title="Add New Permission">
            <button class="btn btn-sm btn-outline-success"><span data-feather="plus"></span> Add New</button>
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
    <table class="table table-hover table-striped table-sm">
      <thead>
        <tr>
          <th>#</th>
          <th>Name</th>
          <th>Posted On</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($permissions as $permission)
                    <tr>
                      <td>{{ $permission->id }}</td>
                      <td>{{ $permission->name }}</td>
                      <td>{{ date('d F Y', strtotime($permission->created_at)) }}</td>
                      <td>
                        <a title="Read permission" href="{{ route('permissions.show', ['id'=> $permission->id]) }}" class="btn btn-primary"><span data-feather="eye"></span></a>
                        <a title="Edit permission" href="{{ route('permissions.edit', ['id'=> $permission->id]) }}" class="btn btn-warning"><span data-feather="edit"></span></a>
                        <button title="Delete permission" type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_permission_{{ $permission->id  }}"><span data-feather="delete"></span></button>
                      </td>
                    </tr>

                    <div class="modal fade" id="delete_permission_{{ $permission->id  }}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                      <form class="" action="{{ route('permissions.destroy', ['id' => $permission->id]) }}" method="post">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="modal-dialog modal-sm">
                          <div class="modal-content">
                            <div class="modal-header bg-red">
                              <h4 class="modal-title" id="mySmallModalLabel">Delete permission</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>

                            <div class="modal-body">
                              Are you sure to delete permission: <b>{{ $permission->name }} </b>?
                            </div>
                            <div class="modal-footer">
                              <a href="{{ url('/permissions') }}">
                                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                              </a>
                              <button type="submit" class="btn btn-outline" title="Delete" value="delete">Delete</button>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
        @endforeach
      </tbody>
    </table>

    {{ $permissions->onEachSide(2)->links() }}
  </div>
@endsection