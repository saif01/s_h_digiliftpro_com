<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\About;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Only create if it doesn't exist (singleton pattern)
        if (About::count() === 0) {
            About::create([
                'hero' => [
                    'overline' => 'WHO WE ARE',
                    'title' => 'Build Better Digital Systems',
                    'subtitle' => 'We help businesses plan, build, and maintain modern websites and web apps—with SEO, email setup, and web operations support.'
                ],
                'story' => [
                    'overline' => 'OUR STORY',
                    'title' => 'Clear Planning. Measurable Results.',
                    'description' => '<p>digiliftpro helps businesses ship reliable digital products and keep them running. From discovery and design to build, test, deploy, and support—we focus on clarity, performance, and long-term maintainability.</p><p>We deliver websites, web apps, SEO improvements, business email setups (SPF/DKIM/DMARC), and web asset management (domain/hosting/SSL/backups/monitoring).</p>',
                    'image' => null,
                    'stats' => [
                        ['value' => '100+', 'label' => 'Deliveries'],
                        ['value' => '99.9%', 'label' => 'Uptime Focus'],
                        ['value' => '24/7', 'label' => 'Support Options']
                    ]
                ],
                'values_title' => 'Our Core Values',
                'values_subtitle' => 'The principles that guide every project we undertake.',
                'values' => [
                    [
                        'title' => 'Reliability',
                        'description' => 'We ship production-ready systems with monitoring, documentation, and maintainable code.',
                        'icon' => 'mdi-shield-check'
                    ],
                    [
                        'title' => 'Innovation',
                        'description' => 'We use modern stacks and best practices to deliver fast, scalable solutions.',
                        'icon' => 'mdi-lightbulb-on-outline'
                    ],
                    [
                        'title' => 'Customer First',
                        'description' => 'Transparent scope, clear timelines, and support plans that fit your business.',
                        'icon' => 'mdi-account-heart-outline'
                    ]
                ],
                'team_overline' => 'OUR TEAM',
                'team_title' => 'Meet the Experts',
                'team' => [
                    [
                        'name' => 'Project Lead',
                        'role' => 'Planning & Delivery',
                        'image' => 'https://i.pravatar.cc/300?img=11',
                        'linkedin' => null,
                        'twitter' => null
                    ],
                    [
                        'name' => 'Full-Stack Engineer',
                        'role' => 'Web Apps & APIs',
                        'image' => 'https://i.pravatar.cc/300?img=5',
                        'linkedin' => null,
                        'twitter' => null
                    ],
                    [
                        'name' => 'SEO Specialist',
                        'role' => 'Growth & Performance',
                        'image' => 'https://i.pravatar.cc/300?img=3',
                        'linkedin' => null,
                        'twitter' => null
                    ],
                    [
                        'name' => 'Support Engineer',
                        'role' => 'Maintenance & Monitoring',
                        'image' => 'https://i.pravatar.cc/300?img=9',
                        'linkedin' => null,
                        'twitter' => null
                    ]
                ]
            ]);

            $this->command->info('About page default data seeded successfully!');
        } else {
            $this->command->info('About page data already exists. Skipping seed.');
        }
    }
}
