<?php

namespace Database\Seeders;

use App\Models\SaleProperty;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SalePropertySeeder extends Seeder
{
    public function run(): void
    {
        // Placeholder: dati reali da inserire da admin.
        $rows = [
            [
                'title' => 'Immobile demo',
                'location' => 'Italia',
                'price' => 0,
                'description_short' => 'Scheda di esempio per avviare la sezione vendite.',
                'description_long' => null,
                'sort_order' => 10,
                'active' => false,
            ],
        ];

        foreach ($rows as $row) {
            SaleProperty::updateOrCreate(
                ['title' => $row['title']],
                array_merge($row, ['slug' => Str::slug($row['title'])])
            );
        }
    }
}
