<template>
    <section class="why-choose-section py-16 position-relative overflow-hidden">
        <!-- Animated gradient background -->
        <div class="gradient-bg"></div>
        <div class="pattern-overlay"></div>
        <div class="floating-shapes">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
        </div>

        <v-container class="position-relative">
            <!-- Header -->
            <v-row justify="center" class="mb-12">
                <v-col cols="12" lg="10" class="text-center">
                    <div class="overline-badge d-inline-flex align-center px-5 py-2 rounded-pill mb-5">
                        <v-icon icon="mdi-diamond-stone" size="18" class="mr-2 sparkle-icon"></v-icon>
                        <span class="text-caption font-weight-bold letter-spacing">{{ overline || 'WHY CHOOSE US'
                        }}</span>
                        <v-icon icon="mdi-diamond-stone" size="18" class="ml-2 sparkle-icon"></v-icon>
                    </div>
                    <h2 class="display-title text-h3 text-md-h2 font-weight-black mb-5 gradient-text">
                        {{ title || 'Transparent Scope, Production-Ready Code' }}
                    </h2>
                    <p class="text-h6 font-weight-regular subtitle-text mx-auto" style="max-width: 700px;">
                        We deliver fast, secure, and scalable digital solutions with clear planning, measurable results,
                        and long-term support
                    </p>
                </v-col>
            </v-row>

            <!-- Content Grid -->
            <v-row align="center" class="position-relative">
                <!-- Features Side -->
                <v-col cols="12" lg="6" order="2" order-lg="1">
                    <div class="features-grid">
                        <div v-for="(feature, i) in features" :key="i" class="feature-card"
                            :style="{ '--delay': i * 0.15 + 's' }">
                            <div class="feature-card-inner pa-7" @mousemove="handleMouseMove"
                                @mouseleave="handleMouseLeave">
                                <div class="d-flex align-start">
                                    <div class="feature-icon-wrapper mr-4">
                                        <div class="icon-glow"></div>
                                        <div class="icon-pulse"></div>
                                        <v-icon :icon="feature.icon" size="36" class="feature-icon"></v-icon>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h4 class="text-h6 font-weight-bold mb-3 feature-title">{{ feature.title }}</h4>
                                        <p class="text-body-2 feature-desc mb-0">{{ feature.desc }}</p>
                                    </div>
                                </div>
                                <div class="feature-accent"></div>
                                <div class="hover-gradient"></div>
                            </div>
                        </div>
                    </div>
                </v-col>

                <!-- Image Side -->
                <v-col cols="12" lg="6" order="1" order-lg="2" class="mb-8 mb-lg-0">
                    <div class="image-showcase">
                        <div class="showcase-frame">
                            <!-- Decorative grid -->
                            <div class="decorative-grid"></div>

                            <!-- Animated border -->
                            <div class="animated-border"></div>

                            <v-img
                                :src="imageUrl ? resolveImageUrl(imageUrl) : 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'"
                                class="showcase-image rounded-lg" :cover="true" height="550">
                                <template v-slot:placeholder>
                                    <div class="d-flex align-center justify-center fill-height">
                                        <v-progress-circular indeterminate color="primary"></v-progress-circular>
                                    </div>
                                </template>
                            </v-img>

                            <!-- Floating stats cards with modern design -->
                            <div class="stat-card stat-card-1 glass-morph">
                                <div class="d-flex align-center">
                                    <div class="stat-icon-modern mr-3">
                                        <v-icon icon="mdi-rocket-launch" size="32"></v-icon>
                                    </div>
                                    <div>
                                        <div class="text-h4 font-weight-black stat-number mb-1">500+</div>
                                        <div class="text-caption stat-label">Projects Delivered</div>
                                    </div>
                                </div>
                                <div class="stat-glow"></div>
                            </div>

                            <div class="stat-card stat-card-2 glass-morph">
                                <div class="d-flex align-center">
                                    <div class="stat-icon-modern mr-3">
                                        <v-icon icon="mdi-clock-fast" size="32"></v-icon>
                                    </div>
                                    <div>
                                        <div class="text-h4 font-weight-black stat-number mb-1">24/7</div>
                                        <div class="text-caption stat-label">Support Available</div>
                                    </div>
                                </div>
                                <div class="stat-glow"></div>
                            </div>

                            <div class="stat-card stat-card-3 glass-morph">
                                <div class="d-flex align-center">
                                    <div class="stat-icon-modern mr-3">
                                        <v-icon icon="mdi-shield-check" size="32"></v-icon>
                                    </div>
                                    <div>
                                        <div class="text-h4 font-weight-black stat-number mb-1">100%</div>
                                        <div class="text-caption stat-label">Quality Assured</div>
                                    </div>
                                </div>
                                <div class="stat-glow"></div>
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
            default: 'WHY CHOOSE DIGILIFTPRO'
        },
        title: {
            type: String,
            default: 'Transparent Scope, Production-Ready Code'
        },
        imageUrl: {
            type: String,
            default: 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
        },
        features: {
            type: Array,
            default: () => [
                {
                    title: 'Clear Planning & Timelines',
                    desc: 'Every project starts with transparent scope definition, realistic milestones, and clear deliverables—so you always know what to expect.',
                    icon: 'mdi-timeline-clock-outline'
                },
                {
                    title: 'Production-Ready & Secure',
                    desc: 'We deliver clean, maintainable code with industry-standard security practices, proper testing, and complete documentation for seamless handover.',
                    icon: 'mdi-shield-lock-outline'
                },
                {
                    title: 'Dedicated Support Plans',
                    desc: 'Beyond launch, we provide ongoing maintenance, performance monitoring, security updates, and 24/7 technical support to keep your business running smoothly.',
                    icon: 'mdi-lifebuoy'
                },
                {
                    title: 'Full-Stack Expertise',
                    desc: 'From custom web apps to SEO optimization, domain management, email setup, and analytics—we handle your entire digital infrastructure under one roof.',
                    icon: 'mdi-layers-triple-outline'
                }
            ]
        }
    },
    methods: {
        resolveImageUrl(url) {
            return resolveUploadUrl(url);
        },
        handleMouseMove(event) {
            const card = event.currentTarget;
            const rect = card.getBoundingClientRect();
            const x = ((event.clientX - rect.left) / rect.width) * 100;
            const y = ((event.clientY - rect.top) / rect.height) * 100;

            card.style.setProperty('--mouse-x', `${x}%`);
            card.style.setProperty('--mouse-y', `${y}%`);
        },
        handleMouseLeave(event) {
            const card = event.currentTarget;
            card.style.setProperty('--mouse-x', '50%');
            card.style.setProperty('--mouse-y', '50%');
        }
    }
};
</script>

