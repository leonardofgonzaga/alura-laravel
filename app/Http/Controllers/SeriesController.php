<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeriesController extends Controller
{
    public function index(Request $request)
    {
        // return $request->get('id'); buscar o dado em qualquer lugar do request
        // return redirect('https://www.google.com'); redirecionar

        $series = Serie::query()->orderBy('nome')->get();

        $html = '<ul>';

        return view('series.index')->with('series', $series);
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(Request $request)
    {
        Serie::create($request->all());
        // Serie::create($request->only(['nome'])); Pegar campos especificos

        return to_route('series.index');                
    }

}
