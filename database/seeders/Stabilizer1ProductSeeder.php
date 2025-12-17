<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;

class Stabilizer1ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get or create the Voltage Stabilizers category
        $stabilizerCategory = Category::firstOrCreate(
            ['slug' => 'voltage-stabilizers', 'type' => 'product'],
            [
                'name' => 'Voltage Stabilizers',
                'slug' => 'voltage-stabilizers',
                'type' => 'product',
                'published' => true,
                'order' => 3
            ]
        );

        // Define Voltage Stabilizer models from Catalog 1
        $models = [
            ['model' => 'STB-500', 'capacity' => '500VA'],
            ['model' => 'STB-1000', 'capacity' => '1000VA'],
            ['model' => 'STB-2000', 'capacity' => '2000VA'],
            ['model' => 'STB-3000', 'capacity' => '3000VA'],
            ['model' => 'STB-5000', 'capacity' => '5000VA'],
            ['model' => 'STB-7500', 'capacity' => '7500VA'],
            ['model' => 'STB-10000', 'capacity' => '10000VA'],
        ];

        // Common specifications for Voltage Stabilizers
        $commonSpecs = [
            'Technology' => 'Servo motor controlled voltage stabilizer',
            'Input Voltage Range' => '140V - 260V AC',
            'Output Voltage' => '220V AC ±3%',
            'Input Frequency' => '50/60 Hz',
            'Output Frequency' => '50/60 Hz',
            'Voltage Regulation' => '±3%',
            'Response Time' => '<0.5 seconds',
            'Efficiency' => '>95%',
            'Power Factor' => '0.8 ~ 1 (Lagging)',
            'Protection' => 'Over voltage protection, Under voltage protection, Overload protection, Short circuit protection, Thermal protection',
            'Operating Temperature' => '0°C - 45°C',
            'Operating Humidity' => '20% - 90% (Non condensing)',
            'Noise Level' => '<40 dBA at 1m distance',
            'LED Indicators' => 'Input voltage (green), Output voltage (green), Overload (red), Fault (red)',
            'Display' => 'Digital voltage display (on select models)',
            'Cooling' => 'Natural air cooling / Forced air cooling (on higher capacity models)',
        ];

        foreach ($models as $index => $modelData) {
            $model = $modelData['model'];
            $capacity = $modelData['capacity'];
            $slug = Str::slug(strtolower($model) . '-stabilizer');

            $product = Product::updateOrCreate(
                ['slug' => $slug],
                [
                    'title' => "Voltage Stabilizer {$model} ({$capacity})",
                    'slug' => $slug,
                    'sku' => $model,
                    'short_description' => "Servo motor controlled voltage stabilizer with {$capacity} capacity. Features fast response time, high efficiency, and comprehensive protection for sensitive equipment.",
                    'description' => $this->generateDescription($model, $capacity, $commonSpecs),
                    'price' => null,
                    'price_range' => 'Contact for pricing',
                    'show_price' => false,
                    'specifications' => $this->generateSpecifications($model, $capacity, $commonSpecs),
                    'downloads' => [
                        [
                            'name' => 'Stabilizer Catalog 1',
                            'url' => '/Product Report/Stabilizer1.pdf',
                            'type' => 'pdf'
                        ]
                    ],
                    'meta_title' => "Voltage Stabilizer {$model} ({$capacity}) - Micro Control Technology",
                    'meta_description' => "Servo motor controlled voltage stabilizer {$model} with {$capacity} capacity. Fast response time, high efficiency, comprehensive protection. Ideal for protecting sensitive electronic equipment.",
                    'meta_keywords' => "voltage stabilizer, {$model}, {$capacity}, servo motor, voltage regulation, power protection, Micro Control Technology",
                    'published' => true,
                    'featured' => $index < 3,
                    'order' => $index + 1,
                ]
            );

            // Attach to Voltage Stabilizers category
            $product->categories()->syncWithoutDetaching([$stabilizerCategory->id]);
        }
    }

    /**
     * Generate detailed description for the product
     */
    private function generateDescription($model, $capacity, $specs): string
    {
        return "<h2>Voltage Stabilizer {$model} - {$capacity}</h2>
        <p>Servo motor controlled voltage stabilizer designed to protect sensitive electronic equipment from voltage fluctuations, ensuring stable and regulated power supply.</p>
        
        <h3>Key Features:</h3>
        <ul>
            <li><strong>Technology:</strong> {$specs['Technology']}</li>
            <li><strong>Fast Response Time:</strong> {$specs['Response Time']}</li>
            <li><strong>High Efficiency:</strong> {$specs['Efficiency']}</li>
            <li><strong>Wide Input Range:</strong> {$specs['Input Voltage Range']}</li>
            <li><strong>Stable Output:</strong> {$specs['Output Voltage']}</li>
            <li><strong>Comprehensive Protection:</strong> {$specs['Protection']}</li>
            <li><strong>LED Indicators:</strong> {$specs['LED Indicators']}</li>
        </ul>

        <h3>Applications:</h3>
        <ul>
            <li>Home appliances (TV, Refrigerator, AC, etc.)</li>
            <li>Office equipment (Computers, Printers, etc.)</li>
            <li>Industrial equipment</li>
            <li>Medical equipment</li>
            <li>Telecommunications equipment</li>
            <li>Laboratory equipment</li>
        </ul>

        <h3>Technical Specifications:</h3>
        <ul>
            <li><strong>Input Voltage Range:</strong> {$specs['Input Voltage Range']}</li>
            <li><strong>Output Voltage:</strong> {$specs['Output Voltage']}</li>
            <li><strong>Input Frequency:</strong> {$specs['Input Frequency']}</li>
            <li><strong>Output Frequency:</strong> {$specs['Output Frequency']}</li>
            <li><strong>Voltage Regulation:</strong> {$specs['Voltage Regulation']}</li>
            <li><strong>Response Time:</strong> {$specs['Response Time']}</li>
            <li><strong>Efficiency:</strong> {$specs['Efficiency']}</li>
            <li><strong>Power Factor:</strong> {$specs['Power Factor']}</li>
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
            'Input' => [
                'Voltage Range' => $specs['Input Voltage Range'],
                'Frequency' => $specs['Input Frequency']
            ],
            'Output' => [
                'Voltage' => $specs['Output Voltage'],
                'Frequency' => $specs['Output Frequency'],
                'Voltage Regulation' => $specs['Voltage Regulation']
            ],
            'Performance' => [
                'Response Time' => $specs['Response Time'],
                'Efficiency' => $specs['Efficiency'],
                'Power Factor' => $specs['Power Factor']
            ],
            'Protection' => $specs['Protection'],
            'Indicators' => $specs['LED Indicators'],
            'Operating Environment' => [
                'Temperature' => $specs['Operating Temperature'],
                'Humidity' => $specs['Operating Humidity']
            ],
            'Noise Level' => $specs['Noise Level'],
            'Display' => $specs['Display'],
            'Cooling' => $specs['Cooling']
        ];
    }
}

