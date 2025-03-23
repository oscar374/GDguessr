@extends('layouts.app')

@section('content')
    <div class="gameContent">
        <div class="iframe-wrapper">
            <iframe muted width="1300" height="700"
                src="{{ $embedLink }}">
            </iframe>
            <div class="title-cover"></div>
        </div>

        <div style='display: flex; justify-content: center; align-items: center;'>
            <form id="guessForm" style="margin-top: 20px;"> 
                @csrf
                <input type="text" id="answer" name="answer" placeholder="type your guess">
            </form>
            <h3 style="margin-left: 40px;"> Guesses: 0 </h3>
        </div>
    </div>

    <style>
        .iframe-wrapper {
            position: relative;
            width: 1300px;
            height: 80vh;
        }
        
        iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 1300px;
            height: 80vh;
        }
    </style>

    <script>
        let guesses = 0;

        document.getElementById("guessForm").addEventListener("submit", function(event) {
            guesses++;
            document.querySelector('h3').innerHTML = "Guesses: " + guesses;
            event.preventDefault(); 

            let answer = document.getElementById("answer").value;
            let levelName = "{{ $levelName }}";

            if(answer.toLowerCase() == levelName.toLowerCase()) {
                document.querySelector('body').style.animation = "none";
                setTimeout(() => {
                    document.querySelector('body').style.animation = "pulseBackgroundGreen 3s forwards";
                }, 10);
                setTimeout(() => {
                    location.reload();
                }, 1000);
            } else {
                document.querySelector('body').style.animation = "none";
                setTimeout(() => {
                    document.getElementById("answer").value = "";
                    document.querySelector('body').style.animation = "pulseBackgroundRed 1s forwards";
                }, 10);
            }

        });
    </script>  
@endsection