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
    Schema::create('pacients', function (Blueprint $table) {
      $table->id();
      $table->string('lastname');
      $table->string('pname');
      $table->string('surname');
      $table->Date('birthday');
      $table->foreignId('uchastok_id')->constrained('uchastoks')->onDelete('cascade')->onUpdate('cascade');
      $table->integer('rost');
      $table->float('ves');
      $table->boolean('pol')->default(false);
      $table->integer('gestaci');
      $table->foreignId('roddom_id')->constrained('roddoms')->onDelete('cascade')->onUpdate('cascade');
      $table->boolean('skrinning')->nullable();
      $table->boolean('audio')->nullable();
      $table->boolean('vich')->nullable();
      $table->boolean('gepatit')->nullable();
      $table->boolean('recepient')->nullable();
      $table->boolean('gruppasvs')->nullable();
      $table->string('recommend')->nullable();
      $table->date('date_add');
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
    Schema::dropIfExists('pacients');
  }
};
