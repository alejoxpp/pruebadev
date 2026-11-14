<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('contribuyentes', function (Blueprint $table) {
            $table->string('nombre_completo', 201)->nullable();
        });
        DB::table('contribuyentes')->update([
        'nombre_completo' => DB::raw(
        "TRIM(CONCAT(COALESCE(nombre, ''), ' ', COALESCE(apellidos, '')))" ),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contribuyentes', function (Blueprint $table) {
            $table->dropColumn('nombre_completo');
        });
    }
    };