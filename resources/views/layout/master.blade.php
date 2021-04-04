@extends('layout.base')

{{-- extend <head> --}}
@section('head')
    <meta name="csrf-token" content="{{ app('session')->token() }}">
@endsection

{{-- extend <body> --}}
@section('body')
    @include('partials.header')
    @yield('content')
@endsection

{{-- extend jquery --}}
@section('jquery')
    <script>
        let route = {}
        route.challenge = {}
        route.challenge.sign_up = "{{route('challenge.sign-up')}}"
        route.challenge.renew_game = "{{route('challenge.renew-game')}}"
        route.challenge.guess_number = "{{route('challenge.guess-number')}}"
    </script>
@endsection
