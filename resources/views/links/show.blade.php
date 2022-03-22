@extends('layouts.app', ['nav' => 'links', 'title' => 'Redirect'])

@section('content-header', 'Redirect')

@section('content-body')

    <p class="text-center p-2 my-4" id='redirect' style="background-color: #80ed99">
        Redirecting...
    </p>

    <script type="text/javascript">
        function Redirect() {
            window.location = "{{ $link->link }}";
        }
        setTimeout('Redirect()', 3000);

    </script>

 @endsection
