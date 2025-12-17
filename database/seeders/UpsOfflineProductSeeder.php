<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;

class UpsOfflineProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get or create the UPS Systems category
        $upsCategory = Category::firstOrCreate(
            ['slug' => 'ups-systems', 'type' => 'product'],
            [
                'name' => 'UPS Systems',
                'slug' => 'ups-systems',
                'type' => 'product',
                'published' => true,
                'order' => 1
            ]
        );

        // Define Off-Line UPS models (common models for offline UPS)
        $models = [
            ['model' => 'OLF-500', 'capacity' => '500VA'],
            ['model' => 'OLF-600', 'capacity' => '600VA'],
            ['model' => 'OLF-800', 'capacity' => '800VA'],
            ['model' => 'OLF-1000', 'capacity' => '1000VA'],
            ['model' => 'OLF-1500', 'capacity' => '1500VA'],
            ['model' => 'OLF-2000', 'capacity' => '2000VA'],
            ['model' => 'OLF-3000', 'capacity' => '3000VA'],
        ];

        // Common specifications for Off-Line UPS
        $commonSpecs = [
            'Technology' => 'Off-Line UPS technology',
            'AC Input Voltage' => '220V AC ±20%',
            'AC Input Frequency' => '50/60 Hz ±3 Hz',
            'Battery Type' => 'Sealed lead acid battery, Maintenance free',
            'Battery Charging Time' => 'About 8-10 hours after fully discharged',
            'Protection' => 'Surge protection, Overload protection, Short circuit protection, Battery low protection',
            'AC Output Voltage' => '220V AC (±5% adjustable)',
            'AC Output Frequency' => '50/60 Hz',
            'Transfer Time' => '<10 ms',
            'Wave Form' => 'Modified sine wave / Pure sine wave',
            'Efficiency' => '>80%',
            'Operating Temperature' => '0°C - 40°C',
            'Operating Humidity' => '20% - 90% (Non condensing)',
            'Noise Level' => '<45 dBA at 1m distance',
            'LED Indicators' => 'Line input (green), Battery mode (yellow), Fault (red)',
            'Battery Discharge Alarm' => 'Audible alarm when battery is low',
            'Back-up Time' => 'Varies based on load and battery capacity',
        ];

        foreach ($models as $index => $modelData) {
            $model = $modelData['model'];
            $capacity = $modelData['capacity'];
            $slug = Str::slug(strtolower($model) . '-offline-ups');

            $product = Product::updateOrCreate(
                ['slug' => $slug],
                [
                    'title' => "Off-Line UPS {$model} ({$capacity})",
                    'slug' => $slug,
                    'sku' => $model,
                    'short_description' => "Reliable Off-Line UPS system with {$capacity} capacity. Features fast transfer time, surge protection, and battery backup for home and office applications.",
                    'description' => $this->generateDescription($model, $capacity, $commonSpecs),
                    'price' => null,
                    'price_range' => 'Contact for pricing',
                    'show_price' => false,
                    'specifications' => $this->generateSpecifications($model, $capacity, $commonSpecs),
                    'downloads' => [
                        [
                            'name' => 'UPS Off Line Catalog',
                            'url' => '/Product Report/UPS Off Line.pdf',
                            'type' => 'pdf'
                        ]
                    ],
                    'meta_title' => "Off-Line UPS {$model} ({$capacity}) - Micro Control Technology",
                    'meta_description' => "Reliable Off-Line UPS system {$model} with {$capacity} capacity. Fast transfer time, surge protection, battery backup. Ideal for home and office use.",
                    'meta_keywords' => "offline ups, {$model}, {$capacity}, ups system, battery backup, surge protection, Micro Control Technology",
                    'published' => true,
                    'featured' => $index < 3,
                    'order' => $index + 1,
                ]
            );

            // Attach to UPS Systems category
            $product->categories()->syncWithoutDetaching([$upsCategory->id]);
        }
    }

    /**
     * Generate detailed description for the product
     */
    private function generateDescription($model, $capacity, $specs): string
    {
        return "<h2>Off-Line UPS {$model} - {$capacity}</h2>
        <p>Reliable Off-Line UPS system designed for home and office applications, providing essential power protection and battery backup during power outages.</p>
        
        <h3>Key Features:</h3>
        <ul>
            <li><strong>Technology:</strong> {$specs['Technology']}</li>
            <li><strong>Fast Transfer Time:</strong> {$specs['Transfer Time']}</li>
            <li><strong>Surge Protection:</strong> {$specs['Protection']}</li>
            <li><strong>Wave Form:</strong> {$specs['Wave Form']}</li>
            <li><strong>High Efficiency:</strong> {$specs['Efficiency']}</li>
            <li><strong>LED Indicators:</strong> {$specs['LED Indicators']}</li>
        </ul>

        <h3>Applications:</h3>
        <ul>
            <li>Home computers and workstations</li>
            <li>Small office equipment</li>
            <li>Network devices</li>
            <li>Security systems</li>
            <li>Gaming consoles</li>
        </ul>

        <h3>Technical Specifications:</h3>
        <ul>
            <li><strong>AC Input:</strong> {$specs['AC Input Voltage']}, {$specs['AC Input Frequency']}</li>
            <li><strong>AC Output:</strong> {$specs['AC Output Voltage']}, {$specs['AC Output Frequency']}</li>
            <li><strong>Battery:</strong> {$specs['Battery Type']}</li>
            <li><strong>Charging Time:</strong> {$specs['Battery Charging Time']}</li>
            <li><strong>Operating Environment:</strong> {$specs['Operating Temperature']}, {$specs['Operating Humidity']}</li>
            <li><strong>Noise Level:</strong> {$specs['Noise Level']}</li>
        </ul>

        <p><strong>Note:</strong> Actual specifications may vary. For detailed information and custom configurations, please contact Micro Control Technology.</p>";
    }

    /**
     * Generate specifications array for the product
     */
    private function generateSpecifications($model, $capacity, $specs): array
    {
        return [
            'Model' => $model,
            'Capacity' => $capacity,
            'Technology' => $specs['Technology'],
            'AC Input' => [
                'Voltage' => $specs['AC Input Voltage'],
                'Frequency' => $specs['AC Input Frequency']
            ],
            'AC Output' => [
                'Voltage' => $specs['AC Output Voltage'],
                'Frequency' => $specs['AC Output Frequency']
            ],
            'Battery' => [
                'Type' => $specs['Battery Type'],
                'Charging Time' => $specs['Battery Charging Time']
            ],
            'Protection' => $specs['Protection'],
            'Efficiency' => $specs['Efficiency'],
            'Transfer Time' => $specs['Transfer Time'],
            'Wave Form' => $specs['Wave Form'],
            'Indicators' => $specs['LED Indicators'],
            'Alarms' => [
                'Battery Discharge' => $specs['Battery Discharge Alarm']
            ],
            'Operating Environment' => [
                'Temperature' => $specs['Operating Temperature'],
                'Humidity' => $specs['Operating Humidity']
            ],
            'Noise Level' => $specs['Noise Level'],
            'Back-up Time' => $specs['Back-up Time']
        ];
    }
}

