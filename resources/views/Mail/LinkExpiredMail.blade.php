@component('mail::message')
    # Hi {{ $username }}!

    Your Shortened Link: <b><a href="{{ url('/') . '/' . $link }}">{{ env('URL_DOMAIN', 'ellps.co') . '/' . $link }}</a></b> has expired!.

    @component('mail::panel')
        Remember that shortened links only last for {{ env('URL_EXPIRY_TIME', 2) }} Minutes!
    @endcomponent

    Regards,<br>
    {{ config('app.name') }}
@endcomponent
