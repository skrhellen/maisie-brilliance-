<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Joias extends Model
{
    use HasFactory;
    protected $table = "joia";
    
    protected $fillable = [ // campos q podem ser preenchidos em massa. Isso é importante ao criar ou atualizar registros no banco de dados usando o método create() ou update() em um modelo.
        "clientes_id",
        "nome",
        "estilojoias_id",
        "marca_id",
        "materiais",
        "valor",
        "imagem",
    ];

    protected $casts = [
        'estilojoias_id'=>'integer'
    ];

    public function estilojoias(){
        return $this->belongsTo(EstiloJoias::class,'estilojoias_id'); // Este método estabelece a relação "pertence a" entre dois modelos.
        //return $this->hasOne(Estoque::class);
    }

    public function marca(){
        return $this->belongsTo(Marca::class,'marca_id');
    }


    public function estoque(){
        return $this->hasOne(Estoque::class);
    }

    public function clientes()
    {
        return $this->belongsToMany(Clientes::class, 'joias_id')
                    ->withPivot('preco_tot', 'quantidade', 'data')
                    ->withTimestamps();
    }

    public function venda()
    {
        return $this->hasMany(Vendas::class);
    }
}

