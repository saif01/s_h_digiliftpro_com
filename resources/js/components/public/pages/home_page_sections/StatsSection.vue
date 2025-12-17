<template>
    <section class="stats-section py-8 py-md-12 bg-surface position-relative z-index-2 mt-n12">
        <div class="floating-orbs">
            <div class="orb orb-1"></div>
            <div class="orb orb-2"></div>
            <div class="orb orb-3"></div>
        </div>

        <v-container>
            <v-card elevation="0" rounded="xl" class="stats-card overflow-hidden position-relative">
                <!-- Animated Background -->
                <div class="card-glow"></div>
                <div class="card-gradient-bg"></div>

                <v-row no-gutters class="position-relative">
                    <v-col v-for="(stat, index) in stats" :key="index" cols="6" md="3" class="stat-col">
                        <div class="stat-item h-100 d-flex flex-column justify-center align-center"
                            :class="`stat-item-${index}`" :style="{ animationDelay: `${index * 0.15}s` }">
                            <!-- Icon Container -->
                            <div class="stat-icon-wrapper mb-4">
                                <div class="icon-circle">
                                    <div class="icon-pulse"></div>
                                    <v-icon :icon="getIcon(index)" size="32" class="stat-icon"></v-icon>
                                </div>
                            </div>

                            <!-- Value with Counter Animation -->
                            <div class="stat-value-wrapper mb-2">
                                <div v-if="isVisible" class="stat-value">
                                    {{ animatedValue(stat.value, index) }}
                                </div>
                                <div v-else class="stat-value">
                                    {{ stat.value }}
                                </div>
                                <div class="value-glow"></div>
                            </div>

                            <!-- Label -->
                            <div class="stat-label">
                                {{ stat.label }}
                            </div>

                            <!-- Decorative Elements -->
                            <div class="stat-sparkle sparkle-1"></div>
                            <div class="stat-sparkle sparkle-2"></div>
                        </div>
                    </v-col>
                </v-row>
            </v-card>
        </v-container>
    </section>
</template>

<script>
export default {
    name: 'StatsSection',
    props: {
        stats: {
            type: Array,
            default: () => [
                { value: '500+', label: 'Systems Installed' },
                { value: '99.9%', label: 'Power Uptime' },
                { value: '24/7', label: 'Support' },
                { value: '15+', label: 'Years Experience' }
            ]
        }
    },
    data() {
        return {
            isVisible: false,
            animatedValues: [],
            observer: null
        };
    },
    mounted() {
        this.setupIntersectionObserver();
        this.initializeAnimatedValues();
    },
    beforeUnmount() {
        if (this.observer) {
            this.observer.disconnect();
        }
    },
    methods: {
        setupIntersectionObserver() {
            const options = {
                threshold: 0.3,
                rootMargin: '0px'
            };

            this.observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting && !this.isVisible) {
                        this.isVisible = true;
                        this.startCountAnimation();
                    }
                });
            }, options);

            this.observer.observe(this.$el);
        },
        initializeAnimatedValues() {
            this.animatedValues = this.stats.map(() => 0);
        },
        startCountAnimation() {
            this.stats.forEach((stat, index) => {
                this.animateCounter(stat.value, index);
            });
        },
        animateCounter(value, index) {
            // Check if value contains special characters like "/" - don't animate these
            if (value.includes('/')) {
                this.animatedValues[index] = value;
                return;
            }

            const numericValue = this.extractNumber(value);
            if (numericValue === null) {
                this.animatedValues[index] = value;
                return;
            }

            const duration = 2000;
            const steps = 60;
            const stepDuration = duration / steps;
            const increment = numericValue / steps;
            let current = 0;
            let step = 0;

            const timer = setInterval(() => {
                step++;
                current += increment;

                if (step >= steps) {
                    current = numericValue;
                    clearInterval(timer);
                }

                this.animatedValues[index] = this.formatValue(current, value);
                this.$forceUpdate();
            }, stepDuration);
        },
        extractNumber(value) {
            // Remove non-numeric characters except decimal point
            const match = value.match(/[\d.]+/);
            return match ? parseFloat(match[0]) : null;
        },
        formatValue(current, original) {
            // Get everything that's not a digit or decimal
            const suffix = original.replace(/[\d.]/g, '');
            const hasDecimal = original.includes('.');

            if (hasDecimal) {
                return current.toFixed(1) + suffix;
            }
            return Math.floor(current) + suffix;
        },
        animatedValue(value, index) {
            return this.animatedValues[index] || value;
        },
        getIcon(index) {
            const icons = [
                'mdi-check-decagram',
                'mdi-shield-check',
                'mdi-clock-fast',
                'mdi-trophy-variant'
            ];
            return icons[index] || 'mdi-chart-line';
        }
    }
};
</script>

