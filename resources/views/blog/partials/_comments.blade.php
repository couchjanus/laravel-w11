<!-- Comments Form -->
@if (Auth::check())
    <h4>Hello {!! Auth::user()->name !!}!</h4>
    <comments :current-id='{!! $post->id !!}' :current-user='{!! Auth::user()->id !!}'></comments>
@else
    <comments :current-id='{!! $post->id !!}'></comments>
@endif  
