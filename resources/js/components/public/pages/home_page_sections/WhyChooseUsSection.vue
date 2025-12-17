<template>
    <section class="why-choose-section py-16 position-relative overflow-hidden">
        <!-- Animated gradient background -->
        <div class="gradient-bg"></div>
        <div class="pattern-overlay"></div>

        <v-container class="position-relative">
            <!-- Header -->
            <v-row justify="center" class="mb-12">
                <v-col cols="12" lg="8" class="text-center">
                    <div class="overline-badge d-inline-flex align-center px-4 py-2 rounded-pill mb-4">
                        <v-icon icon="mdi-star-four-points" size="16" class="mr-2"></v-icon>
                        <span class="text-caption font-weight-bold">{{ overline || 'WHY CHOOSE US' }}</span>
                    </div>
                    <h2 class="text-h3 text-md-h2 font-weight-bold mb-4 gradient-text">
                        {{ title || 'Reliable Power, Guaranteed' }}
                    </h2>
                    <p class="text-h6 font-weight-regular text-medium-emphasis mx-auto" style="max-width: 600px;">
                        Experience excellence in every aspect of our service
                    </p>
                </v-col>
            </v-row>

            <!-- Content Grid -->
            <v-row align="center" class="position-relative">
                <!-- Features Side -->
                <v-col cols="12" lg="6" order="2" order-lg="1">
                    <div class="features-grid">
                        <div v-for="(feature, i) in features" :key="i" class="feature-card"
                            :style="{ '--delay': i * 0.1 + 's' }">
                            <div class="feature-card-inner pa-6">
                                <div class="feature-icon-wrapper mb-4">
                                    <div class="icon-glow"></div>
                                    <v-icon :icon="feature.icon" size="32" class="feature-icon"></v-icon>
                                </div>
                                <h4 class="text-h6 font-weight-bold mb-3">{{ feature.title }}</h4>
                                <p class="text-body-2 text-medium-emphasis mb-0">{{ feature.desc }}</p>
                                <div class="feature-accent"></div>
                            </div>
                        </div>
                    </div>
                </v-col>

                <!-- Image Side -->
                <v-col cols="12" lg="6" order="1" order-lg="2" class="mb-8 mb-lg-0">
                    <div class="image-showcase">
                        <div class="showcase-frame">
                            <!-- Decorative elements -->
                            <div class="frame-corner frame-corner-tl"></div>
                            <div class="frame-corner frame-corner-tr"></div>
                            <div class="frame-corner frame-corner-bl"></div>
                            <div class="frame-corner frame-corner-br"></div>

                            <v-img :src="imageUrl ? resolveImageUrl(imageUrl) : '/assets/img/default.jpg'"
                                class="showcase-image rounded-lg" :cover="true" height="500">
                                <template v-slot:placeholder>
                                    <div class="d-flex align-center justify-center fill-height">
                                        <v-progress-circular indeterminate color="primary"></v-progress-circular>
                                    </div>
                                </template>
                            </v-img>

                            <!-- Floating stats cards -->
                            <div class="stat-card stat-card-1 glass-card">
                                <div class="stat-icon mb-2">
                                    <v-icon icon="mdi-check-decagram" color="success" size="28"></v-icon>
                                </div>
                                <div class="text-h5 font-weight-bold text-white mb-1">100%</div>
                                <div class="text-caption text-white-70">Quality Assured</div>
                            </div>

                            <div class="stat-card stat-card-2 glass-card">
                                <div class="stat-icon mb-2">
                                    <v-icon icon="mdi-shield-check" color="primary" size="28"></v-icon>
                                </div>
                                <div class="text-h5 font-weight-bold text-white mb-1">24/7</div>
                                <div class="text-caption text-white-70">Support</div>
                            </div>
                        </div>
                    </div>
                </v-col>
            </v-row>
        </v-container>
    </section>
</template>

<script>
import { resolveUploadUrl } from '../../../../utils/uploads';