<style scoped>
/* Section Styles */
.stats-section {
    position: relative;
    overflow: hidden;
}

/* Floating Orbs Background */
.floating-orbs {
    position: absolute;
    inset: 0;
    pointer-events: none;
    overflow: hidden;
}

.orb {
    position: absolute;
    border-radius: 50%;
    filter: blur(60px);
    opacity: 0.15;
    animation: float-orb 20s ease-in-out infinite;
}

.orb-1 {
    width: 200px;
    height: 200px;
    background: linear-gradient(135deg, #2563eb, #7c3aed);
    top: 10%;
    left: 10%;
    animation-delay: 0s;
}

.orb-2 {
    width: 150px;
    height: 150px;
    background: linear-gradient(135deg, #f59e0b, #ef4444);
    top: 60%;
    right: 15%;
    animation-delay: 5s;
}

.orb-3 {
    width: 180px;
    height: 180px;
    background: linear-gradient(135deg, #10b981, #3b82f6);
    bottom: 20%;
    left: 20%;
    animation-delay: 10s;
}

@keyframes float-orb {

    0%,
    100% {
        transform: translate(0, 0);
    }

    50% {
        transform: translate(30px, -30px);
    }
}

/* Stats Card */
.stats-card {
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.95), rgba(255, 255, 255, 0.85));
    backdrop-filter: blur(30px);
    -webkit-backdrop-filter: blur(30px);
    border: 2px solid rgba(255, 255, 255, 0.3);
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1),
        inset 0 1px 0 rgba(255, 255, 255, 0.6);
    transition: all 0.4s ease;
}

.stats-card:hover {
    box-shadow: 0 30px 80px rgba(0, 0, 0, 0.15),
        inset 0 1px 0 rgba(255, 255, 255, 0.8);
    transform: translateY(-4px);
}

/* Card Background Effects */
.card-glow {
    position: absolute;
    inset: -2px;
    background: linear-gradient(135deg, #2563eb, #7c3aed, #f59e0b);
    opacity: 0;
    filter: blur(20px);
    transition: opacity 0.4s ease;
    z-index: 0;
}

.stats-card:hover .card-glow {
    opacity: 0.3;
}

.card-gradient-bg {
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg,
            rgba(37, 99, 235, 0.03) 0%,
            rgba(124, 58, 237, 0.03) 50%,
            rgba(245, 158, 11, 0.03) 100%);
    z-index: 0;
}

/* Stat Column */
.stat-col {
    position: relative;
}

/* Stat Item */
.stat-item {
    padding: 2.5rem 1.5rem;
    position: relative;
    cursor: pointer;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    opacity: 0;
    animation: slideInUp 0.8s ease-out forwards;
}

.stat-item::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(37, 99, 235, 0.05), rgba(245, 158, 11, 0.05));
    opacity: 0;
    transition: opacity 0.3s ease;
    z-index: 0;
}

.stat-item:hover::before {
    opacity: 1;
}

.stat-item:hover {
    transform: translateY(-8px) scale(1.05);
}

/* Dividers */
.stat-item:not(:last-child)::after {
    content: '';
    position: absolute;
    right: 0;
    top: 20%;
    height: 60%;
    width: 1px;
    background: linear-gradient(180deg,
            transparent,
            rgba(37, 99, 235, 0.3),
            transparent);
}

/* Icon Styles */
.stat-icon-wrapper {
    position: relative;
    z-index: 1;
}

