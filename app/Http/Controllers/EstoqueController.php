<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estoque;
use App\Models\Joias;
use PDF;

class EstoqueController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dados = Estoque::all(); 
        $joias = Joias::all();
        return view('estoque.list', [
            "dados" => $dados,
            "joias"=>$joias 
    ]);
    }

    /**
     * Show the form for creating a new resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $joias = Joias::all();  // Obtém todas as joias disponíveis para a seleção
        return view('estoque.form', ['joias'=>$joias ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'joia_id' => 'required',
            'quantidade' => 'required|integer|min:0',
            'lote' => 'required|integer|min:0',
            'imagem' => "nullable|image|mimes:png,jpeg,jpg",
        ]);

        $data = $request->all();
        $imagem = $request->file('imagem');

        if ($imagem) {
            $nome_arquivo =
                date('YmdHis') . "." . $imagem->getClientOriginalExtension(); //Cria um nome único para o arquivo de imagem
            $diretorio = "imagem/estoque/"; //onde o arquivo será armazenado

            $imagem->storeAs($diretorio, $nome_arquivo, 'public');

            $data['imagem'] = $diretorio . $nome_arquivo;
        }

        Estoque::create($data);

        return redirect('estoque');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * @param  \App\Models\Estoque  
     * @return \Illuminate\Http\Response
     */
    public function edit(string $id)
    {
        $dado = estoque::FindOrFail($id);

        $joias = Joias::all();  // Obtém todas as joias disponíveis para a seleção

        return view('estoque.form', [
                'dado' => $dado,
                'joias'=> $joias
        ]);
    
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Estoque  
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Estoque $estoque)
    {
        $request->validate([
            'joia_id' => 'required',
            'quantidade' => 'required|integer|min:0',
            'lote' => 'required|integer|min:0',
            'imagem' => "nullable|image|mimes:png,jpeg,jpg",
        ],
        [
            'joia_id.required' => "O :attribute é obrigatório!",
            'quantidade.required' => "O :attribute é obrigatório!",
            'lote.required' => "O :attribute é obrigatório!",
            'imagem.image' => "Deve ser enviado uma imagem",
            'imagem.mimes' => "A imagem deve ser da extensão de PNG, JPEG ou JPG",
        ]);

        $data = $request->all();
        $imagem = $request->file('imagem');

        if ($imagem) {
            $nome_arquivo =
                date('YmdHis') . "." . $imagem->getClientOriginalExtension();
            $diretorio = "imagem/estoque/";

            $imagem->storeAs($diretorio, $nome_arquivo, 'public');

            $data['imagem'] = $diretorio . $nome_arquivo;
        }

        Estoque::updateOrCreate(
            ['id' => $request->id],
            $data
        );

        return redirect('estoque');
    }

    /**
     * Remove the specified resource from storage.
     * @param  \App\Models\Estoque
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dado = Estoque::findOrFail($id); 
        $dado->delete();
        return redirect('estoque');
    }

    public function search(Request $request)
    {
        if (!empty($request->nome)) { 
            $dados = Joias::where(
                "joia_id",
                "like",
                "%" . $request->joia_id . "%" 
            )->get(); 
        } else {
            $dados = Joias::all(); 

        return view("estoque.list", ["dados" => $dados]);
        }
    }

    public function report()
    {
        $estoque = estoque::All();

        $data = [
            'titulo' => 'Relatório de Estoque',
            'estoque'=> $estoque,
        ];

        $pdf = PDF::loadView('estoque.report', $data);

        return $pdf->download('relatorio_estoque.pdf');
    }

}
