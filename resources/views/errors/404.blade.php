@extends('errors::minimal')

@section('title', __('404 Not Found: Let\'s Get You Back on Track'))

@section('description', __('The page you are looking for could not be found. Let\'s get you back on track and find what you are looking for.'))

@section('code')
    <img loading="lazy" src="{{ Vite::asset('resources/images/errors/404.png') }}" width="546" height="350" alt="404 Page not found">
@endsection
