<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('sale_properties', function (Blueprint $table) {
            if (!Schema::hasColumn('sale_properties', 'source_item_id')) {
                $table->unsignedBigInteger('source_item_id')->nullable()->unique()->after('id');
            }

            if (!Schema::hasColumn('sale_properties', 'address')) {
                $table->string('address')->nullable()->after('location');
            }

            if (!Schema::hasColumn('sale_properties', 'orientation')) {
                $table->string('orientation', 50)->nullable()->after('address');
            }

            if (!Schema::hasColumn('sale_properties', 'latitude')) {
                $table->decimal('latitude', 10, 7)->nullable()->after('orientation');
            }

            if (!Schema::hasColumn('sale_properties', 'longitude')) {
                $table->decimal('longitude', 10, 7)->nullable()->after('latitude');
            }

            if (!Schema::hasColumn('sale_properties', 'description_translations')) {
                $table->json('description_translations')->nullable()->after('description_long');
            }

            if (!Schema::hasColumn('sale_properties', 'bathrooms')) {
                $table->unsignedInteger('bathrooms')->nullable()->after('description_translations');
            }

            if (!Schema::hasColumn('sale_properties', 'rooms')) {
                $table->unsignedInteger('rooms')->nullable()->after('bathrooms');
            }

            if (!Schema::hasColumn('sale_properties', 'surface_commercial')) {
                $table->decimal('surface_commercial', 8, 2)->nullable()->after('rooms');
            }

            if (!Schema::hasColumn('sale_properties', 'surface_residential')) {
                $table->decimal('surface_residential', 8, 2)->nullable()->after('surface_commercial');
            }

            if (!Schema::hasColumn('sale_properties', 'surface_balcony')) {
                $table->decimal('surface_balcony', 8, 2)->nullable()->after('surface_residential');
            }

            if (!Schema::hasColumn('sale_properties', 'garden_surface')) {
                $table->decimal('garden_surface', 8, 2)->nullable()->after('surface_balcony');
            }

            if (!Schema::hasColumn('sale_properties', 'floor')) {
                $table->string('floor', 20)->nullable()->after('garden_surface');
            }

            if (!Schema::hasColumn('sale_properties', 'construction_year')) {
                $table->unsignedInteger('construction_year')->nullable()->after('floor');
            }

            if (!Schema::hasColumn('sale_properties', 'energy_class')) {
                $table->string('energy_class', 10)->nullable()->after('construction_year');
            }

            if (!Schema::hasColumn('sale_properties', 'condition')) {
                $table->string('condition', 50)->nullable()->after('energy_class');
            }

            if (!Schema::hasColumn('sale_properties', 'balcony')) {
                $table->unsignedInteger('balcony')->nullable()->after('condition');
            }

            foreach (['has_parking', 'has_garage', 'has_pool', 'has_spa', 'has_park', 'negotiable'] as $column) {
                if (!Schema::hasColumn('sale_properties', $column)) {
                    $table->boolean($column)->default(false);
                }
            }

            if (!Schema::hasColumn('sale_properties', 'parking_spaces')) {
                $table->unsignedInteger('parking_spaces')->nullable()->after('has_park');
            }

            if (!Schema::hasColumn('sale_properties', 'other_amenities')) {
                $table->text('other_amenities')->nullable()->after('parking_spaces');
            }

            if (!Schema::hasColumn('sale_properties', 'annual_fee')) {
                $table->decimal('annual_fee', 10, 2)->nullable()->after('other_amenities');
            }

            if (!Schema::hasColumn('sale_properties', 'monthly_expenses')) {
                $table->decimal('monthly_expenses', 10, 2)->nullable()->after('annual_fee');
            }

            if (!Schema::hasColumn('sale_properties', 'imu_tax')) {
                $table->decimal('imu_tax', 10, 2)->nullable()->after('monthly_expenses');
            }

            if (!Schema::hasColumn('sale_properties', 'contact_name')) {
                $table->string('contact_name', 100)->nullable()->after('imu_tax');
            }

            if (!Schema::hasColumn('sale_properties', 'contact_phone')) {
                $table->string('contact_phone', 30)->nullable()->after('contact_name');
            }

            if (!Schema::hasColumn('sale_properties', 'pdf_files')) {
                $table->json('pdf_files')->nullable()->after('contact_phone');
            }

            if (!Schema::hasColumn('sale_properties', 'videos')) {
                $table->json('videos')->nullable()->after('pdf_files');
            }

            if (!Schema::hasColumn('sale_properties', 'nearby')) {
                $table->text('nearby')->nullable()->after('videos');
            }

            if (!Schema::hasColumn('sale_properties', 'external_link')) {
                $table->string('external_link')->nullable()->after('nearby');
            }

            if (!Schema::hasColumn('sale_properties', 'category_id')) {
                $table->unsignedBigInteger('category_id')->nullable()->after('external_link');
            }

            if (!Schema::hasColumn('sale_properties', 'status')) {
                $table->string('status', 20)->default('draft')->after('category_id');
            }

            if (!Schema::hasColumn('sale_properties', 'property_type')) {
                $table->string('property_type', 50)->nullable()->after('status');
            }
        });

        if (Schema::hasColumn('sale_properties', 'status')) {
            DB::table('sale_properties')
                ->where('active', true)
                ->where('status', 'draft')
                ->update(['status' => 'publish']);
        }
    }

    public function down(): void
    {
        Schema::table('sale_properties', function (Blueprint $table) {
            $columns = [
                'source_item_id',
                'address',
                'orientation',
                'latitude',
                'longitude',
                'description_translations',
                'bathrooms',
                'rooms',
                'surface_commercial',
                'surface_residential',
                'surface_balcony',
                'garden_surface',
                'floor',
                'construction_year',
                'energy_class',
                'condition',
                'balcony',
                'has_parking',
                'has_garage',
                'has_pool',
                'has_spa',
                'has_park',
                'negotiable',
                'parking_spaces',
                'other_amenities',
                'annual_fee',
                'monthly_expenses',
                'imu_tax',
                'contact_name',
                'contact_phone',
                'pdf_files',
                'videos',
                'nearby',
                'external_link',
                'category_id',
                'status',
                'property_type',
            ];

            foreach ($columns as $column) {
                if (Schema::hasColumn('sale_properties', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
