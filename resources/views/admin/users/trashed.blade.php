@extends('layouts.admin')

@section('content')
<div class="container-fluid">
  <div class="animate fadeIn">
    <div class="col-md-12">
      <div class="panel panel-default">
      <div class="panel-heading"><h2>Users In The Trash</h2></div>
        <div class="panel-body">
            <a href="{{ route('users.index') }}" class="btn btn-success btn-sm" title="All Posts">
              <i class="fa fa-arrow-left" aria-hidden="true"></i> Go Back
            </a>
            <br/>
            @if (Session::get('message') != Null)
              <div class="row">
                  <div class="col-md-9">
                      <div class="alert alert-warning alert-dismissible fade show" role="alert">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                          {{ Session::get('message') }}
                      </div>
                  </div>
              </div>
            @endif

            <div class="table-responsive">
                  
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Action</th>
                  </tr>
                </thead>

                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <form style="display: inline" action="{{ route('users.restore', ['id' => $user->id]) }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-warning" title="Restore" value="delete"><span data-feather="rewind"></span> </button>
                            </form>
                            <form style="display: inline" action="{{ route('user.force.destroy', $user->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit"><span data-feather="trash"></span></button>
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
          </div>
        </div>
      </div>
    </div>    
  </div>
</div>
@endsection
