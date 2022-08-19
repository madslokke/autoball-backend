<?php

use App\Models\Company;
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
        Schema::table('invites', function (Blueprint $table) {
            $table->foreignIdFor(Role::class);
            $table->foreignIdFor(Company::class);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('invites', function (Blueprint $table) {
            $table->dropForeignIdFor(Role::class);
            $table->dropForeignIdFor(Company::class);
        });
    }
};
