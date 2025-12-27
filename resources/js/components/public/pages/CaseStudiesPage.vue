<template>
    <div class="case-studies-page">
        <!-- Page Header -->
        <v-container class="py-12">
            <v-row justify="center">
                <v-col cols="12" md="10" lg="8">
                    <div class="text-center mb-8">
                        <h1 class="text-h3 text-md-h2 font-weight-bold mb-4">
                            Case Studies
                        </h1>
                        <p class="text-h6 text-grey-darken-1">
                            Real projects, real results. See how we help businesses grow with websites, SEO, and digital
                            management.
                        </p>
                    </div>
                </v-col>
            </v-row>

            <!-- Case Studies List -->
            <v-row v-if="loading" justify="center" class="my-12">
                <v-col cols="12" class="text-center">
                    <v-progress-circular indeterminate color="primary" size="64"></v-progress-circular>
                    <p class="mt-4 text-grey">Loading case studies...</p>
                </v-col>
            </v-row>

            <v-row v-else-if="caseStudies.length > 0">
                <v-col v-for="study in caseStudies" :key="study.id" cols="12" md="6" lg="4">
                    <v-card class="case-study-card h-100" elevation="2" hover>
                        <v-img :src="study.image ? resolveImageUrl(study.image) : defaultImage" height="240" cover
                            class="case-study-image"></v-img>

                        <v-card-title class="text-h6 font-weight-bold">
                            {{ study.title }}
                        </v-card-title>

                        <v-card-subtitle v-if="study.client" class="text-body-2">
                            {{ study.client }}
                        </v-card-subtitle>

                        <v-card-text>
                            <p class="text-body-2 mb-3">{{ study.summary }}</p>

                            <!-- Results/Metrics -->
                            <div v-if="study.results" class="results-section">
                                <v-divider class="mb-3"></v-divider>
                                <div class="d-flex flex-wrap gap-2">
                                    <v-chip v-for="(result, index) in study.results" :key="index" size="small"
                                        color="success" variant="tonal">
                                        {{ result }}
                                    </v-chip>
                                </div>
                            </div>
                        </v-card-text>

                        <v-card-actions>
                            <v-btn color="primary" variant="text" :to="`/case-studies/${study.slug}`">
                                Read Full Case Study
                                <v-icon end>mdi-arrow-right</v-icon>
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-col>
            </v-row>

            <v-row v-else>
                <v-col cols="12" class="text-center py-12">
                    <v-icon size="80" color="grey-lighten-1">mdi-file-document-outline</v-icon>
                    <p class="text-h6 text-grey mt-4">No case studies available yet.</p>
                    <p class="text-body-1 text-grey">Check back soon for real-world success stories.</p>
                </v-col>
            </v-row>
        </v-container>

        <!-- CTA Section -->
        <v-container class="py-12 bg-primary-lighten-5">
            <v-row justify="center">
                <v-col cols="12" md="8" class="text-center">
                    <h2 class="text-h4 font-weight-bold mb-4">
                        Want similar results for your business?
                    </h2>
                    <p class="text-h6 mb-6">
                        Let's discuss your project and create a solution that drives real growth.
                    </p>
                    <v-btn color="primary" size="large" to="/contact" class="mr-2">
                        Get Started
                    </v-btn>
                    <v-btn color="primary" variant="outlined" size="large" to="/products">
                        View Our Work
                    </v-btn>
                </v-col>
            </v-row>
        </v-container>
    </div>
</template>

<script>
import { resolveUploadUrl } from '../../../utils/uploads';

export default {
    name: 'CaseStudiesPage',
    data() {
        return {
            loading: false,
            defaultImage: 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=800&h=600&fit=crop&auto=format', // Business/Project placeholder
            caseStudies: [
                // Placeholder data - replace with API call
                {
                    id: 1,
                    title: 'E-commerce Platform Redesign',
                    slug: 'ecommerce-platform-redesign',
                    client: 'Retail Client',
                    image: '/assets/img/case-study-ecommerce.jpg', // E-commerce/Shopping
                    summary: 'Complete redesign and performance optimization of an e-commerce platform, resulting in improved conversion rates and user experience.',
                    results: ['40% faster load time', '25% increase in conversions', 'SEO rank improved']
                },
                {
                    id: 2,
                    title: 'CRM System Development',
                    slug: 'crm-system-development',
                    client: 'Manufacturing Company',
                    image: '/assets/img/case-study-crm.jpg', // Business Dashboard/CRM
                    summary: 'Custom CRM solution built to streamline operations, automate workflows, and improve customer relationship management.',
                    results: ['50% time saved', 'Automated reporting', 'Real-time analytics']
                },
                {
                    id: 3,
                    title: 'SEO & Digital Marketing Campaign',
                    slug: 'seo-digital-marketing-campaign',
                    client: 'Education Sector',
                    image: '/assets/img/case-study-seo.jpg', // Analytics/Marketing
                    summary: 'Comprehensive SEO strategy and implementation that increased organic traffic and improved search engine rankings.',
                    results: ['200% traffic increase', 'Top 3 rankings', '10x lead generation']
                }
            ]
        };
    },
    mounted() {
        // TODO: Load case studies from API
        // this.loadCaseStudies();
    },
    methods: {
        resolveImageUrl(imageValue) {
            return resolveUploadUrl(imageValue);
        },
        async loadCaseStudies() {
            this.loading = true;
            try {
                // const response = await this.$axios.get('/api/openapi/case-studies');
                // this.caseStudies = response.data.data || response.data;
            } catch (error) {
                console.error('Error loading case studies:', error);
            } finally {
                this.loading = false;
            }
        }
    }
};
</script>

<style scoped>
.case-studies-page {
    min-height: 60vh;
}

.case-study-card {
    transition: transform 0.3s ease;
}

.case-study-card:hover {
    transform: translateY(-4px);
}

.case-study-image {
    border-bottom: 1px solid #e0e0e0;
}

.case-study-image-default :deep(img) {
    transform: scale(1.1);
    transform-origin: center center;
}

.results-section {
    margin-top: 8px;
}

.gap-2 {
    gap: 8px;
}
</style>
