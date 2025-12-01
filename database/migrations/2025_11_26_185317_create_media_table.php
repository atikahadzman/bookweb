<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('media', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('model_type');             // Eloquent model class
            $table->unsignedBigInteger('model_id');  // Model ID
            $table->uuid('uuid')->nullable();
            $table->string('collection_name');       // Collection name
            $table->string('name');                  // Original file name
            $table->string('file_name');             // Stored file name
            $table->string('mime_type')->nullable();
            $table->string('disk');                  // Storage disk
            $table->string('conversions_disk')->nullable();
            $table->unsignedBigInteger('size');      // File size in bytes
            $table->json('manipulations');           // Manipulations applied
            $table->json('custom_properties');       // Custom properties
            $table->json('generated_conversions');   // Generated conversions
            $table->json('responsive_images');       // Responsive images
            $table->unsignedInteger('order_column')->nullable();
            $table->nullableTimestamps();            // created_at & updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
