<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use App\Models\Season;
use Illuminate\Http\Request;

class EpisodesController 
{
    public function index(Season $season)
    {
        return view('episodes.index', [
            'episodes' => $season->episodes,
            'mensagemSucesso' => session('mensagem.sucesso')
        ]);
    }

    public function update(Request $request, Season $season) 
    {
        // $watchedEpisodes = $request->episodes;
        // $season->episodes->each(function (Episode $episode) use ($watchedEpisodes){
        //     $episode->watched = in_array($episode->id, $watchedEpisodes);
        // });        

        // $season->push();

        $watchedEpisodes = $request->episodes;
        // $episodes = [];
        // for ($i = 0; $i < count($watchedEpisodes); $i++) { 
            
        //     $episodes[] = [
        //         'watched' => 1
        //     ];
        // }

        $episodesGet = Episode::whereIn('id', $watchedEpisodes)->update(['watched' => 1]);

        return to_route('episodes.index', $season->id)
            ->with('mensagem.sucesso', 'Episódios marcados como assistidos.');
    }
}