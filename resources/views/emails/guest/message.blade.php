@component('mail::message')
# {{ $user->email }}
# From {{ $user->name }}, <br>

{{ $user->message }}

Thanks,<br>
{{ $user->name }}
<br>
{{ config('app.name') }}
@endcomponent
