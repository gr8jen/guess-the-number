@extends('layout.master')

@section('title')
    Guess the number
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-between">
            @for ($key = 1; $key <= $minimumPlayers; $key++)
                @include('partials.user', ['key' => $key, 'user' => $users->get($key)])
            @endfor
        </div>
    </div>
@endsection
