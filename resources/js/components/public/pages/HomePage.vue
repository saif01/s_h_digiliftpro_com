<template>
    <div class="home-page">
        <!-- Hero Section -->
        <HeroSection v-if="isSectionEnabled('hero_section')" :hero-title="heroTitle" :hero-subtitle="heroSubtitle" />

        <!-- Stats Section -->
        <StatsSection v-if="isSectionEnabled('stats_section')" :stats="stats" />

        <!-- Trusted By Section -->
        <TrustedBySection v-if="isSectionEnabled('trusted_by_section')" :title="trustedByTitle" :clients="clients" />

        <!-- Services Section -->
        <ServicesSection v-if="isSectionEnabled('services_section')" :overline="servicesOverline" :title="servicesTitle"
            :subtitle="servicesSubtitle" :services="services" />

        <!-- Why Choose Us Section -->
        <WhyChooseUsSection v-if="isSectionEnabled('why_choose_us_section')" :overline="whyChooseUsOverline"
            :title="whyChooseUsTitle" :image-url="whyChooseUsImage" :features="features" />

        <!-- Testimonials Section -->
        <TestimonialsSection v-if="isSectionEnabled('testimonials_section')" :overline="testimonialsOverline"
            :title="testimonialsTitle" :subtitle="testimonialsSubtitle" :testimonials="testimonials" />

        <!-- Featured Products Section -->
        <FeaturedProductsSection v-if="isSectionEnabled('featured_products_section')" :overline="productsOverline"
            :title="productsTitle" :button-text="productsButtonText" :button-link="productsButtonLink"
            :products="products" />

        <!-- CTA Section -->
        <CTASection v-if="isSectionEnabled('cta_section')" :title="ctaTitle" :subtitle="ctaSubtitle"
            :primary-button-text="ctaPrimaryButtonText" :primary-button-link="ctaPrimaryButtonLink"
            :secondary-button-text="ctaSecondaryButtonText" :secondary-button-link="ctaSecondaryButtonLink" />
    </div>
</template>

<script>
import HeroSection from './home_page_sections/HeroSection.vue';
import StatsSection from './home_page_sections/StatsSection.vue';
import TrustedBySection from './home_page_sections/TrustedBySection.vue';
import ServicesSection from './home_page_sections/ServicesSection.vue';
import WhyChooseUsSection from './home_page_sections/WhyChooseUsSection.vue';
import TestimonialsSection from './home_page_sections/TestimonialsSection.vue';
import FeaturedProductsSection from './home_page_sections/FeaturedProductsSection.vue';
import CTASection from './home_page_sections/CTASection.vue';

