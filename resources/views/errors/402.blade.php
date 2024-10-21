@extends('errors::minimal')

@section('title', __('Payment Required'))

@section('code')
    <img src="{{ Vite::asset('resources/images/errors/402.png') }}" width="546" height="350" alt="402 Payment Required">
@endsection
