@extends('errors::minimal')

@section('title', __('Unauthorized'))

@section('code')
    <img src="{{ Vite::asset('resources/images/errors/401.png') }}" width="546" height="350" alt="401 Unauthorized">
@endsection
