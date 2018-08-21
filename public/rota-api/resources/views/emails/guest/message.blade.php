@component('mail::message')
#From {{ $user->name }}

{{ $user->message }}

Thanks,<br>
{{ $user->name }} <br>
{{ config('app.name') }}
@endcomponent