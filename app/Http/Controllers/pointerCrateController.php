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
        $videoLink = 'https://www.youtube.com/watch?v=G5xZf8sP2W0';
            
        if (isset($data['data']['records']) && !empty($data['data']['records'])) {
            foreach ($data['data']['records'] as $record) {
                if (!empty($record['video'])) {
                    if($this->isVideoAvailable($record['video'])){
                        $videoLink = $record['video'];
                        break; 
                    }
                }
            }
        }

        $videoId = $this->extractYouTubeId($videoLink);

        if ($videoId) {     
            $embedLink = "https://www.youtube.com/embed/{$videoId}?start=" . rand(30, 90) . "&autoplay=1&mute=1&controls=0&modestbranding=0&showinfo=1";
        } else {
            $embedLink = "https://www.youtube.com/embed/Si0aV7WkzpA";
        }

        return view('game', ['embedLink' => $embedLink, 'levelName' => $levelName]);
    }

    private function isVideoAvailable($url) {
        try {
            $videoId = $this->extractYouTubeId($url);
            if (!$videoId) return false;
            
            $response = Http::withOptions(['verify' => false])
                ->get("https://www.youtube.com/oembed?url=https://www.youtube.com/watch?v={$videoId}&format=json");
            
            return $response->successful();
        } catch (\Exception $e) {
            return false;
        }
    }

    private function extractYouTubeId($url) {
        $pattern = '~
            (?:youtube\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)
            ([^"&?/\s]{11})
        ~ix';
        
        if (preg_match($pattern, $url, $matches)) {
            return $matches[1];
        }
        
        return null;
    }
}