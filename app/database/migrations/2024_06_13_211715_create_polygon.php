<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement('CREATE EXTENSION IF NOT EXISTS postgis');

        Schema::create('polygons', function (Blueprint $table) {
            $table->id();
            $table->string("oblast");
            $table->geometry("geom");
            $table->timestamps();
        });

        Schema::create("sessions", function (Blueprint $table) {
            $table->string('id')->primary();
            $table->text('payload');
            $table->unsignedBigInteger('last_activity');
            $table->integer('user_id')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('user_agent')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('polygons');
    }
};
