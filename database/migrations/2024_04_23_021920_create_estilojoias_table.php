<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * 
     * @return void
     */
    public function up()
    {
        
        Schema::create('estilojoias', function (Blueprint $table) {
            $table->id();
            $table->string("estilojoias");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * 
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estilojoias');
    }
};
