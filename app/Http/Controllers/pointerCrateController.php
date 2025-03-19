<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;

class PointerCrateController extends Controller 
{
    public function getApiData(){
        $randomNumber = rand(1, 400);
        $response = Http::withOptions(['verify' => false])->get("https://pointercrate.com/api/v2/demons/{$randomNumber}");
        $data = $response->json();

        $videoLink = null;
        if (isset($data['data']['records']) && !empty($data['data']['records'])) {
            foreach ($data['data']['records'] as $record) {
                if (!empty($record['video'])) {
                    $videoLink = $record['video'];
                    break;
                }
            }
        }        

        if ($videoLink) {
            $videoLink = str_replace('watch?v=', 'embed/', $videoLink);
            $randomStart = rand(0, 90);
            $videoLink .= "?start={$randomStart}&autoplay=1&mute=1&controls=0&modestbranding=0&showinfo=1";
        }
        return view('game', ['apiData' => $videoLink]);
    }
}