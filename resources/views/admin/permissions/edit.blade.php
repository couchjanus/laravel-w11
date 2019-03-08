@extends('layouts.admin')

@section('content')
<div class="container-fluid">
  <div class="animate fadeIn">
    <div class="col-md-9">
      <div class="panel panel-default">
        <div class="panel-heading"><h2>Edit category</h2></div>
          <div class="panel-body">

            <a href="{{ route('categories.index') }}" class="btn btn-success btn-sm" title="All categories">
                <i class="fa fa-arrow-left" aria-hidden="true"></i> Go Back
            </a>
            <br/>
            <br/>
            <div class="table-responsive">
              <form action="{{ route('categories.update',['id' => $category->id]) }}" method="post">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="card">
                    <div class="card-block">
                        <div class="form-group">
                            <label for="title">Name</label>
                            <input name="name" class="form-control" type="text" value="{{ $category->name }}" required>
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
