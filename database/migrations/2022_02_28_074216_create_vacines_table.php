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
        Schema::create('vacines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pacients_id')->constrained('pacients')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('descr_vacines_id')->constrained('descr_vacines')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('vacines');
    }
};
