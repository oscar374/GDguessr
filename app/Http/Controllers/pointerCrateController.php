<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;

class PointerCrateController extends Controller 
{
    public function getApiData(){
        $randomNumber = rand(1, 400);
        $response = Http::withOptions(['verify' => false])->get("https://pointercrate.com/api/v2/demons/{$randomNumber}");
        $data = $response->json();

        $levelName = $data['data']['name'] ?? 'Unknown Level';
        $videoLink = 'https://www.youtube.com/watch?v=Si0aV7WkzpA';
        
        if (isset($data['data']['records']) && !empty($data['data']['records'])) {
            foreach ($data['data']['records'] as $record) {
                if (!empty($record['video'])) {
                    $videoLink = $record['video'];
                    break;
                }
            }
        }

        $videoId = null;
        if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $videoLink, $matches)) {
            $videoId = $matches[1];
        }

        if ($videoId) {
            $embedLink = "https://www.youtube.com/embed/{$videoId}?start=" . rand(30, 90) . "&autoplay=1&mute=1&controls=0&modestbranding=0&showinfo=1";
        } else {
            $embedLink = "https://www.youtube.com/embed/Si0aV7WkzpA";
        }

        return view('game', ['embedLink' => $embedLink, 'levelName' => $levelName]);
    }
}
