@extends('layouts.admin')

@section('content')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
      <h2 class="h2">Users</h2>
      <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
          <a href="{{ route('users.create') }}" title="Add New Users">
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
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Id</th>
          <th>Online</th>
          <th>Username</th>
          <th>Email</th>
          <th>Action</th>
        </tr>
      </thead>

      <tbody>
          @foreach($users as $user)
          <tr>
              <td>{{ $user->id }}</td>
              <td>
                @if($user->isOnline())
                  <span style="color:green">Online</span>
                @else
                  <span style="color:red">Offline</span>
                @endif
              </td>
              <td>{{ $user->name }}</td>
              <td>{{ $user->email }}</td>
              <td>
                  <a title="Show User" href="{{ route('users.show', ['id'=> $user->id]) }}" class="btn btn-primary"><span class="fa fa-newspaper-o"></span></a>
                  <a title="Edit article" href="{{ route('users.edit', ['id'=> $user->id]) }}" class="btn btn-warning"><span class="fa fa-edit"></span></a>
                  <button title="Delete user" type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_user_{{ $user->id  }}"><span class="fa fa-trash-o"></span></button>
              </td>
          </tr>

          <div class="modal fade" id="delete_user_{{ $user->id  }}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
              <form class="" action="{{ route('users.destroy', ['id' => $user->id]) }}" method="post">
                  <input type="hidden" name="_method" value="DELETE">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">

                  <div class="modal-dialog modal-sm">
                  <div class="modal-content">
                      <div class="modal-header bg-red">
                      <h4 class="modal-title" id="mySmallModalLabel">Delete user</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                      </div>

                      <div class="modal-body">
                      Are you sure to delete user: <b>{{ $user->title }} </b>?
                      </div>
                      <div class="modal-footer">
                      <a href="{{ url('/users') }}">
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
  </div>
  <!-- Pagination -->
  <div class="pagination justify-content-center mb-4">
      {{ $users->links() }}
  </div>
@endsection
