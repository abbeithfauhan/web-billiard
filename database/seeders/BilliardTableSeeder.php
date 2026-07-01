<?php
namespace Database\Seeders;

use App\Models\BilliardTable;
use Illuminate\Database\Seeder;

class BilliardTableSeeder extends Seeder
{
    public function run(): void
    {
        BilliardTable::create(['name' => 'Meja 1', 'type' => 'Regular', 'price_per_hour' => 50000]);
        BilliardTable::create(['name' => 'Meja 2', 'type' => 'Regular', 'price_per_hour' => 50000]);
        BilliardTable::create(['name' => 'Meja 3', 'type' => 'Regular', 'price_per_hour' => 50000]);
        BilliardTable::create(['name' => 'Meja 4', 'type' => 'Regular', 'price_per_hour' => 50000]);
        BilliardTable::create(['name' => 'Meja 5', 'type' => 'VIP', 'price_per_hour' => 80000]);
        BilliardTable::create(['name' => 'Meja 6', 'type' => 'VIP', 'price_per_hour' => 80000, 'is_active' => false]);
    }
}
