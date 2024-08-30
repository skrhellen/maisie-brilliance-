<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    use HasFactory;

    protected $table = "clientes";
    //app/Models/
    protected $fillable = [
        "nome",
        "email",
        "contato",
        "imagem",
    ];

    public function joias()
    {
        return $this->belongsToMany(Joias::class, 'venda')
                    ->withPivot('preco_tot', 'quantidade', 'data')
                    ->withTimestamps();
    }

    public function venda()
    {
        return $this->hasMany(Vendas::class);
    }
}
