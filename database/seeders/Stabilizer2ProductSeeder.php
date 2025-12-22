<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;

class Stabilizer2ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get first admin user or first user for created_by/updated_by
        $admin = \App\Models\User::whereHas('roles', function ($q) {
            $q->where('slug', 'administrator');
        })->first();
        $defaultUserId = $admin?->id ?? \App\Models\User::first()?->id;
        
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

        // Define Voltage Stabilizer models from Catalog 2 (higher capacity models)
        $models = [
            ['model' => 'STB-15000', 'capacity' => '15KVA'],
            ['model' => 'STB-20000', 'capacity' => '20KVA'],
            ['model' => 'STB-25000', 'capacity' => '25KVA'],
            ['model' => 'STB-30000', 'capacity' => '30KVA'],
            ['model' => 'STB-40000', 'capacity' => '40KVA'],
            ['model' => 'STB-50000', 'capacity' => '50KVA'],
            ['model' => 'STB-75000', 'capacity' => '75KVA'],
            ['model' => 'STB-100000', 'capacity' => '100KVA'],
        ];

        // Common specifications for high-capacity Voltage Stabilizers
        $commonSpecs = [
            'Technology' => 'Servo motor controlled voltage stabilizer',
            'Input Voltage Range' => '140V - 260V AC (Single phase) / 380V AC ±20% (Three phase)',
            'Output Voltage' => '220V AC ±3% (Single phase) / 380V AC ±3% (Three phase)',
            'Input Frequency' => '50/60 Hz',
            'Output Frequency' => '50/60 Hz',
            'Voltage Regulation' => '±3%',
            'Response Time' => '<0.5 seconds',
            'Efficiency' => '>96%',
            'Power Factor' => '0.8 ~ 1 (Lagging)',
            'Protection' => 'Over voltage protection, Under voltage protection, Overload protection, Short circuit protection, Thermal protection, Phase failure protection (for three phase models)',
            'Operating Temperature' => '0°C - 45°C',
            'Operating Humidity' => '20% - 90% (Non condensing)',
            'Noise Level' => '<45 dBA at 1m distance',
            'LED Indicators' => 'Input voltage (green), Output voltage (green), Overload (red), Fault (red), Phase status (for three phase models)',
            'Display' => 'Digital voltage display with advanced monitoring',
            'Cooling' => 'Forced air cooling with temperature control',
            'Mounting' => 'Floor mounting / Wall mounting options available',
        ];

        foreach ($models as $index => $modelData) {
            $model = $modelData['model'];
            $capacity = $modelData['capacity'];
            $slug = Str::slug(strtolower($model) . '-stabilizer-catalog2');

            $product = Product::updateOrCreate(
                ['slug' => $slug],
                [
                    'title' => "Voltage Stabilizer {$model} ({$capacity})",
                    'slug' => $slug,
                    'sku' => $model,
                    'short_description' => "High-capacity servo motor controlled voltage stabilizer with {$capacity} capacity. Features fast response time, high efficiency, and comprehensive protection for industrial and commercial applications.",
                    'description' => $this->generateDescription($model, $capacity, $commonSpecs),
                    'price' => null,
                    'price_range' => 'Contact for pricing',
                    'show_price' => false,
                    'specifications' => $this->generateSpecifications($model, $capacity, $commonSpecs),
                    'downloads' => [
                        [
                            'name' => 'Stabilizer Catalog 2',
                            'url' => '/Product Report/Stabilizer2.pdf',
                            'type' => 'pdf'
                        ]
                    ],
                    'meta_title' => "Voltage Stabilizer {$model} ({$capacity}) - Micro Control Technology",
                    'meta_description' => "High-capacity servo motor controlled voltage stabilizer {$model} with {$capacity} capacity. Fast response time, high efficiency, comprehensive protection. Ideal for industrial and commercial applications.",
                    'meta_keywords' => "voltage stabilizer, {$model}, {$capacity}, servo motor, voltage regulation, industrial stabilizer, power protection, Micro Control Technology",
                    'published' => true,
                    'featured' => $index < 3,
                    'order' => $index + 1,
                    'created_by' => $defaultUserId,
                    'updated_by' => $defaultUserId,
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
        <p>High-capacity servo motor controlled voltage stabilizer designed for industrial and commercial applications, providing stable and regulated power supply for large-scale operations.</p>
        
        <h3>Key Features:</h3>
        <ul>
            <li><strong>Technology:</strong> {$specs['Technology']}</li>
            <li><strong>Fast Response Time:</strong> {$specs['Response Time']}</li>
            <li><strong>High Efficiency:</strong> {$specs['Efficiency']}</li>
            <li><strong>Wide Input Range:</strong> {$specs['Input Voltage Range']}</li>
            <li><strong>Stable Output:</strong> {$specs['Output Voltage']}</li>
            <li><strong>Comprehensive Protection:</strong> {$specs['Protection']}</li>
            <li><strong>Advanced Display:</strong> {$specs['Display']}</li>
            <li><strong>Forced Air Cooling:</strong> {$specs['Cooling']}</li>
        </ul>

        <h3>Applications:</h3>
        <ul>
            <li>Industrial manufacturing facilities</li>
            <li>Commercial buildings and offices</li>
            <li>Data centers and server rooms</li>
            <li>Hospitals and medical facilities</li>
            <li>Telecommunications facilities</li>
            <li>Large-scale industrial equipment</li>
            <li>Three-phase motor applications</li>
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
            <li><strong>Mounting:</strong> {$specs['Mounting']}</li>
        </ul>

        <p><strong>Note:</strong> Actual specifications may vary. Three-phase models available for higher capacity requirements. For detailed information and custom configurations, please contact Micro Control Technology.</p>";
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
            'Cooling' => $specs['Cooling'],
            'Mounting' => $specs['Mounting']
        ];
    }
}