export default {
    name: 'WhyChooseUsSection',
    props: {
        overline: {
            type: String,
            default: 'WHY CHOOSE US'
        },
        title: {
            type: String,
            default: 'Reliable Power, Guaranteed'
        },
        imageUrl: {
            type: String,
            default: 'https://images.unsplash.com/photo-1473341304170-971dccb5ac1e?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
        },
        features: {
            type: Array,
            default: () => [
                {
                    title: 'Uninterrupted Operations',
                    desc: 'We ensure your business never stops with our reliable backup power solutions and UPS systems.',
                    icon: 'mdi-lightning-bolt-circle'
                },
                {
                    title: 'High-Quality Products',
                    desc: 'We supply top-tier batteries, inverters, and power management systems built for long-term performance.',
                    icon: 'mdi-shield-star'
                },
                {
                    title: 'Responsive Support',
                    desc: 'Our professional maintenance team is available 24/7 to handle installation and repairs.',
                    icon: 'mdi-headset'
                }
            ]
        }
    },
    methods: {
        resolveImageUrl(url) {
            return resolveUploadUrl(url);
        }
    }
};
</script>

<style scoped>
.why-choose-section {
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    min-height: 600px;
}

/* Animated Background */
.gradient-bg {
    position: absolute;
    inset: 0;
    background:
        radial-gradient(circle at 20% 30%, rgba(59, 130, 246, 0.08) 0%, transparent 50%),
        radial-gradient(circle at 80% 70%, rgba(168, 85, 247, 0.06) 0%, transparent 50%),
        radial-gradient(circle at 50% 50%, rgba(236, 72, 153, 0.04) 0%, transparent 50%);
    animation: gradientShift 15s ease infinite;
}

@keyframes gradientShift {

    0%,
    100% {
        transform: scale(1) rotate(0deg);
        opacity: 1;
    }

    50% {
        transform: scale(1.1) rotate(5deg);
        opacity: 0.8;
    }
}

.pattern-overlay {
    position: absolute;
    inset: 0;
    background-image:
        repeating-linear-gradient(45deg, transparent, transparent 10px, rgba(0, 0, 0, 0.01) 10px, rgba(0, 0, 0, 0.01) 20px);
    pointer-events: none;
}

/* Header Styles */
.overline-badge {
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), rgba(147, 51, 234, 0.1));
    border: 1px solid rgba(59, 130, 246, 0.2);
    color: rgb(59, 130, 246);
    transition: all 0.3s ease;
}

.gradient-text {
    background: linear-gradient(135deg, #1e293b 0%, #3b82f6 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

/* Features Grid */
.features-grid {
    display: grid;
    gap: 20px;
}

.feature-card {
    animation: fadeInUp 0.6s ease forwards;
    animation-delay: var(--delay);
    opacity: 0;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.feature-card-inner {
    background: white;
    border-radius: 16px;
    border: 1px solid rgba(148, 163, 184, 0.1);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
    height: 100%;
}

.feature-card-inner:hover {
    transform: translateY(-4px);
    box-shadow: 0 20px 40px rgba(59, 130, 246, 0.12);
    border-color: rgba(59, 130, 246, 0.3);
}

.feature-card-inner::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, #3b82f6, #8b5cf6);
    transform: scaleX(0);
    transform-origin: left;
    transition: transform 0.4s ease;
}

.feature-card-inner:hover::before {
    transform: scaleX(1);
}

.feature-icon-wrapper {
    position: relative;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 64px;
    height: 64px;
    border-radius: 16px;
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), rgba(147, 51, 234, 0.1));
    transition: all 0.3s ease;
}

.feature-card-inner:hover .feature-icon-wrapper {
    transform: scale(1.1) rotate(5deg);
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.15), rgba(147, 51, 234, 0.15));
}

