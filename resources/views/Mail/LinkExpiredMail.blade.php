@component('mail::message')
# Hi {{ $username }}!

Your Shortened Link: <b><a href="{{ url('/') . '/' . $link }}">{{ env('URL_DOMAIN', url('/')) . '/' . $link }}</a></b> has expired!.

@component('mail::panel')
Remember that shortened links only last for 24 hours!
@endcomponent

Regards,<br>
{{ config('app.name') }}
@endcomponent
