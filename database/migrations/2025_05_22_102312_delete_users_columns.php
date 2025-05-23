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
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex('users_email_unique');
            $table->dropColumn('email');
            $table->dropColumn('email_verified_at');
            $table->dropColumn('password');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('email')->after('name')->default('null')->unique();
            $table->timestamp('email_verified_at')->nullable()->after('name');
            $table->string('password')->default('null');
        });
    }
};
