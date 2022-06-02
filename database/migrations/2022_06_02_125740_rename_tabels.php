<?php

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
        Schema::rename('company', 'companies');
        Schema::rename('player', 'players');
        Schema::rename('product', 'products');
        Schema::rename('team', 'teams');
        Schema::rename('weapon', 'weapons');
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
