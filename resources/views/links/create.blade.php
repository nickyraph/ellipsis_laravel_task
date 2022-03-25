@extends('layouts.app', ['nav' => 'links', 'title' => 'Shorten URL'])

@section('content-header')

    @auth
        Create New Short URL
    @endauth

    @guest
        Welcome to URL Shortner Platform!
    @endguest

@endsection

@section('content-body')

    <p style="background-color: #f7f7f7" class="rounded">
        <small class="px-3 d-block py-2 text-center">
            To get started, type/paste in the link you wish to shorten and we will do the magic for you! <br>

            <i class="fw-bold">PS: These Shortened URLs only last for {{ env('URL_EXPIRY_TIME', 5) }} minutes.</i>
        </small>
    </p>

    <form action="{{ route('links.store') }}" method="POST">
        @csrf
        <div class="form-group my-3">
            <label for="link">Link (URL)</label>
            <input id="link" type="text" class="form-control @error('link') is-invalid @enderror"
                name="link" value="{{ old('link') }}" required autocomplete="link" autofocus>

            @error('link')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary text-center w-100">Shorten</button>
    </form>

@endsection
