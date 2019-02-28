<!-- Categories Widget -->
@if($data)
<div class="card my-4">
  <h5 class="card-header">Categories</h5>
    <div class="card-body">
      <div class="row">
        <div class="col-lg-6">
          <ul class="list-unstyled mb-0">
            @foreach($data as $item)
              @if($loop->iteration  % 2 == 0)
                <li>
                    <a href="{{ route('blog.category', $item->id) }}">{{ $item->name }}</a>
                </li>
              @endif 
            @endforeach
          </ul>
        </div>

        <div class="col-lg-6">
          <ul class="list-unstyled mb-0">
            @foreach($data as $item)
              @if($loop->iteration  % 2 != 0)
                <li>
                    <a href="{{ route('blog.category', $item->id) }}">{{ $item->name }}</a>
                </li>
              @endif 
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>
@endif
