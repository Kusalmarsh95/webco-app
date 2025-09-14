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
        Schema::create('type_assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_id')->constrained('product_types')->cascadeOnDelete();
            $table->morphs('type_assignment'); 
            $table->timestamps();

            $table->unique(['type_id', 'type_assignment_id', 'type_assignment_type'], 'unique_type_assignment');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('type_assignments');
    }
};