<style scoped>
/* Using CSS Custom Properties from _variables.scss */
.why-choose-section {
    background: var(--brand-gradient-hero);
    min-height: 700px;
    position: relative;
}

/* Animated Gradient Background with Brand Colors */
.gradient-bg {
    position: absolute;
    inset: 0;
    background:
        radial-gradient(circle at 20% 30%, rgba(var(--brand-primary-rgb), 0.15) 0%, transparent 50%),
        radial-gradient(circle at 80% 70%, rgba(var(--brand-accent-blue-rgb), 0.12) 0%, transparent 50%),
        radial-gradient(circle at 50% 50%, rgba(var(--brand-primary-light-rgb), 0.1) 0%, transparent 50%),
        radial-gradient(circle at 10% 80%, rgba(var(--brand-accent-cyan-rgb), 0.08) 0%, transparent 50%);
    animation: gradientShift 20s ease infinite alternate;
}

@keyframes gradientShift {
    0% {
        transform: scale(1) rotate(0deg);
        opacity: 1;
    }

    50% {
        transform: scale(1.2) rotate(10deg);
        opacity: 0.85;
    }

    100% {
        transform: scale(1.1) rotate(-5deg);
        opacity: 1;
    }
}

/* Grid Pattern Overlay */
.pattern-overlay {
    position: absolute;
    inset: 0;
    background-image:
        repeating-linear-gradient(0deg, transparent, transparent 2px, rgba(var(--brand-primary-rgb), 0.03) 2px, rgba(var(--brand-primary-rgb), 0.03) 4px),
        repeating-linear-gradient(90deg, transparent, transparent 2px, rgba(var(--brand-accent-blue-rgb), 0.03) 2px, rgba(var(--brand-accent-blue-rgb), 0.03) 4px);
    pointer-events: none;
    opacity: 0.5;
}

