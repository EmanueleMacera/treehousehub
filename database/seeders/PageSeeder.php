<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        Page::updateOrCreate(
            ['key' => 'about'],
            ['title' => 'Chi siamo', 'content' => null]
        );

        Page::updateOrCreate(
            ['key' => 'owners'],
            ['title' => 'Diventa proprietario', 'content' => null]
        );
    }
}
