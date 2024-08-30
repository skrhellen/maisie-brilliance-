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
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('venda', function (Blueprint $table) {
            $table->id();
            $table->foreignId('clientes_id')
                ->constrained('clientes');
            $table->foreignId('joia_id')
                ->constrained('joia');
            $table->date('data');
            $table->string('quantidade');
            $table->string('preco_tot');
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
        Schema::dropIfExists('venda');
    }
};
