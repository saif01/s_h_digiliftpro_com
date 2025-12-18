<template>
    <div class="product-detail-page">
        <!-- Modern Hero Section with Gradient -->
        <section class="software-hero">
            <div class="hero-gradient"></div>
            <div class="hero-pattern"></div>

            <v-container class="hero-content">
                <v-row>
                    <v-col cols="12">
                        <!-- Breadcrumbs -->
                        <v-breadcrumbs :items="breadcrumbs" class="px-0 mb-6 breadcrumb-modern">
                            <template v-slot:divider>
                                <v-icon icon="mdi-chevron-right" size="small"></v-icon>
                            </template>
                        </v-breadcrumbs>
                    </v-col>
                </v-row>

                <v-row align="center" class="hero-main">
                    <v-col cols="12" lg="6" class="hero-text">
                        <!-- Product Badges -->
                        <div class="d-flex align-center gap-2 mb-6 flex-wrap">
                            <v-chip v-if="product.featured" color="gradient-primary" variant="flat" size="small"
                                prepend-icon="mdi-star" class="chip-modern">
                                FEATURED
                            </v-chip>
                            <v-chip v-if="product.discount_percent > 0" color="error" variant="flat" size="small"
                                prepend-icon="mdi-tag-outline" class="chip-modern">
                                {{ Math.round(parseFloat(product.discount_percent)) }}% OFF
                            </v-chip>
                            <v-chip color="primary" variant="outlined" size="small" class="chip-modern">
                                {{ getCategoryName(product) }}
                            </v-chip>
                            <v-chip v-if="product.version" color="success" variant="tonal" size="small"
                                prepend-icon="mdi-information-outline" class="chip-modern">
                                v{{ product.version || '1.0.0' }}
                            </v-chip>
                        </div>

                        <!-- Product Title -->
                        <h1 class="product-title mb-4">
                            {{ product.title }}
                        </h1>

                        <!-- Product Description -->
                        <p class="product-description mb-6">
                            {{ product.short_description || product.description }}
                        </p>

                        <!-- Quick Info -->
                        <div class="quick-info mb-8">
                            <div class="info-item" v-if="product.rating && product.rating > 0">
                                <v-rating :model-value="parseFloat(product.rating)" color="amber-darken-1"
                                    density="compact" half-increments readonly size="small">
                                </v-rating>
                                <span class="info-text ml-2">
                                    {{ parseFloat(product.rating).toFixed(1) }}
                                    <span class="text-medium-emphasis">({{ product.rating_count || 0 }})</span>
                                </span>
                            </div>
                            <div class="info-item" v-if="product.brand">
                                <v-icon icon="mdi-domain" size="18"></v-icon>
                                <span class="info-text">{{ product.brand }}</span>
                            </div>
                            <div class="info-item">
                                <v-icon icon="mdi-code-tags" size="18"></v-icon>
                                <span class="info-text">SKU: {{ product.sku || 'N/A' }}</span>
                            </div>
                        </div>

                        <!-- CTA Buttons -->
                        <div class="cta-buttons">
                            <v-btn color="primary" size="x-large" rounded="lg" elevation="0"
                                class="px-8 btn-modern btn-primary-gradient" prepend-icon="mdi-download">
                                Download Free Trial
                            </v-btn>
                            <v-btn variant="outlined" color="primary" size="x-large" rounded="lg"
                                class="px-8 btn-modern" prepend-icon="mdi-play-circle-outline">
                                Watch Demo
                            </v-btn>
                            <v-btn variant="text" color="primary" size="large" icon class="btn-icon-modern"
                                @click="openShareMenu">
                                <v-icon>mdi-share-variant</v-icon>
                            </v-btn>
                        </div>
                    </v-col>

                    <v-col cols="12" lg="6" class="hero-visual">
                        <!-- Floating Card with 3D Effect -->
                        <div class="floating-card">
                            <div class="card-glow"></div>
                            <div class="software-preview-card">
                                <img :src="activeImage" alt="Software Preview" class="preview-image" />
                                <div class="preview-overlay">
                                    <v-btn icon variant="flat" color="white" size="large" class="zoom-btn"
                                        @click="showImageZoom = true">
                                        <v-icon color="primary">mdi-magnify-plus</v-icon>
                                    </v-btn>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Stats -->
                        <div class="stats-grid">
                            <div class="stat-card">
                                <v-icon color="primary" size="32">mdi-download</v-icon>
                                <div class="stat-value">10K+</div>
                                <div class="stat-label">Downloads</div>
                            </div>
                            <div class="stat-card">
                                <v-icon color="success" size="32">mdi-account-group</v-icon>
                                <div class="stat-value">5K+</div>
                                <div class="stat-label">Active Users</div>
                            </div>
                            <div class="stat-card">
                                <v-icon color="amber-darken-1" size="32">mdi-star</v-icon>
                                <div class="stat-value">4.8</div>
                                <div class="stat-label">Rating</div>
                            </div>
                        </div>
                    </v-col>
                </v-row>
            </v-container>
        </section>

        <!-- Main Content -->
        <v-container class="content-container">
            <!-- Screenshot Gallery -->
            <section class="gallery-section mb-12">
                <div class="section-header mb-8">
                    <h2 class="section-title">Product Screenshots</h2>
                    <p class="section-subtitle">Explore the interface and key features</p>
                </div>

                <v-row>
                    <v-col cols="12" lg="8">
                        <!-- Main Preview -->
                        <div class="main-preview-wrapper">
                            <div class="preview-card-modern">
                                <img :src="activeImage" alt="Product Screenshot" class="main-preview-img" />
                                <v-btn icon variant="flat" color="white" size="small" class="fullscreen-btn"
                                    @click="showImageZoom = true">
                                    <v-icon size="20" color="primary">mdi-fullscreen</v-icon>
                                </v-btn>
                            </div>

                            <!-- Thumbnail Navigation -->
                            <div class="thumbnails-wrapper">
                                <div v-for="(img, i) in productImages" :key="i" class="thumbnail-item"
                                    :class="{ 'thumbnail-active': activeImage === img }" @click="activeImage = img">
                                    <img :src="img" alt="Thumbnail" />
                                    <div class="thumbnail-overlay"></div>
                                </div>
                            </div>
                        </div>
                    </v-col>

                    <v-col cols="12" lg="4">
                        <!-- Pricing Card -->
                        <div class="pricing-card-modern mb-6">
                            <div class="pricing-header">
                                <div class="pricing-label">Starting at</div>
                                <div class="pricing-amount">
                                    <span v-if="product.discount_percent > 0 && product.discounted_price"
                                        class="price-current">
                                        Tk {{ formatNumber(product.discounted_price) }}
                                    </span>
                                    <span v-else class="price-current">
                                        {{ formatPrice(product) }}
                                    </span>
                                    <span v-if="product.discount_percent > 0 && product.price" class="price-old">
                                        Tk {{ formatNumber(product.price) }}
                                    </span>
                                </div>
                                <div v-if="product.discount_percent > 0" class="savings-badge">
                                    Save {{ Math.round(parseFloat(product.discount_percent)) }}%
                                </div>
                            </div>

                            <div class="pricing-actions">
                                <v-btn color="primary" size="large" block rounded="lg" elevation="0"
                                    class="mb-3 btn-primary-gradient" prepend-icon="mdi-download">
                                    Get Started Free
                                </v-btn>
                                <v-btn variant="outlined" color="primary" size="large" block rounded="lg"
                                    prepend-icon="mdi-cart-outline">
                                    Purchase License
                                </v-btn>
                            </div>

                            <v-divider class="my-6"></v-divider>

                            <!-- What's Included -->
                            <div class="includes-section">
                                <h4 class="includes-title">What's Included</h4>
                                <div class="includes-list">
                                    <div class="include-item">
                                        <v-icon color="success" size="18">mdi-check-circle</v-icon>
                                        <span>Lifetime Updates</span>
                                    </div>
                                    <div class="include-item">
                                        <v-icon color="success" size="18">mdi-check-circle</v-icon>
                                        <span>Technical Support</span>
                                    </div>
                                    <div class="include-item">
                                        <v-icon color="success" size="18">mdi-check-circle</v-icon>
                                        <span>Documentation</span>
                                    </div>
                                    <div class="include-item">
                                        <v-icon color="success" size="18">mdi-check-circle</v-icon>
                                        <span>API Access</span>
                                    </div>
                                </div>
                            </div>

                            <v-divider class="my-6"></v-divider>

                            <!-- Trust Icons -->
                            <div class="trust-icons">
                                <div class="trust-item">
                                    <v-icon color="primary" size="24">mdi-shield-check</v-icon>
                                    <span>Secure</span>
                                </div>
                                <div class="trust-item">
                                    <v-icon color="primary" size="24">mdi-update</v-icon>
                                    <span>Updates</span>
                                </div>
                                <div class="trust-item">
                                    <v-icon color="primary" size="24">mdi-headset</v-icon>
                                    <span>Support</span>
                                </div>
                            </div>
                        </div>

                        <!-- System Requirements Card -->
                        <div class="system-card-modern">
                            <div class="system-header">
                                <v-icon color="primary">mdi-laptop</v-icon>
                                <h4>System Requirements</h4>
                            </div>
                            <div class="system-list">
                                <div class="system-item">
                                    <div class="system-label">OS</div>
                                    <div class="system-value">Windows 10+, macOS 10.14+, Linux</div>
                                </div>
                                <div class="system-item">
                                    <div class="system-label">Memory</div>
                                    <div class="system-value">4 GB RAM minimum</div>
                                </div>
                                <div class="system-item">
                                    <div class="system-label">Storage</div>
                                    <div class="system-value">500 MB available space</div>
                                </div>
                                <div class="system-item">
                                    <div class="system-label">Browser</div>
                                    <div class="system-value">Chrome, Firefox, Safari, Edge</div>
                                </div>
                            </div>
                        </div>
                    </v-col>
                </v-row>
            </section>

            <!-- Key Features Grid -->
            <section class="features-grid-section mb-12">
                <div class="section-header mb-8 text-center">
                    <h2 class="section-title">Key Features</h2>
                    <p class="section-subtitle">Everything you need to succeed</p>
                </div>

                <v-row>
                    <v-col v-for="(feature, i) in keyFeatures" :key="i" cols="12" sm="6" md="4">
                        <div class="feature-card-modern">
                            <div class="feature-icon-wrapper">
                                <v-icon size="32" color="primary">mdi-check-circle</v-icon>
                            </div>
                            <h4 class="feature-title">{{ feature }}</h4>
                            <p class="feature-description">
                                Advanced functionality that enhances your workflow
                            </p>
                        </div>
                    </v-col>
                </v-row>
            </section>

            <!-- Modern Tabs Section -->
            <section class="tabs-section">
                <div class="tabs-card-modern">
                    <v-tabs v-model="tab" color="primary" align-tabs="center" class="modern-tabs">
                        <v-tab value="overview" class="modern-tab">
                            <v-icon class="mr-2">mdi-information-outline</v-icon>
                            Overview
                        </v-tab>
                        <v-tab value="features" class="modern-tab">
                            <v-icon class="mr-2">mdi-star-outline</v-icon>
                            Features
                        </v-tab>
                        <v-tab value="specs" class="modern-tab">
                            <v-icon class="mr-2">mdi-cog-outline</v-icon>
                            Specifications
                        </v-tab>
                        <v-tab value="downloads" class="modern-tab">
                            <v-icon class="mr-2">mdi-download-outline</v-icon>
                            Downloads
                        </v-tab>
                        <v-tab value="faq" class="modern-tab">
                            <v-icon class="mr-2">mdi-help-circle-outline</v-icon>
                            FAQ
                        </v-tab>
                        <v-tab value="reviews" class="modern-tab">
                            <v-icon class="mr-2">mdi-star-outline</v-icon>
                            Reviews
                            <v-chip v-if="product.rating_count" size="x-small" color="primary" class="ml-2">
                                {{ product.rating_count }}
                            </v-chip>
                        </v-tab>
                    </v-tabs>

                    <div class="tab-content-wrapper">
                        <v-window v-model="tab">
                            <!-- Overview Tab -->
                            <v-window-item value="overview">
                                <div class="tab-content-inner">
                                    <div class="overview-content">
                                        <div class="content-block mb-8">
                                            <h3 class="content-title">About This Software</h3>
                                            <div class="content-text" v-html="formattedDescription"></div>
                                        </div>

                                        <div class="benefits-grid">
                                            <h3 class="content-title mb-6">Why Choose This Product?</h3>
                                            <v-row>
                                                <v-col cols="12" md="6" v-for="(benefit, i) in productBenefits"
                                                    :key="i">
                                                    <div class="benefit-card-modern">
                                                        <div class="benefit-icon">
                                                            <v-icon color="primary" size="28">mdi-check-circle</v-icon>
                                                        </div>
                                                        <div class="benefit-content">
                                                            <h4 class="benefit-title">{{ benefit.title }}</h4>
                                                            <p class="benefit-description">{{ benefit.description }}</p>
                                                        </div>
                                                    </div>
                                                </v-col>
                                            </v-row>
                                        </div>

                                        <!-- Integration Section -->
                                        <div class="integration-section mt-8">
                                            <h3 class="content-title mb-6">Integrations & Compatibility</h3>
                                            <div class="integration-grid">
                                                <div class="integration-item">
                                                    <v-icon size="48" color="primary">mdi-api</v-icon>
                                                    <span>REST API</span>
                                                </div>
                                                <div class="integration-item">
                                                    <v-icon size="48" color="primary">mdi-database</v-icon>
                                                    <span>Database</span>
                                                </div>
                                                <div class="integration-item">
                                                    <v-icon size="48" color="primary">mdi-cloud</v-icon>
                                                    <span>Cloud Ready</span>
                                                </div>
                                                <div class="integration-item">
                                                    <v-icon size="48" color="primary">mdi-webhook</v-icon>
                                                    <span>Webhooks</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </v-window-item>

                            <!-- Features Tab -->
                            <v-window-item value="features">
                                <div class="tab-content-inner">
                                    <h3 class="content-title mb-6">Detailed Features</h3>
                                    <v-row>
                                        <v-col cols="12" md="6" lg="4" v-for="(feature, i) in detailedFeatures"
                                            :key="i">
                                            <div class="feature-detail-card">
                                                <div class="feature-detail-icon">
                                                    <v-icon :icon="feature.icon || 'mdi-check-circle'"
                                                        size="36"></v-icon>
                                                </div>
                                                <h4 class="feature-detail-title">{{ feature.title }}</h4>
                                                <p class="feature-detail-description">{{ feature.description }}</p>
                                            </div>
                                        </v-col>
                                    </v-row>
                                </div>
                            </v-window-item>

                            <!-- Technical Specs Tab -->
                            <v-window-item value="specs">
                                <div class="tab-content-inner">
                                    <h3 class="content-title mb-6">Technical Specifications</h3>
                                    <div class="specs-modern-grid">
                                        <div v-for="spec in flattenedSpecifications" :key="spec.key"
                                            class="spec-item-modern">
                                            <div class="spec-label">{{ spec.label }}</div>
                                            <div class="spec-value" v-html="formatSpecValue(spec.value)"></div>
                                        </div>
                                    </div>
                                </div>
                            </v-window-item>

                            <!-- Downloads Tab -->
                            <v-window-item value="downloads">
                                <div class="tab-content-inner">
                                    <h3 class="content-title mb-6">Downloads & Resources</h3>
                                    <v-row>
                                        <v-col cols="12" md="6" lg="4" v-for="(doc, idx) in downloadableFiles"
                                            :key="idx">
                                            <div class="download-card-modern">
                                                <div class="download-icon">
                                                    <v-icon :icon="getFileIcon(doc.type)" size="48"></v-icon>
                                                </div>
                                                <div class="download-info">
                                                    <h4 class="download-title">{{ doc.title }}</h4>
                                                    <div class="download-meta">
                                                        <span>{{ doc.size || 'N/A' }}</span>
                                                        <span>•</span>
                                                        <span>{{ doc.type || 'Document' }}</span>
                                                    </div>
                                                </div>
                                                <v-btn variant="flat" color="primary" size="small" rounded="lg"
                                                    class="download-btn" @click="downloadFile(doc)">
                                                    <v-icon start>mdi-download</v-icon>
                                                    Download
                                                </v-btn>
                                            </div>
                                        </v-col>
                                    </v-row>
                                </div>
                            </v-window-item>

                            <!-- FAQs Tab -->
                            <v-window-item value="faq">
                                <div class="tab-content-inner">
                                    <h3 class="content-title mb-6">Frequently Asked Questions</h3>
                                    <div class="faq-modern-wrapper">
                                        <v-expansion-panels variant="accordion" class="faq-panels-modern">
                                            <v-expansion-panel v-for="(faq, i) in productFAQs" :key="i"
                                                class="faq-panel-modern">
                                                <v-expansion-panel-title class="faq-question">
                                                    <v-icon class="mr-3"
                                                        color="primary">mdi-help-circle-outline</v-icon>
                                                    {{ faq.question }}
                                                </v-expansion-panel-title>
                                                <v-expansion-panel-text class="faq-answer">
                                                    {{ faq.answer }}
                                                </v-expansion-panel-text>
                                            </v-expansion-panel>
                                        </v-expansion-panels>
                                    </div>
                                </div>
                            </v-window-item>

                            <!-- Reviews Tab -->
                            <v-window-item value="reviews">
                                <div class="tab-content-inner">
                                    <ProductReviewSection :product-id="product.id" />
                                </div>
                            </v-window-item>
                        </v-window>
                    </div>
                </div>
            </section>

            <!-- Related Products -->
            <section class="related-products-section">
                <div class="section-header mb-8">
                    <div>
                        <h2 class="section-title">Related Products</h2>
                        <p class="section-subtitle">Explore similar software solutions</p>
                    </div>
                    <v-btn variant="tonal" color="primary" size="large" rounded="lg" :to="'/products'"
                        append-icon="mdi-arrow-right">
                        View All
                    </v-btn>
                </div>

                <v-row>
                    <v-col v-for="item in relatedProducts" :key="item.id" cols="12" sm="6" md="4" lg="3">
                        <div class="related-product-card" @click="$router.push(`/products/${item.slug}`)">
                            <div class="related-product-image">
                                <img :src="getProductImage(item)" alt="Product" />
                                <div class="related-product-overlay">
                                    <v-btn icon variant="flat" color="white" size="small">
                                        <v-icon color="primary">mdi-arrow-right</v-icon>
                                    </v-btn>
                                </div>
                            </div>
                            <div class="related-product-content">
                                <div class="related-product-category">{{ getCategoryName(item) }}</div>
                                <h4 class="related-product-title">{{ item.title }}</h4>
                                <div class="related-product-price">{{ formatPrice(item) }}</div>
                            </div>
                        </div>
                    </v-col>
                </v-row>
            </section>
        </v-container>

        <!-- Image Zoom Dialog -->
        <v-dialog v-model="showImageZoom" max-width="1400" class="zoom-dialog">
            <v-card class="zoom-card">
                <v-btn icon variant="flat" color="white" size="large" class="close-zoom-btn"
                    @click="showImageZoom = false">
                    <v-icon color="grey-darken-2">mdi-close</v-icon>
                </v-btn>
                <div class="zoom-image-wrapper">
                    <img :src="activeImage" alt="Zoomed Image" class="zoom-image" />
                </div>
            </v-card>
        </v-dialog>

        <!-- Share Dialog Component -->
        <ShareDialog v-model="showShareMenu" :title="product.title" :url="productUrl" :share-text="shareText" />
    </div>
