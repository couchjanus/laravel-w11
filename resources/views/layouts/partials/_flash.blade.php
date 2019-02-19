@if($message = session('message'))
<div class="alert flash-message alert-dismissible alert-{{ session('type') }} fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <span class="badge badge-pill badge-{{ session('type') }}">{{ session('type') }} </span> <strong>{!! $message !!}</strong>
</div>
@endif