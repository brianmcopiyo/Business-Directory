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
    Schema::dropIfExists('personal_access_tokens');

    // Create the table
    Schema::create('personal_access_tokens', function (Blueprint $table) {
      $table->id();
      $table->foreignId('user_id')->constrained()->cascadeOnDelete();
      $table->string('token', 64)->unique();
      $table->text('abilities')->nullable();
      $table->integer('access_count')->default(0);
      $table->timestamp('expires_at')->nullable();
      $table->string('status')->default('Active');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('personal_access_tokens');
  }
};