export default {
    name: 'HomePage',
    components: {
        HeroSection,
        StatsSection,
        TrustedBySection,
        ServicesSection,
        WhyChooseUsSection,
        TestimonialsSection,
        FeaturedProductsSection,
        CTASection
    },
    data() {
        return {
            heroTitle: 'Build, Manage, and Grow Your Digital Business',
            heroSubtitle: 'Websites, SEO, email services, and web asset management—delivered with clear planning, measurable results, and long-term support.',
            services: [],
            products: [],
            posts: [],
            stats: [
                { value: '100+', label: 'Deliveries' },
                { value: '99.9%', label: 'Uptime Focus' },
                { value: '24/7', label: 'Support Options' },
                { value: '5+', label: 'Core Services' }
            ],
            homePageSettings: {},
            // Section visibility flags - defaults to true if not set
            sectionVisibility: {
                hero_section: true,
                stats_section: true,
                trusted_by_section: true,
                services_section: true,
                why_choose_us_section: true,
                testimonials_section: true,
                featured_products_section: true,
                cta_section: true
            },
            // Dynamic section content
            trustedByTitle: 'TRUSTED BY GROWING TEAMS',
            servicesOverline: 'WHAT WE DO',
            servicesTitle: 'Software + Web Operations',
            servicesSubtitle: 'Fast builds, measurable growth, and reliable support—end to end.',
            whyChooseUsOverline: 'WHY CHOOSE US',
            whyChooseUsTitle: 'Clear Scope. Production-Ready Delivery. Long-Term Support.',
            whyChooseUsImage: 'https://images.unsplash.com/photo-1473341304170-971dccb5ac1e?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            testimonialsOverline: 'TESTIMONIALS',
            testimonialsTitle: 'Client Success Stories',
            testimonialsSubtitle: "See how we've helped teams launch and improve fast, secure, and scalable systems.",
            productsOverline: 'OUR RECENT WORK',
            productsTitle: 'Products & Projects',
            productsButtonText: 'View Our Projects',
            productsButtonLink: '/products',
            ctaTitle: 'Have a project in mind?',
            ctaSubtitle: "Let’s turn your idea into a fast, secure, and scalable solution.",
            ctaPrimaryButtonText: 'Book a Free Consultation',
            ctaPrimaryButtonLink: { name: 'Contact' },
            ctaSecondaryButtonText: 'Request a Quote',
            ctaSecondaryButtonLink: { name: 'Contact' },
            features: [
                {
                    title: 'Transparent scope & timelines',
                    desc: 'Clear plans, clear deliverables, realistic deadlines.',
                    icon: 'mdi-timeline-check-outline'
                },
                {
                    title: 'Production-ready code & secure setup',
                    desc: 'Secure, maintainable builds with best practices.',
                    icon: 'mdi-shield-check-outline'
                },
                {
                    title: 'Documentation + handover training',
                    desc: 'Documentation and walkthroughs so your team can own it.',
                    icon: 'mdi-book-open-page-variant-outline'
                }
            ],
            clients: [
                { logo: 'https://via.placeholder.com/120x60?text=Client+1' },
                { logo: 'https://via.placeholder.com/120x60?text=Client+2' },
                { logo: 'https://via.placeholder.com/120x60?text=Client+3' },
                { logo: 'https://via.placeholder.com/120x60?text=Client+4' },
                { logo: 'https://via.placeholder.com/120x60?text=Client+5' },
                { logo: 'https://via.placeholder.com/120x60?text=Client+6' },
            ],
            testimonials: [
                {
                    text: "Clear scope, fast delivery, and great communication. The new site is noticeably faster and easier to manage.",
                    name: "Robert Fox",
                    role: "Operations Manager",
                    avatar: "https://i.pravatar.cc/150?img=12"
                },
                {
                    text: "They fixed our technical SEO issues and improved performance. We finally have a clean structure and reporting.",
                    name: "Sarah Jenkins",
                    role: "Marketing Lead",
                    avatar: "https://i.pravatar.cc/150?img=5"
                },
                {
                    text: "Email deliverability improved after SPF/DKIM/DMARC setup. Support was quick and practical.",
                    name: "David Miller",
                    role: "IT Manager",
                    avatar: "https://i.pravatar.cc/150?img=3"
                }
            ]
        };
    },
    async mounted() {
        await this.loadHomeData();
    },
    methods: {
        async loadHomeData() {
            try {
                const response = await this.$axios.get('/api/openapi/home');
                const data = response.data;

                // Store home page settings if available
                if (data.homePageSettings) {
                    this.homePageSettings = data.homePageSettings;

                    // Update section visibility from settings
                    // Default to true if setting is not set (backward compatibility)
                    this.sectionVisibility = {
                        hero_section: this.getSettingValue('hero_section_enabled', true),
                        stats_section: this.getSettingValue('stats_section_enabled', true),
                        trusted_by_section: this.getSettingValue('trusted_by_section_enabled', true),
                        services_section: this.getSettingValue('services_section_enabled', true),
                        why_choose_us_section: this.getSettingValue('why_choose_us_section_enabled', true),
                        testimonials_section: this.getSettingValue('testimonials_section_enabled', true),
                        featured_products_section: this.getSettingValue('featured_products_section_enabled', true),
                        cta_section: this.getSettingValue('cta_section_enabled', true)
                    };

                    // Load dynamic section content from settings
                    this.loadDynamicSectionContent();
                }

                // Handle homePage data
                if (data.homePage) {
                    // Use settings if available, otherwise use page data
                    this.heroTitle = this.homePageSettings.home_hero_title || data.homePage.title || this.heroTitle;
                    // Use content or short description from homePage, or keep default
                    const subtitle = this.homePageSettings.home_hero_subtitle || data.homePage.content;
                    if (subtitle) {
                        // If content is HTML, extract text or use as is
                        this.heroSubtitle = subtitle.replace(/<[^>]*>/g, '').substring(0, 200) || this.heroSubtitle;
                    }
                } else if (this.homePageSettings.home_hero_title) {
                    // Use settings if no page exists
                    this.heroTitle = this.homePageSettings.home_hero_title;
                    this.heroSubtitle = this.homePageSettings.home_hero_subtitle || this.heroSubtitle;
                }

                // Update stats from settings if available
                if (this.homePageSettings.stat_1_value && this.homePageSettings.stat_1_label) {
                    this.stats[0] = { value: this.homePageSettings.stat_1_value, label: this.homePageSettings.stat_1_label };
                }
                if (this.homePageSettings.stat_2_value && this.homePageSettings.stat_2_label) {
                    this.stats[1] = { value: this.homePageSettings.stat_2_value, label: this.homePageSettings.stat_2_label };
                }
                if (this.homePageSettings.stat_3_value && this.homePageSettings.stat_3_label) {
                    this.stats[2] = { value: this.homePageSettings.stat_3_value, label: this.homePageSettings.stat_3_label };
                }
                if (this.homePageSettings.stat_4_value && this.homePageSettings.stat_4_label) {
                    this.stats[3] = { value: this.homePageSettings.stat_4_value, label: this.homePageSettings.stat_4_label };
                }

                // Handle services - map API response to component format
                if (data.services && Array.isArray(data.services) && data.services.length > 0) {
                    this.services = data.services.map(service => ({
                        id: service.id,
                        title: service.title || '',
                        slug: service.slug || '',
                        short_description: service.short_description || service.description || '',
                        icon: service.icon || null,
                        image: service.image || null,
                    }));
                } else {
                    // Fallback services if API returns empty or services module not enabled
                    this.services = [
                        { id: 1, title: 'UPS Systems', slug: 'ups-systems', short_description: 'Reliable Uninterruptible Power Supply systems for critical equipment.' },
                        { id: 2, title: 'Industrial Backup', slug: 'industrial-backup', short_description: 'Heavy-duty power backup solutions for industrial applications.' },
                        { id: 3, title: 'Home Power Solutions', slug: 'home-power', short_description: 'Keep your home running smoothly during outages.' },
                        { id: 4, title: 'Battery Maintenance', slug: 'battery-maintenance', short_description: 'Professional testing, replacement, and disposal services.' },
                        { id: 5, title: 'Power Management', slug: 'power-management', short_description: 'Smart energy monitoring and efficiency optimization.' },
                        { id: 6, title: 'Installation Services', slug: 'installation', short_description: 'Expert installation of all power systems and wiring.' }
                    ];
                }

                // Handle products - map API response to component format
                if (data.products && Array.isArray(data.products) && data.products.length > 0) {
                    this.products = data.products.map(product => ({
                        id: product.id,
                        title: product.title || '',
                        slug: product.slug || '',
                        short_description: product.short_description || product.description || '',
                        thumbnail: product.thumbnail || (product.images && product.images[0]) || null,
                        price: product.price || product.price_range || null,
                        show_price: product.show_price !== false,
                    }));
                }

                // Handle blog posts if blog module is enabled (optional)
                if (data.posts && Array.isArray(data.posts) && data.posts.length > 0) {
                    // Store posts if needed for future use
                    this.posts = data.posts;
                }

            } catch (error) {
                console.error('Error loading home data:', error);
                // Fallback for demo purposes if API fails
                this.services = [
                    { id: 1, title: 'UPS Systems', slug: 'ups-systems', short_description: 'Reliable Uninterruptible Power Supply systems for critical equipment.' },
                    { id: 2, title: 'Industrial Backup', slug: 'industrial-backup', short_description: 'Heavy-duty power backup solutions for industrial applications.' },
                    { id: 3, title: 'Home Power Solutions', slug: 'home-power', short_description: 'Keep your home running smoothly during outages.' },
                    { id: 4, title: 'Battery Maintenance', slug: 'battery-maintenance', short_description: 'Professional testing, replacement, and disposal services.' },
                    { id: 5, title: 'Power Management', slug: 'power-management', short_description: 'Smart energy monitoring and efficiency optimization.' },
                    { id: 6, title: 'Installation Services', slug: 'installation', short_description: 'Expert installation of all power systems and wiring.' }
                ];
            }
        },
        isSectionEnabled(sectionKey) {
            return this.sectionVisibility[sectionKey] !== false;
        },
        getSettingValue(key, defaultValue = null) {
            const value = this.homePageSettings[key];
            if (value === null || value === undefined || value === '') {
                return defaultValue;
            }
            // Handle boolean strings
            if (typeof value === 'string') {
                return value === '1' || value === 'true' || value === 'yes';
            }
            return value;
        },
        loadDynamicSectionContent() {
            // Trusted By Section
            if (this.homePageSettings.trusted_by_title) {
                this.trustedByTitle = this.homePageSettings.trusted_by_title;
            }
            if (this.homePageSettings.trusted_by_clients) {
                try {
                    const clients = typeof this.homePageSettings.trusted_by_clients === 'string'
                        ? JSON.parse(this.homePageSettings.trusted_by_clients)
                        : this.homePageSettings.trusted_by_clients;
                    if (Array.isArray(clients) && clients.length > 0) {
                        this.clients = clients;
                    }
                } catch (e) {
                    console.warn('Error parsing trusted_by_clients:', e);
                }
            }

            // Services Section
            if (this.homePageSettings.services_overline) {
                this.servicesOverline = this.homePageSettings.services_overline;
            }
            if (this.homePageSettings.services_title) {
                this.servicesTitle = this.homePageSettings.services_title;
            }
            if (this.homePageSettings.services_subtitle) {
                this.servicesSubtitle = this.homePageSettings.services_subtitle;
            }

            // Why Choose Us Section
            if (this.homePageSettings.why_choose_us_overline) {
                this.whyChooseUsOverline = this.homePageSettings.why_choose_us_overline;
            }
            if (this.homePageSettings.why_choose_us_title) {
                this.whyChooseUsTitle = this.homePageSettings.why_choose_us_title;
            }
            if (this.homePageSettings.why_choose_us_image) {
                this.whyChooseUsImage = this.homePageSettings.why_choose_us_image;
            }
            if (this.homePageSettings.why_choose_us_features) {
                try {
                    const features = typeof this.homePageSettings.why_choose_us_features === 'string'
                        ? JSON.parse(this.homePageSettings.why_choose_us_features)
                        : this.homePageSettings.why_choose_us_features;
                    if (Array.isArray(features) && features.length > 0) {
                        this.features = features;
                    }
                } catch (e) {
                    console.warn('Error parsing why_choose_us_features:', e);
                }
            }

            // Testimonials Section
            if (this.homePageSettings.testimonials_overline) {
                this.testimonialsOverline = this.homePageSettings.testimonials_overline;
            }
            if (this.homePageSettings.testimonials_title) {
                this.testimonialsTitle = this.homePageSettings.testimonials_title;
            }
            if (this.homePageSettings.testimonials_subtitle) {
                this.testimonialsSubtitle = this.homePageSettings.testimonials_subtitle;
            }
            if (this.homePageSettings.testimonials_data) {
                try {
                    const testimonials = typeof this.homePageSettings.testimonials_data === 'string'
                        ? JSON.parse(this.homePageSettings.testimonials_data)
                        : this.homePageSettings.testimonials_data;
                    if (Array.isArray(testimonials) && testimonials.length > 0) {
                        this.testimonials = testimonials;
                    }
                } catch (e) {
                    console.warn('Error parsing testimonials_data:', e);
                }
            }

            // Featured Products Section
            if (this.homePageSettings.products_overline) {
                this.productsOverline = this.homePageSettings.products_overline;
            }
            if (this.homePageSettings.products_title) {
                this.productsTitle = this.homePageSettings.products_title;
            }
            if (this.homePageSettings.products_button_text) {
                this.productsButtonText = this.homePageSettings.products_button_text;
            }
            if (this.homePageSettings.products_button_link) {
                this.productsButtonLink = this.homePageSettings.products_button_link;
            }

            // CTA Section
            if (this.homePageSettings.cta_title) {
                this.ctaTitle = this.homePageSettings.cta_title;
            }
            if (this.homePageSettings.cta_subtitle) {
                this.ctaSubtitle = this.homePageSettings.cta_subtitle;
            }
            if (this.homePageSettings.cta_primary_button_text) {
                this.ctaPrimaryButtonText = this.homePageSettings.cta_primary_button_text;
            }
            if (this.homePageSettings.cta_primary_button_link) {
                try {
                    const link = typeof this.homePageSettings.cta_primary_button_link === 'string'
                        ? JSON.parse(this.homePageSettings.cta_primary_button_link)
                        : this.homePageSettings.cta_primary_button_link;
                    this.ctaPrimaryButtonLink = link;
                } catch (e) {
                    this.ctaPrimaryButtonLink = this.homePageSettings.cta_primary_button_link;
                }
            }
            if (this.homePageSettings.cta_secondary_button_text) {
                this.ctaSecondaryButtonText = this.homePageSettings.cta_secondary_button_text;
            }
            if (this.homePageSettings.cta_secondary_button_link) {
                try {
                    const link = typeof this.homePageSettings.cta_secondary_button_link === 'string'
                        ? JSON.parse(this.homePageSettings.cta_secondary_button_link)
                        : this.homePageSettings.cta_secondary_button_link;
                    this.ctaSecondaryButtonLink = link;
                } catch (e) {
                    this.ctaSecondaryButtonLink = this.homePageSettings.cta_secondary_button_link;
                }
            }
        }
    }
};
</script>

<style scoped>
/* Home page specific styles if needed */
</style>
