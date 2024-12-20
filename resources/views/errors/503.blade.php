@extends('errors::minimal')

@section('title', __('Service Unavailable'))

@section('code')
    <img loading="lazy" src="{{ Vite::asset('resources/images/errors/503.png') }}" width="546" height="350" alt="503 Service Unavailable">
@endsection