/* Floating Shapes */
.floating-shapes {
    position: absolute;
    inset: 0;
    overflow: hidden;
    pointer-events: none;
}

.shape {
    position: absolute;
    border-radius: 50%;
    opacity: 0.6;
    animation: float-around 25s ease-in-out infinite;
}

.shape-1 {
    width: 300px;
    height: 300px;
    background: radial-gradient(circle, rgba(var(--brand-primary-rgb), 0.2), transparent);
    top: -100px;
    left: 10%;
    animation-delay: 0s;
}

.shape-2 {
    width: 400px;
    height: 400px;
    background: radial-gradient(circle, rgba(var(--brand-accent-blue-rgb), 0.15), transparent);
    bottom: -150px;
    right: 5%;
    animation-delay: 5s;
}

.shape-3 {
    width: 250px;
    height: 250px;
    background: radial-gradient(circle, rgba(var(--brand-accent-cyan-rgb), 0.15), transparent);
    top: 50%;
    right: 20%;
    animation-delay: 10s;
}

@keyframes float-around {

    0%,
    100% {
        transform: translate(0, 0) scale(1);
    }

    25% {
        transform: translate(30px, -30px) scale(1.1);
    }

    50% {
        transform: translate(-20px, 20px) scale(0.9);
    }

    75% {
        transform: translate(40px, 10px) scale(1.05);
    }
}

/* Header Styles with Brand Colors */
.overline-badge {
    background: linear-gradient(135deg, rgba(var(--brand-primary-rgb), 0.25), rgba(var(--brand-accent-blue-rgb), 0.25));
    border: 2px solid rgba(var(--brand-primary-rgb), 0.5);
    color: var(--brand-white);
    backdrop-filter: blur(10px);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 4px 20px rgba(var(--brand-primary-rgb), 0.3);
    font-weight: 700;
}

.overline-badge:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 30px rgba(var(--brand-primary-rgb), 0.5);
    border-color: rgba(var(--brand-primary-rgb), 0.7);
    background: linear-gradient(135deg, rgba(var(--brand-primary-rgb), 0.35), rgba(var(--brand-accent-blue-rgb), 0.35));
}

.letter-spacing {
    letter-spacing: 0.1em;
}

.sparkle-icon {
    animation: sparkle 2s ease-in-out infinite;
}

@keyframes sparkle {

    0%,
    100% {
        opacity: 1;
        transform: scale(1);
    }

    50% {
        opacity: 0.5;
        transform: scale(0.8);
    }
}

.display-title {
    line-height: 1.2;
}

.gradient-text {
    background: linear-gradient(135deg, var(--brand-white) 0%, var(--brand-primary-light) 50%, var(--brand-accent-light-blue) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    background-size: 200% auto;
    animation: gradient-shift 8s ease infinite;
}

@keyframes gradient-shift {

    0%,
    100% {
        background-position: 0% 50%;
    }

    50% {
        background-position: 100% 50%;
    }
}

.subtitle-text {
    color: rgba(255, 255, 255, 0.9);
    line-height: 1.6;
    text-shadow: 0 2px 10px rgba(0, 0, 0, 0.4);
    font-weight: 500;
}

/* Features Grid - Modern Design */
.features-grid {
    display: grid;
    gap: 24px;
}

.feature-card {
    animation: fadeInUp 0.8s cubic-bezier(0.4, 0, 0.2, 1) forwards;
    animation-delay: var(--delay);
    opacity: 0;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(40px) scale(0.95);
    }

    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

.feature-card-inner {
    background: var(--brand-overlay-light);
    backdrop-filter: blur(20px);
    border-radius: 20px;
    border: 1px solid var(--brand-overlay-medium);
    transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
    height: 100%;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
}

.feature-card-inner:hover {
    transform: translateY(-8px) scale(1.02);
    background: var(--brand-backdrop-blur);
    border-color: rgba(var(--brand-primary-rgb), 0.5);
    box-shadow: 0 20px 60px rgba(var(--brand-primary-rgb), 0.4);
}

/* Animated top border gradient */
.feature-card-inner::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--brand-primary), var(--brand-accent-blue), var(--brand-accent-cyan));
    background-size: 200% 100%;
    transform: scaleX(0);
    transform-origin: left;
    transition: transform 0.6s ease;
    animation: gradient-flow 3s ease infinite;
}

