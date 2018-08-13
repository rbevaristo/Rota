@component('mail::message')
# Verify Account

# Hello {{ $fname }} {{ $lname }},
To complete your registration please click the button below.

@component('mail::button', ['url' => 'http://localhost:8000/verify/'.$token, 'color' => 'green'])
Verify
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
