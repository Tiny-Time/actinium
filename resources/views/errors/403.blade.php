@extends('errors::minimal')

@section('title', __('Forbidden'))

@section('code')
    <img src="{{ Vite::asset('resources/images/errors/403.png') }}" width="546" height="350"
        alt="403 {{ __($exception->getMessage() ?: 'Forbidden') }}">
@endsection
