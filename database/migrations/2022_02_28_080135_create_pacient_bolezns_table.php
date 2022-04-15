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
        Schema::create('pacient_bolezns', function (Blueprint $table) {
            $table->id();
            $table->date("date_in")->nullable();
            $table->date("date_ou")->nullable();
            $table->foreignId('pacients_id')->constrained('pacients')->onDelete('cascade')->onUpdate('cascade');;
            $table->foreignId('bolezn_id')->constrained('bolezns')->onDelete('cascade')->onUpdate('cascade');;
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
        Schema::dropIfExists('pacient_bolezns');
    }
};
