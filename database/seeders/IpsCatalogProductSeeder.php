<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;

class IpsCatalogProductSeeder extends Seeder
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
        
        // Get or create the IPS Systems category
        $ipsCategory = Category::firstOrCreate(
            ['slug' => 'ips-systems', 'type' => 'product'],
            [
                'name' => 'IPS Systems',
                'slug' => 'ips-systems',
                'type' => 'product',
                'published' => true,
                'order' => 2
            ]
        );

        // Define IPS (Interactive Power Supply) models
        $models = [
            ['model' => 'IPS-1K', 'capacity' => '1KVA'],
            ['model' => 'IPS-2K', 'capacity' => '2KVA'],
            ['model' => 'IPS-3K', 'capacity' => '3KVA'],
            ['model' => 'IPS-5K', 'capacity' => '5KVA'],
            ['model' => 'IPS-6K', 'capacity' => '6KVA'],
            ['model' => 'IPS-10K', 'capacity' => '10KVA'],
            ['model' => 'IPS-15K', 'capacity' => '15KVA'],
            ['model' => 'IPS-20K', 'capacity' => '20KVA'],
        ];

        // Common specifications for IPS systems
        $commonSpecs = [
            'Technology' => 'Interactive Power Supply (IPS) technology',
            'AC Input Voltage' => '220V AC ±20%',
            'AC Input Frequency' => '50/60 Hz ±3 Hz',
            'Battery Type' => 'Sealed lead acid battery, Maintenance free',
            'Battery Charging Time' => 'About 8-10 hours after fully discharged',
            'Protection' => 'Surge protection, Overload protection, Short circuit protection, Battery low protection, Over voltage protection, Under voltage protection',
            'AC Output Voltage' => '220V AC (±5% adjustable)',
            'AC Output Frequency' => '50/60 Hz',
            'Voltage Regulation' => '±3%',
            'Transfer Time' => '<4 ms',
            'Wave Form' => 'Pure sine wave',
            'Efficiency' => '>85%',
            'Power Factor' => '0.7 ~ 1 (Lagging)',
            'Operating Temperature' => '0°C - 40°C',
            'Operating Humidity' => '20% - 90% (Non condensing)',
            'Noise Level' => '<50 dBA at 1m distance',
            'LED Indicators' => 'Line input (green), Battery mode (yellow), Fault (red), Overload (red)',
            'Battery Discharge Alarm' => 'Audible alarm when battery is low',
            'Display' => 'LCD Display (on select models)',
            'Back-up Time' => 'Varies based on load and battery capacity',
        ];

        foreach ($models as $index => $modelData) {
            $model = $modelData['model'];
            $capacity = $modelData['capacity'];
            $slug = Str::slug(strtolower($model) . '-ips');

            $product = Product::updateOrCreate(
                ['slug' => $slug],
                [
                    'title' => "IPS System {$model} ({$capacity})",
                    'slug' => $slug,
                    'sku' => $model,
                    'short_description' => "Interactive Power Supply (IPS) system with {$capacity} capacity. Features fast transfer time, voltage regulation, and reliable battery backup for small to medium applications.",
                    'description' => $this->generateDescription($model, $capacity, $commonSpecs),
                    'price' => null,
                    'price_range' => 'Contact for pricing',
                    'show_price' => false,
                    'specifications' => $this->generateSpecifications($model, $capacity, $commonSpecs),
                    'downloads' => [
                        [
                            'name' => 'IPS Catalog',
                            'url' => '/Product Report/IPS Catalog.pdf',
                            'type' => 'pdf'
                        ]
                    ],
                    'meta_title' => "IPS System {$model} ({$capacity}) - Micro Control Technology",
                    'meta_description' => "Interactive Power Supply (IPS) system {$model} with {$capacity} capacity. Fast transfer time, voltage regulation, battery backup. Ideal for small to medium business applications.",
                    'meta_keywords' => "ips, interactive power supply, {$model}, {$capacity}, ups system, battery backup, voltage regulation, Micro Control Technology",
                    'published' => true,
                    'featured' => $index < 3,
                    'order' => $index + 1,
                    'created_by' => $defaultUserId,
                    'updated_by' => $defaultUserId,
                ]
            );

            // Attach to IPS Systems category
            $product->categories()->syncWithoutDetaching([$ipsCategory->id]);
        }
    }

    /**
     * Generate detailed description for the product
     */
    private function generateDescription($model, $capacity, $specs): string
    {
        return "<h2>IPS System {$model} - {$capacity}</h2>
        <p>Interactive Power Supply (IPS) system designed for small to medium business applications, providing reliable power protection and battery backup with fast transfer time.</p>
        
        <h3>Key Features:</h3>
        <ul>
            <li><strong>Technology:</strong> {$specs['Technology']}</li>
            <li><strong>Fast Transfer Time:</strong> {$specs['Transfer Time']}</li>
            <li><strong>Voltage Regulation:</strong> {$specs['Voltage Regulation']}</li>
            <li><strong>Surge Protection:</strong> {$specs['Protection']}</li>
            <li><strong>Pure Sine Wave:</strong> {$specs['Wave Form']}</li>
            <li><strong>High Efficiency:</strong> {$specs['Efficiency']}</li>
            <li><strong>LED Indicators:</strong> {$specs['LED Indicators']}</li>
        </ul>

        <h3>Applications:</h3>
        <ul>
            <li>Small to medium business offices</li>
            <li>Workstations and servers</li>
            <li>Network equipment</li>
            <li>Point of sale systems</li>
            <li>Security systems</li>
            <li>Telecommunications equipment</li>
        </ul>

        <h3>Technical Specifications:</h3>
        <ul>
            <li><strong>AC Input:</strong> {$specs['AC Input Voltage']}, {$specs['AC Input Frequency']}</li>
            <li><strong>AC Output:</strong> {$specs['AC Output Voltage']}, {$specs['AC Output Frequency']}</li>
            <li><strong>Voltage Regulation:</strong> {$specs['Voltage Regulation']}</li>
            <li><strong>Power Factor:</strong> {$specs['Power Factor']}</li>
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
                'Frequency' => $specs['AC Output Frequency'],
                'Voltage Regulation' => $specs['Voltage Regulation']
            ],
            'Battery' => [
                'Type' => $specs['Battery Type'],
                'Charging Time' => $specs['Battery Charging Time']
            ],
            'Protection' => $specs['Protection'],
            'Efficiency' => $specs['Efficiency'],
            'Transfer Time' => $specs['Transfer Time'],
            'Wave Form' => $specs['Wave Form'],
            'Power Factor' => $specs['Power Factor'],
            'Indicators' => $specs['LED Indicators'],
            'Alarms' => [
                'Battery Discharge' => $specs['Battery Discharge Alarm']
            ],
            'Operating Environment' => [
                'Temperature' => $specs['Operating Temperature'],
                'Humidity' => $specs['Operating Humidity']
            ],
            'Noise Level' => $specs['Noise Level'],
            'Display' => $specs['Display'],
            'Back-up Time' => $specs['Back-up Time']
        ];
    }
}

