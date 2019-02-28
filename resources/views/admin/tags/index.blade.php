@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">Tags</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
            <a href="{{ route('tags.create') }}" title="Add New Tag">
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
                    <th>Name</th>
                    <th>Posted On</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tags as $tag)
                    <tr>
                        <td>{{ $tag->name }}</td>
                        <td>{{ date('d F Y', strtotime($tag->created_at)) }}</td>
                        <td>
                            <a title="Read tag" href="{{ route('tags.show', ['id'=> $tag->id]) }}">
                            <button class="btn btn-sm btn-outline-primary">
                            <span data-feather="eye"></span></button></a>
                            <a title="Edit tag" href="{{ route('tags.edit', ['id'=> $tag->id]) }}" class="btn btn-outline-warning"><span data-feather="edit"></span></a>
                            <button title="Delete tag" type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#delete_tag_{{ $tag->id  }}"><span data-feather="trash"></span></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

    @foreach($tags as $tag)
        <div class="modal fade" id="delete_tag_{{ $tag->id  }}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <form class="" action="{{ route('tags.destroy', ['id' => $tag->id]) }}" method="post">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header bg-red">
                            <h4 class="modal-title" id="mySmallModalLabel">Delete tag</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>


                        <div class="modal-body">
                            Are you sure to delete tag: <b>{{ $tag->name }} </b>?

                        </div>
                        <div class="modal-footer">
                            <a href="{{ url('/') }}">
                                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                            </a>
                            <button type="submit" class="btn btn-outline" title="Delete" value="delete">Delete</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    @endforeach

@endsection