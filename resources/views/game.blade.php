@extends('layouts.app')

@section('content')
    <div class='gameContent'>
        <iframe width="1500" height="700"
            src="{{ $apiData }}">
        </iframe>

    </div>
@endsection