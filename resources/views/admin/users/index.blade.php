@extends('layouts.admin')

@section('content')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
      <h2 class="h2">Users</h2>
      <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
          <a href="{{ route('users.create') }}" title="Add New Users">
              <button class="btn btn-sm btn-outline-success"><span data-feather="plus"></span> Add New</button>
          </a>
          <a href="{{ route('users.trashed') }}" title="Trashed Posts"><button class="btn btn-sm btn-outline-secondary"><span data-feather="trash"></span> Trashed List</button>
          </a>
        </div>
        
        <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
          <span data-feather="calendar"></span>
          This week
        </button>
      </div>
  </div>
    
  <div class="table-responsive">
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <span class="badge badge-pill badge-success">Success</span> {!! $message !!}
        </div>
    @endif
    <table class="table table-hover">
      @if($users->count() === 0)
        <div class="well text-center">No users found.</div>
      @else
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
                  <a title="Edit user" href="{{ route('users.edit', ['id'=> $user->id]) }}" class="btn btn-warning"><span class="fa fa-edit"></span></a>
                  <form action="{{ route('users.destroy', ['id' => $user->id]) }}" method="post" style="display: inline">@method('DELETE') @csrf
                    <button title="Delete user" type="submit" class="btn btn-outline-danger"><span data-feather="trash"></span></button>
                  </form>  
              </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <!-- Pagination -->
  <div class="pagination justify-content-center mb-4">
      {{ $users->links() }}
  </div>
  @endif
@endsection
