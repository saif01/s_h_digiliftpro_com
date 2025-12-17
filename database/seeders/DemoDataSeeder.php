<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;
use App\Models\Menu;
use App\Models\Setting;
use App\Models\Service;
use App\Models\BlogPost;
use App\Models\Faq;
use App\Models\Portfolio;
use App\Models\Product;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Lead;
use App\Models\Branch;
use App\Models\Career;
use App\Models\Event;
use App\Models\User;
use App\Models\Module;
use Carbon\Carbon;

class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
        // Seed Settings
        $this->seedSettings();

        // Seed Pages
        $this->seedPages();

        // Seed Menu Items
        $this->seedMenus();

        // Seed Categories and Tags
        $categories = $this->seedCategories();
        $tags = $this->seedTags();

        // Seed Services (if module enabled or we'll enable it)
        Module::where('name', 'services')->update(['enabled' => true]);
        $this->seedServices($categories['service'], $tags['service']);

        // Seed Products (used for "Products & Projects" demo content)
        Module::where('name', 'products')->update(['enabled' => true]);
        $this->seedProducts($categories['product'], $tags['product']);

        // Seed Portfolio
        Module::where('name', 'portfolio')->update(['enabled' => true]);
        $this->seedPortfolio();

        // Seed Blog Posts
        Module::where('name', 'blog')->update(['enabled' => true]);
        $this->seedBlogPosts($categories['post'], $tags['post']);

        // Seed FAQs
        Module::where('name', 'faq')->update(['enabled' => true]);
        $this->seedFaqs();

        // Seed Branches
        Module::where('name', 'branches')->update(['enabled' => true]);
        $this->seedBranches();

        // Seed Careers
        Module::where('name', 'careers')->update(['enabled' => true]);
        $this->seedCareers();

        // Seed Events
        Module::where('name', 'events')->update(['enabled' => true]);
        $this->seedEvents();

        // Seed Sample Leads
        $this->seedLeads();

        $this->command->info('Demo data seeded successfully!');
    }

    private function seedSettings(): void
    {
        $settings = [
            // General (from the Project Report)
            ['key' => 'site_name', 'value' => 'digiliftpro', 'type' => 'text', 'group' => 'general'],
            ['key' => 'site_tagline', 'value' => 'Digital Business Services', 'type' => 'text', 'group' => 'general'],
            ['key' => 'contact_email', 'value' => 'info@digiliftpro.com', 'type' => 'email', 'group' => 'general'],
            ['key' => 'contact_phone', 'value' => '', 'type' => 'text', 'group' => 'general'],
            ['key' => 'whatsapp_number', 'value' => '', 'type' => 'text', 'group' => 'general'],
            ['key' => 'address', 'value' => '', 'type' => 'textarea', 'group' => 'general'],
            ['key' => 'owner_name', 'value' => '', 'type' => 'text', 'group' => 'general'],
            ['key' => 'footer_description', 'value' => 'Websites, SEO, email services, and web asset management—delivered with clear planning, measurable results, and long-term support.', 'type' => 'textarea', 'group' => 'general'],
            ['key' => 'newsletter_description', 'value' => 'Get practical growth tips, updates, and launch notes—no spam.', 'type' => 'text', 'group' => 'general'],
            ['key' => 'facebook_url', 'value' => '', 'type' => 'url', 'group' => 'social'],
            ['key' => 'twitter_url', 'value' => '', 'type' => 'url', 'group' => 'social'],
            ['key' => 'linkedin_url', 'value' => '', 'type' => 'url', 'group' => 'social'],
            ['key' => 'instagram_url', 'value' => '', 'type' => 'url', 'group' => 'social'],
            // SEO (aligned with the report copy)
            ['key' => 'meta_title', 'value' => 'digiliftpro — Build, Manage, and Grow Your Digital Business', 'type' => 'text', 'group' => 'seo'],
            ['key' => 'meta_description', 'value' => 'Websites, SEO, email services, and web asset management—delivered with clear planning, measurable results, and long-term support.', 'type' => 'textarea', 'group' => 'seo'],
            ['key' => 'meta_keywords', 'value' => 'web development, web app development, seo, performance optimization, email setup, domain hosting ssl management, maintenance support', 'type' => 'text', 'group' => 'seo'],
        ];

        // Home page dynamic settings (used by HomePage.vue via /api/openapi/home)
        $homePageSettings = [
            ['key' => 'home_hero_title', 'value' => 'Build, Manage, and Grow Your Digital Business', 'type' => 'text', 'group' => 'home_page'],
            ['key' => 'home_hero_subtitle', 'value' => 'Websites, SEO, email services, and web asset management—delivered with clear planning, measurable results, and long-term support.', 'type' => 'textarea', 'group' => 'home_page'],

            ['key' => 'services_overline', 'value' => 'SERVICES', 'type' => 'text', 'group' => 'home_page'],
            ['key' => 'services_title', 'value' => 'Software + Web Operations', 'type' => 'text', 'group' => 'home_page'],
            ['key' => 'services_subtitle', 'value' => 'Fast builds, measurable growth, and reliable support—end to end.', 'type' => 'text', 'group' => 'home_page'],

            ['key' => 'why_choose_us_overline', 'value' => 'WHY CHOOSE US', 'type' => 'text', 'group' => 'home_page'],
            ['key' => 'why_choose_us_title', 'value' => 'Clear Scope. Production-Ready Delivery. Long-Term Support.', 'type' => 'text', 'group' => 'home_page'],
            ['key' => 'why_choose_us_features', 'value' => json_encode([
                ['title' => 'Transparent scope & timelines', 'desc' => 'Clear plans, clear deliverables, realistic deadlines.', 'icon' => 'mdi-timeline-check-outline'],
                ['title' => 'Production-ready code & secure setup', 'desc' => 'Secure, maintainable builds with best practices.', 'icon' => 'mdi-shield-check-outline'],
                ['title' => 'Documentation + handover training', 'desc' => 'Documentation and walkthroughs so your team can own it.', 'icon' => 'mdi-book-open-page-variant-outline'],
                ['title' => 'Dedicated support plans', 'desc' => 'Ongoing maintenance, monitoring, and improvements.', 'icon' => 'mdi-headset'],
            ]), 'type' => 'json', 'group' => 'home_page'],

            ['key' => 'products_overline', 'value' => 'OUR RECENT WORK', 'type' => 'text', 'group' => 'home_page'],
            ['key' => 'products_title', 'value' => 'Products & Projects', 'type' => 'text', 'group' => 'home_page'],
            ['key' => 'products_button_text', 'value' => 'View Our Projects', 'type' => 'text', 'group' => 'home_page'],
            ['key' => 'products_button_link', 'value' => '/products', 'type' => 'text', 'group' => 'home_page'],

            ['key' => 'cta_title', 'value' => 'Have a project in mind?', 'type' => 'text', 'group' => 'home_page'],
            ['key' => 'cta_subtitle', 'value' => 'Let’s turn your idea into a fast, secure, and scalable solution.', 'type' => 'text', 'group' => 'home_page'],
            ['key' => 'cta_primary_button_text', 'value' => 'Book a Free Consultation', 'type' => 'text', 'group' => 'home_page'],
            ['key' => 'cta_primary_button_link', 'value' => json_encode(['name' => 'Contact']), 'type' => 'json', 'group' => 'home_page'],
        ];

        foreach (array_merge($settings, $homePageSettings) as $setting) {
            // Ensure value is stored as string for json types (AdminSettings supports JSON but DB stores text)
            if (($setting['type'] ?? 'text') === 'json' && !is_string($setting['value'])) {
                $setting['value'] = json_encode($setting['value']);
            }

            Setting::updateOrCreate(['key' => $setting['key']], $setting);
        }
    }

    private function seedPages(): array
    {
        $pages = [
            [
                'title' => 'Build, Manage, and Grow Your Digital Business',
                'slug' => 'home',
                'content' => '<h1>Build, Manage, and Grow Your Digital Business</h1><p>Websites, SEO, email services, and web asset management—delivered with clear planning, measurable results, and long-term support.</p><h2>Quick Highlights</h2><ul><li>Custom Website & Web App Development</li><li>SEO & Performance Optimization</li><li>Email Service Setup & Monitoring</li><li>Domain / Hosting / SSL Management</li><li>Ongoing Maintenance & Support</li><li>Analytics, Tracking & Reporting</li></ul>',
                'page_type' => 'home',
                'published' => true,
                'order' => 0,
                'meta_title' => 'digiliftpro — Build, Manage, and Grow Your Digital Business',
                'meta_description' => 'Websites, SEO, email services, and web asset management—delivered with clear planning, measurable results, and long-term support.',
            ],
            [
                'title' => 'About digiliftpro',
                'slug' => 'about',
                'content' => '<h1>About digiliftpro</h1><p>We help businesses plan, build, and run fast, secure, and scalable digital products—websites, web apps, SEO, email services, and web operations.</p><h2>How we work</h2><p>Discovery → Design → Build → Test → Deploy → Support</p><h2>What you get</h2><ul><li>Transparent scope & timelines</li><li>Production-ready delivery</li><li>Documentation + handover training</li><li>Dedicated support plans</li></ul>',
                'page_type' => 'about',
                'published' => true,
                'order' => 1,
                'meta_title' => 'About — digiliftpro',
                'meta_description' => 'Learn about our mission, values, and delivery process.',
            ],
            [
                'title' => 'Contact Us',
                'slug' => 'contact',
                'content' => '<h1>Get in Touch</h1><p>We\'d love to hear from you. Send us a message and we\'ll respond as soon as possible.</p><p><strong>Email:</strong> info@digiliftpro.com</p><p><strong>Service Needed:</strong> Website / Web App / SEO / Email / Asset Management</p><p><strong>Budget:</strong> (optional)</p><p><strong>Details:</strong> Tell us what you want to build.</p>',
                'page_type' => 'page',
                'published' => true,
                'order' => 2,
            ],
            [
                'title' => 'Privacy Policy',
                'slug' => 'privacy-policy',
                'content' => '<h1>Privacy Policy</h1><p>Last updated: ' . date('F d, Y') . '</p><p>At digiliftpro, we take your privacy seriously. This policy describes how we collect, use, and protect your personal information.</p><h2>Information We Collect</h2><p>We collect information you provide directly to us, including name, email address, phone number, and project details.</p><h2>How We Use Your Information</h2><p>We use your information to respond to inquiries, provide services, and improve our offerings.</p>',
                'page_type' => 'page',
                'published' => true,
                'order' => 10,
            ],
            [
                'title' => 'Terms & Conditions',
                'slug' => 'terms-conditions',
                'content' => '<h1>Terms & Conditions</h1><p>Last updated: ' . date('F d, Y') . '</p><p>By using our website and services, you agree to these terms and conditions.</p><h2>Use of Services</h2><p>Our services are provided for business purposes. You agree to use them in accordance with applicable laws and regulations.</p><h2>Limitation of Liability</h2><p>We strive to provide accurate information, but we are not liable for any errors or omissions.</p>',
                'page_type' => 'page',
                'published' => true,
                'order' => 11,
            ],
        ];

        $createdPages = [];
        foreach ($pages as $page) {
            $createdPages[$page['slug']] = Page::updateOrCreate(
                ['slug' => $page['slug']],
                $page
            );
        }

        return $createdPages;
    }

    private function seedMenus(): void
    {
        $homePage = Page::where('slug', 'home')->first();
        $aboutPage = Page::where('slug', 'about')->first();
        $contactPage = Page::where('slug', 'contact')->first();

        $menus = [
            // Header Menu
            ['name' => 'header', 'label' => 'Home', 'page_id' => $homePage->id, 'url' => null, 'order' => 1, 'active' => true],
            ['name' => 'header', 'label' => 'Services', 'page_id' => null, 'url' => '/services', 'order' => 2, 'active' => true],
            ['name' => 'header', 'label' => 'Products & Projects', 'page_id' => null, 'url' => '/products', 'order' => 3, 'active' => true],
            ['name' => 'header', 'label' => 'Case Studies', 'page_id' => null, 'url' => '/case-studies', 'order' => 4, 'active' => false],
            ['name' => 'header', 'label' => 'Pricing', 'page_id' => null, 'url' => '/pricing', 'order' => 5, 'active' => false],
            ['name' => 'header', 'label' => 'About', 'page_id' => $aboutPage->id, 'url' => null, 'order' => 6, 'active' => true],
            ['name' => 'header', 'label' => 'Contact', 'page_id' => $contactPage->id, 'url' => null, 'order' => 7, 'active' => true],

            // Footer Menu
            ['name' => 'footer', 'label' => 'Privacy Policy', 'page_id' => Page::where('slug', 'privacy-policy')->first()->id, 'url' => null, 'order' => 1, 'active' => true],
            ['name' => 'footer', 'label' => 'Terms & Conditions', 'page_id' => Page::where('slug', 'terms-conditions')->first()->id, 'url' => null, 'order' => 2, 'active' => true],
        ];

        foreach ($menus as $menu) {
            Menu::updateOrCreate(
                ['name' => $menu['name'], 'label' => $menu['label']],
                $menu
            );
        }
    }

    private function seedCategories(): array
    {
        $categories = [];

        // Service Categories
        $categories['service'] = [
            Category::updateOrCreate(
                ['slug' => 'website-web-app-development', 'type' => 'service'],
                ['name' => 'Website & Web App Development', 'slug' => 'website-web-app-development', 'type' => 'service', 'published' => true, 'order' => 1]
            ),
            Category::updateOrCreate(
                ['slug' => 'seo-growth-optimization', 'type' => 'service'],
                ['name' => 'SEO & Growth Optimization', 'slug' => 'seo-growth-optimization', 'type' => 'service', 'published' => true, 'order' => 2]
            ),
            Category::updateOrCreate(
                ['slug' => 'maintenance-support', 'type' => 'service'],
                ['name' => 'Maintenance & Support', 'slug' => 'maintenance-support', 'type' => 'service', 'published' => true, 'order' => 3]
            ),
        ];

        // Product Categories
        $categories['product'] = [
            Category::updateOrCreate(
                ['slug' => 'website', 'type' => 'product'],
                ['name' => 'Website', 'slug' => 'website', 'type' => 'product', 'published' => true, 'order' => 1]
            ),
            Category::updateOrCreate(
                ['slug' => 'web-app', 'type' => 'product'],
                ['name' => 'Web App', 'slug' => 'web-app', 'type' => 'product', 'published' => true, 'order' => 2]
            ),
            Category::updateOrCreate(
                ['slug' => 'seo', 'type' => 'product'],
                ['name' => 'SEO', 'slug' => 'seo', 'type' => 'product', 'published' => true, 'order' => 3]
            ),
            Category::updateOrCreate(
                ['slug' => 'email', 'type' => 'product'],
                ['name' => 'Email', 'slug' => 'email', 'type' => 'product', 'published' => true, 'order' => 4]
            ),
            Category::updateOrCreate(
                ['slug' => 'asset-management', 'type' => 'product'],
                ['name' => 'Asset Management', 'slug' => 'asset-management', 'type' => 'product', 'published' => true, 'order' => 5]
            ),
        ];

        // Post Categories
        $categories['post'] = [
            Category::updateOrCreate(
                ['slug' => 'news', 'type' => 'post'],
                ['name' => 'News', 'slug' => 'news', 'type' => 'post', 'published' => true, 'order' => 1]
            ),
            Category::updateOrCreate(
                ['slug' => 'tips', 'type' => 'post'],
                ['name' => 'Tips & Tricks', 'slug' => 'tips', 'type' => 'post', 'published' => true, 'order' => 2]
            ),
            Category::updateOrCreate(
                ['slug' => 'case-studies', 'type' => 'post'],
                ['name' => 'Case Studies', 'slug' => 'case-studies', 'type' => 'post', 'published' => true, 'order' => 3]
            ),
        ];

        return $categories;
    }

    private function seedTags(): array
    {
        $tags = [];

        $tagNames = ['business', 'technology', 'strategy', 'growth', 'digital', 'marketing', 'performance', 'security'];

        // Service Tags
        $tags['service'] = [];
        foreach ($tagNames as $name) {
            $slug = $name . '-service';
            $tags['service'][] = Tag::updateOrCreate(
                ['slug' => $slug],
                ['name' => ucfirst($name), 'slug' => $slug, 'type' => 'service']
            );
        }

        // Product Tags
        $tags['product'] = [];
        $productTechTags = ['Laravel', 'Vue', 'React', 'WordPress', 'Node', 'MySQL', 'PostgreSQL'];
        foreach ($productTechTags as $name) {
            $slug = strtolower($name) . '-product';
            $tags['product'][] = Tag::updateOrCreate(
                ['slug' => $slug],
                ['name' => $name, 'slug' => $slug, 'type' => 'product']
            );
        }

        // Post Tags
        $tags['post'] = [];
        foreach ($tagNames as $name) {
            $slug = $name . '-post';
            $tags['post'][] = Tag::updateOrCreate(
                ['slug' => $slug],
                ['name' => ucfirst($name), 'slug' => $slug, 'type' => 'post']
            );
        }

        return $tags;
    }

    private function seedServices($categories, $tags): void
    {
        $services = [
            [
                'title' => 'Website & Web App Development',
                'slug' => 'website-web-app-development',
                'short_description' => 'Fast, secure, modern websites and web applications built for long-term growth.',
                'description' => '<p>We build business websites, landing pages, portfolios, admin panels, dashboards, CRM modules, and custom systems. We focus on performance, security, and maintainability.</p><h3>Includes</h3><ul><li>Discovery + planning</li><li>UI/UX implementation</li><li>Backend/API integration</li><li>Testing + deployment</li><li>Documentation + handover</li></ul>',
                'icon' => 'mdi-laptop',
                'price_range' => 'Custom quote',
                'features' => ['Modern Stack', 'Secure Setup', 'Responsive UI', 'Production Ready'],
                'benefits' => ['Faster launch', 'Better UX', 'Scalable architecture', 'Clean handover'],
                'published' => true,
                'order' => 1,
            ],
            [
                'title' => 'SEO & Growth Optimization',
                'slug' => 'seo-growth-optimization',
                'short_description' => 'Technical SEO, on-page structure, and speed optimization for measurable growth.',
                'description' => '<p>SEO that increases visibility and brings real traffic.</p><h3>Includes</h3><ul><li>Technical SEO audit & fixes</li><li>On-page SEO (structure, content, schema)</li><li>Speed optimization (Core Web Vitals)</li><li>Keyword plan + monthly reporting</li></ul>',
                'icon' => 'mdi-chart-line',
                'price_range' => 'Monthly plans available',
                'features' => ['Audit & Fixes', 'Schema', 'Core Web Vitals', 'Reporting'],
                'benefits' => ['More traffic', 'Better rankings', 'Faster pages', 'Clear KPIs'],
                'published' => true,
                'order' => 2,
            ],
            [
                'title' => 'Web Assets Management',
                'slug' => 'web-assets-management',
                'short_description' => 'Domain, DNS, hosting/VPS, SSL, backups, and monitoring—handled end to end.',
                'description' => '<p>We manage the critical assets that keep your business online.</p><h3>Includes</h3><ul><li>Domain renewals & DNS configuration</li><li>Hosting/VPS monitoring and backups</li><li>SSL certificate setup and renewal</li><li>Security hardening + uptime monitoring</li></ul>',
                'icon' => 'mdi-domain',
                'price_range' => 'Monthly plans available',
                'features' => ['Monitoring', 'Backups', 'SSL', 'Security hardening'],
                'benefits' => ['Less downtime', 'Better security', 'Peace of mind', 'Clear ownership'],
                'published' => true,
                'order' => 3,
            ],
            [
                'title' => 'Email Service Management',
                'slug' => 'email-service-management',
                'short_description' => 'Business email setup, SPF/DKIM/DMARC, deliverability troubleshooting, monitoring.',
                'description' => '<p>Reliable email delivery for your business.</p><h3>Includes</h3><ul><li>Business email setup (Google Workspace / Microsoft 365 / cPanel)</li><li>SPF/DKIM/DMARC configuration</li><li>Deliverability monitoring & troubleshooting</li><li>Mailing list and transactional email setup (if needed)</li></ul>',
                'icon' => 'mdi-email-check-outline',
                'price_range' => 'Custom quote',
                'features' => ['SPF/DKIM/DMARC', 'Monitoring', 'Troubleshooting', 'Transactional setup'],
                'benefits' => ['Better inboxing', 'Fewer bounces', 'Brand trust', 'Reliable delivery'],
                'published' => true,
                'order' => 4,
            ],
            [
                'title' => 'Maintenance & Support',
                'slug' => 'maintenance-support',
                'short_description' => 'Bug fixes, upgrades, security patches, performance monitoring, and ongoing support.',
                'description' => '<p>Stay updated, secure, and stable.</p><h3>Includes</h3><ul><li>Monthly maintenance packages</li><li>Bug fixes, version upgrades</li><li>Security patches & logs review</li><li>Performance monitoring</li></ul>',
                'icon' => 'mdi-wrench-clock-outline',
                'price_range' => 'Monthly plans available',
                'features' => ['Upgrades', 'Security', 'Monitoring', 'Support'],
                'benefits' => ['Stability', 'Security', 'Speed', 'Predictable costs'],
                'published' => true,
                'order' => 5,
            ],
        ];

        $createdServices = [];
        foreach ($services as $index => $service) {
            $createdService = Service::updateOrCreate(
                ['slug' => $service['slug']],
                $service
            );

            // Attach categories
            if (isset($categories[$index % count($categories)])) {
                $createdService->categories()->syncWithoutDetaching([$categories[$index % count($categories)]->id]);
            }

            // Attach random tags
            $randomTags = array_slice($tags, 0, rand(2, 4));
            $tagIds = array_map(fn($tag) => $tag->id, $randomTags);
            $createdService->tags()->syncWithoutDetaching($tagIds);
        }
    }


    private function seedPortfolio(): void
    {
        $portfolio = [
            [
                'title' => 'Example CRM Portal',
                'slug' => 'example-crm-portal',
                'description' => '<p>A CRM portal that centralizes leads, sales workflows, and reporting with role-based access and exportable reports.</p>',
                'short_description' => 'CRM portal with dashboards, reports, and role-based access.',
                'client_name' => null,
                'industry' => 'Business Services',
                'type' => 'Web App',
                'platform' => 'Web / Mobile Responsive',
                'status' => 'live',
                'year' => (int) now()->format('Y'),
                'project_date' => Carbon::now()->subMonths(6),
                'challenge' => 'Manual lead tracking and fragmented reporting across teams.',
                'solution' => 'A unified portal with dashboards, permissions, and automated exports.',
                'results' => 'Reduced manual work, improved reporting speed, clearer KPIs.',
                'technology_stack' => ['frontend' => 'Vue', 'backend' => 'Laravel', 'db' => 'MySQL'],
                'hosting' => 'VPS / Cloud',
                'security' => ['ssl' => true, 'roles_permissions' => true, 'backups' => true, 'notes' => 'Hardened configuration + monitoring'],
                'integrations' => ['Email', 'Analytics'],
                'modules' => ['Admin dashboard', 'Reports', 'Export (PDF/Excel)', 'User management'],
                'timeline' => '6–8 weeks',
                'support_plan' => 'Monthly maintenance',
                'key_features' => [
                    'Role-based access control',
                    'Dynamic reports & export (PDF/Excel)',
                    'Admin dashboard with KPI charts',
                    'SEO-ready structure and performance optimization',
                    'Automated backups & uptime monitoring',
                ],
                'published' => true,
                'featured' => true,
                'order' => 1,
            ],
            [
                'title' => 'Marketing Website + SEO Sprint',
                'slug' => 'marketing-website-seo-sprint',
                'description' => '<p>High-performance marketing site with technical SEO fixes, schema, and Core Web Vitals improvements.</p>',
                'short_description' => 'Fast website + technical SEO improvements.',
                'client_name' => null,
                'industry' => 'Retail',
                'type' => 'Website',
                'platform' => 'Web',
                'status' => 'live',
                'year' => (int) now()->format('Y'),
                'project_date' => Carbon::now()->subMonths(4),
                'challenge' => 'Low organic visibility and slow pages causing drop-offs.',
                'solution' => 'SEO audit + fixes, optimized structure, speed improvements.',
                'results' => 'Better speed scores and improved search visibility.',
                'technology_stack' => ['frontend' => 'Vue', 'backend' => 'Laravel', 'db' => 'MySQL'],
                'hosting' => 'Shared/VPS/Cloud',
                'security' => ['ssl' => true, 'roles_permissions' => false, 'backups' => true],
                'integrations' => ['Analytics'],
                'modules' => ['Landing pages', 'Contact form', 'Tracking'],
                'timeline' => '2–3 weeks',
                'support_plan' => 'SEO reporting + maintenance',
                'key_features' => [
                    'SEO-ready structure and schema',
                    'Core Web Vitals optimization',
                    'Analytics, tracking & reporting',
                ],
                'published' => true,
                'featured' => true,
                'order' => 2,
            ],
            [
                'title' => 'Business Email Setup + Deliverability',
                'slug' => 'business-email-setup-deliverability',
                'description' => '<p>Business email setup with SPF/DKIM/DMARC, monitoring, and troubleshooting for consistent inboxing.</p>',
                'short_description' => 'Email service setup, authentication, and monitoring.',
                'client_name' => null,
                'industry' => 'NGO',
                'type' => 'System',
                'platform' => 'Web',
                'status' => 'private',
                'year' => (int) now()->format('Y'),
                'project_date' => Carbon::now()->subMonths(8),
                'challenge' => 'Emails landing in spam and inconsistent delivery.',
                'solution' => 'Configured SPF/DKIM/DMARC + monitoring and best practices.',
                'results' => 'Improved deliverability and stronger domain reputation.',
                'technology_stack' => ['frontend' => null, 'backend' => null, 'db' => null],
                'hosting' => 'Microsoft 365 / Google Workspace / cPanel',
                'security' => ['ssl' => true, 'roles_permissions' => false, 'backups' => false],
                'integrations' => ['Email'],
                'modules' => ['SPF/DKIM/DMARC', 'Monitoring'],
                'timeline' => '3–5 days',
                'support_plan' => 'Monitoring + ongoing support',
                'key_features' => [
                    'SPF/DKIM/DMARC configuration',
                    'Deliverability monitoring & troubleshooting',
                ],
                'published' => true,
                'featured' => false,
                'order' => 3,
            ],
        ];

        foreach ($portfolio as $item) {
            Portfolio::updateOrCreate(
                ['slug' => $item['slug']],
                $item
            );
        }
    }

    private function seedProducts($categories, $tags): void
    {
        // Clear existing demo products first so "migrate:fresh --seed" is consistent
        Product::query()->delete();

        // Map tech tags by name for quick attaching
        $tagByName = [];
        foreach ($tags as $t) {
            $tagByName[strtolower($t->name)] = $t;
        }

        $products = [
            [
                'title' => 'Example CRM Portal',
                'slug' => 'example-crm-portal',
                'short_description' => 'CRM portal with dashboards, reports, exports, and role-based access.',
                'description' => 'Business goal: centralize leads and reporting. Delivered: web app with dashboards and exports. Results: faster reporting and less manual work.',
                'thumbnail' => 'assets/img/default.jpg',
                'images' => ['assets/img/default.jpg'],
                'price' => null,
                'price_range' => 'Custom Quote',
                'show_price' => false,
                'published' => true,
                'featured' => true,
                'order' => 1,
                'specifications' => [
                    'client_company' => null,
                    'industry' => 'Business Services',
                    'type' => 'Web App',
                    'platform' => 'Web / Mobile Responsive',
                    'technology_stack' => ['frontend' => 'Vue', 'backend' => 'Laravel', 'db' => 'MySQL'],
                    'hosting' => 'VPS / Cloud',
                    'security' => ['ssl' => true, 'roles_permissions' => true, 'backups' => true],
                    'integrations' => ['Email', 'Analytics'],
                    'pages_modules' => ['Dashboard', 'User roles', 'Reports', 'Export (PDF/Excel)'],
                    'timeline' => '6–8 weeks',
                    'support_plan' => 'Monthly maintenance',
                    '_key_features' => [
                        'Role-based access control',
                        'Dynamic reports & export (PDF/Excel)',
                        'Admin dashboard with KPI charts',
                        'SEO-ready structure and performance optimization',
                        'Automated backups & uptime monitoring',
                    ],
                ],
            ],
            [
                'title' => 'Company Website + SEO Boost',
                'slug' => 'company-website-seo-boost',
                'short_description' => 'Modern website with technical SEO fixes, schema, and performance optimization.',
                'description' => 'Business goal: improve visibility and conversions. Delivered: website + SEO audit and fixes. Results: better load times and improved search readiness.',
                'thumbnail' => 'assets/img/default.jpg',
                'images' => ['assets/img/default.jpg'],
                'price' => null,
                'price_range' => 'Custom Quote',
                'show_price' => false,
                'published' => true,
                'featured' => true,
                'order' => 2,
                'specifications' => [
                    'industry' => 'Retail',
                    'type' => 'Website',
                    'platform' => 'Web',
                    'technology_stack' => ['frontend' => 'Vue', 'backend' => 'Laravel', 'db' => 'MySQL'],
                    'hosting' => 'Shared/VPS/Cloud',
                    'security' => ['ssl' => true, 'backups' => true],
                    'integrations' => ['Analytics'],
                    'pages_modules' => ['Landing pages', 'Contact form', 'Schema / SEO'],
                    'timeline' => '2–3 weeks',
                    'support_plan' => 'Monthly reporting + maintenance',
                    '_key_features' => [
                        'Technical SEO audit & fixes',
                        'On-page SEO (structure, content, schema)',
                        'Speed optimization (Core Web Vitals)',
                        'Keyword plan + monthly reporting',
                    ],
                ],
            ],
            [
                'title' => 'Web Assets Management Setup',
                'slug' => 'web-assets-management-setup',
                'short_description' => 'DNS, SSL, monitoring, and backups for reliable web operations.',
                'description' => 'Business goal: reduce downtime and operational risk. Delivered: asset management plan + monitoring. Results: stable hosting and automated backups.',
                'thumbnail' => 'assets/img/default.jpg',
                'images' => ['assets/img/default.jpg'],
                'price' => null,
                'price_range' => 'Monthly Plan',
                'show_price' => false,
                'published' => true,
                'featured' => false,
                'order' => 3,
                'specifications' => [
                    'industry' => 'Healthcare',
                    'type' => 'System',
                    'platform' => 'Web',
                    'technology_stack' => ['frontend' => null, 'backend' => null, 'db' => null],
                    'hosting' => 'Shared/VPS/Cloud',
                    'security' => ['ssl' => true, 'backups' => true, 'notes' => 'Hardening + uptime monitoring'],
                    'integrations' => [],
                    'pages_modules' => ['DNS', 'SSL renewal', 'Monitoring', 'Backups'],
                    'timeline' => '3–5 days',
                    'support_plan' => 'Monthly maintenance',
                    '_key_features' => [
                        'Domain renewals & DNS configuration',
                        'Hosting/VPS monitoring and backups',
                        'SSL certificate setup and renewal',
                        'Security hardening + uptime monitoring',
                    ],
                ],
            ],
        ];

        foreach ($products as $idx => $p) {
            $product = Product::updateOrCreate(['slug' => $p['slug']], $p);

            // Attach category (round-robin) so category filters work
            if (!empty($categories) && isset($categories[$idx % count($categories)])) {
                $product->categories()->syncWithoutDetaching([$categories[$idx % count($categories)]->id]);
            }

            // Attach a couple tech tags where possible
            $attach = [];
            foreach (['laravel', 'vue', 'mysql'] as $tech) {
                if (isset($tagByName[$tech])) {
                    $attach[] = $tagByName[$tech]->id;
                }
            }
            if (!empty($attach)) {
                $product->tags()->syncWithoutDetaching($attach);
            }
        }
    }

    private function seedBlogPosts($categories, $tags): void
    {
        // Get any user with administrator role, or fallback to first user
        $author = User::whereHas('roles', function ($q) {
            $q->where('slug', 'administrator');
        })->first();
        
        // Fallback to first user if no admin found
        if (!$author) {
            $author = User::first();
        }
        
        if (!$author) {
            $this->command->warn('No users found. Please run AdminUserSeeder first.');
            return;
        }

        $posts = [
            [
                'title' => '10 Ways to Improve Your Business Efficiency',
                'slug' => 'improve-business-efficiency',
                'excerpt' => 'Discover practical strategies to streamline operations and boost productivity in your business.',
                'content' => '<p>Efficiency is key to business success. In this article, we explore ten proven strategies to improve your business operations and drive better results.</p><h2>1. Automate Repetitive Tasks</h2><p>Automation can save countless hours and reduce errors. Identify tasks that can be automated and implement solutions.</p><h2>2. Streamline Communication</h2><p>Effective communication is essential. Use collaboration tools to improve team communication.</p><p>Continue reading for more tips...</p>',
                'author_id' => $author->id,
                'published_at' => Carbon::now()->subDays(5),
                'published' => true,
            ],
            [
                'title' => 'The Future of Digital Marketing',
                'slug' => 'future-of-digital-marketing',
                'excerpt' => 'Exploring emerging trends and technologies shaping the future of digital marketing.',
                'content' => '<p>Digital marketing continues to evolve. Let\'s explore the trends that will shape the industry in the coming years.</p><h2>AI and Machine Learning</h2><p>Artificial intelligence is revolutionizing how we approach marketing, enabling personalization at scale.</p><h2>Voice Search Optimization</h2><p>With the rise of smart speakers, optimizing for voice search is becoming increasingly important.</p>',
                'author_id' => $author->id,
                'published_at' => Carbon::now()->subDays(12),
                'published' => true,
            ],
            [
                'title' => 'Case Study: Successful Business Transformation',
                'slug' => 'case-study-business-transformation',
                'excerpt' => 'How one company achieved remarkable results through strategic business transformation.',
                'content' => '<p>This case study examines how a mid-size company achieved significant growth through strategic transformation.</p><h2>The Challenge</h2><p>The company faced declining market share and operational inefficiencies.</p><h2>The Solution</h2><p>Through comprehensive analysis and strategic planning, we helped implement transformative changes.</p><h2>The Results</h2><p>The results exceeded expectations, with 200% growth in revenue.</p>',
                'author_id' => $author->id,
                'published_at' => Carbon::now()->subDays(20),
                'published' => true,
            ],
        ];

        foreach ($posts as $index => $post) {
            $createdPost = BlogPost::updateOrCreate(
                ['slug' => $post['slug']],
                $post
            );

            // Attach categories
            if (isset($categories[$index % count($categories)])) {
                $createdPost->categories()->syncWithoutDetaching([$categories[$index % count($categories)]->id]);
            }

            // Attach random tags
            $randomTags = array_slice($tags, 0, rand(2, 4));
            $tagIds = array_map(fn($tag) => $tag->id, $randomTags);
            $createdPost->tags()->syncWithoutDetaching($tagIds);
        }
    }

    private function seedFaqs(): void
    {
        $faqs = [
            [
                'question' => 'What services do you offer?',
                'answer' => 'We offer a wide range of business services including consulting, digital marketing, IT solutions, and financial planning. Our services are tailored to meet your specific business needs.',
                'category' => 'General',
                'order' => 1,
                'published' => true,
            ],
            [
                'question' => 'How long does a typical project take?',
                'answer' => 'Project timelines vary depending on the scope and complexity. Simple projects may take 2-4 weeks, while larger implementations can take 3-6 months. We provide detailed timelines during the consultation phase.',
                'category' => 'General',
                'order' => 2,
                'published' => true,
            ],
            [
                'question' => 'Do you offer ongoing support?',
                'answer' => 'Yes, we offer various support packages to ensure your systems continue to run smoothly. Support options include helpdesk, maintenance, and strategic consulting.',
                'category' => 'Support',
                'order' => 1,
                'published' => true,
            ],
            [
                'question' => 'What is your pricing model?',
                'answer' => 'Our pricing varies based on the services required. We offer both one-time project fees and monthly retainer options. Contact us for a customized quote based on your needs.',
                'category' => 'Pricing',
                'order' => 1,
                'published' => true,
            ],
            [
                'question' => 'Can you work with businesses of all sizes?',
                'answer' => 'Absolutely! We work with startups, small businesses, and large enterprises. Our solutions are scalable and adaptable to businesses of any size.',
                'category' => 'General',
                'order' => 3,
                'published' => true,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::updateOrCreate(
                ['question' => $faq['question']],
                $faq
            );
        }
    }

    private function seedBranches(): void
    {
        $branches = [
            [
                'name' => 'Head Office',
                'slug' => 'head-office',
                'address' => '',
                'city' => '',
                'state' => '',
                'postal_code' => '',
                'country' => '',
                'phone' => '',
                'email' => 'info@digiliftpro.com',
                'opening_hours' => [
                    'monday' => '9:00 AM - 7:00 PM',
                    'tuesday' => '9:00 AM - 7:00 PM',
                    'wednesday' => '9:00 AM - 7:00 PM',
                    'thursday' => '9:00 AM - 7:00 PM',
                    'friday' => '9:00 AM - 7:00 PM',
                    'saturday' => '9:00 AM - 5:00 PM',
                    'sunday' => 'Closed',
                ],
                'published' => true,
                'order' => 1,
            ],
        ];

        foreach ($branches as $branch) {
            Branch::updateOrCreate(
                ['slug' => $branch['slug']],
                $branch
            );
        }
    }

    private function seedCareers(): void
    {
        $careers = [
            [
                'title' => 'Senior Business Consultant',
                'slug' => 'senior-business-consultant',
                'department' => 'Consulting',
                'location' => 'New York, NY',
                'employment_type' => 'Full-time',
                'description' => '<p>We are seeking an experienced business consultant to join our team.</p>',
                'responsibilities' => '<ul><li>Lead client consulting engagements</li><li>Develop strategic recommendations</li><li>Manage project teams</li><li>Build client relationships</li></ul>',
                'requirements' => '<ul><li>5+ years of consulting experience</li><li>MBA or equivalent</li><li>Strong analytical skills</li><li>Excellent communication</li></ul>',
                'deadline' => Carbon::now()->addMonths(2),
                'published' => true,
                'order' => 1,
            ],
            [
                'title' => 'Digital Marketing Specialist',
                'slug' => 'digital-marketing-specialist',
                'department' => 'Marketing',
                'location' => 'Los Angeles, CA',
                'employment_type' => 'Full-time',
                'description' => '<p>Join our marketing team and help clients grow their digital presence.</p>',
                'responsibilities' => '<ul><li>Develop marketing strategies</li><li>Manage campaigns</li><li>Analyze performance</li><li>Create content</li></ul>',
                'requirements' => '<ul><li>3+ years of digital marketing experience</li><li>Proficiency in SEO/SEM</li><li>Social media expertise</li><li>Analytics skills</li></ul>',
                'deadline' => Carbon::now()->addMonths(1),
                'published' => true,
                'order' => 2,
            ],
        ];

        foreach ($careers as $career) {
            Career::updateOrCreate(
                ['slug' => $career['slug']],
                $career
            );
        }
    }

    private function seedEvents(): void
    {
        $events = [
            [
                'title' => 'Business Growth Summit 2024',
                'slug' => 'business-growth-summit-2024',
                'description' => '<p>Join us for a day of insights, networking, and strategies for business growth.</p>',
                'event_date' => Carbon::now()->addMonths(2),
                'event_time' => Carbon::now()->setTime(9, 0),
                'end_date_time' => Carbon::now()->addMonths(2)->setTime(17, 0),
                'venue' => 'Grand Conference Center',
                'address' => '789 Event Avenue, New York, NY 10001',
                'speakers' => [
                    ['name' => 'Project Lead', 'title' => 'Delivery & Planning, digiliftpro'],
                    ['name' => 'SEO Specialist', 'title' => 'Growth & Performance'],
                ],
                'allow_registration' => true,
                'max_attendees' => 200,
                'published' => true,
            ],
            [
                'title' => 'Digital Transformation Workshop',
                'slug' => 'digital-transformation-workshop',
                'description' => '<p>Learn how to transform your business with digital technologies.</p>',
                'event_date' => Carbon::now()->addMonths(3),
                'event_time' => Carbon::now()->setTime(10, 0),
                'end_date_time' => Carbon::now()->addMonths(3)->setTime(16, 0),
                'venue' => 'Tech Hub Los Angeles',
                'address' => '321 Innovation Drive, Los Angeles, CA 90001',
                'speakers' => [
                    ['name' => 'Mike Johnson', 'title' => 'CTO, Tech Solutions'],
                ],
                'allow_registration' => true,
                'max_attendees' => 50,
                'published' => true,
            ],
        ];

        foreach ($events as $event) {
            Event::updateOrCreate(
                ['slug' => $event['slug']],
                $event
            );
        }
    }

    private function seedLeads(): void
    {
        $leads = [
            [
                'type' => 'contact',
                'name' => 'John Doe',
                'email' => 'john.doe@example.com',
                'phone' => '+1 (555) 111-2222',
                'subject' => 'Inquiry about Services',
                'message' => 'I am interested in learning more about your business consulting services.',
                'status' => 'new',
                'created_at' => Carbon::now()->subDays(2),
            ],
            [
                'type' => 'quote',
                'name' => 'Jane Smith',
                'email' => 'jane.smith@example.com',
                'phone' => '+1 (555) 333-4444',
                'subject' => 'Request for Quote - Digital Marketing',
                'message' => 'Please provide a quote for your digital marketing services for our company.',
                'status' => 'in_progress',
                'created_at' => Carbon::now()->subDays(5),
            ],
            [
                'type' => 'contact',
                'name' => 'Robert Johnson',
                'email' => 'robert.j@example.com',
                'phone' => '+1 (555) 555-6666',
                'subject' => 'General Inquiry',
                'message' => 'Would like to schedule a consultation meeting.',
                'status' => 'completed',
                'created_at' => Carbon::now()->subDays(10),
            ],
        ];

        foreach ($leads as $lead) {
            Lead::create($lead);
        }
    }
}
