<?php

namespace App\Console\Commands;

use App\Models\SaleProperty;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ImportItemsSales extends Command
{
    protected $signature = 'sales:import-items-sql {path : Percorso del dump items.sql} {--keep-temp : Non elimina la tabella temporanea items_import}';

    protected $description = 'Importa il dump vendite items.sql dentro sale_properties.';

    public function handle(): int
    {
        $path = (string) $this->argument('path');

        if (!is_file($path)) {
            $this->error("File non trovato: {$path}");
            return self::FAILURE;
        }

        $sql = file_get_contents($path);
        if ($sql === false || trim($sql) === '') {
            $this->error('Il file SQL e vuoto o non leggibile.');
            return self::FAILURE;
        }

        $sql = $this->rewriteDumpForTemporaryTable($sql);

        DB::statement('DROP TABLE IF EXISTS `items_import`');
        DB::unprepared($sql);

        $rows = DB::table('items_import')->orderBy('id')->get();
        $imported = 0;

        foreach ($rows as $row) {
            $descriptionTranslations = $this->decodeJson($row->description);
            $descriptionIt = $descriptionTranslations['it'] ?? null;
            $descriptionEn = $descriptionTranslations['en'] ?? null;
            $description = $descriptionIt ?: $descriptionEn ?: $row->description;
            $summary = Str::of((string) $description)->stripTags()->squish()->limit(500)->toString();

            SaleProperty::query()->updateOrCreate(
                ['source_item_id' => $row->id],
                [
                    'title' => $row->name,
                    'slug' => $row->slug ?: Str::slug($row->name . '-' . $row->id),
                    'location' => $this->locationFromAddress($row->address),
                    'address' => $row->address,
                    'orientation' => $row->orientation,
                    'latitude' => $row->latitude,
                    'longitude' => $row->longitude,
                    'description_short' => $summary,
                    'description_long' => $description,
                    'description_translations' => $descriptionTranslations ?: null,
                    'bathrooms' => $row->bathrooms,
                    'rooms' => $row->rooms,
                    'surface_commercial' => $row->surface_commercial,
                    'surface_residential' => $row->surface_residential,
                    'surface_balcony' => $row->surface_balcony,
                    'garden_surface' => $row->garden_surface,
                    'surface_common_parts' => $row->surface_common_parts ?? null,
                    'thousandths' => $row->thousandths ?? null,
                    'floor' => $row->floor,
                    'construction_year' => $row->construction_year,
                    'energy_class' => $row->energy_class,
                    'condition' => $row->condition,
                    'balcony' => $row->balcony,
                    'has_parking' => (bool) $row->has_parking,
                    'has_garage' => (bool) $row->has_garage,
                    'has_pool' => (bool) $row->has_pool,
                    'has_spa' => (bool) $row->has_spa,
                    'has_park' => (bool) $row->has_park,
                    'parking_spaces' => $row->parking_spaces,
                    'other_amenities' => $row->other_amenities,
                    'annual_fee' => $row->annual_fee,
                    'monthly_expenses' => $row->monthly_expenses,
                    'imu_tax' => $row->imu_tax,
                    'contact_name' => $row->contact_name,
                    'contact_phone' => $row->contact_phone,
                    'pdf_files' => $this->normalizeFiles($row->pdf_files),
                    'videos' => $this->decodeJson($row->videos) ?: null,
                    'nearby' => $row->nearby,
                    'external_link' => $row->link,
                    'category_id' => $row->category_id,
                    'status' => $row->status ?: 'draft',
                    'property_type' => $row->property_type,
                    'price' => $row->price !== null ? (int) round((float) $row->price) : null,
                    'negotiable' => (bool) $row->negotiable,
                    'active' => $row->status === 'publish',
                    'sort_order' => $row->id,
                    'created_at' => $row->created_at,
                    'updated_at' => $row->updated_at,
                ]
            );

            $imported++;
        }

        if (!$this->option('keep-temp')) {
            DB::statement('DROP TABLE IF EXISTS `items_import`');
        }

        $this->info("Import completato: {$imported} immobili importati/aggiornati.");

        return self::SUCCESS;
    }

    private function rewriteDumpForTemporaryTable(string $sql): string
    {
        return str_replace(
            ['`items`', 'items_category_id_foreign'],
            ['`items_import`', 'items_import_category_id_foreign'],
            $sql
        );
    }

    private function decodeJson(?string $value): ?array
    {
        if (!$value) {
            return null;
        }

        $decoded = json_decode($value, true);

        return is_array($decoded) ? $decoded : null;
    }

    private function normalizeFiles(?string $value): ?array
    {
        $decoded = $this->decodeJson($value);
        if (!$decoded) {
            return null;
        }

        return array_values(array_filter($decoded, fn ($item) => is_array($item) && !empty($item['path'])));
    }

    private function locationFromAddress(?string $address): ?string
    {
        if (!$address) {
            return null;
        }

        if (preg_match('/-\s*([^,]+)$/', $address, $matches)) {
            return trim($matches[1]);
        }

        return $address;
    }
}
