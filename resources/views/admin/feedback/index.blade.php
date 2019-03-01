@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h1 class="h2">Feedback List</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
      <div class="btn-group mr-2">
        <a href="#" title="Find Feedback">
            <button class="btn btn-sm btn-outline-success"><span data-feather="search"></span> Find Feedback</button>
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
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Message</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
        @forelse($feedbacks as $feedback)
        <tr>
            <th scope="row">{{ $feedback->id  }}</th>
            <td>{{ $feedback->name }}</td>
            <td>{{ $feedback->email }}</td>
            <td>{{ $feedback->message }}</td>
            <td>
                <a href="{{ action('Admin\FeedbackController@destroy', $feedback->id) }}" class="btn btn-outline-danger btn-sm">
                    Delete
                </a>
            </td>
        </tr>
        @empty
            <tr class="table-warning">
                <td class="text-center" colspan="5">
                    There are no feedbacks yet.
                </td>
            </tr>
        @endforelse

    </tbody>
  </table>
  <!-- Pagination -->
  <div class="pagination justify-content-center mb-4">
      {{ $feedbacks->links() }}
  </div>
</div>

@endsection
