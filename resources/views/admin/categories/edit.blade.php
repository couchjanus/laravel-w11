@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h2 class="h2">Edit Category</h2>
    <div class="btn-toolbar mb-2 mb-md-0">
      <div class="btn-group mr-2">
          <a href="{{ route('categories.index') }}" class="btn btn-success btn-sm" title="All categories">
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
    @if (Session::get('errors') != Null)
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
          {{  $errors->first() }}
      </div>
    @endif
  <form action="{{ route('categories.update',['id' => $category->id]) }}" method="post">
    @method('put')
    @csrf
    <div class="card">
      <div class="card-block">
        <div class="form-group">
          <label for="title">Name</label>
            <input name="name" class="form-control" type="text" value="{{ $category->name }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
              <input name="description" class="form-control" type="text" value="{{ $category->description }}">
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
@endsection  
