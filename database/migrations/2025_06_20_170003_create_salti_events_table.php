<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('salti_events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->date('event_date');
            $table->time('event_time')->nullable(); // <-- TAMBAHKAN BARIS INI
            $table->foreignId('category_id')->constrained('salti_categories')->onDelete('cascade');
            $table->foreignId('location_id')->constrained('salti_locations')->onDelete('cascade');
            $table->string('poster')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('salti_events');
    }
};