@keyframes gradient-flow {

    0%,
    100% {
        background-position: 0% 50%;
    }

    50% {
        background-position: 100% 50%;
    }
}

.feature-card-inner:hover::before {
    transform: scaleX(1);
}

/* Hover gradient overlay */
.hover-gradient {
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at var(--mouse-x, 50%) var(--mouse-y, 50%), rgba(var(--brand-primary-rgb), 0.15), transparent 60%);
    opacity: 0;
    transition: opacity 0.4s ease;
    pointer-events: none;
}

.feature-card-inner:hover .hover-gradient {
    opacity: 1;
}

.feature-icon-wrapper {
    position: relative;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 70px;
    height: 70px;
    min-width: 70px;
    border-radius: 18px;
    background: linear-gradient(135deg, rgba(var(--brand-primary-rgb), 0.25), rgba(var(--brand-accent-blue-rgb), 0.25));
    transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 4px 20px rgba(var(--brand-primary-rgb), 0.3);
}

.feature-card-inner:hover .feature-icon-wrapper {
    transform: scale(1.15) rotate(10deg);
    background: linear-gradient(135deg, rgba(var(--brand-primary-rgb), 0.4), rgba(var(--brand-accent-blue-rgb), 0.4));
    box-shadow: 0 8px 30px rgba(var(--brand-primary-rgb), 0.5);
}

.icon-glow {
    position: absolute;
    inset: -10px;
    border-radius: 18px;
    background: radial-gradient(circle, rgba(var(--brand-primary-rgb), 0.6), transparent 70%);
    opacity: 0;
    transition: opacity 0.4s ease;
    filter: blur(15px);
}

.icon-pulse {
    position: absolute;
    inset: 0;
    border-radius: 18px;
    border: 2px solid rgba(var(--brand-primary-rgb), 0.5);
    animation: pulse-ring 2s ease-out infinite;
}

@keyframes pulse-ring {
    0% {
        transform: scale(1);
        opacity: 1;
    }

    100% {
        transform: scale(1.5);
        opacity: 0;
    }
}

.feature-card-inner:hover .icon-glow {
    opacity: 1;
}

.feature-icon {
    color: var(--brand-primary-light);
    position: relative;
    z-index: 1;
    transition: all 0.3s ease;
}

.feature-card-inner:hover .feature-icon {
    color: var(--brand-white);
    filter: drop-shadow(0 0 10px rgba(var(--brand-primary-rgb), 0.8));
}

.feature-title {
    color: var(--brand-white);
    transition: color 0.3s ease;
    text-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
    font-weight: 700;
}

.feature-desc {
    color: rgba(255, 255, 255, 0.85);
    line-height: 1.7;
    text-shadow: 0 1px 4px rgba(0, 0, 0, 0.3);
}

.feature-accent {
    position: absolute;
    bottom: -50px;
    right: -50px;
    width: 150px;
    height: 150px;
    background: radial-gradient(circle at bottom right, rgba(var(--brand-primary-rgb), 0.15), transparent 70%);
    border-radius: 50%;
    pointer-events: none;
    transition: all 0.5s ease;
}

.feature-card-inner:hover .feature-accent {
    bottom: -30px;
    right: -30px;
    background: radial-gradient(circle at bottom right, rgba(var(--brand-accent-blue-rgb), 0.2), transparent 70%);
}

/* Image Showcase - Modern Design */
.image-showcase {
    position: relative;
    padding: 30px;
}

.showcase-frame {
    position: relative;
    animation: float 8s ease-in-out infinite;
}