</template>

<script>
import ShareDialog from './ShareDialog.vue';
import ProductReviewSection from './ProductReviewSection.vue';
import { resolveUploadUrl } from '../../../utils/uploads';
import { formatNumber as formatNumberUtil, formatProductPrice } from '../../../utils/formatters';

export default {
    name: 'ProductDetailPage',
    components: {
        ShareDialog,
        ProductReviewSection
    },
    data() {
        return {
            tab: 'overview',
            activeImage: '',
            showImageZoom: false,
            showShareMenu: false,
            product: {
                title: 'Loading...',
                price: '0.00',
                images: [],
                specifications: {},
                downloads: [],
                key_features: []
            },
            relatedProducts: [],
            breadcrumbs: [
                { title: 'Home', disabled: false, href: '/' },
                { title: 'Products', disabled: false, href: '/products' },
                { title: 'Loading...', disabled: true, href: '#' },
            ],
            warrantyInfo: {
                period: '2 Years',
                coverage: [
                    'Manufacturing defects',
                    'Component failures',
                    'Normal wear and tear',
                    'Technical support'
                ],
                terms: 'Warranty is valid from the date of purchase. Original purchase receipt required. Warranty does not cover damage caused by misuse, accidents, or unauthorized modifications.'
            },
            serviceInfo: [
                {
                    icon: 'mdi-headset',
                    title: '24/7 Technical Support',
                    description: 'Round-the-clock assistance for all your technical queries and troubleshooting needs.'
                },
                {
                    icon: 'mdi-tools',
                    title: 'On-Site Service',
                    description: 'Professional technicians available for on-site installation and maintenance.'
                },
                {
                    icon: 'mdi-truck-fast',
                    title: 'Fast Replacement',
                    description: 'Quick replacement service for defective units under warranty.'
                },
                {
                    icon: 'mdi-school',
                    title: 'Training & Documentation',
                    description: 'Comprehensive training materials and documentation for optimal product usage.'
                }
            ]
        };
    },
    computed: {
        productImages() {
            if (this.product.images && Array.isArray(this.product.images) && this.product.images.length > 0) {
                return this.product.images;
            }
            if (this.product.thumbnail) {
                return [this.product.thumbnail];
            }
            return ['/assets/img/default.jpg'];
        },
        keyFeatures() {
            if (this.product.key_features && Array.isArray(this.product.key_features)) {
                return this.product.key_features;
            }
            // Check in specifications
            if (this.product.specifications?._key_features && Array.isArray(this.product.specifications._key_features)) {
                return this.product.specifications._key_features;
            }
            // Extract from description or use defaults
            return [
                'High Performance',
                'Reliable Design',
                'Energy Efficient',
                'Easy Installation'
            ];
        },
        quickSpecs() {
            const specs = {};
            if (this.product.specifications) {
                const quickKeys = ['capacity', 'input', 'output', 'type', 'voltage', 'power'];
                quickKeys.forEach(key => {
                    if (this.product.specifications[key]) {
                        specs[key] = this.product.specifications[key];
                    }
                });
            }
            return Object.keys(specs).length > 0 ? specs : {
                'Type': 'Industrial Grade',
                'Category': this.getCategoryName(this.product),
                'Warranty': '2 Years'
            };
        },
        allSpecifications() {
            return this.product.specifications || {};
        },
        flattenedSpecifications() {
            const specs = [];
            if (!this.product.specifications || typeof this.product.specifications !== 'object') {
                return specs;
            }

            // Exclude special fields that are handled in other tabs
            const excludedKeys = ['_key_features', '_faqs', '_warranty_info'];

            const flatten = (obj, parentKey = '', parentLabel = '') => {
                Object.entries(obj).forEach(([key, value]) => {
                    // Skip excluded keys
                    if (excludedKeys.includes(key)) {
                        return;
                    }

                    const keyPath = parentKey ? `${parentKey}.${key}` : key;
                    const label = parentLabel ? `${parentLabel} > ${this.formatSpecLabel(key)}` : this.formatSpecLabel(key);

                    if (value && typeof value === 'object' && !Array.isArray(value)) {
                        // Recursively flatten nested objects
                        flatten(value, keyPath, label);
                    } else {
                        // Add leaf node
                        specs.push({ key: keyPath, label, value });
                    }
                });
            };

            flatten(this.product.specifications);
            return specs;
        },
        productWarrantyInfo() {
            if (this.product.specifications?._warranty_info && typeof this.product.specifications._warranty_info === 'object') {
                return this.product.specifications._warranty_info;
            }
            return null;
        },
        formattedDescription() {
            if (this.product.description) {
                return this.product.description.replace(/\n/g, '<br>');
            }
            return this.product.short_description || 'No description available.';
        },
        productBenefits() {
            return [
                {
                    title: 'Superior Performance',
                    description: 'Engineered for maximum efficiency and reliability in demanding environments.'
                },
                {
                    title: 'Advanced Technology',
                    description: 'Incorporates the latest innovations for optimal performance and longevity.'
                },
                {
                    title: 'Easy Integration',
                    description: 'Designed to seamlessly integrate with your existing infrastructure.'
                },
                {
                    title: 'Comprehensive Support',
                    description: 'Backed by expert technical support and comprehensive documentation.'
                }
            ];
        },
        detailedFeatures() {
            const features = [];
            const keyFeatures = this.keyFeatures;

            if (keyFeatures && keyFeatures.length > 0) {
                keyFeatures.forEach((feature) => {
                    features.push({
                        title: feature,
                        description: `This product includes ${feature.toLowerCase()} for enhanced performance and reliability.`,
                        icon: 'mdi-check-circle'
                    });
                });
            }

            if (features.length === 0) {
                return [
                    { title: 'High Performance', description: 'Optimized for maximum output and efficiency.', icon: 'mdi-speedometer' },
                    { title: 'Reliable Design', description: 'Built to last with quality components.', icon: 'mdi-shield-check' },
                    { title: 'Energy Efficient', description: 'Designed to minimize power consumption.', icon: 'mdi-lightning-bolt' },
                    { title: 'Easy Installation', description: 'Simple setup process with clear instructions.', icon: 'mdi-tools' }
                ];
            }
            return features;
        },
        downloadableFiles() {
            if (this.product.downloads && Array.isArray(this.product.downloads) && this.product.downloads.length > 0) {
                return this.product.downloads.map(doc => ({
                    title: doc.title || doc.name || 'Document',
                    type: doc.type || 'PDF',
                    size: doc.size || 'N/A',
                    url: doc.url || doc.path || '#'
                }));
            }
            // Default downloads
            return [
                { title: 'Product Datasheet', type: 'PDF', size: '1.2 MB', url: '#' },
                { title: 'User Manual', type: 'PDF', size: '2.4 MB', url: '#' },
                { title: 'Installation Guide', type: 'PDF', size: '800 KB', url: '#' }
            ];
        },
        productFAQs() {
            // Use FAQs from product specifications if available
            if (this.product.specifications?._faqs && Array.isArray(this.product.specifications._faqs) && this.product.specifications._faqs.length > 0) {
                return this.product.specifications._faqs.map(faq => ({
                    question: faq.question || 'Question',
                    answer: faq.answer || 'Answer'
                }));
            }
            // Default FAQs
            return [
                {
                    question: 'What is the warranty period for this product?',
                    answer: 'This product comes with a 2-year warranty covering manufacturing defects and component failures. Please refer to the warranty section for complete details.'
                },
                {
                    question: 'How do I install this product?',
                    answer: 'Installation instructions are included in the user manual. For complex installations, we recommend contacting our technical support team or scheduling an on-site service.'
                },
                {
                    question: 'What are the power requirements?',
                    answer: 'Power requirements vary by model. Please refer to the technical specifications table for detailed electrical requirements.'
                },
                {
                    question: 'Is technical support available?',
                    answer: 'Yes, we provide 24/7 technical support via phone, email, and live chat. Our support team is ready to assist with any questions or issues.'
                },
                {
                    question: 'Can I get a custom quote?',
                    answer: 'Absolutely! Click the "Request Quote" button to submit your requirements, and our sales team will provide a customized quote within 24 hours.'
                }
            ];
        },
        productUrl() {
            const baseUrl = window.location.origin;
            return `${baseUrl}/products/${this.product.slug || this.$route.params.slug}`;
        },
        shareText() {
            const title = this.product.title || 'Product';
            const description = this.product.short_description || '';
            const price = this.formatPrice(this.product);
            return `Check out ${title}${description ? ` - ${description}` : ''}${price ? ` - ${price}` : ''}`;
        }
    },
    mounted() {
        this.loadProduct();
    },
    watch: {
        '$route.params.slug': 'loadProduct'
    },
    methods: {
        async loadProduct() {
            const slug = this.$route.params.slug;
            try {
                const response = await this.$axios.get(`/api/openapi/products/${slug}`);
                this.product = response.data || {};
                this.activeImage = this.productImages[0];
                this.breadcrumbs[2].title = this.product.title;
                await this.loadRelatedProducts();
            } catch (error) {
                console.error('Error loading product:', error);
                // Fallback mock data
                const title = slug ? slug.split('-').map(w => w.charAt(0).toUpperCase() + w.slice(1)).join(' ') : 'Product Title';
                this.product = {
                    title: title,
                    sku: 'MCT-UPS-2000X',
                    price: '499.00',
                    oldPrice: '599.00',
                    rating: 4.5,
                    reviewCount: 24,
                    featured: true,
                    short_description: 'Professional-grade Uninterruptible Power Supply with double-conversion technology.',
                    description: `The ${title} is engineered for the most demanding IT environments. It features true online double-conversion topology, which provides the highest level of power protection by isolating your equipment from raw utility power.`,
                    images: [
                        'https://via.placeholder.com/600x600?text=Main+Product',
                        'https://via.placeholder.com/600x600?text=Side+View',
                        'https://via.placeholder.com/600x600?text=Back+Panel'
                    ],
                    specifications: {
                        'Capacity': '2000VA / 1800W',
                        'Input Voltage': '110-300 VAC',
                        'Output Voltage': '208/220/230/240 VAC',
                        'Frequency Range': '40Hz ~ 70Hz',
                        'Battery Type': '12V / 9Ah',
                        'Recharge Time': '4 hours to 90%',
                        'Noise Level': 'Less than 50dBA',
                        'Dimensions': '190 x 318 x 421 mm',
                        'Weight': '15.5 kg'
                    },
                    key_features: [
                        'True Online Double-Conversion',
                        'Output Power Factor 0.9',
                        'User-Friendly LCD Display',
                        'ECO Mode for Energy Saving'
                    ],
                    categories: [{ id: 1, name: 'UPS Systems' }]
                };
                this.activeImage = this.productImages[0];
                this.breadcrumbs[2].title = title;
            }
        },
        async loadRelatedProducts() {
            try {
                const response = await this.$axios.get('/api/openapi/products');
                const allProducts = response.data || [];
                // Filter out current product and get related ones
                this.relatedProducts = allProducts
                    .filter(p => p.id !== this.product.id && p.slug !== this.product.slug)
                    .slice(0, 4);
            } catch (error) {
                console.error('Error loading related products:', error);
                this.relatedProducts = [];
            }
        },
        formatNumber(value) {
            return formatNumberUtil(value);
        },
        formatPrice(product) {
            return formatProductPrice(product, 'Contact for Price');
        },
        formatSpecLabel(key) {
            return key
                .replace(/_/g, ' ')
                .split(' ')
                .map(word => word.charAt(0).toUpperCase() + word.slice(1))
                .join(' ');
        },
        formatSpecValue(value) {
            if (value === null || value === undefined || value === '') {
                return '<span class="text-medium-emphasis">N/A</span>';
            }

            // Handle arrays
            if (Array.isArray(value)) {
                if (value.length === 0) {
                    return '<span class="text-medium-emphasis">N/A</span>';
                }

                // Check if array contains objects
                const hasObjects = value.some(item => typeof item === 'object' && item !== null);
                if (hasObjects) {
                    // Format array of objects
                    return value
                        .map((item, idx) => {
                            if (item && typeof item === 'object') {
                                const entries = Object.entries(item)
                                    .map(([k, v]) => `<strong>${this.formatSpecLabel(k)}:</strong> ${this.formatSpecValue(v)}`)
                                    .join('; ');
                                return `${idx + 1}. ${entries}`;
                            }
                            return `${idx + 1}. ${this.formatSpecValue(item)}`;
                        })
                        .join('<br>');
                }

                // Simple array - join with commas
                return value.map(v => this.escapeHtml(String(v))).join(', ');
            }

            // Handle objects
            if (typeof value === 'object') {
                return Object.entries(value)
                    .map(([k, v]) => {
                        const formattedKey = this.formatSpecLabel(k);
                        const formattedValue = this.formatSpecValue(v);
                        return `<div class="mb-1"><strong>${formattedKey}:</strong> ${formattedValue}</div>`;
                    })
                    .join('');
            }

            // Handle boolean values
            if (typeof value === 'boolean') {
                return value ? '<span class="text-success">Yes</span>' : '<span class="text-error">No</span>';
            }

            // Simple value - escape HTML
            return this.escapeHtml(String(value));
        },
        escapeHtml(text) {
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        },
        getCategoryName(product) {
            if (product.categories && product.categories.length > 0) {
                return product.categories[0].name;
            }
            return 'Uncategorized';
        },
        getProductImage(product) {
            if (product.thumbnail) return resolveUploadUrl(product.thumbnail);
            if (product.images && product.images.length > 0) return resolveUploadUrl(product.images[0]);
            return '/assets/img/default.jpg';
        },
        getFileIcon(type) {
            const iconMap = {
                'PDF': 'mdi-file-pdf-box',
                'ZIP': 'mdi-folder-zip',
                'DOC': 'mdi-file-word',
                'DOCX': 'mdi-file-word',
                'XLS': 'mdi-file-excel',
                'XLSX': 'mdi-file-excel'
            };
            return iconMap[type?.toUpperCase()] || 'mdi-file-document-outline';
        },
        downloadFile(doc) {
            if (doc.url && doc.url !== '#') {
                window.open(doc.url, '_blank');
            } else {
                // Handle download logic
                console.log('Download:', doc);
            }
        },
        openShareMenu() {
            // Check if Web Share API is available (mobile devices)
            if (navigator.share) {
                navigator.share({
                    title: this.product.title,
                    text: this.shareText,
                    url: this.productUrl
                }).catch((error) => {
                    // User cancelled or error occurred, show share menu instead
                    if (error.name !== 'AbortError') {
                        this.showShareMenu = true;
                    }
                });
            } else {
                this.showShareMenu = true;
            }
        },
        // Helper function to get availability color
        getAvailabilityColorDetail(availability) {
            const colorMap = {
                'in_stock': 'success',
                'out_of_stock': 'error',
                'pre_order': 'warning',
                'coming_soon': 'info'
            };
            return colorMap[availability] || 'success';
        },
        // Helper function to get availability label
        getAvailabilityLabelDetail(availability) {
            const labelMap = {
                'in_stock': 'In Stock',
                'out_of_stock': 'Out of Stock',
                'pre_order': 'Pre-Order',
                'coming_soon': 'Coming Soon'
            };
            return labelMap[availability] || availability;
        },
        // Helper function to get availability icon
        getAvailabilityIconDetail(availability) {
            const iconMap = {
                'in_stock': 'mdi-check-circle',
                'out_of_stock': 'mdi-close-circle',
                'pre_order': 'mdi-clock-outline',
                'coming_soon': 'mdi-new-box'
            };
            return iconMap[availability] || 'mdi-help-circle';
        }
    }
};
</script>

