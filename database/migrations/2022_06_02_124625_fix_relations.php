<?php

use App\Models\Company;
use App\Models\Product;
use App\Models\Weapon;
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

        Schema::table('player', function (Blueprint $table) {
            $table->dropColumn('weaponId');
            $table->dropColumn('teamId');
            $table->dropColumn('productId');
        });

        Schema::table('product', function (Blueprint $table) {
            $table->dropColumn('companyId');
        });

        Schema::table('team', function (Blueprint $table) {
            $table->dropColumn('companyId');
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
