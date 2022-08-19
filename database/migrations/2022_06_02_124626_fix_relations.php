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
            $table->foreignIdFor(Weapon::class);
            $table->foreignIdFor(Product::class);
        });

        Schema::table('product', function (Blueprint $table) {
            $table->foreignIdFor(Company::class);
        });

        Schema::table('team', function (Blueprint $table) {
            $table->foreignIdFor(Company::class);
            $table->integer('teamCode');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreignIdFor(Company::class);
        });

        Schema::table('weapon', function (Blueprint $table) {
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
