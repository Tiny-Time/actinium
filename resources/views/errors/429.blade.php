@extends('errors::minimal')

@section('title', __('Too Many Requests'))

@section('code')
    <img src="{{ Vite::asset('resources/images/errors/429.png') }}" width="546" height="350" alt="429 Too Many Requests">
@endsection
