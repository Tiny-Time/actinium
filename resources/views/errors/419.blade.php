@extends('errors::minimal')

@section('title', __('Page Expired'))

@section('code')
    <img src="{{ Vite::asset('resources/images/errors/419.png') }}" width="546" height="350" alt="419 Page Expired">
@endsection
