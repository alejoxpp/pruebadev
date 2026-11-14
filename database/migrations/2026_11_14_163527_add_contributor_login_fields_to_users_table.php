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
        Schema::table('users', function (Blueprint $table) {
    $table->string('username', 50)->nullable()->unique();
    $table->integer('contribuyente_id')->nullable()->unique();

    $table->foreign('contribuyente_id')
        ->references('id')
        ->on('contribuyentes')
        ->cascadeOnDelete();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    Schema::table('users', function (Blueprint $table) {
    $table->dropForeign(['contribuyente_id']);
    $table->dropUnique(['contribuyente_id']);
    $table->dropUnique(['username']);
    $table->dropColumn(['contribuyente_id', 'username']);
    });
    }
};
