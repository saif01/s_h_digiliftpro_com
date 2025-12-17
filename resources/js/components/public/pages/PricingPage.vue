<template>
    <div class="pricing-page">
        <!-- Page Header -->
        <v-container class="py-12">
            <v-row justify="center">
                <v-col cols="12" md="10" lg="8">
                    <div class="text-center mb-12">
                        <h1 class="text-h3 text-md-h2 font-weight-bold mb-4">
                            Simple, Transparent Pricing
                        </h1>
                        <p class="text-h6 text-grey-darken-1">
                            Choose a plan that fits your needs. Clear scope, measurable results, and dedicated support.
                        </p>
                    </div>
                </v-col>
            </v-row>

            <!-- Pricing Plans -->
            <v-row justify="center">
                <!-- Starter Plan -->
                <v-col cols="12" md="6" lg="4">
                    <v-card class="pricing-card h-100" elevation="3">
                        <v-card-title class="text-center py-6 bg-grey-lighten-4">
                            <div>
                                <h3 class="text-h5 font-weight-bold">Starter</h3>
                                <p class="text-body-2 text-grey-darken-1 mt-2">Perfect for small businesses</p>
                            </div>
                        </v-card-title>

                        <v-card-text class="pa-6">
                            <div class="text-center mb-6">
                                <div class="text-h6 text-grey-darken-1">Starting at</div>
                                <div class="text-h3 font-weight-bold primary--text my-2">Custom Quote</div>
                                <div class="text-body-2 text-grey">Based on project scope</div>
                            </div>

                            <v-divider class="mb-4"></v-divider>

                            <div class="features-list">
                                <div v-for="(feature, index) in starterFeatures" :key="index"
                                    class="d-flex align-start mb-3">
                                    <v-icon color="success" class="mr-2">mdi-check-circle</v-icon>
                                    <span class="text-body-2">{{ feature }}</span>
                                </div>
                            </div>
                        </v-card-text>

                        <v-card-actions class="pa-6 pt-0">
                            <v-btn block color="primary" variant="outlined" size="large" to="/contact">
                                Get Started
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-col>

                <!-- Business Plan -->
                <v-col cols="12" md="6" lg="4">
                    <v-card class="pricing-card pricing-card-featured h-100" elevation="8">
                        <v-chip color="primary" class="popular-badge" size="small">Most Popular</v-chip>

                        <v-card-title class="text-center py-6 bg-primary text-white">
                            <div>
                                <h3 class="text-h5 font-weight-bold">Business</h3>
                                <p class="text-body-2 mt-2">Website + SEO + Support</p>
                            </div>
                        </v-card-title>

                        <v-card-text class="pa-6">
                            <div class="text-center mb-6">
                                <div class="text-h6 text-grey-darken-1">Starting at</div>
                                <div class="text-h3 font-weight-bold primary--text my-2">Custom Quote</div>
                                <div class="text-body-2 text-grey">Based on project scope</div>
                            </div>

                            <v-divider class="mb-4"></v-divider>

                            <div class="features-list">
                                <div v-for="(feature, index) in businessFeatures" :key="index"
                                    class="d-flex align-start mb-3">
                                    <v-icon color="success" class="mr-2">mdi-check-circle</v-icon>
                                    <span class="text-body-2">{{ feature }}</span>
                                </div>
                            </div>
                        </v-card-text>

                        <v-card-actions class="pa-6 pt-0">
                            <v-btn block color="primary" size="large" to="/contact">
                                Get Started
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-col>

                <!-- Pro Plan -->
                <v-col cols="12" md="6" lg="4">
                    <v-card class="pricing-card h-100" elevation="3">
                        <v-card-title class="text-center py-6 bg-grey-lighten-4">
                            <div>
                                <h3 class="text-h5 font-weight-bold">Pro</h3>
                                <p class="text-body-2 text-grey-darken-1 mt-2">Complete digital solution</p>
                            </div>
                        </v-card-title>

                        <v-card-text class="pa-6">
                            <div class="text-center mb-6">
                                <div class="text-h6 text-grey-darken-1">Starting at</div>
                                <div class="text-h3 font-weight-bold primary--text my-2">Custom Quote</div>
                                <div class="text-body-2 text-grey">Based on project scope</div>
                            </div>

                            <v-divider class="mb-4"></v-divider>

                            <div class="features-list">
                                <div v-for="(feature, index) in proFeatures" :key="index"
                                    class="d-flex align-start mb-3">
                                    <v-icon color="success" class="mr-2">mdi-check-circle</v-icon>
                                    <span class="text-body-2">{{ feature }}</span>
                                </div>
                            </div>
                        </v-card-text>

                        <v-card-actions class="pa-6 pt-0">
                            <v-btn block color="primary" variant="outlined" size="large" to="/contact">
                                Get Started
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-col>
            </v-row>

            <!-- Custom Solutions -->
            <v-row justify="center" class="mt-8">
                <v-col cols="12" md="10" lg="8">
                    <v-card class="pa-6" elevation="2" color="primary-lighten-5">
                        <v-card-text class="text-center">
                            <v-icon size="48" color="primary" class="mb-4">mdi-cog-outline</v-icon>
                            <h3 class="text-h5 font-weight-bold mb-3">Custom Solutions</h3>
                            <p class="text-body-1 mb-4">
                                Need a CRM, ERP, or custom automation system? We build tailored solutions for complex
                                business needs.
                            </p>
                            <v-btn color="primary" size="large" to="/contact">
                                Request Custom Quote
                            </v-btn>
                        </v-card-text>
                    </v-card>
                </v-col>
            </v-row>

            <!-- FAQ Section -->
            <v-row justify="center" class="mt-12">
                <v-col cols="12" md="10" lg="8">
                    <h2 class="text-h4 font-weight-bold text-center mb-8">Frequently Asked Questions</h2>

                    <v-expansion-panels variant="accordion">
                        <v-expansion-panel v-for="(faq, index) in faqs" :key="index">
                            <v-expansion-panel-title>
                                <strong>{{ faq.question }}</strong>
                            </v-expansion-panel-title>
                            <v-expansion-panel-text>
                                {{ faq.answer }}
                            </v-expansion-panel-text>
                        </v-expansion-panel>
                    </v-expansion-panels>
                </v-col>
            </v-row>
        </v-container>

        <!-- CTA Section -->
        <v-container class="py-12 bg-grey-lighten-4">
            <v-row justify="center">
                <v-col cols="12" md="8" class="text-center">
                    <h2 class="text-h4 font-weight-bold mb-4">
                        Ready to get started?
                    </h2>
                    <p class="text-h6 mb-6">
                        Let's discuss your project and find the perfect solution for your business.
                    </p>
                    <v-btn color="primary" size="large" to="/contact">
                        Book a Free Consultation
                    </v-btn>
                </v-col>
            </v-row>
        </v-container>
    </div>
