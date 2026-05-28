<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('sale_properties', function (Blueprint $table) {
            if (!Schema::hasColumn('sale_properties', 'surface_common_parts')) {
                $table->decimal('surface_common_parts', 8, 2)->nullable()->after('garden_surface');
            }

            if (!Schema::hasColumn('sale_properties', 'thousandths')) {
                $table->decimal('thousandths', 8, 2)->nullable()->after('surface_common_parts');
            }
        });
    }

    public function down(): void
    {
        Schema::table('sale_properties', function (Blueprint $table) {
            foreach (['surface_common_parts', 'thousandths'] as $column) {
                if (Schema::hasColumn('sale_properties', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
