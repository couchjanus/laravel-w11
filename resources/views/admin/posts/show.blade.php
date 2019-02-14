@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">Show Post</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
            <a href="{{ route('posts.index') }}" title="All posts">
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
        <div class="card">
            <div class="card-header">
                <b>{{$post->title}}</b>
            </div>
            <div class="card-block">
                {!! $post->content !!}
            </div>
            <div class="card-footer text-muted">
                <div class="pull-right">
                    <a title="Edit article" href="{{ url('/posts/'.$post->id.'/edit/') }}" class="btn btn-warning"><span data-feather="edit"></span></a>
                    <button title="Delete article" type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_article_{{ $post->id  }}"><span data-feather="trash"></span></button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="delete_article_{{ $post->id  }}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <form class="" action="{{ route('posts.destroy', ['id' => $post->id]) }}" method="post">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
    
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header bg-red">
                        <h4 class="modal-title" id="mySmallModalLabel">Delete article</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure to delete article: <b>{{ $post->title }} </b>?
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
@endsection

@section('scripts')
    @parent
@endsection