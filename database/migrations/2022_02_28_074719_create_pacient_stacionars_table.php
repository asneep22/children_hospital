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
        Schema::create('pacient_stacionars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pacients_id')->constrained('pacients')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('stacionar_id')->constrained('stacionars')->onDelete('cascade')->onUpdate('cascade');
            $table->date('date_in');
            $table->date('date_ou')->nullable();
            $table->string('diagnoz');
            $table->boolean('inhome')->nullable();
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
        Schema::dropIfExists('pacient_stacionars');
    }
};
