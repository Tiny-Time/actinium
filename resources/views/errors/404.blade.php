@extends('errors::minimal')

@section('title', __('Not Found'))

@section('code')
    <img src="{{ Vite::asset('resources/images/errors/404.png') }}" width="546" height="350" alt="404 Page not found">
@endsection
