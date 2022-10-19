<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Language::firstOrCreate([
            'locale' => 'en_US',
            'prefix' => 'en'
        ]);

        Language::firstOrCreate([
            'locale' => 'ru_RU',
            'prefix' => 'ru'
        ]);

        Language::firstOrCreate([
            'locale' => 'uk_UA',
            'prefix' => 'ua'
        ]);
    }
}
