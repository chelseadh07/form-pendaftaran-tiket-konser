<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('concert_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();
            $table->string('name', 120);
            $table->string('email', 160);
            $table->string('phone', 24);
            $table->string('ticket_type', 20);
            $table->unsignedTinyInteger('quantity');
            $table->unsignedInteger('unit_price');
            $table->unsignedInteger('total_price');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('concert_registrations');
    }
};
