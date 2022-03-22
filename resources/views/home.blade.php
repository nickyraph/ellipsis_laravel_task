@extends('layouts.app', ['nav' => 'home', 'title' => 'Home'])

@section('content-header', 'Welcome')

@section('content-body')

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    {{ __('You are logged in!') }}

@endsection
