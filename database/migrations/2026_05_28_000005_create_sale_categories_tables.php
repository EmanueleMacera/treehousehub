<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasTable('category_types')) {
            Schema::create('category_types', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('slug')->unique();
                $table->json('macrodescription')->nullable();
                $table->json('microdescription')->nullable();
                $table->text('iniziativa_immobiliare')->nullable();
                $table->text('stato_iniziativa')->nullable();
                $table->text('progetto')->nullable();
                $table->text('area_intervento')->nullable();
                $table->decimal('superficie_edifici', 10, 2)->nullable();
                $table->decimal('volume_edifici', 10, 2)->nullable();
                $table->unsignedInteger('unita_immobiliari')->nullable();
                $table->unsignedInteger('box_posti_auto')->nullable();
                $table->text('tempi_concessioni')->nullable();
                $table->text('tempi_acquisizione')->nullable();
                $table->text('tempi_realizzazione')->nullable();
                $table->text('promotori')->nullable();
                $table->text('compagine_sociale')->nullable();
                $table->text('amministratore_unico')->nullable();
                $table->text('consiglieri_soci')->nullable();
                $table->text('collaboratori')->nullable();
                $table->text('gestione_generale_iniziativa')->nullable();
                $table->text('consulente_vendite')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('categories')) {
            Schema::create('categories', function (Blueprint $table) {
                $table->id();
                $table->foreignId('type_id')->nullable()->constrained('category_types')->nullOnDelete();
                $table->string('name');
                $table->string('slug')->unique();
                $table->string('status', 20)->default('public');
                $table->string('thumbnail')->nullable();
                $table->timestamps();
                $table->index(['type_id', 'status']);
            });
        }

        if (!Schema::hasTable('category_type_media')) {
            Schema::create('category_type_media', function (Blueprint $table) {
                $table->id();
                $table->foreignId('category_type_id')->constrained('category_types')->cascadeOnDelete();
                $table->string('path');
                $table->string('type', 30);
                $table->unsignedInteger('sort_order')->default(0);
                $table->timestamps();
                $table->index(['category_type_id', 'type', 'sort_order']);
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('category_type_media');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('category_types');
    }
};
