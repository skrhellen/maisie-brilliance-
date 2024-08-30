<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstiloJoias extends Model
{
    use HasFactory;

    protected $table = "estilojoias";
    //app/Models/
    protected $fillable = [
        "estilojoias",
    ];
}
