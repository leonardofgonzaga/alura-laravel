<?php

namespace App\Http\Controllers\Api;

use App\Models\Series;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SeriesRequest;
use App\Repositories\SeriesRepository;

class SeriesController extends Controller
{
    public function __construct(private SeriesRepository $seriesRepository)
    {
        
    }

    public function index() 
    {
        return Series::all();
    }  

    public function store(SeriesRequest $request) 
    {
        return response()
            ->json($this->seriesRepository->add($request), 201);
    }

    public function show(int $series) 
    {
        $seriesModel = Series::with('seasons.episodes')->find($series);

        if ($seriesModel == null) {
            return response()->json(['message' => 'Series not found']);
        }

        return $seriesModel;
    }

    public function update(Series $series, SeriesRequest $request)
    {
        $series->fill($request->all());
        $series->save();
        return $series;
    }

    public function destroy(int $series)
    {
        Series::destroy($series);
        return response()->noContent();
    }
}
