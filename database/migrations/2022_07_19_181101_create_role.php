<?php

use App\Models\Role;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('roles', function (Blueprint $table) {
      $table->id();
      $table->timestamps();
      $table->string('name');
    });
    Schema::table('users', function (Blueprint $table) {
      $table->foreignIdFor(Role::class);
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('role');
  }
};
