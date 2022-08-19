<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        DB::table('roles')->insert(
            array(
                'name' => 'Admin'
            )
        );
        DB::table('roles')->insert(
            array(
                'name' => 'Instruktør'
            )
        );
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
