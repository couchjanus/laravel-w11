<h1>{{ $event }}  Blah уже скоро!</h1>
<p>Lorem ipsum.</p>

{{ public_path() }}
<img src="{{ $message->embed(asset('/public/cat.jpg')) }}">

<img src="{{ $message->embed($pathToFile) }}" alt="An inline image" />


<img src="{{ asset('/images/logo.png') }}" alt="{{ config('app.name') }} Logo">