<?php

namespace Branzia\Tax\Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Branzia\Shop\Models\TaxClass;
class TaxClassSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $defaultClasses = [
            ['name' => 'Taxable Goods', 'type' => 'product'],
            ['name' => 'Refund Adjustments', 'type' => 'product'],
            ['name' => 'Gift Options', 'type' => 'product'],
            ['name' => 'Order Gift Wrapping', 'type' => 'order'],
            ['name' => 'Item Gift Wrapping', 'type' => 'product'],
            ['name' => 'Printed Gift Card', 'type' => 'product'],
            ['name' => 'Reward Points', 'type' => 'product'],
            ['name' => 'Shipping', 'type' => 'shipping'],
        ];

        foreach ($defaultClasses as $class) {
            TaxClass::firstOrCreate(
                ['name' => $class['name']],
                ['type' => $class['type']]
            );
        }
    }
}
