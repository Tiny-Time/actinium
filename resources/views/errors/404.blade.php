@extends('errors::minimal')

@section('title', __('404 Not Found: Let’s Get You Back on Track'))

@section('code')
    <img loading="lazy" src="{{ Vite::asset('resources/images/errors/404.png') }}" width="546" height="350" alt="404 Page not found">
@endsection
