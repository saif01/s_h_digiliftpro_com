<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductFiltersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = ['PowerTech', 'EnergyMax', 'VoltPro', 'SafeGuard', 'IndustrialPower', 'TechForce', 'ElitePower'];
        $features = ['wireless', 'waterproof', 'bluetooth', 'rechargeable', 'warranty', 'eco_friendly'];
        
        $this->command->info('Updating products with filter data...');
        
        $count = 0;
        Product::chunk(50, function ($products) use ($brands, $features, &$count) {
            foreach ($products as $product) {
                // Skip if already has brand (already updated)
                if (!empty($product->brand)) {
                    continue;
                }
                
                // Randomly assign brand
                $product->brand = $brands[array_rand($brands)];
                
                // Calculate availability based on stock
                if (is_null($product->stock)) {
                    $product->stock = rand(0, 100);
                }
                
                if ($product->stock > 20) {
                    $product->availability = 'in_stock';
                } elseif ($product->stock > 0) {
                    $product->availability = 'in_stock';
                } elseif (rand(0, 1)) {
                    $product->availability = 'pre_order';
                } else {
                    $product->availability = rand(0, 1) ? 'out_of_stock' : 'coming_soon';
                }
                
                // Random rating between 3.0 and 5.0
                $product->rating = rand(30, 50) / 10;
                $product->rating_count = rand(5, 150);
                
                // Random features (2-4 features per product)
                $numFeatures = rand(2, 4);
                $selectedFeatures = array_rand(array_flip($features), $numFeatures);
                $product->features = is_array($selectedFeatures) ? array_values($selectedFeatures) : [$selectedFeatures];
                
                // Random discount (30% chance of having a discount)
                if (rand(0, 100) < 30 && !is_null($product->price) && $product->price > 0) {
                    $discounts = [10, 15, 20, 25, 30, 35, 40, 50];
                    $product->discount_percent = $discounts[array_rand($discounts)];
                    $product->discounted_price = round($product->price * (1 - $product->discount_percent / 100), 2);
                } else {
                    $product->discount_percent = 0;
                    $product->discounted_price = null;
                }
                
                $product->save();
                $count++;
            }
        });
        
        $this->command->info("✅ Successfully updated {$count} products with filter data!");
        $this->command->newLine();
        $this->command->info("Filter data added:");
        $this->command->line("  • Brands: " . implode(', ', $brands));
        $this->command->line("  • Features: " . implode(', ', $features));
        $this->command->line("  • Ratings: 3.0 - 5.0 stars");
        $this->command->line("  • Discounts: 0% - 50% (30% of products have discounts)");
        $this->command->line("  • Availability: Based on stock levels");
    }
}

