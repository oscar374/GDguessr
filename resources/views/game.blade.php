@extends('layouts.app')

@section('content')
    <div class="gameContent">
        <div class="iframe-wrapper">
            <iframe muted width="1500" height="700"
                src="{{ $apiData }}">
            </iframe>
            <div class="title-cover"></div>
        </div>
    </div>

    <style>
        .iframe-wrapper {
            position: relative;
            width: 1500px;
            height: 700px;
        }

        iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 1500px;
            height: 700px;
        }

    </style>

    <script>
        let count = 0;

        document.addEventListener('keydown', function(event) {
            count++;

            if(count == 2) location.reload();

            if (event.code === 'Space') {
                const titleCover = document.querySelector('.title-cover');
                if (titleCover) {
                    titleCover.style.backgroundColor = 'rgba(0, 0, 0, 0)';
                    titleCover.style.border = '1px solid rgba(0, 0, 0, 0)';
                }
                event.preventDefault();
            }
        });
    </script>
@endsection
