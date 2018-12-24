@component('mail::message')
# You have a Pending Video

@component('mail::panel')
    You have a new video to review.
    Video "{{$video}}" was just uploaded.
    Visit the admin page to review the video
@endcomponent

@component('mail::button', ['url' => config('app.url').'/admin'])
Admin page
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
