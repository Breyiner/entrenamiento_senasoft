<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('profiles', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('user_id');
      $table->foreign('user_id')->references('id')->on('users');
      $table->string('company_name')->nullable();
      $table->string('first_name')->nullable();
      $table->string('last_name')->nullable();
      $table->string('phone_number')->nullable();
      $table->unsignedBigInteger('arl_id')->nullable();
      $table->foreign('arl_id')->references('id')->on('arls');
      $table->string('email')->nullable();
      $table->string('address')->nullable();
      $table->unsignedBigInteger('gender_id')->nullable();
      $table->foreign('gender_id')->references('id')->on('genders');
      $table->unsignedBigInteger('city_id')->nullable();
      $table->foreign('city_id')->references('id')->on('cities');
      $table->timestamps();

    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('profiles');
  }
};
