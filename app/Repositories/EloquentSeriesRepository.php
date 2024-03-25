<?php

namespace App\Repositories;

use App\Http\Requests\SeriesRequest;
use App\Models\Series;
use App\Models\Season;
use App\Models\Episode;
use Illuminate\Support\Facades\DB;

class EloquentSeriesRepository implements SeriesRepository
{
    public function add(SeriesRequest $request): Series
    {
        return DB::transaction(function () use ($request, &$serie) {

            $serie = Series::create([
                "name" => $request->name,
                'cover' => $request->coverPath
            ]);

            /* for ($i = 1; $i <= $request->seasonsQty; $i++) { 

            $season = $serie->seasons()->create([
            'number' => $i
        ]);

        for ($j = 1; $j <= $request->episodesPerSeason; $j++) { 
            $season->episodes()->create([
                'number' => $j
            ]);
            }
        } */

            $seasons = [];
            for ($i = 1; $i <= $request->seasonsQty; $i++) {

                $seasons[] = [
                    'series_id' => $serie->id,
                    'number' => $i
                ];
            }

            Season::insert($seasons);

            $episodes = [];
            foreach ($serie->seasons as $season) {

                for ($j = 1; $j <= $request->episodesPerSeason; $j++) {

                    $episodes[] = [
                        'season_id' => $season->id,
                        'number' => $j
                    ];
                }
            }

            Episode::insert($episodes);

            return $serie;
        }, 5);
    }
}