<style scoped>
/* ===================================
   MODERN SOFTWARE PRODUCT DETAIL PAGE
   =================================== */

.product-detail-page {
    background: linear-gradient(180deg, #f8fafc 0%, #ffffff 100%);
    min-height: 100vh;
    -webkit-overflow-scrolling: touch;
}

/* Touch-friendly adjustments */
* {
    -webkit-tap-highlight-color: transparent;
}

button,
a {
    -webkit-tap-highlight-color: rgba(var(--v-theme-primary), 0.1);
}

/* ===================================
   HERO SECTION - MODERN GRADIENT
   =================================== */

.software-hero {
    position: relative;
    min-height: 600px;
    display: flex;
    align-items: center;
    overflow: hidden;
    padding: 60px 0 80px;
}

.hero-gradient {
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg,
            rgb(var(--v-theme-primary)) 0%,
            rgb(var(--v-theme-secondary)) 50%,
            rgb(var(--v-theme-primary)) 100%);
    opacity: 0.95;
}

.hero-pattern {
    position: absolute;
    inset: 0;
    background-image:
        radial-gradient(circle at 20% 50%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 80% 80%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
    background-size: 100% 100%;
}

.hero-content {
    position: relative;
    z-index: 2;
}

.breadcrumb-modern {
    opacity: 0.9;
}

.breadcrumb-modern :deep(.v-breadcrumbs-item) {
    color: rgba(255, 255, 255, 0.9);
}

.breadcrumb-modern :deep(.v-breadcrumbs-divider) {
    color: rgba(255, 255, 255, 0.6);
}

.hero-main {
    margin-top: 24px;
}

.hero-text {
    color: white;
}

.chip-modern {
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-size: 0.7rem;
    padding: 4px 10px;
    height: auto;
}

.product-title {
    font-size: clamp(1.75rem, 5vw, 3rem);
    font-weight: 800;
    line-height: 1.2;
    margin-bottom: 1rem;
    color: white;
    text-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
}

.product-description {
    font-size: clamp(0.95rem, 2vw, 1.125rem);
    line-height: 1.5;
    color: rgba(255, 255, 255, 0.95);
    max-width: 600px;
}

.quick-info {
    display: flex;
    gap: 16px;
    flex-wrap: wrap;
    align-items: center;
}

.info-item {
    display: flex;
    align-items: center;
    gap: 6px;
    color: rgba(255, 255, 255, 0.95);
}

.info-text {
    font-size: 0.875rem;
    font-weight: 500;
}

.cta-buttons {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
    align-items: center;
}

.btn-modern {
    font-weight: 600;
    text-transform: none;
    letter-spacing: 0.3px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.btn-modern:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
}

.btn-primary-gradient {
    background: linear-gradient(135deg,
            rgb(var(--v-theme-primary)) 0%,
            rgb(var(--v-theme-primary-darken-1)) 100%);
}

.btn-icon-modern {
    backdrop-filter: blur(10px);
    background: rgba(255, 255, 255, 0.2);
    border: 1px solid rgba(255, 255, 255, 0.3);
}

.btn-icon-modern:hover {
    background: rgba(255, 255, 255, 0.3);
}

/* Hero Visual */
.hero-visual {
    position: relative;
}

.floating-card {
    position: relative;
    animation: float 6s ease-in-out infinite;
}

@keyframes float {

    0%,
    100% {
        transform: translateY(0px);
    }

    50% {
        transform: translateY(-20px);
    }
}

.card-glow {
    position: absolute;
    inset: -20px;
    background: radial-gradient(circle, rgba(255, 255, 255, 0.3) 0%, transparent 70%);
    filter: blur(40px);
    animation: pulse 4s ease-in-out infinite;
}

@keyframes pulse {

    0%,
    100% {
        opacity: 0.5;
    }

    50% {
        opacity: 0.8;
    }
}

.software-preview-card {
    position: relative;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    background: white;
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.preview-image {
    width: 100%;
    height: auto;
    display: block;
}

.preview-overlay {
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: all 0.3s ease;
}

.software-preview-card:hover .preview-overlay {
    background: rgba(0, 0, 0, 0.5);
    opacity: 1;
}

.zoom-btn {
    transform: scale(0.8);
    transition: transform 0.3s ease;
}

.software-preview-card:hover .zoom-btn {
    transform: scale(1);
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 16px;
    margin-top: 32px;
}

.stat-card {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    border-radius: 12px;
    padding: 16px 12px;
    text-align: center;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-4px);
}

.stat-value {
    font-size: 1.5rem;
    font-weight: 800;
    color: rgb(var(--v-theme-primary));
    margin: 6px 0 2px;
}

.stat-label {
    font-size: 0.8rem;
    color: #64748b;
    font-weight: 600;
}

/* ===================================
   CONTENT CONTAINER
   =================================== */

.content-container {
    margin-top: -40px;
    position: relative;
    z-index: 3;
    padding-bottom: 60px;
}

/* Section Headers */
.section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 12px;
}

