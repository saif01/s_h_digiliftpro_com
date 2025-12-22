<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Facades\Schema;

class CategorySeeder extends Seeder
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

        // Check if categories table has created_by and updated_by columns
        $hasAuditColumns = Schema::hasColumns('categories', ['created_by', 'updated_by']);

        // Service Categories
        $serviceCategories = [
            ['slug' => 'website-web-app-development', 'name' => 'Website & Web App Development', 'order' => 1],
            ['slug' => 'seo-growth-optimization', 'name' => 'SEO & Growth Optimization', 'order' => 2],
            ['slug' => 'maintenance-support', 'name' => 'Maintenance & Support', 'order' => 3],
        ];

        foreach ($serviceCategories as $cat) {
            $data = [
                'name' => $cat['name'],
                'slug' => $cat['slug'],
                'type' => 'service',
                'published' => true,
                'order' => $cat['order'],
            ];

            if ($hasAuditColumns) {
                $data['created_by'] = $defaultUserId;
                $data['updated_by'] = $defaultUserId;
            }

            Category::updateOrCreate(
                ['slug' => $cat['slug'], 'type' => 'service'],
                $data
            );
        }

        // Product Categories
        $productCategories = [
            ['slug' => 'website', 'name' => 'Website', 'order' => 1],
            ['slug' => 'web-app', 'name' => 'Web App', 'order' => 2],
            ['slug' => 'system', 'name' => 'System', 'order' => 3],
            ['slug' => 'crm', 'name' => 'CRM', 'order' => 4],
            ['slug' => 'erp', 'name' => 'ERP', 'order' => 5],
            ['slug' => 'ecommerce', 'name' => 'E-commerce', 'order' => 6],
            ['slug' => 'mobile-app', 'name' => 'Mobile App', 'order' => 7],
            ['slug' => 'dashboard', 'name' => 'Dashboard', 'order' => 8],
            ['slug' => 'api-integration', 'name' => 'API & Integration', 'order' => 9],
            ['slug' => 'seo', 'name' => 'SEO', 'order' => 10],
            ['slug' => 'email', 'name' => 'Email', 'order' => 11],
            ['slug' => 'asset-management', 'name' => 'Asset Management', 'order' => 12],
        ];

        foreach ($productCategories as $cat) {
            $data = [
                'name' => $cat['name'],
                'slug' => $cat['slug'],
                'type' => 'product',
                'published' => true,
                'order' => $cat['order'],
            ];

            if ($hasAuditColumns) {
                $data['created_by'] = $defaultUserId;
                $data['updated_by'] = $defaultUserId;
            }

            Category::updateOrCreate(
                ['slug' => $cat['slug'], 'type' => 'product'],
                $data
            );
        }

        // Post Categories
        $postCategories = [
            ['slug' => 'news', 'name' => 'News', 'order' => 1],
            ['slug' => 'tips', 'name' => 'Tips & Tricks', 'order' => 2],
            ['slug' => 'case-studies', 'name' => 'Case Studies', 'order' => 3],
        ];

        foreach ($postCategories as $cat) {
            $data = [
                'name' => $cat['name'],
                'slug' => $cat['slug'],
                'type' => 'post',
                'published' => true,
                'order' => $cat['order'],
            ];

            if ($hasAuditColumns) {
                $data['created_by'] = $defaultUserId;
                $data['updated_by'] = $defaultUserId;
            }

            Category::updateOrCreate(
                ['slug' => $cat['slug'], 'type' => 'post'],
                $data
            );
        }

        $this->command->info('Categories seeded successfully!');
    }
}

