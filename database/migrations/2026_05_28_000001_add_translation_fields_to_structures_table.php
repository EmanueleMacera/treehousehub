<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('structures', function (Blueprint $table) {
            if (!Schema::hasColumn('structures', 'name_translations')) {
                $table->json('name_translations')->nullable()->after('name');
            }

            if (!Schema::hasColumn('structures', 'location_translations')) {
                $table->json('location_translations')->nullable()->after('location');
            }

            if (!Schema::hasColumn('structures', 'address')) {
                $table->string('address')->nullable()->after('location_translations');
            }

            if (!Schema::hasColumn('structures', 'address_translations')) {
                $table->json('address_translations')->nullable()->after('address');
            }

            if (!Schema::hasColumn('structures', 'description_short_translations')) {
                $table->json('description_short_translations')->nullable()->after('description_short');
            }

            if (!Schema::hasColumn('structures', 'description_long_translations')) {
                $table->json('description_long_translations')->nullable()->after('description_long');
            }

            if (!Schema::hasColumn('structures', 'image_path')) {
                $table->string('image_path')->nullable()->after('external_url');
            }
        });
    }

    public function down(): void
    {
        Schema::table('structures', function (Blueprint $table) {
            $columns = [
                'name_translations',
                'location_translations',
                'address_translations',
                'description_short_translations',
                'description_long_translations',
            ];

            foreach ($columns as $column) {
                if (Schema::hasColumn('structures', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
