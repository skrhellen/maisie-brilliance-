<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use App\Models\NomeMarcas;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dados = Marca::all();

        return view("marca.list", ["dados" => $dados]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //  dd($estilojoias);
  
          return view("marca.form");
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => "required|max:100",
            'contato' => "required",
            'materiais' => "required",
        ], [
            'nome.required' => "O :attribute é obrigatório",
            'nome.max' => "Só é permitido 100 caracteres",
            'contato.required' => "O :attribute é obrigatório",
            'contato.max' => "Só é permitido 11 caracteres no :attribute",
            'materiais.required' => "O :attribute é obrigatório",
            
        ]);
        
        Marca::create(
            [
            'nome' =>$request->nome,
            'contato' =>$request->contato,
            'materiais' =>$request->materiais,
            ]
        );

        return redirect('marca');
    }
    

    /**
     * Display the specified resource.
     * 
     * @param  \App\Models\Marca 
     * @return \Illuminate\Http\Response
     */
    public function show(Marca $marca)  //***************************** */
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * @param  \App\Models\Marca  
     * @return \Illuminate\Http\Response
     */
    public function edit(string $id)
    {
        $dado = Marca::findOrFail($id);

        return view("marca.form", [
            'dado' => $dado,
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Marca 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Marca $marca)
    {
        $request->validate([
            'nome' => "required|max:100",
            'contato' => "required",
            'materiais' => "required",
        ], [
            'nome.required' => "O :attribute é obrigatório",
            'nome.max' => "Só é permitido 100 caracteres",
            'contato.required' => "O :attribute é obrigatório",
            'contato.max' => "Só é permitido 11 caracteres no :attribute",
            'materiais.required' => "O :attribute é obrigatório",
            
        ]);

        Marca::updateOrCreate(
            ['id' => $request->id],
            [
                'nome' =>$request->nome,
                'contato' =>$request->contato,
                'materiais' =>$request->materiais,
                ]
        );

        return redirect('marca');
    }

    /**
     * Remove the specified resource from storage.
     * @param  \App\Models\Marca  
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {
        $dado = Marca::findOrFail($id); //busca um registro com o ID fornecido
        $dado->delete();
        return redirect('marca'); 
    }

    //campo de busca
    public function search(Request $request)
    {
        if (!empty($request->nome)) { //'!empty' verifica se uma variável está vazia ou não
            $dados = Marca::where(
                "nome",
                "like",
                "%" . $request->nome . "%" //% é um caractere curinga em consultas SQL que indica que pode haver qualquer coisa antes ou depois do valor de nome
            )->get(); //executa a cosulta
        } else {
            $dados = Marca::all(); //mostra todas as instancias da classse 'joia' no banco de dados sem filtros
        }

        return view("marca.list", ["dados" => $dados]);
    }
}
