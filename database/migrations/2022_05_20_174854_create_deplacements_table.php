<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deplacements', function (Blueprint $table) {
            $table->id();


            $table->integer('user_id');
            $table->integer('id_vehicule');
            $table->date('date');
            $table->string('intitule');
            $table->double('peage')->nullable();
            $table->double('gasoil')->nullable();
            $table->double('ptm')->nullable();
            $table->double('nb_km')->nullable();
            $table->boolean('f_divers')->default(0);
            $table->string('infos')->nullable();
            $table->double('m_divers')->nullable();


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
        Schema::dropIfExists('deplacements');
    }
};