.section-title {
    font-size: clamp(1.5rem, 4vw, 2rem);
    font-weight: 800;
    color: #1e293b;
    margin: 0;
}

.section-subtitle {
    color: #64748b;
    font-size: 0.95rem;
    margin: 4px 0 0;
}

/* ===================================
   GALLERY SECTION
   =================================== */

.gallery-section {
    margin-bottom: 60px;
}

.main-preview-wrapper {
    background: white;
    border-radius: 16px;
    padding: 16px;
    box-shadow: 0 4px 30px rgba(0, 0, 0, 0.08);
}

.preview-card-modern {
    position: relative;
    border-radius: 16px;
    overflow: hidden;
    background: #f1f5f9;
    aspect-ratio: 16/10;
}

.main-preview-img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    display: block;
}

.fullscreen-btn {
    position: absolute;
    top: 16px;
    right: 16px;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.preview-card-modern:hover .fullscreen-btn {
    opacity: 1;
}

.thumbnails-wrapper {
    display: flex;
    gap: 12px;
    margin-top: 16px;
    overflow-x: auto;
    padding: 8px 0;
}

.thumbnails-wrapper::-webkit-scrollbar {
    height: 6px;
}

.thumbnails-wrapper::-webkit-scrollbar-track {
    background: #f1f5f9;
    border-radius: 10px;
}

.thumbnails-wrapper::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 10px;
}