.icon-circle {
    width: 64px;
    height: 64px;
    position: relative;
    background: linear-gradient(135deg, #2563eb, #7c3aed);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 8px 24px rgba(37, 99, 235, 0.3);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    animation: bounce-in 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55) both;
}

.stat-item:hover .icon-circle {
    transform: rotate(360deg) scale(1.1);
    box-shadow: 0 12px 32px rgba(37, 99, 235, 0.4);
}

.icon-pulse {
    position: absolute;
    inset: -4px;
    border-radius: 50%;
    border: 2px solid #2563eb;
    opacity: 0;
    animation: pulse-ring 2s ease-out infinite;
}

@keyframes pulse-ring {
    0% {
        transform: scale(1);
        opacity: 0.8;
    }

    100% {
        transform: scale(1.5);
        opacity: 0;
    }
}

.stat-icon {
    color: white;
    position: relative;
    z-index: 1;
    animation: icon-float 3s ease-in-out infinite;
}

@keyframes icon-float {

    0%,
    100% {
        transform: translateY(0);
    }

    50% {
        transform: translateY(-4px);
    }
}

/* Value Styles */
.stat-value-wrapper {
    position: relative;
    z-index: 1;
}

.stat-value {
    font-size: 2.5rem;
    font-weight: 900;
    background: linear-gradient(135deg, #2563eb, #7c3aed, #f59e0b);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    background-size: 200% 200%;
    animation: gradient-flow 3s ease infinite;
    letter-spacing: -1px;
    line-height: 1;
    text-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
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

.value-glow {
    position: absolute;
    inset: -10px;
    background: radial-gradient(circle, rgba(37, 99, 235, 0.3), transparent);
    opacity: 0;
    filter: blur(15px);
    transition: opacity 0.3s ease;
    z-index: 0;
}

.stat-item:hover .value-glow {
    opacity: 1;
    animation: pulse-glow 2s ease-in-out infinite;
}

@keyframes pulse-glow {

    0%,
    100% {
        transform: scale(1);
        opacity: 0.6;
    }

    50% {
        transform: scale(1.2);
        opacity: 1;
    }
}

/* Label Styles */
.stat-label {
    font-size: 0.875rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: #64748b;
    position: relative;
    z-index: 1;
    transition: all 0.3s ease;
}

.stat-item:hover .stat-label {
    color: #2563eb;
    transform: scale(1.05);
}

/* Sparkle Effects */
.stat-sparkle {
    position: absolute;
    width: 6px;
    height: 6px;
    background: #2563eb;
    clip-path: polygon(50% 0%, 61% 35%, 98% 35%, 68% 57%, 79% 91%, 50% 70%, 21% 91%, 32% 57%, 2% 35%, 39% 35%);
    opacity: 0;
    z-index: 2;
}

.sparkle-1 {
    top: 15%;
    right: 15%;
}

.sparkle-2 {
    bottom: 15%;
    left: 15%;
}

.stat-item:hover .sparkle-1 {
    animation: sparkle-twinkle 1.5s ease-in-out infinite;
}

.stat-item:hover .sparkle-2 {
    animation: sparkle-twinkle 1.5s ease-in-out 0.5s infinite;
}

@keyframes sparkle-twinkle {

    0%,
    100% {
        opacity: 0;
        transform: scale(0) rotate(0deg);
    }

    50% {
        opacity: 1;
        transform: scale(1.5) rotate(180deg);
    }
}

/* Entrance Animation */
@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translateY(40px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes bounce-in {
    0% {
        opacity: 0;
        transform: scale(0.3);
    }

    50% {
        opacity: 1;
        transform: scale(1.05);
    }

    70% {
        transform: scale(0.9);
    }

    100% {
        opacity: 1;
        transform: scale(1);
    }
}

/* Staggered Animation Delays */
.stat-item-0 {
    animation-delay: 0.1s;
}

.stat-item-1 {
    animation-delay: 0.25s;
}

.stat-item-2 {
    animation-delay: 0.4s;
}

.stat-item-3 {
    animation-delay: 0.55s;
}

/* Responsive Styles */
@media (max-width: 960px) {
    .stat-item {
        padding: 2rem 1rem;
    }

    .stat-item:not(:last-child)::after {
        display: none;
    }

    .stat-value {
        font-size: 2rem;
    }

    .icon-circle {
        width: 56px;
        height: 56px;
    }

    .stat-icon {
        font-size: 28px !important;
    }

    .stat-label {
        font-size: 0.75rem;
    }

    /* Add bottom borders for mobile */
    .stat-col:nth-child(-n+2) .stat-item::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 10%;
        width: 80%;
        height: 1px;
        background: linear-gradient(90deg,
                transparent,
                rgba(37, 99, 235, 0.3),
                transparent);
    }
}

@media (max-width: 600px) {
    .stat-item {
        padding: 1.5rem 1rem;
    }

    .stat-value {
        font-size: 1.75rem;
    }

    .icon-circle {
        width: 48px;
        height: 48px;
    }

    .stat-icon {
        font-size: 24px !important;
    }

    .stat-label {
        font-size: 0.7rem;
    }

    /* Reduce animation intensity on mobile */
    .stat-item:hover {
        transform: translateY(-4px) scale(1.02);
    }

    .orb {
        filter: blur(40px);
        opacity: 0.1;
    }
}

/* Performance optimization for mobile */
@media (hover: none) and (pointer: coarse) {
    .stat-item:hover {
        transform: none;
    }

    .stat-item:active {
        transform: scale(0.98);
    }

    .icon-circle,
    .stat-icon {
        animation: none;
    }
}

/* Reduce motion for accessibility */
@media (prefers-reduced-motion: reduce) {
    * {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
    }

    .orb,
    .icon-pulse,
    .stat-sparkle {
        display: none;
    }
}
</style>
