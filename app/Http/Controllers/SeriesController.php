<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesRequest;
use App\Models\Series;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeriesController extends Controller
{
    public function index(Request $request)
    {
        // return $request->get('id'); buscar o dado em qualquer lugar do request
        // return redirect('https://www.google.com'); redirecionar

        $series = Series::with(['seasons'])->get();
        
        /* Buscar séries já com as temporadas passando o relacionamento
        $series = Serie::with(['seasons'])->get(); */

        $mensagemSucesso = $request->session()->get('mensagem.sucesso');
        // $mensagemSucesso = session('mensagem.sucesso'); Para buscar na sessão

        /* Limpar mensagem da sessão
        $request->session()->forget('mensagem.sucesso'); */


        return view('series.index')
            ->with('series', $series)
            ->with('mensagemSucesso', $mensagemSucesso);
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(SeriesRequest $request)
    {
        $serie = Series::create($request->all());

        for ($i = 1; $i <= $request->seasonQty; $i++) { 

            $season = $serie->seasons()->create([
                'number' => $i
            ]);

            for ($j = 1; $j <= $request->episodesPerSeason; $j++) { 
                $season->episodes()->create([
                    'number' => $j
                ]);
            }
        }
        // Serie::create($request->only(['nome'])); Pegar campos especificos

        // $request->session()->flash('mensagem.sucesso', "Série {$serie->nome} adicionada com sucesso");

        return to_route('series.index')
            ->with('mensagem.sucesso', "Série {$serie->nome} adicionada com sucesso");                
    }

    public function destroy(Series $series, Request $request)
    {
        $series->delete();
        /* Adicionar mensagem a sessão */
        // $request->session()->put('mensagem.sucesso', 'Série removida com sucesso'); 

        /* Adiciona mensagem na sessão e esquece automaticamente  
        $request->session()->flash('mensagem.sucesso', "Série {$series->nome} removida com sucesso");*/
        
        /* Adiciona mensagem na sessão
        session(['mensagem.sucesso' => 'Série removida com sucesso']);  */
       
        return to_route('series.index')
            ->with('mensagem.sucesso', "Série {$series->nome} removida com sucesso");
    }

    public function edit(Series $series)
    {
        /*  
            Para acessar a coleção
            $series->seasons; 

            Para acessar o relacionamento e modificar a query
            $series->temporadas()->whereId()->get()
        */
        return view('series.edit')->with('serie', $series);
    }

    public function update(Series $series, SeriesRequest $request) 
    {
        // $series->nome = $request->nome;

        // fill() utiliza o atributi fillable para adicionar apenas o necessário
        $series->fill($request->all()); 
        $series->save();

        return to_route('series.index')
            ->with('mensagem.sucesso', "Série {$series->nome} atualizada com sucesso");
    }
}