</template>

<script>
export default {
    name: 'PricingPage',
    data() {
        return {
            starterFeatures: [
                'Business website or landing page',
                'Mobile-responsive design',
                'Up to 5-7 pages',
                'Basic SEO setup',
                'Contact form integration',
                'SSL certificate setup',
                '30 days post-launch support'
            ],
            businessFeatures: [
                'Everything in Starter',
                'Advanced website (10-15 pages)',
                'Technical SEO audit & fixes',
                'On-page SEO optimization',
                'Google Analytics & Search Console',
                'Email service setup',
                'Monthly maintenance & updates',
                '90 days priority support'
            ],
            proFeatures: [
                'Everything in Business',
                'Web application or dashboard',
                'Custom admin panel',
                'API integrations',
                'Hosting & domain management',
                'Advanced security setup',
                'Performance optimization',
                'Ongoing support & monitoring',
                'Analytics & reporting'
            ],
            faqs: [
                {
                    question: 'How is pricing determined?',
                    answer: 'Pricing depends on project scope, features, complexity, timeline, and support requirements. We provide detailed quotes after understanding your specific needs.'
                },
                {
                    question: 'What is included in support?',
                    answer: 'Support includes bug fixes, security updates, performance monitoring, backup management, and technical assistance during business hours.'
                },
                {
                    question: 'Do you offer payment plans?',
                    answer: 'Yes, we offer flexible payment terms with milestone-based payments for larger projects. Contact us to discuss options.'
                },
                {
                    question: 'Can I upgrade my plan later?',
                    answer: 'Absolutely! You can start with a basic package and add features or upgrade to a higher tier as your business grows.'
                },
                {
                    question: 'What technologies do you use?',
                    answer: 'We work with modern technologies including Laravel, Vue.js, React, WordPress, and more. We choose the best stack based on your project requirements.'
                },
                {
                    question: 'How long does a typical project take?',
                    answer: 'Timeline varies by project: Basic websites take 2-4 weeks, business sites 4-8 weeks, and custom web applications 8-16+ weeks depending on complexity.'
                }
            ]
        };
    }
};
</script>

<style scoped>
.pricing-page {
    min-height: 60vh;
}

.pricing-card {
    transition: transform 0.3s ease;
    position: relative;
}

.pricing-card:hover {
    transform: translateY(-8px);
}

.pricing-card-featured {
    border: 2px solid rgb(var(--v-theme-primary));
}

.popular-badge {
    position: absolute;
    top: 12px;
    right: 12px;
    z-index: 1;
}

.features-list {
    min-height: 280px;
}
</style>

