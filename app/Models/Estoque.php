<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    use HasFactory;
    protected $table = "estoque";

    protected $fillable = [
        'joia_id', 
        'quantidade',
        'lote',
        "imagem",
    ];

    protected $casts = [
        'joia_id'=>'integer'
    ];

    public function joia()
    {
        return $this->belongsTo(Joias::class, 'joia_id');
    }
}
