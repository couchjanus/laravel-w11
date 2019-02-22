@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h2 class="h2">Posts</h2>
    <div class="btn-toolbar mb-2 mb-md-0">
      <div class="btn-group mr-2">
        <a href="{{ route('posts.create') }}" title="Add New Post">
            <button class="btn btn-sm btn-outline-success"><span data-feather="plus"></span> Add New</button>
        </a>
        <button class="btn btn-sm btn-outline-secondary">Export</button>
      </div>

      <div class="dropdown">
          <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span data-feather="calendar"></span>
              Choice Status
          </button>
          
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            @foreach($status as $key => $value)
              <a class="dropdown-item" href=""
                onclick="event.preventDefault();
                  document.getElementById('post-status').value={{ $key }};
                  document.getElementById('status-form').submit();">
                  {{$value}} <span class="caret"></span> 
              </a>
              
            @endforeach
          </div>
          <form id="status-form" action="{{ route('posts.status') }}" method="GET" style="display: none;">
              <input type="hidden" id="post-status" name="status" value="">
          </form>
        </div>
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
    <thead>
      <tr>
        <th>Title</th>
        <th>Posted On</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($posts as $post)
        <tr>
          <td>{{ $post->title }}</td>
          <td>{{ date('d F Y', strtotime($post->created_at)) }}</td>
          <td>{{ $status[$post->status] }} </td>
          <td>
            <a title="Read post" href="{{ route('posts.show', ['id'=> $post->id]) }}">
              <button class="btn btn-sm btn-outline-primary"><span data-feather="eye"></span>
              </button>
            </a>
            <a title="Edit post" href="{{ route('posts.edit', ['id'=> $post->id]) }}" class="btn btn-outline-warning"><span data-feather="edit"></span></a>
            <button title="Delete post" type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#delete_post_{{ $post->id  }}"><span data-feather="trash"></span></button>
          </td>
        </tr>

        <div class="modal fade" id="delete_post_{{ $post->id  }}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
          <form class="" action="{{ route('posts.destroy', ['id' => $post->id]) }}" method="post">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="modal-dialog modal-sm">
              <div class="modal-content">
                <div class="modal-header bg-red">
                  <h4 class="modal-title" id="mySmallModalLabel">Delete post</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>

                <div class="modal-body">
                  Are you sure to delete post: <b>{{ $post->title }} </b>?
                </div>
                <div class="modal-footer">
                  <a href="{{ url('/posts') }}">
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
  <!-- Pagination -->
  <div class="pagination justify-content-center mb-4">
    {{ $posts->appends(['status' => $statusPost])->links() }}
  </div>
</div>

@endsection