@keyframes float {

    0%,
    100% {
        transform: translateY(0) rotate(0deg);
    }

    25% {
        transform: translateY(-15px) rotate(1deg);
    }

    50% {
        transform: translateY(-5px) rotate(-1deg);
    }

    75% {
        transform: translateY(-20px) rotate(0.5deg);
    }
}

.showcase-image {
    border-radius: 24px !important;
    box-shadow:
        0 40px 80px rgba(0, 0, 0, 0.4),
        0 0 60px rgba(var(--brand-primary-rgb), 0.3),
        inset 0 0 0 1px rgba(255, 255, 255, 0.1);
    overflow: hidden;
    position: relative;
    border: 2px solid rgba(var(--brand-primary-rgb), 0.3);
    transition: all 0.5s ease;
}

.showcase-image:hover {
    transform: scale(1.02);
    box-shadow:
        0 50px 100px rgba(0, 0, 0, 0.5),
        0 0 80px rgba(var(--brand-primary-rgb), 0.5);
    border-color: rgba(var(--brand-primary-rgb), 0.6);
}

.showcase-image::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(var(--brand-primary-rgb), 0.2) 0%, transparent 50%, rgba(var(--brand-accent-blue-rgb), 0.2) 100%);
    pointer-events: none;
    z-index: 1;
    opacity: 0.6;
}

/* Decorative Grid */
.decorative-grid {
    position: absolute;
    inset: -50px;
    background-image:
        repeating-linear-gradient(0deg, transparent, transparent 30px, rgba(var(--brand-primary-rgb), 0.1) 30px, rgba(var(--brand-primary-rgb), 0.1) 31px),
        repeating-linear-gradient(90deg, transparent, transparent 30px, rgba(var(--brand-accent-blue-rgb), 0.1) 30px, rgba(var(--brand-accent-blue-rgb), 0.1) 31px);
    pointer-events: none;
    opacity: 0.3;
    animation: grid-flow 15s linear infinite;
}

@keyframes grid-flow {
    0% {
        transform: translate(0, 0);
    }

    100% {
        transform: translate(30px, 30px);
    }
}

/* Animated Border */
.animated-border {
    position: absolute;
    inset: -4px;
    border-radius: 24px;
    background: linear-gradient(45deg, var(--brand-primary), var(--brand-accent-blue), var(--brand-accent-cyan), var(--brand-primary));
    background-size: 300% 300%;
    animation: gradient-rotate 6s ease infinite;
    opacity: 0;
    transition: opacity 0.5s ease;
    z-index: -1;
    filter: blur(10px);
}

.showcase-frame:hover .animated-border {
    opacity: 0.8;
}

@keyframes gradient-rotate {

    0%,
    100% {
        background-position: 0% 50%;
    }

    50% {
        background-position: 100% 50%;
    }
}

/* Floating Stats Cards - Glassmorphism */
.glass-morph {
    background: var(--brand-backdrop-blur);
    backdrop-filter: blur(30px) saturate(180%);
    border: 2px solid var(--brand-overlay-strong);
    border-radius: 20px;
    padding: 24px;
    position: absolute;
    z-index: 4;
    box-shadow:
        0 20px 50px rgba(0, 0, 0, 0.5),
        inset 0 0 0 1px rgba(255, 255, 255, 0.1);
    transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    animation: floatSlow 5s ease-in-out infinite;
    cursor: pointer;
}

.glass-morph:hover {
    transform: translateY(-10px) scale(1.05);
    background: rgba(255, 255, 255, 0.15);
    border-color: rgba(var(--brand-primary-rgb), 0.6);
    box-shadow:
        0 30px 70px rgba(var(--brand-primary-rgb), 0.5),
        inset 0 0 0 1px rgba(255, 255, 255, 0.2);
}

@keyframes floatSlow {

    0%,
    100% {
        transform: translateY(0) rotate(0deg);
    }

    25% {
        transform: translateY(-12px) rotate(1deg);
    }

    50% {
        transform: translateY(-5px) rotate(-0.5deg);
    }

    75% {
        transform: translateY(-15px) rotate(0.5deg);
    }
}

.stat-card-1 {
    top: 40px;
    right: -30px;
    animation-delay: 0s;
}

