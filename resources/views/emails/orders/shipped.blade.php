@component('mail::message')
# Introduction

The body of your message.

{{-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent --}}

@component('mail::button', ['url' => $url, 'color' => 'success'])
View Order
@endcomponent

@component('mail::panel')
This is the panel content.
{{--  {{ $order }}  --}}
@endcomponent

@component('mail::table')
| Id       | Product         | Price  |
| ------------- |:-------------:| --------:|
| {{ $order->id }}      | {{ $order->name }}      | {{ $order->price }}      |
| Col 3 is      | Right-Aligned | $20      |
@endcomponent


Thanks,<br>
{{ config('app.name') }}
@endcomponent
