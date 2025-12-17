<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Module;

class ModuleSeeder extends Seeder
{
    public function run(): void
    {
        $modules = [
            ['name' => 'services', 'label' => 'Services', 'description' => 'Service catalog module', 'enabled' => false, 'order' => 1],
            ['name' => 'products', 'label' => 'Products', 'description' => 'Product catalog module', 'enabled' => false, 'order' => 2],
            ['name' => 'portfolio', 'label' => 'Portfolio', 'description' => 'Portfolio/Projects module', 'enabled' => false, 'order' => 3],
            ['name' => 'blog', 'label' => 'Blog', 'description' => 'Blog/News module', 'enabled' => false, 'order' => 4],
            ['name' => 'faq', 'label' => 'FAQ', 'description' => 'FAQ module', 'enabled' => false, 'order' => 5],
            ['name' => 'careers', 'label' => 'Careers', 'description' => 'Careers/Recruitment module', 'enabled' => false, 'order' => 6],
            ['name' => 'booking', 'label' => 'Booking', 'description' => 'Appointment booking module', 'enabled' => false, 'order' => 7],
            ['name' => 'events', 'label' => 'Events', 'description' => 'Events & Registration module', 'enabled' => false, 'order' => 8],
            ['name' => 'branches', 'label' => 'Branches', 'description' => 'Multi-location/Branches module', 'enabled' => false, 'order' => 9],
            ['name' => 'ecommerce', 'label' => 'E-commerce', 'description' => 'E-commerce module', 'enabled' => false, 'order' => 10],
            ['name' => 'multilanguage', 'label' => 'Multi-language', 'description' => 'Multi-language support module', 'enabled' => false, 'order' => 11],
        ];

        foreach ($modules as $module) {
            Module::updateOrCreate(
                ['name' => $module['name']],
                $module
            );
        }
    }
}