.icon-glow {
    position: absolute;
    inset: 0;
    border-radius: 16px;
    background: radial-gradient(circle, rgba(59, 130, 246, 0.4), transparent 70%);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.feature-card-inner:hover .icon-glow {
    opacity: 1;
}

.feature-icon {
    color: rgb(59, 130, 246);
    position: relative;
    z-index: 1;
}

.feature-accent {
    position: absolute;
    bottom: 0;
    right: 0;
    width: 100px;
    height: 100px;
    background: radial-gradient(circle at bottom right, rgba(59, 130, 246, 0.05), transparent 70%);
    border-radius: 16px 0 16px 0;
    pointer-events: none;
}

/* Image Showcase */
.image-showcase {
    position: relative;
    padding: 20px;
}

.showcase-frame {
    position: relative;
    animation: float 6s ease-in-out infinite;
}

@keyframes float {

    0%,
    100% {
        transform: translateY(0);
    }

    50% {
        transform: translateY(-10px);
    }
}

.showcase-image {
    border-radius: 16px !important;
    box-shadow: 0 30px 60px rgba(15, 23, 42, 0.15);
    overflow: hidden;
    position: relative;
}

.showcase-image::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, transparent 50%);
    pointer-events: none;
    z-index: 1;
}

/* Frame Corners */
.frame-corner {
    position: absolute;
    width: 40px;
    height: 40px;
    border: 3px solid;
    border-image: linear-gradient(135deg, #3b82f6, #8b5cf6) 1;
    z-index: 2;
}

.frame-corner-tl {
    top: 0;
    left: 0;
    border-right: none;
    border-bottom: none;
    border-radius: 8px 0 0 0;
}

.frame-corner-tr {
    top: 0;
    right: 0;
    border-left: none;
    border-bottom: none;
    border-radius: 0 8px 0 0;
}

.frame-corner-bl {
    bottom: 0;
    left: 0;
    border-right: none;
    border-top: none;
    border-radius: 0 0 0 8px;
}

.frame-corner-br {
    bottom: 0;
    right: 0;
    border-left: none;
    border-top: none;
    border-radius: 0 0 8px 0;
}

/* Floating Stats Cards */
.glass-card {
    background: rgba(15, 23, 42, 0.85);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 12px;
    padding: 20px;
    position: absolute;
    z-index: 3;
    animation: floatSlow 4s ease-in-out infinite;
}

@keyframes floatSlow {

    0%,
    100% {
        transform: translateY(0);
    }

    50% {
        transform: translateY(-8px);
    }
}

.stat-card-1 {
    top: 30px;
    right: -20px;
    animation-delay: 0s;
}

.stat-card-2 {
    bottom: 30px;
    left: -20px;
    animation-delay: 2s;
}

.stat-icon {
    width: 50px;
    height: 50px;
    border-radius: 12px;
    background: rgba(255, 255, 255, 0.1);
    display: flex;
    align-items: center;
    justify-content: center;
}

.text-white-70 {
    color: rgba(255, 255, 255, 0.7);
}

/* Responsive Design */
@media (max-width: 1280px) {
    .features-grid {
        gap: 16px;
    }
}

@media (max-width: 960px) {
    .image-showcase {
        padding: 10px;
        margin-bottom: 40px;
    }

    .showcase-image {
        height: 400px !important;
    }

    .stat-card-1 {
        top: 20px;
        right: 10px;
    }

    .stat-card-2 {
        bottom: 20px;
        left: 10px;
    }

    .frame-corner {
        width: 30px;
        height: 30px;
        border-width: 2px;
    }
}

@media (max-width: 600px) {
    .why-choose-section {
        padding-top: 48px !important;
        padding-bottom: 48px !important;
    }

    .showcase-image {
        height: 320px !important;
    }

    .glass-card {
        padding: 16px;
    }

    .stat-card-1,
    .stat-card-2 {
        position: static;
        display: inline-block;
        margin: 10px;
    }

    .feature-card-inner {
        padding: 20px !important;
    }

    .feature-icon-wrapper {
        width: 56px;
        height: 56px;
    }

    .frame-corner {
        display: none;
    }
}
</style>
