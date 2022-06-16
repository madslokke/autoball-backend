<?php

use App\Models\Company;
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
        Schema::table('playing_fields', function (Blueprint $table) {
            $table->foreignIdFor(Company::class);
        });
        Schema::table('reload_stations', function (Blueprint $table) {
            $table->foreignIdFor(Company::class);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        //
    }
};
