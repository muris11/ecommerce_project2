<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class SetDefaultProductWeightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('🔍 Checking products without weight...');
        
        // Count products without weight
        $count = Product::where(function($query) {
            $query->whereNull('weight')
                  ->orWhere('weight', 0);
        })->count();
        
        if ($count === 0) {
            $this->command->info('✅ All products already have weight set!');
            return;
        }
        
        $this->command->warn("⚠️  Found {$count} products without weight.");
        $this->command->info('⚙️  Setting default weight to 1000 grams (1 kg)...');
        
        // Set default weight 1000 gram (1kg) untuk produk yang belum punya weight
        Product::where(function($query) {
            $query->whereNull('weight')
                  ->orWhere('weight', 0);
        })->update([
            'weight' => 1000
        ]);
        
        $this->command->info('✅ Default weight (1000g) telah diset untuk ' . $count . ' produk!');
        $this->command->newLine();
        $this->command->warn('💡 Tips:');
        $this->command->line('   - Login ke Admin Panel untuk edit weight yang lebih akurat');
        $this->command->line('   - Berat dalam satuan GRAM (1000 = 1kg)');
        $this->command->line('   - Contoh: Beras 5kg = 5000 gram');
        $this->command->newLine();
    }
}
