@extends('layouts.app')

@section('content')
    <div class="gameContent">
        <div class="iframe-wrapper">
            <iframe muted width="1300" height="700"
                src="{{ $embedLink }}">
            </iframe>
            <div class="title-cover">
                <div style='display: flex; justify-content: center; align-items: center;'>
                    <form id="guessForm" style="margin-top: 20px;"> 
                        @csrf
                        <input autocomplete="off" type="text" id="answer" name="answer" placeholder="type your guess">
                    </form>
                    <h3 style="margin-left: 40px;"> Guesses: 0 </h3>
                    <h2 style="margin-left: 40px;"> </h2>
                </div>
            </div>
        </div>

    </div> 

    <div class='pulseEffect'> </div>

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
        let levelName = "{{ $levelName }}";

        document.getElementById("guessForm").addEventListener("submit", function(event) {
            let answer = document.getElementById("answer").value;
            guesses++;
            document.querySelector('h3').innerHTML = "Guesses: " + guesses;
            event.preventDefault(); 

            if(answer.toLowerCase() == levelName.toLowerCase()) {
                document.querySelector('body').style.animation = "none";
                document.querySelector('.pulseEffect').style.animation = "none";
                setTimeout(() => {
                    document.querySelector('.pulseEffect').style.animation = "pulseBackgroundGreen 3s forwards";
                }, 10);
                setTimeout(() => {
                    location.reload();
                }, 1000);
            } else {
                document.querySelector('body').style.animation = "none";
                document.querySelector('.pulseEffect').style.animation = "none";
                setTimeout(() => {
                    document.getElementById("answer").value = "";
                    document.querySelector('.pulseEffect').style.animation = "pulseBackgroundRed 1s forwards";
                }, 10);

                 if(guesses > 0){
                    let hangman = "";
                    let revealedCount = 0;

                    for(let i = 0; i < levelName.length; i++) {
                        if(revealedCount < guesses && levelName[i] !== " ") {c
                            hangman += levelName[i];
                            revealedCount++;
                        } else if(levelName[i] === " ") {
                            hangman += " "; 
                        } else {
                            hangman += "_";
                        }
                    }
                document.querySelector('h2').innerHTML = hangman;
                  }
            }
        });
    </script>  
@endsection     