<?php

namespace Database\Seeders;

use App\Models\Structure;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class StructureSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            [
                'name' => 'Borgo Fantino',
                'location' => null,
                'description_short' => null,
                'description_long' => null,
                'external_url' => 'https://www.borgofantino.it/',
                'sort_order' => 10,
                'active' => true,
            ],
            [
                'name' => 'Colletta di Castelbianco',
                'location' => null,
                'description_short' => null,
                'description_long' => null,
                'external_url' => 'https://www.colletta.it/',
                'sort_order' => 20,
                'active' => true,
            ],
            [
                'name' => 'Dominio Mare Bergeggi',
                'location' => null,
                'description_short' => null,
                'description_long' => null,
                'external_url' => 'https://www.dominiomarebergeggi.it/',
                'sort_order' => 30,
                'active' => true,
            ],
            [
                'name' => 'Castello Borelli',
                'location' => null,
                'description_short' => null,
                'description_long' => null,
                'external_url' => 'https://www.castelloborelli.com/il-castello',
                'sort_order' => 40,
                'active' => true,
            ],
        ];

        foreach ($rows as $row) {
            Structure::updateOrCreate(
                ['name' => $row['name']],
                array_merge($row, ['slug' => Str::slug($row['name'])])
            );
        }
    }
}
