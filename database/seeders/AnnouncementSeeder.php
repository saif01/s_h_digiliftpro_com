<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Announcement;
use App\Models\User;
use Carbon\Carbon;

class AnnouncementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
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

        $announcements = [
            // Company News
            [
                'title' => 'Welcome to Our New Website',
                'slug' => 'welcome-new-website',
                'short_description' => 'We are excited to announce the launch of our new website with improved features and better user experience.',
                'content' => '<p>We are thrilled to announce the launch of our brand new website! Our team has been working hard to create a better experience for our customers.</p><p>The new website features:</p><ul><li>Improved navigation and user interface</li><li>Faster loading times</li><li>Mobile-responsive design</li><li>Enhanced search functionality</li><li>Better integration with our services</li></ul><p>We hope you enjoy exploring the new site. Feel free to contact us if you have any feedback!</p>',
                'type' => 'company_news',
                'display_type' => 'slider_banner',
                'priority' => 80,
                'is_active' => false,
                'start_date' => Carbon::now()->subDays(2),
                'end_date' => Carbon::now()->addDays(30),
                'author_id' => $author->id,
                'meta_title' => 'Welcome to digiliftpro',
                'meta_description' => 'Discover our newly launched website with enhanced features, better user experience, and improved functionality.',
            ],
            [
                'title' => 'Company Expansion: Opening New Branch in Dubai',
                'slug' => 'new-branch-dubai',
                'short_description' => 'We are expanding our operations with a new branch in Dubai to better serve our Middle Eastern customers.',
                'content' => '<p>We are excited to announce the opening of our new branch in Dubai, United Arab Emirates!</p><p>This expansion represents our commitment to providing excellent service to our customers in the Middle East. Our new facility will offer:</p><ul><li>Full range of power solutions</li><li>Local technical support</li><li>Same-day service in Dubai area</li><li>Extended warranty options</li></ul><p>Join us for the grand opening event on December 15th. We look forward to serving you better!</p>',
                'type' => 'company_news',
                'display_type' => 'page_section',
                'priority' => 70,
                'is_active' => false,
                'start_date' => Carbon::now()->subDays(5),
                'end_date' => Carbon::now()->addDays(60),
                'author_id' => $author->id,
            ],

            // Offers / Promotions
            [
                'title' => 'Free Consultation Week — Book Your Slot',
                'slug' => 'free-consultation-week',
                'short_description' => 'Book a free consultation and get a clear plan for your website, SEO, or web app.',
                'content' => '<p><strong>Free Consultation Week</strong></p><p>Have a project in mind? Book a free consultation and we\'ll help you clarify scope, timeline, and the best approach for your goals.</p><p><strong>What you get:</strong></p><ul><li>Scope outline</li><li>Recommended tech stack</li><li>Timeline estimate</li><li>Next steps</li></ul>',
                'type' => 'offers_promotions',
                'display_type' => 'popup',
                'priority' => 90,
                'is_active' => false,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addDays(15),
                'external_link' => '/contact',
                'open_in_new_tab' => false,
                'author_id' => $author->id,
                'meta_title' => 'Book a Free Consultation | digiliftpro',
                'meta_description' => 'Get a clear plan, timeline, and next steps for your website, SEO, or web app.',
            ],
            [
                'title' => 'Summer Maintenance Packages - Buy 2 Get 1 Free',
                'slug' => 'summer-maintenance-packages',
                'short_description' => 'Special summer offer: Purchase 2 maintenance packages and get 1 free. Perfect for keeping your systems running smoothly.',
                'content' => '<p>☀️ <strong>Summer Maintenance Special</strong></p><p>Keep your power systems in top condition with our special summer maintenance offer!</p><p><strong>Buy 2 Maintenance Packages, Get 1 FREE!</strong></p><p>What\'s included:</p><ul><li>Professional system inspection</li><li>Battery health check</li><li>Performance optimization</li><li>24/7 support access</li></ul><p>Valid until the end of summer. Book your maintenance appointment today!</p>',
                'type' => 'offers_promotions',
                'display_type' => 'slider_banner',
                'priority' => 75,
                'is_active' => false,
                'start_date' => Carbon::now()->subDays(1),
                'end_date' => Carbon::now()->addMonths(2),
                'author_id' => $author->id,
            ],

            // Events
            [
                'title' => 'Annual Technology Conference 2025 - Register Now!',
                'slug' => 'technology-conference-2025',
                'short_description' => 'Join us for our annual technology conference featuring industry experts and the latest innovations in power solutions.',
                'content' => '<p>📅 <strong>Save the Date!</strong></p><p>We are pleased to announce our Annual Technology Conference 2025!</p><p><strong>Event Details:</strong></p><ul><li>Date: March 15-17, 2025</li><li>Location: Grand Convention Center</li><li>Time: 9:00 AM - 5:00 PM daily</li></ul><p><strong>What to Expect:</strong></p><ul><li>Keynote speeches from industry leaders</li><li>Technical workshops and training sessions</li><li>Product demonstrations</li><li>Networking opportunities</li><li>Exclusive deals and discounts</li></ul><p>Early bird registration is now open. Register before February 1st to get 20% discount!</p>',
                'type' => 'events',
                'display_type' => 'page_section',
                'priority' => 85,
                'is_active' => false,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::parse('2025-03-17'),
                'external_link' => '/contact',
                'open_in_new_tab' => false,
                'author_id' => $author->id,
            ],
            [
                'title' => 'Free Webinar: Power Backup Solutions for Small Businesses',
                'slug' => 'free-webinar-power-backup-solutions',
                'short_description' => 'Join our free webinar to learn about power backup solutions tailored for small businesses.',
                'content' => '<p>🎓 <strong>Free Webinar Announcement</strong></p><p>We invite you to join our free educational webinar focused on power backup solutions for small businesses.</p><p><strong>Webinar Details:</strong></p><ul><li>Date: January 20, 2025</li><li>Time: 2:00 PM - 3:30 PM (EST)</li><li>Format: Online via Zoom</li><li>Cost: FREE</li></ul><p><strong>Topics Covered:</strong></p><ul><li>Understanding your power needs</li><li>Choosing the right UPS system</li><li>Budget planning for power solutions</li><li>Maintenance best practices</li><li>Q&A session with experts</li></ul><p>Limited seats available. Register now to secure your spot!</p>',
                'type' => 'events',
                'display_type' => 'sidebar_ticker',
                'priority' => 60,
                'is_active' => false,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::parse('2025-01-20'),
                'author_id' => $author->id,
            ],

            // Holidays
            [
                'title' => 'Holiday Schedule: Office Closed December 25-26',
                'slug' => 'holiday-schedule-christmas',
                'short_description' => 'Our office will be closed on December 25th and 26th for Christmas holidays. Emergency support will still be available.',
                'content' => '<p>🎄 <strong>Holiday Notice</strong></p><p>Please be informed that our office will be closed on <strong>December 25th and 26th</strong> for Christmas holidays.</p><p><strong>Important Information:</strong></p><ul><li>Regular office hours resume on December 27th</li><li>Emergency support will still be available 24/7</li><li>Online orders will be processed after holidays</li><li>For urgent matters, contact our emergency hotline</li></ul><p>We wish you and your family a joyful and peaceful holiday season!</p>',
                'type' => 'holidays',
                'display_type' => 'popup',
                'priority' => 50,
                'is_active' => false,
                'start_date' => Carbon::parse('2024-12-20'),
                'end_date' => Carbon::parse('2024-12-26'),
                'author_id' => $author->id,
            ],
            [
                'title' => 'New Year Holiday: Office Closed January 1st',
                'slug' => 'new-year-holiday-notice',
                'short_description' => 'Happy New Year! Our office will be closed on January 1st. We will resume normal operations on January 2nd.',
                'content' => '<p>🎉 <strong>Happy New Year!</strong></p><p>We wish you a prosperous and successful New Year!</p><p>Please note that our office will be closed on <strong>January 1st, 2025</strong> for New Year\'s Day. We will resume normal business operations on January 2nd, 2025.</p><p>Emergency support services remain available 24/7 for urgent situations.</p><p>Thank you for your understanding, and we look forward to serving you in the new year!</p>',
                'type' => 'holidays',
                'display_type' => 'sidebar_ticker',
                'priority' => 40,
                'is_active' => false,
                'start_date' => Carbon::parse('2024-12-30'),
                'end_date' => Carbon::parse('2025-01-02'),
                'author_id' => $author->id,
            ],

            // Urgent Alerts
            [
                'title' => '⚠️ Scheduled Maintenance: System Update Tonight at 2 AM',
                'slug' => 'scheduled-maintenance-system-update',
                'short_description' => 'Scheduled system maintenance will occur tonight from 2:00 AM to 4:00 AM. Brief service interruption expected.',
                'content' => '<p>⚠️ <strong>IMPORTANT NOTICE: Scheduled Maintenance</strong></p><p>We will be performing scheduled system maintenance tonight to improve our services.</p><p><strong>Maintenance Window:</strong></p><ul><li>Date: Tonight</li><li>Time: 2:00 AM - 4:00 AM (EST)</li><li>Duration: Approximately 2 hours</li></ul><p><strong>Expected Impact:</strong></p><ul><li>Brief service interruption during maintenance window</li><li>Online portal may be temporarily unavailable</li><li>Emergency support will remain operational</li></ul><p>We apologize for any inconvenience and appreciate your patience. We will restore full services as quickly as possible.</p>',
                'type' => 'urgent_alerts',
                'display_type' => 'popup',
                'priority' => 95,
                'is_active' => false,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addDays(1),
                'author_id' => $author->id,
            ],
            [
                'title' => '🚨 Security Alert: Phishing Email Warning',
                'slug' => 'security-alert-phishing-warning',
                'short_description' => 'Important security notice: Be aware of fraudulent emails claiming to be from our company. Always verify the sender.',
                'content' => '<p><strong>SECURITY ALERT</strong></p><p>We have been notified of fraudulent emails circulating that appear to be from our company. Please be vigilant.</p><p><strong>How to identify fake emails:</strong></p><ul><li>Check the sender\'s email address carefully</li><li>We never ask for passwords via email</li><li>Be cautious of urgent payment requests</li></ul><p><strong>What to do:</strong></p><ul><li>Do not click suspicious links</li><li>Do not download unknown attachments</li><li>When in doubt, contact us through the official website</li></ul>',
                'type' => 'urgent_alerts',
                'display_type' => 'slider_banner',
                'priority' => 100,
                'is_active' => false,
                'start_date' => Carbon::now()->subDays(3),
                'end_date' => Carbon::now()->addDays(7),
                'author_id' => $author->id,
            ],
        ];

        // Check if announcements table has created_by and updated_by columns
        $hasAuditColumns = \Illuminate\Support\Facades\Schema::hasColumns('announcements', ['created_by', 'updated_by']);

        foreach ($announcements as $announcement) {
            // Only set audit columns if they exist in the table
            if ($hasAuditColumns) {
                $announcement['created_by'] = $author->id;
                $announcement['updated_by'] = $author->id;
            }
            
            Announcement::updateOrCreate(
                ['slug' => $announcement['slug']],
                $announcement
            );
        }

        $this->command->info('Announcements demo data seeded successfully!');
    }
}

