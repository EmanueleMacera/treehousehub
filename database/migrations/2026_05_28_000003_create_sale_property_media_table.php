<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('sale_property_media', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sale_property_id')->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('source_media_id')->nullable()->unique();
            $table->string('type')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->string('path')->nullable();
            $table->timestamps();

            $table->index(['sale_property_id', 'type', 'sort_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sale_property_media');
    }
};
