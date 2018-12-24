@component('mail::message')
# Welcome to Mouthpiece.


Thanks for joining the service, {{$name}}. We are pleased you joined.
Visit our website and enjoy our services.

{{--@component('mail::panel')--}}
{{--The video "{{$video}}" you upload has been approved by the admin.--}}
{{--Video is now live on the website and every one can see it.--}}

{{--Have a nice day--}}
{{--@endcomponent--}}

@component('mail::button', ['url' => config('app.url')])
Go To Website
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