/* Smooth scrolling for mobile */
@media (max-width: 960px) {
    .thumbnails-wrapper {
        scroll-behavior: smooth;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: thin;
    }

    .modern-tabs {
        scroll-behavior: smooth;
        -webkit-overflow-scrolling: touch;
    }
}

.thumbnail-item {
    position: relative;
    flex-shrink: 0;
    width: 100px;
    height: 70px;
    border-radius: 12px;
    overflow: hidden;
    cursor: pointer;
    border: 3px solid transparent;
    transition: all 0.3s ease;
    -webkit-tap-highlight-color: transparent;
}

.thumbnail-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.thumbnail-overlay {
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0.3);
    transition: opacity 0.3s ease;
}

.thumbnail-item:hover .thumbnail-overlay {
    opacity: 0;
}

.thumbnail-active {
    border-color: rgb(var(--v-theme-primary));
}

.thumbnail-active .thumbnail-overlay {
    opacity: 0;
}

/* ===================================
   PRICING CARD
   =================================== */

.pricing-card-modern {
    background: white;
    border-radius: 16px;
    padding: 24px;
    box-shadow: 0 4px 30px rgba(0, 0, 0, 0.08);
    position: sticky;
    top: 100px;
}

.pricing-header {
    text-align: center;
    margin-bottom: 24px;
}

