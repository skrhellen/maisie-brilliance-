<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up() // criação de uma tabela
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('joia', function (Blueprint $table) {
            $table->id();
            $table->string('nome',120);
            $table->foreignId('marca_id')->nullable() //chave estrangeira
                ->constrained('marca'); //vinculação da chave estrangeira (id) na tabela
            $table->float('valor',8,2);
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('joia');
    }
};
