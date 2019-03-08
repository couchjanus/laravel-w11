@extends('layouts.admin')

@section('content')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h2 class="h2">Add New Permission</h2>
    <div class="btn-toolbar mb-2 mb-md-0">
      <div class="btn-group mr-2">
          <a href="{{ route('permissions.index') }}" class="btn btn-success btn-sm" title="All roles">
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
    <form action="{{ route('permissions.store') }}" method="post">
      @csrf
      <div class="card">
        <div class="card-block">
          <div class="form-group">
            <label for="title">Name</label>
              <input name="name" class="form-control" type="text" value="" required>
          </div>
        </div>
        <div class="card-footer text-muted">
          <button type="submit" class="btn btn-primary btn-sm pull-right"><span data-feather="save"></span> Save</button>
        </div>
      </div>
    </form>
  </div>
@endsection  