.pricing-label {
    font-size: 0.875rem;
    color: #64748b;
    font-weight: 600;
    margin-bottom: 8px;
}

.pricing-amount {
    display: flex;
    align-items: baseline;
    justify-content: center;
    gap: 12px;
    flex-wrap: wrap;
}

.price-current {
    font-size: 2.5rem;
    font-weight: 800;
    color: rgb(var(--v-theme-primary));
    line-height: 1;
}

.price-old {
    font-size: 1.25rem;
    color: #94a3b8;
    text-decoration: line-through;
}

.savings-badge {
    display: inline-block;
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: white;
    padding: 6px 16px;
    border-radius: 20px;
    font-size: 0.875rem;
    font-weight: 700;
    margin-top: 8px;
}

.pricing-actions {
    margin-bottom: 24px;
}

.includes-title {
    font-size: 1.125rem;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 16px;
}

.includes-list {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.include-item {
    display: flex;
    align-items: center;
    gap: 12px;
    color: #475569;
    font-size: 0.95rem;
}

.trust-icons {
    display: flex;
    justify-content: space-around;
    gap: 16px;
}

.trust-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 8px;
    font-size: 0.875rem;
    color: #64748b;
    font-weight: 600;
}

/* ===================================
   SYSTEM REQUIREMENTS CARD
   =================================== */

.system-card-modern {
    background: white;
    border-radius: 20px;
    padding: 24px;
    box-shadow: 0 4px 30px rgba(0, 0, 0, 0.08);
    margin-top: 24px;
}

.system-header {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 20px;
}

.system-header h4 {
    font-size: 1.125rem;
    font-weight: 700;
    color: #1e293b;
    margin: 0;
}

.system-list {
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.system-item {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.system-label {
    font-size: 0.75rem;
    color: #94a3b8;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.system-value {
    font-size: 0.95rem;
    color: #475569;
    font-weight: 500;
}

/* ===================================
   FEATURES GRID
   =================================== */

.features-grid-section {
    margin-bottom: 60px;
}

.feature-card-modern {
    background: white;
    border-radius: 16px;
    padding: 24px 20px;
    text-align: center;
    box-shadow: 0 4px 30px rgba(0, 0, 0, 0.06);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    height: 100%;
    border: 1px solid transparent;
}

.feature-card-modern:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.12);
    border-color: rgb(var(--v-theme-primary));
}

.feature-icon-wrapper {
    width: 64px;
    height: 64px;
    margin: 0 auto 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg,
            rgba(var(--v-theme-primary), 0.1) 0%,
            rgba(var(--v-theme-primary), 0.05) 100%);
    border-radius: 16px;
}

.feature-title {
    font-size: 1.125rem;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 12px;
}

.feature-description {
    font-size: 0.95rem;
    color: #64748b;
    line-height: 1.6;
    margin: 0;
}

/* ===================================
   TABS SECTION
   =================================== */

.tabs-section {
    margin-bottom: 80px;
}

.tabs-card-modern {
    background: white;
    border-radius: 24px;
    box-shadow: 0 4px 30px rgba(0, 0, 0, 0.08);
    overflow: hidden;
}

.modern-tabs {
    background: #f8fafc;
    border-bottom: 1px solid #e2e8f0;
}

.modern-tab {
    text-transform: none;
    font-weight: 600;
    font-size: 0.95rem;
    letter-spacing: 0.3px;
}

.tab-content-wrapper {
    padding: 48px;
}

/* Overview Tab */

.content-title {
    font-size: 1.75rem;
    font-weight: 800;
    color: #1e293b;
    margin-bottom: 16px;
}

.content-text {
    font-size: 1.05rem;
    color: #475569;
    line-height: 1.8;
}

.benefit-card-modern {
    display: flex;
    gap: 16px;
    padding: 24px;
    background: #f8fafc;
    border-radius: 16px;
    border: 1px solid #e2e8f0;
    transition: all 0.3s ease;
    height: 100%;
}

.benefit-card-modern:hover {
    background: white;
    border-color: rgb(var(--v-theme-primary));
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
}

.benefit-icon {
    flex-shrink: 0;
}

.benefit-title {
    font-size: 1.125rem;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 8px;
}

.benefit-description {
    font-size: 0.95rem;
    color: #64748b;
    line-height: 1.6;
    margin: 0;
}

.integration-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
    gap: 24px;
}

.integration-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 12px;
    padding: 24px;
    background: #f8fafc;
    border-radius: 16px;
    border: 1px solid #e2e8f0;
    transition: all 0.3s ease;
    text-align: center;
}

.integration-item:hover {
    background: white;
    border-color: rgb(var(--v-theme-primary));
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
}

