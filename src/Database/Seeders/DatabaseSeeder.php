<?php

namespace Branzia\Tax\Database\Seeders;

use Illuminate\Database\Seeder;
use Branzia\Tax\Database\Seeders\TaxClassSeeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            TaxClassSeeder::class,
        ]);
    }
}
