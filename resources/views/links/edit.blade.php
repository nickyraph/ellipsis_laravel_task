@extends('layouts.app', ['nav' => 'links', 'title' => 'Edit URLs'])

@section('content-header', 'Edit a URL')

@section('content-body')
    <form action="{{ route('links.update', $link) }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="form-group my-3">
            <label for="link">Link (URL)</label>
            <input id="link" type="text" class="form-control @error('link') is-invalid @enderror" name="link"
                value="{{ old('link') ?? $link->link }}" required autocomplete="link">

            @error('link')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group my-3">
            <label for="shortcode">Status</label>
            <select name="disabled" id="disabled" class="form-control">
                <option value="0" @selected(old('disabled')==0) @selected($link->disabled == 0)>Enabled</option>
                <option value="1" @selected(old('enabled')==1) @selected($link->disabled == 1)>Disabled</option>
            </select>
            @error('shortcode')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary text-center w-100">Update</button>
    </form>

    <button onclick="event.preventDefault();
        document.getElementById('delete_url_form').submit();" class="btn btn-danger w-100 mt-2">Delete URL</button>

    <form id="delete_url_form" action="{{ route('links.destroy', $link) }}" method="POST" class="d-none">
        @method("DELETE")
        @csrf
    </form>
@endsection