.integration-item span {
    font-size: 0.95rem;
    font-weight: 600;
    color: #475569;
}

/* Features Tab */
.feature-detail-card {
    background: #f8fafc;
    border-radius: 16px;
    padding: 32px 24px;
    border: 1px solid #e2e8f0;
    transition: all 0.3s ease;
    height: 100%;
    text-align: center;
}

.feature-detail-card:hover {
    background: white;
    border-color: rgb(var(--v-theme-primary));
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
    transform: translateY(-4px);
}

.feature-detail-icon {
    width: 72px;
    height: 72px;
    margin: 0 auto 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg,
            rgba(var(--v-theme-primary), 0.1) 0%,
            rgba(var(--v-theme-primary), 0.05) 100%);
    border-radius: 20px;
    color: rgb(var(--v-theme-primary));
}

.feature-detail-title {
    font-size: 1.125rem;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 12px;
}

.feature-detail-description {
    font-size: 0.95rem;
    color: #64748b;
    line-height: 1.6;
    margin: 0;
}

/* Specifications Tab */
.specs-modern-grid {
    display: grid;
    gap: 2px;
    background: #e2e8f0;
    border-radius: 12px;
    overflow: hidden;
}

.spec-item-modern {
    display: grid;
    grid-template-columns: 200px 1fr;
    background: white;
}

.spec-label {
    padding: 20px 24px;
    background: #f8fafc;
    font-weight: 700;
    color: #475569;
    font-size: 0.95rem;
    display: flex;
    align-items: center;
}

.spec-value {
    padding: 20px 24px;
    color: #1e293b;
    font-size: 0.95rem;
    display: flex;
    align-items: center;
}

/* Downloads Tab */
.download-card-modern {
    background: white;
    border: 2px solid #e2e8f0;
    border-radius: 16px;
    padding: 24px;
    display: flex;
    flex-direction: column;
    gap: 16px;
    transition: all 0.3s ease;
    height: 100%;
}

.download-card-modern:hover {
    border-color: rgb(var(--v-theme-primary));
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
    transform: translateY(-4px);
}

.download-icon {
    width: 72px;
    height: 72px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg,
            rgba(var(--v-theme-primary), 0.1) 0%,
            rgba(var(--v-theme-primary), 0.05) 100%);
    border-radius: 16px;
    color: rgb(var(--v-theme-primary));
}

.download-info {
    flex: 1;
}

.download-title {
    font-size: 1.125rem;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 8px;
}

.download-meta {
    display: flex;
    gap: 8px;
    color: #94a3b8;
    font-size: 0.875rem;
}

.download-btn {
    width: 100%;
}

/* FAQ Tab */
.faq-panels-modern {
    background: transparent;
}

.faq-panel-modern {
    background: white;
    border: 1px solid #e2e8f0;
    border-radius: 12px !important;
    margin-bottom: 12px;
    overflow: hidden;
}

.faq-question {
    font-weight: 600;
    font-size: 1.05rem;
    color: #1e293b;
    padding: 20px 24px;
}

.faq-answer {
    font-size: 0.95rem;
    color: #64748b;
    line-height: 1.7;
}

/* ===================================
   RELATED PRODUCTS
   =================================== */

.related-products-section {
    margin-bottom: 40px;
}

.related-product-card {
    background: white;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
    transition: all 0.3s ease;
    cursor: pointer;
    height: 100%;
    border: 1px solid transparent;
}

.related-product-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.12);
    border-color: rgb(var(--v-theme-primary));
}

.related-product-image {
    position: relative;
    aspect-ratio: 16/10;
    overflow: hidden;
    background: #f1f5f9;
}

.related-product-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.related-product-card:hover .related-product-image img {
    transform: scale(1.05);
}

.related-product-overlay {
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: all 0.3s ease;
}

.related-product-card:hover .related-product-overlay {
    background: rgba(0, 0, 0, 0.4);
    opacity: 1;
}

.related-product-content {
    padding: 20px;
}

.related-product-category {
    font-size: 0.75rem;
    color: rgb(var(--v-theme-primary));
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 8px;
}

.related-product-title {
    font-size: 1.05rem;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 12px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.related-product-price {
    font-size: 1.125rem;
    font-weight: 700;
    color: rgb(var(--v-theme-primary));
}

/* ===================================
   ZOOM DIALOG
   =================================== */

.zoom-dialog :deep(.v-overlay__content) {
    max-width: 90vw !important;
    max-height: 90vh !important;
}

.zoom-card {
    position: relative;
    background: transparent;
    box-shadow: none;
}

.close-zoom-btn {
    position: absolute;
    top: 16px;
    right: 16px;
    z-index: 10;
}

.zoom-image-wrapper {
    display: flex;
    align-items: center;
    justify-content: center;
    max-height: 90vh;
}

.zoom-image {
    max-width: 100%;
    max-height: 90vh;
    object-fit: contain;
    border-radius: 12px;
}

/* ===================================
   RESPONSIVE DESIGN
   =================================== */

@media (max-width: 1280px) {
    .software-hero {
        min-height: 500px;
        padding: 50px 0 60px;
    }

    .stats-grid {
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;
    }

    .pricing-card-modern {
        position: static;
    }

    .section-title {
        font-size: 1.75rem;
    }
}

@media (max-width: 960px) {
    .software-hero {
        min-height: auto;
        padding: 40px 0;
    }

    .hero-main {
        margin-top: 16px;
    }

    .product-title {
        font-size: 1.75rem;
        margin-bottom: 0.75rem;
    }

    .product-description {
        font-size: 0.95rem;
        margin-bottom: 1rem !important;
    }

    .quick-info {
        gap: 12px;
    }

    .cta-buttons {
        width: 100%;
        gap: 10px;
    }

    .cta-buttons .v-btn {
        flex: 1;
        min-width: 120px;
        font-size: 0.875rem !important;
        padding: 0 16px !important;
    }

    .stats-grid {
        margin-top: 24px;
        gap: 8px;
    }

    .stat-card {
        padding: 14px 10px;
        border-radius: 10px;
    }

    .stat-value {
        font-size: 1.35rem;
    }

    .stat-label {
        font-size: 0.75rem;
    }

    .content-container {
        margin-top: -30px;
        padding-bottom: 40px;
    }

    .gallery-section {
        margin-bottom: 40px;
    }

    .main-preview-wrapper {
        padding: 12px;
    }

    .pricing-card-modern {
        padding: 20px;
        margin-top: 20px;
    }

    .system-card-modern {
        padding: 18px;
        margin-top: 16px;
    }

    .features-grid-section {
        margin-bottom: 40px;
    }

    .feature-card-modern {
        padding: 20px 16px;
    }

    .feature-icon-wrapper {
        width: 56px;
        height: 56px;
        margin-bottom: 16px;
    }

    .tabs-section {
        margin-bottom: 40px;
    }

    .tab-content-wrapper {
        padding: 24px 20px;
    }

    .spec-item-modern {
        grid-template-columns: 1fr;
    }

    .spec-label {
        background: #f1f5f9;
        border-bottom: none;
        padding: 16px 20px;
    }

    .spec-value {
        padding: 16px 20px;
    }

    .integration-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
    }

    .benefit-card-modern {
        padding: 20px;
    }

    .content-title {
        font-size: 1.5rem;
    }
}

