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
    Schema::create('service_orders', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('client_id');
      $table->foreign('client_id')->references('id')->on('users');
      $table->unsignedBigInteger('professional_id');
      $table->foreign('professional_id')->references('id')->on('users');
      $table->unsignedBigInteger('activity_id');
      $table->foreign('activity_id')->references('id')->on('activities');
      $table->dateTime('date');
      $table->integer('hours');
      $table->text('observations')->nullable();
      $table->unsignedBigInteger('status_id');
      $table->foreign('status_id')->references('id')->on('order_statuses');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('service_orders');
  }
};
