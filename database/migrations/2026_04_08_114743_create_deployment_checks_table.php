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
        Schema::create('deployment_checks', function (Blueprint $table) {
            $table->id();
            // Foreign key with indexing and cascading delete
            $table->foreignId('project_id')
                ->constrained('projects')
                ->onDelete('cascade')
                ->index();

            $table->string('title'); // String, Required
            $table->boolean('is_completed')->default(false); // Boolean, Default false
            $table->timestamp('completed_at')->nullable();   // Timestamp, Nullable
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deployment_checks');
    }
};