@media (max-width: 600px) {
    .software-hero {
        padding: 32px 0;
        min-height: auto;
    }

    .hero-main {
        margin-top: 12px;
    }

    .breadcrumb-modern {
        margin-bottom: 16px !important;
    }

    .chip-modern {
        font-size: 0.65rem;
        padding: 3px 8px;
    }

    .product-title {
        font-size: 1.5rem;
        margin-bottom: 0.75rem;
    }

    .product-description {
        font-size: 0.875rem;
        margin-bottom: 1rem !important;
    }

    .quick-info {
        gap: 10px;
    }

    .info-text {
        font-size: 0.8rem;
    }

    .cta-buttons {
        flex-direction: column;
        gap: 8px;
    }

    .cta-buttons .v-btn {
        width: 100%;
        min-width: auto !important;
        height: 44px !important;
        font-size: 0.875rem !important;
    }

    .btn-icon-modern {
        width: 44px !important;
        height: 44px !important;
    }

    .stats-grid {
        grid-template-columns: repeat(3, 1fr);
        gap: 6px;
        margin-top: 20px;
    }

    .stat-card {
        padding: 12px 8px;
        border-radius: 8px;
    }

    .stat-card :deep(.v-icon) {
        font-size: 24px !important;
    }

    .stat-value {
        font-size: 1.15rem;
        margin: 4px 0 2px;
    }

    .stat-label {
        font-size: 0.7rem;
    }

    .content-container {
        margin-top: -24px;
        padding-bottom: 32px;
    }

    .section-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 12px;
        margin-bottom: 20px !important;
    }

    .section-title {
        font-size: 1.35rem;
    }

    .section-subtitle {
        font-size: 0.875rem;
    }

    .gallery-section {
        margin-bottom: 32px;
    }

    .main-preview-wrapper {
        padding: 12px;
        border-radius: 12px;
    }

    .preview-card-modern {
        border-radius: 12px;
    }

    .thumbnails-wrapper {
        gap: 8px;
        margin-top: 12px;
    }

    .thumbnail-item {
        width: 80px;
        height: 56px;
        border-radius: 8px;
        border-width: 2px;
    }

    .pricing-card-modern {
        padding: 20px;
        margin-top: 20px;
        border-radius: 12px;
    }

    .pricing-header {
        margin-bottom: 20px;
    }

    .price-current {
        font-size: 1.75rem;
    }

    .price-old {
        font-size: 1rem;
    }

    .savings-badge {
        font-size: 0.8rem;
        padding: 4px 12px;
    }

    .includes-title {
        font-size: 1rem;
        margin-bottom: 12px;
    }

    .includes-list {
        gap: 10px;
    }

    .include-item {
        font-size: 0.875rem;
        gap: 10px;
    }

    .include-item :deep(.v-icon) {
        font-size: 16px !important;
    }

    .trust-icons {
        gap: 12px;
    }

    .trust-item :deep(.v-icon) {
        font-size: 20px !important;
    }

    .system-card-modern {
        padding: 16px;
        margin-top: 16px;
        border-radius: 12px;
    }

    .system-header {
        margin-bottom: 16px;
        gap: 10px;
    }

    .system-header h4 {
        font-size: 1rem;
    }

    .system-list {
        gap: 12px;
    }

    .system-label {
        font-size: 0.7rem;
    }

    .system-value {
        font-size: 0.875rem;
    }

    .features-grid-section {
        margin-bottom: 32px;
    }

    .feature-card-modern {
        padding: 20px 16px;
        border-radius: 12px;
    }

    .feature-icon-wrapper {
        width: 48px;
        height: 48px;
        margin-bottom: 12px;
        border-radius: 12px;
    }

    .feature-icon-wrapper :deep(.v-icon) {
        font-size: 24px !important;
    }

    .feature-title {
        font-size: 1rem;
        margin-bottom: 8px;
    }

    .feature-description {
        font-size: 0.875rem;
    }

    .tabs-section {
        margin-bottom: 32px;
    }

    .tabs-card-modern {
        border-radius: 16px;
    }

    .modern-tabs {
        overflow-x: auto;
    }

    .modern-tabs :deep(.v-tab) {
        min-width: auto;
        padding: 10px 12px !important;
        font-size: 0.75rem !important;
        white-space: nowrap;
    }

    .modern-tabs :deep(.v-icon) {
        display: none;
    }

    .tab-content-wrapper {
        padding: 20px 16px;
    }

    .content-title {
        font-size: 1.25rem;
        margin-bottom: 12px;
    }

    .content-text {
        font-size: 0.95rem;
    }

    .benefit-card-modern {
        padding: 16px;
        border-radius: 12px;
        gap: 12px;
    }

    .benefit-icon :deep(.v-icon) {
        font-size: 24px !important;
    }

    .benefit-title {
        font-size: 1rem;
        margin-bottom: 6px;
    }

    .benefit-description {
        font-size: 0.875rem;
    }

    .integration-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
    }

    .integration-item {
        padding: 16px 12px;
        border-radius: 12px;
        gap: 8px;
    }

    .integration-item :deep(.v-icon) {
        font-size: 32px !important;
    }

    .integration-item span {
        font-size: 0.85rem;
    }

    .feature-detail-card {
        padding: 20px 16px;
        border-radius: 12px;
    }

    .feature-detail-icon {
        width: 56px;
        height: 56px;
        margin-bottom: 16px;
        border-radius: 14px;
    }

    .feature-detail-icon :deep(.v-icon) {
        font-size: 28px !important;
    }

    .feature-detail-title {
        font-size: 1rem;
        margin-bottom: 8px;
    }

    .feature-detail-description {
        font-size: 0.875rem;
    }

    .specs-modern-grid {
        border-radius: 8px;
    }

    .spec-label {
        padding: 14px 16px;
        font-size: 0.875rem;
    }

    .spec-value {
        padding: 14px 16px;
        font-size: 0.875rem;
    }

    .download-card-modern {
        padding: 20px;
        border-radius: 12px;
    }

    .download-icon {
        width: 56px;
        height: 56px;
        border-radius: 12px;
    }

    .download-icon :deep(.v-icon) {
        font-size: 36px !important;
    }

    .download-title {
        font-size: 1rem;
        margin-bottom: 6px;
    }

    .download-meta {
        font-size: 0.8rem;
        gap: 6px;
    }

    .faq-panel-modern {
        border-radius: 8px !important;
        margin-bottom: 8px;
    }

    .faq-question {
        font-size: 0.95rem;
        padding: 16px 18px;
    }

    .faq-question :deep(.v-icon) {
        font-size: 18px !important;
        margin-right: 10px !important;
    }

    .faq-answer {
        font-size: 0.875rem;
    }

    .related-products-section {
        margin-bottom: 20px;
    }

    .related-product-card {
        border-radius: 12px;
    }

    .related-product-content {
        padding: 16px;
    }

    .related-product-category {
        font-size: 0.7rem;
        margin-bottom: 6px;
    }

    .related-product-title {
        font-size: 0.95rem;
        margin-bottom: 10px;
    }

    .related-product-price {
        font-size: 1rem;
    }

    .zoom-dialog :deep(.v-overlay__content) {
        max-width: 95vw !important;
        max-height: 95vh !important;
    }

    .close-zoom-btn {
        top: 8px;
        right: 8px;
    }
}

/* Extra small devices (phones < 375px) */
@media (max-width: 374px) {
    .product-title {
        font-size: 1.35rem;
    }

    .product-description {
        font-size: 0.85rem;
    }

    .stat-value {
        font-size: 1rem;
    }

    .stat-label {
        font-size: 0.65rem;
    }

    .section-title {
        font-size: 1.25rem;
    }

    .pricing-card-modern {
        padding: 16px;
    }

    .price-current {
        font-size: 1.5rem;
    }

    .system-card-modern {
        padding: 14px;
    }

    .feature-card-modern {
        padding: 16px 12px;
    }

    .tab-content-wrapper {
        padding: 16px 12px;
    }

    .modern-tabs :deep(.v-tab) {
        padding: 8px 10px !important;
        font-size: 0.7rem !important;
    }
}

/* Landscape mode for mobile devices */
@media (max-width: 960px) and (orientation: landscape) {
    .software-hero {
        min-height: 400px;
        padding: 30px 0;
    }

    .stats-grid {
        margin-top: 20px;
    }

    .content-container {
        margin-top: -20px;
    }
}

/* High DPI displays */
@media (-webkit-min-device-pixel-ratio: 2),
(min-resolution: 192dpi) {

    .preview-image,
    .main-preview-img,
    .zoom-image {
        image-rendering: -webkit-optimize-contrast;
        image-rendering: crisp-edges;
    }
}
</style>