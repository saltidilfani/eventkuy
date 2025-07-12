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
            $table->time('event_time')->nullable();
            $table->foreignId('category_id')->constrained('salti_categories')->onDelete('cascade');
            $table->foreignId('location_id')->constrained('salti_locations')->onDelete('cascade');
            $table->string('poster')->nullable();
            $table->string('organizer')->nullable();
            $table->integer('max_participants')->default(100);
            // Kolom approval
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->foreignId('submitted_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('salti_events');
    }
};
