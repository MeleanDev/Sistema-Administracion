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
        Schema::create('factura_temps', function (Blueprint $table) {
            $table->id();
            $table->string('factura');
            $table->string('admin');
            $table->string('nombre');
            $table->string('apellido');
            $table->string('cedula');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factura_temps');
    }
};
