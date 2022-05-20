@component('mail::message')
# Welcome, {{$user->name}}

Thanks for your registration,

@component('mail::panel')
To access your CMS panel, click on the button below
@component('mail::button', ['url' => 'http://127.0.0.1:8000/cms/user/login', 'color' => 'error'])
Button Text
@endcomponent
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent