@component('mail::message')
# Welcome, {{$vendor->name}}

Thanks for your registration,

@component('mail::panel')
To access your CMS panel, click on the button below
@component('mail::button', ['url' => 'http://127.0.0.1:8000/cms/vendor/login', 'color' => 'error'])
Button Text
@endcomponent
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent