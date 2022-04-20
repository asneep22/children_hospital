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
      $table->string('address')->nullable();
      $table->Date('birthday');
      $table->foreignId('uchastok_id')->constrained('uchastoks')->onDelete('cascade')->onUpdate('cascade');
      $table->integer('rost');
      $table->float('ves');
      $table->boolean('pol')->default(false);
      $table->float('gestaci');
      $table->foreignId('roddom_id')->constrained('roddoms')->onDelete('cascade')->onUpdate('cascade');
      $table->enum('skrinning',["","roddom","policlinic"])->default("")->nullable();
      $table->boolean('audio')->default(0);
      $table->boolean('vich')->default(0);
      $table->boolean('gepatit')->default(0);
      $table->boolean('recepient')->default(0);
      $table->boolean('gruppasvs')->default(0);
      $table->boolean('bcjm')->default(0);
      $table->boolean('gepatitb')->default(0);
      $table->mediumText('recommend')->nullable();
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
