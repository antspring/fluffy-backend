<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('product_ingredient', function (Blueprint $table) {
            $table->integer('quantity')->nullable()->change();
            $table->string('unit')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_ingredient', function (Blueprint $table) {
            $table->integer('quantity')->default(1)->change();
            $table->string('unit')->default('')->change();
        });
    }
};
