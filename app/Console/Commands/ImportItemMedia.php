<?php

namespace App\Console\Commands;

use App\Models\SaleProperty;
use App\Models\SalePropertyMedia;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ImportItemMedia extends Command
{
    protected $signature = 'sales:import-item-media
        {--sql= : Percorso opzionale del dump item_media.sql}
        {--copy-from= : Cartella sorgente che contiene item_media oppure la cartella item_media stessa}
        {--keep-temp : Non elimina la tabella temporanea item_media_import}';

    protected $description = 'Importa media/foto delle vendite e opzionalmente copia i file in storage/app/public.';

    public function handle(): int
    {
        if ($sqlPath = $this->option('sql')) {
            $this->importSql((string) $sqlPath);
            $sourceTable = 'item_media_import';
        } else {
            $sourceTable = SchemaHelper::tableExists('item_media') ? 'item_media' : null;
        }

        if (!$sourceTable) {
            $this->error('Tabella item_media non trovata. Importala da phpMyAdmin oppure usa --sql="C:\\path\\item_media.sql".');
            return self::FAILURE;
        }

        $properties = SaleProperty::query()
            ->whereNotNull('source_item_id')
            ->pluck('id', 'source_item_id');

        $rows = DB::table($sourceTable)->orderBy('item_id')->orderBy('sort_order')->get();
        $imported = 0;
        $skipped = 0;

        foreach ($rows as $row) {
            $salePropertyId = $properties[$row->item_id] ?? null;
            if (!$salePropertyId) {
                $skipped++;
                continue;
            }

            SalePropertyMedia::query()->updateOrCreate(
                ['source_media_id' => $row->id],
                [
                    'sale_property_id' => $salePropertyId,
                    'type' => $row->type,
                    'sort_order' => $row->sort_order,
                    'path' => $row->path,
                    'created_at' => $row->created_at,
                    'updated_at' => $row->updated_at,
                ]
            );

            $imported++;
        }

        if ($copyFrom = $this->option('copy-from')) {
            $this->copyMediaFiles((string) $copyFrom);
        }

        if ($sourceTable === 'item_media_import' && !$this->option('keep-temp')) {
            DB::statement('DROP TABLE IF EXISTS `item_media_import`');
        }

        $this->info("Media importati/aggiornati: {$imported}. Saltati senza immobile collegato: {$skipped}.");

        return self::SUCCESS;
    }

    private function importSql(string $path): void
    {
        if (!is_file($path)) {
            throw new \RuntimeException("File non trovato: {$path}");
        }

        $sql = file_get_contents($path);
        if ($sql === false || trim($sql) === '') {
            throw new \RuntimeException('Il file SQL dei media e vuoto o non leggibile.');
        }

        $sql = str_replace(
            ['`item_media`', 'foto_rentals_rental_id_foreign'],
            ['`item_media_import`', 'item_media_import_item_id_index'],
            $sql
        );

        DB::statement('DROP TABLE IF EXISTS `item_media_import`');
        DB::unprepared($sql);
    }

    private function copyMediaFiles(string $source): void
    {
        $source = rtrim($source, DIRECTORY_SEPARATOR);
        $mediaSource = basename($source) === 'item_media'
            ? $source
            : $source . DIRECTORY_SEPARATOR . 'item_media';

        if (!is_dir($mediaSource)) {
            $this->warn("Cartella foto non trovata: {$mediaSource}");
            return;
        }

        $destination = storage_path('app/public/item_media');
        File::ensureDirectoryExists($destination);
        File::copyDirectory($mediaSource, $destination);

        $this->info("Foto copiate in: {$destination}");
    }
}

final class SchemaHelper
{
    public static function tableExists(string $table): bool
    {
        return DB::selectOne('SELECT COUNT(*) AS exists_count FROM information_schema.tables WHERE table_schema = DATABASE() AND table_name = ?', [$table])->exists_count > 0;
    }
}
