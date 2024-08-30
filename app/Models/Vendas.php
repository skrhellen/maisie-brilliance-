<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendas extends Model
{
    use HasFactory;

    protected $table = 'venda';

    protected $fillable = [
        "data",
        "quantidade",
        'clientes_id',
        'joia_id',
        'preco_tot',
        "imagem",
    ];

    protected $casts = [
        'clientes_id' => 'integer',
        'joia_id' => 'integer',
        'data' => 'date',
        'quantidade' => 'integer',
        'preco_tot' => 'integer',

    ];

    public function cliente()
    {
        return $this->belongsTo(Clientes::class, 'clientes_id');
    }

    public function joia()
    {
        return $this->belongsTo(Joias::class, 'joia_id');
    }

}
