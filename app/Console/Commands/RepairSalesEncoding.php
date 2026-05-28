<?php

namespace App\Console\Commands;

use App\Models\SaleProperty;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RepairSalesEncoding extends Command
{
    protected $signature = 'sales:repair-encoding {--from-items : Rilegge le descrizioni dalla tabella items importata}';

    protected $description = 'Riscrive le descrizioni vendite preservando Unicode/emoji dove disponibili.';

    public function handle(): int
    {
        if (!$this->option('from-items')) {
            $this->warn('Usa --from-items per rileggerle dalla tabella items.');
            return self::SUCCESS;
        }

        $itemsExists = DB::selectOne('SELECT COUNT(*) AS c FROM information_schema.tables WHERE table_schema = DATABASE() AND table_name = ?', ['items'])->c > 0;
        if (!$itemsExists) {
            $this->error('Tabella items non trovata.');
            return self::FAILURE;
        }

        $rows = DB::table('items')->select(['id', 'description'])->get();
        $updated = 0;

        foreach ($rows as $row) {
            $translations = json_decode($row->description, true);
            if (!is_array($translations)) {
                continue;
            }

            $description = $translations['it'] ?? $translations['en'] ?? null;
            if (!$description) {
                continue;
            }

            $property = SaleProperty::query()->where('source_item_id', $row->id)->first();
            if (!$property) {
                continue;
            }

            $property->update([
                'description_translations' => $translations,
                'description_long' => $description,
                'description_short' => Str::of($description)->stripTags()->squish()->limit(500)->toString(),
            ]);

            $updated++;
        }

        $this->info("Descrizioni aggiornate: {$updated}");

        return self::SUCCESS;
    }
}
