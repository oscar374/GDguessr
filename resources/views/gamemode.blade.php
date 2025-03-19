@extends('layouts.app')

@section('content')
    <h1>Choose a GameMode</h1>
    <div class='gameModes'>
        <a href='{{ url('/game') }}'>Normal</a>
    </div>
@endsection