.stat-card-2 {
    bottom: 120px;
    left: -40px;
    animation-delay: 1.5s;
}

.stat-card-3 {
    bottom: 40px;
    right: -35px;
    animation-delay: 3s;
}

.stat-icon-modern {
    width: 60px;
    height: 60px;
    min-width: 60px;
    border-radius: 16px;
    background: linear-gradient(135deg, rgba(var(--brand-primary-rgb), 0.4), rgba(var(--brand-accent-blue-rgb), 0.4));
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    transition: all 0.4s ease;
    box-shadow: 0 8px 20px rgba(var(--brand-primary-rgb), 0.4);
}

.glass-morph:hover .stat-icon-modern {
    transform: rotate(10deg) scale(1.1);
    box-shadow: 0 12px 30px rgba(var(--brand-primary-rgb), 0.6);
    background: linear-gradient(135deg, rgba(var(--brand-primary-rgb), 0.5), rgba(var(--brand-accent-blue-rgb), 0.5));
}

.stat-icon-modern .v-icon {
    color: var(--brand-white);
    filter: drop-shadow(0 2px 8px rgba(var(--brand-primary-rgb), 0.6));
}

.stat-glow {
    position: absolute;
    inset: -20px;
    background: radial-gradient(circle, rgba(var(--brand-primary-rgb), 0.5), transparent 70%);
    opacity: 0;
    transition: opacity 0.4s ease;
    pointer-events: none;
    filter: blur(20px);
}

.glass-morph:hover .stat-glow {
    opacity: 1;
}

.stat-number {
    background: linear-gradient(135deg, var(--brand-white), var(--brand-primary-light));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    line-height: 1;
}

.stat-label {
    color: rgba(255, 255, 255, 0.95);
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    text-shadow: 0 2px 8px rgba(0, 0, 0, 0.4);
}

/* Responsive Design */
@media (max-width: 1280px) {
    .features-grid {
        gap: 20px;
    }

    .stat-card-1 {
        right: -20px;
    }

    .stat-card-2 {
        left: -30px;
    }

    .stat-card-3 {
        right: -25px;
    }
}

@media (max-width: 960px) {
    .why-choose-section {
        min-height: auto;
    }

    .image-showcase {
        padding: 20px;
        margin-bottom: 50px;
    }

    .showcase-image {
        height: 450px !important;
    }

    .stat-card-1 {
        top: 30px;
        right: 10px;
    }

    .stat-card-2 {
        bottom: 100px;
        left: 10px;
    }

    .stat-card-3 {
        bottom: 30px;
        right: 10px;
    }

    .glass-morph {
        padding: 20px;
    }

    .stat-icon-modern {
        width: 50px;
        height: 50px;
        min-width: 50px;
    }

    .stat-icon-modern .v-icon {
        font-size: 26px !important;
    }

    .stat-number {
        font-size: 1.75rem !important;
    }
}

@media (max-width: 600px) {
    .why-choose-section {
        padding-top: 56px !important;
        padding-bottom: 56px !important;
    }

    .display-title {
        font-size: 1.75rem !important;
    }

    .subtitle-text {
        font-size: 1rem !important;
    }

    .overline-badge {
        padding: 8px 16px !important;
    }

    .image-showcase {
        padding: 10px;
    }

    .showcase-image {
        height: 350px !important;
    }

    .glass-morph {
        padding: 16px;
        border-radius: 16px;
    }

    .stat-card-1,
    .stat-card-2,
    .stat-card-3 {
        position: relative;
        display: block;
        margin: 16px auto;
        max-width: 280px;
        left: 0 !important;
        right: 0 !important;
        top: auto !important;
        bottom: auto !important;
    }

    .feature-card-inner {
        padding: 24px !important;
    }

    .feature-icon-wrapper {
        width: 60px;
        height: 60px;
        min-width: 60px;
    }

    .feature-icon {
        font-size: 28px !important;
    }

    .decorative-grid {
        display: none;
    }

    .floating-shapes {
        opacity: 0.5;
    }

    .shape {
        width: 200px !important;
        height: 200px !important;
    }
}
</style>
