<?php

namespace App\Http\Controllers;

use App\Models\Joias;
use App\Models\Marca;
use App\Charts\JoiasValorChart;
use Illuminate\Http\Request;

class JoiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dados = Joias::all();
        $marca = Marca::all();

        return view("joia.list", [
            "dados" => $dados,
            "marca" => $marca
        
        ]);
    }

        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexPrincipal()
    {
        $dados = Joias::all();

        return view("principal", [
            'dados'=>$dados
        ]);
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $marca = Marca::all();

        return view("joia.form", [
            'marca'=>$marca,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) //$request é usado para acessar e manipular os dados enviados pelo usuário. 
    {
        $request->validate([
            'nome' => "required|max:100",
            'marca_id' => "required",
            'valor' => "required",
            'imagem' => "nullable|image|mimes:png,jpeg,jpg",
        ], [
            'nome.required' => "O :attribute é obrigatório",
            'nome.max' => "Só é permitido 100 caracteres",
            'marca_id.required' => "O :attribute é obrigatório",
            'valor.required' => "O :attribute é obrigatório",
            'imagem.image' => "Deve ser enviado uma imagem",
            'imagem.mimes' => "A imagem deve ser da extensão de PNG, JPEG ou JPG",
        ]);

        $data = $request->all();
        $imagem = $request->file('imagem');

        if ($imagem) {
            $nome_arquivo =
                date('YmdHis') . "." . $imagem->getClientOriginalExtension(); //Cria um nome único para o arquivo de imagem
            $diretorio = "imagem/joia/"; //onde o arquivo será armazenado

            $imagem->storeAs($diretorio, $nome_arquivo, 'public');

            $data['imagem'] = $diretorio . $nome_arquivo;
        }
        /*
        Joias::create(
            [
            'nome' => $request->nome,
            'estilojoias_id' => $request->estilojoias_id,
            'materiais' => $request->materiais,
            'valor' => $request->valor,
        ]);
        */
        Joias::create($data);
        return redirect('joia'); //RETORNA para a rota joia.index
   
    }
         
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Joias  
     * @return \Illuminate\Http\Response
     */
    public function show ($id){
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Joias  
     * @return \Illuminate\Http\Response
     */
    public function edit(string $id)
    {
        $dado = Joias::findOrFail($id);
        $marca = Marca::all();

        return view("joia.form", [
            'dado' => $dado,
            'marca'=> $marca,
        ]);

    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Joias  
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Joias $joias)
    {
        $request->validate([
            'nome' => "required|max:100",
            'marca_id' => "required",
            'valor' => "required",
            'imagem' => "nullable|image|mimes:png,jpeg,jpg",
        ], [
            'nome.required' => "O :attribute é obrigatório",
            'nome.max' => "Só é permitido 100 caracteres",
            'marca_id.required' => "O :attribute é obrigatório",
            'valor.required' => "O :attribute é obrigatório",
            'imagem.image' => "Deve ser enviado uma imagem",
            'imagem.mimes' => "A imagem deve ser da extensão de PNG, JPEG ou JPG",
        ]);
       
        $data = $request->all();
        $imagem = $request->file('imagem');

        if ($imagem) {
            $nome_arquivo =
                date('YmdHis') . "." . $imagem->getClientOriginalExtension();
            $diretorio = "imagem/joia/";

            $imagem->storeAs($diretorio, $nome_arquivo, 'public');

            $data['imagem'] = $diretorio . $nome_arquivo;
        }

        Joias::updateOrCreate(
            ['id' => $request->id],
            $data
        );

        return redirect('joia');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Joias
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) //DEFINIU O PARAMETRO id
    {
        $dado = Joias::findOrFail($id); //busca um registro com o ID fornecido
        $dado->delete();
        return redirect('joia'); //rediciona parade volta para a pagina de joia
    }

    //campo de busca
    public function search(Request $request)
    {
        if (!empty($request->nome)) { //'!empty' verifica se uma variável está vazia ou não
            $dados = Joias::where(
                "nome",
                "like",
                "%" . $request->nome . "%" //% é um caractere curinga em consultas SQL que indica que pode haver qualquer coisa antes ou depois do valor de nome
            )->get(); //executa a cosulta
        } else {
            $dados = Joias::all(); //mostra todas as instancias da classse 'joia' no banco de dados sem filtros
        }

        return view("joia.list", ["dados" => $dados]);
    }

    public function chart(JoiasValorChart $joiasChart)
    {
        return view("joia.chart", ["joiasChart" => $joiasChart->build()]);
    }
}
