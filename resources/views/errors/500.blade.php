@extends('errors::minimal')

@section('title', __('Server Error'))

@section('code')
    <img src="{{ Vite::asset('resources/images/errors/500.png') }}" width="546" height="350"
    alt="500 Server Error">
@endsection
