<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Series;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function index() 
    {
        return Series::all();
    }  

    public function store(Request $request) 
    {
        return response()
            ->json(Series::create($request->all()), 201);
    }
}
