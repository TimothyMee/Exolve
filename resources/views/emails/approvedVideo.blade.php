@component('mail::message')
# Newly Approved Video

@component('mail::panel')
    The video "{{$video}}" you upload has been approved by the admin.
    Video is now live on the website and every one can see it.

    Have a nice day
@endcomponent

@component('mail::button', ['url' => config('app.url')])
Mouthpiece
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
