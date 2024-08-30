<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clientes;
use PDF;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dados = Clientes::all();

        return view("clientes.list", ["dados" => $dados]);
    }

    /**
     * Show the form for creating a new resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("clientes.form");
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => "required|max:100",
            'email' => "required",
            'contato' => "required",
            'imagem' => "nullable|image|mimes:png,jpeg,jpg",
        ], [
            'nome.required' => "O :attribute é obrigatório",
            'nome.max' => "Só é permitido 100 caracteres",
            'email' => "O :attribute é obrigatório",
            'contato' => "O :attribute é obrigatório",
            'imagem.image' => "Deve ser enviado uma imagem",
            'imagem.mimes' => "A imagem deve ser da extensão de PNG, JPEG ou JPG",
        ]);

        $data = $request->all();
        $imagem = $request->file('imagem');

        if ($imagem) {
            $nome_arquivo =
                date('YmdHis') . "." . $imagem->getClientOriginalExtension(); //Cria um nome único para o arquivo de imagem
            $diretorio = "imagem/clientes/"; //onde o arquivo será armazenado

            $imagem->storeAs($diretorio, $nome_arquivo, 'public');

            $data['imagem'] = $diretorio . $nome_arquivo;
        }

        /*
        Clientes::create(
            [
            'nome' => $request->nome,
            'email' => $request->email,
            'contato' => $request->contato,
        ]);
        */

        Clientes::create($data);
        return redirect('clientes'); 
    }

    /**
     * Display the specified resource.
     */
    public function show(clientes $clientes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * 
     * @param  \App\Models\Clientes 
     * @return \Illuminate\Http\Response
     */
    public function edit(string $id)
    {
        $dado = Clientes::findOrFail($id);

        return view("clientes.form", [
            'dado' => $dado,
        ]);
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param  \Illuminate\Http\Request  
     * @param  \App\Models\Clientes  
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Clientes $clientes)
    {
        $request->validate([
            'nome' => "required|max:100",
            'email' => "required",
            'contato' => "required",
            'imagem' => "nullable|image|mimes:png,jpeg,jpg",
        ], [
            'nome.required' => "O :attribute é obrigatório",
            'nome.max' => "Só é permitido 100 caracteres",
            'email' => "O :attribute é obrigatório",
            'contato' => "O :attribute é obrigatório",
            'imagem.image' => "Deve ser enviado uma imagem",
            'imagem.mimes' => "A imagem deve ser da extensão de PNG, JPEG ou JPG",
        ]);

        $data = $request->all();
        $imagem = $request->file('imagem');

        if ($imagem) {
            $nome_arquivo =
                date('YmdHis') . "." . $imagem->getClientOriginalExtension();
            $diretorio = "imagem/clientes/";

            $imagem->storeAs($diretorio, $nome_arquivo, 'public');

            $data['imagem'] = $diretorio . $nome_arquivo;
        }
        Clientes::updateOrCreate(
        [
            ['id' => $request->id],
            $data
        ]);
        
        return redirect('clientes'); 
    }

    /**
     * Remove the specified resource from storage.
     * @param  \App\Models\Clientes
     * @return \Illuminate\Http\Response
     */
    public function destroy(String $id)
    {
        $dado = Clientes::findOrFail($id); 
        $dado->delete();
        return redirect('clientes'); 
    }

    public function search(Request $request)
    {
        if (!empty($request->nome)) { //'!empty' verifica se uma variável está vazia ou não
            $dados = Clientes::where(
                "nome",
                "like",
                "%" . $request->nome . "%" 
            )->get(); 
        } else {
            $dados = Clientes::all(); 
        }

        return view("clientes.list", ["dados" => $dados]);
    }

    public function report()
    {
        $clientes = clientes::All();

        $data = [
            'titulo' => 'Relatório de Clientes',
            'clientes'=> $clientes,
        ];

        $pdf = PDF::loadView('clientes.report', $data);

        return $pdf->download('relatorio_clientes.pdf');
    }
}
