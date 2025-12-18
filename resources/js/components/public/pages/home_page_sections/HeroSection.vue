<template>
    <section class="hero-section">
        <!-- Animated Grid Background -->
        <div class="grid-background"></div>
        <div class="gradient-overlay"></div>

        <!-- Floating Particles -->
        <div class="particles-container">
            <div v-for="i in 20" :key="i" class="particle-dot" :style="getParticleStyle(i)"></div>
        </div>

        <!-- Gradient Orbs -->
        <div class="gradient-orbs">
            <div class="orb orb-1"></div>
            <div class="orb orb-2"></div>
            <div class="orb orb-3"></div>
        </div>

        <v-container class="hero-container">
            <v-row class="align-center min-vh-80">
                <!-- Content Column -->
                <v-col cols="12" lg="6" class="hero-content-col">
                    <div class="hero-content">
                        <!-- Badge -->
                        <div class="hero-badge mb-4">
                            <div class="badge-glow"></div>
                            <v-icon icon="mdi-lightning-bolt" size="16" class="mr-2"></v-icon>
                            <span>Transforming Ideas into Digital Reality</span>
                        </div>

                        <!-- Main Heading -->
                        <h1 class="hero-title mb-4">
                            {{ heroTitle }}
                        </h1>

                        <!-- Subtitle -->
                        <p class="hero-subtitle mb-6">
                            {{ heroSubtitle }}
                        </p>

                        <!-- Feature Pills -->
                        <div class="feature-pills mb-6">
                            <div class="feature-pill">
                                <v-icon icon="mdi-check-circle" size="18" color="success"></v-icon>
                                <span>Fast Delivery</span>
                            </div>
                            <div class="feature-pill">
                                <v-icon icon="mdi-shield-check" size="18" color="purple-accent-2"></v-icon>
                                <span>Secure & Scalable</span>
                            </div>
                            <div class="feature-pill">
                                <v-icon icon="mdi-chart-line-variant" size="18" color="blue-accent-2"></v-icon>
                                <span>SEO Optimized</span>
                            </div>
                        </div>

                        <!-- CTA Buttons -->
                        <div class="hero-actions">
                            <v-btn size="x-large" class="cta-primary" elevation="0" :to="{ name: 'Contact' }">
                                <v-icon icon="mdi-rocket-launch" class="mr-2"></v-icon>
                                Request a Quote
                                <div class="btn-glow-effect"></div>
                            </v-btn>
                            <v-btn size="x-large" variant="outlined" class="cta-secondary" to="/projects">
                                View Our Projects
                                <v-icon icon="mdi-arrow-right" class="ml-2 arrow-animate"></v-icon>
                            </v-btn>
                        </div>

                    </div>
                </v-col>

                <!-- Visual Column -->
                <v-col cols="12" lg="6" class="hero-visual-col">
                    <div class="hero-visual-wrapper">
                        <!-- Main Dashboard Card -->
                        <div class="dashboard-card main-dashboard">
                            <div class="card-header">
                                <div class="card-dots">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                                <div class="card-title">Development Dashboard</div>
                            </div>
                            <div class="card-content">
                                <div class="metric-row">
                                    <div class="metric">
                                        <v-icon icon="mdi-web" color="purple-accent-2" size="32"></v-icon>
                                        <div class="metric-info">
                                            <div class="metric-label">Websites</div>
                                            <div class="metric-value">35+</div>
                                        </div>
                                    </div>
                                    <div class="chart-mini">
                                        <div class="chart-bar" style="height: 60%"></div>
                                        <div class="chart-bar" style="height: 80%"></div>
                                        <div class="chart-bar" style="height: 100%"></div>
                                        <div class="chart-bar" style="height: 75%"></div>
                                    </div>
                                </div>
                                <div class="metric-row">
                                    <div class="metric">
                                        <v-icon icon="mdi-application" color="blue-accent-2" size="32"></v-icon>
                                        <div class="metric-info">
                                            <div class="metric-label">Web Apps</div>
                                            <div class="metric-value">20+</div>
                                        </div>
                                    </div>
                                    <div class="progress-ring">
                                        <svg viewBox="0 0 36 36">
                                            <path
                                                d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
                                                fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="3" />
                                            <path class="circle-progress"
                                                d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
                                                fill="none" stroke-width="3" stroke-dasharray="85, 100" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Floating Cards -->
                        <div class="floating-card card-1">
                            <v-icon icon="mdi-chart-line" size="32" color="success"></v-icon>
                            <div class="floating-card-content">
                                <div class="floating-card-title">SEO Growth</div>
                                <div class="floating-card-value">+245%</div>
                            </div>
                        </div>

                        <div class="floating-card card-2">
                            <v-icon icon="mdi-rocket-launch-outline" size="32" color="purple-accent-2"></v-icon>
                            <div class="floating-card-content">
                                <div class="floating-card-title">Fast Deploy</div>
                                <div class="floating-card-value">&lt; 2 days</div>
                            </div>
                        </div>

                        <div class="floating-card card-3">
                            <v-icon icon="mdi-shield-check" size="32" color="blue-accent-2"></v-icon>
                            <div class="floating-card-content">
                                <div class="floating-card-title">Secure</div>
                                <div class="floating-card-value">100%</div>
                            </div>
                        </div>

                        <!-- Code Window -->
                        <div class="code-window">
                            <div class="code-header">
                                <div class="code-dots">
                                    <span style="background: #ff5f57"></span>
                                    <span style="background: #febc2e"></span>
                                    <span style="background: #28c840"></span>
                                </div>
                                <span class="code-title">app.vue</span>
                            </div>
                            <div class="code-content">
                                <div class="code-line"><span class="code-keyword">const</span> <span
                                        class="code-variable">deploy</span> = <span
                                        class="code-string">'production'</span></div>
                                <div class="code-line"><span class="code-keyword">await</span> <span
                                        class="code-function">build</span>()</div>
                                <div class="code-line"><span class="code-comment">// Success! 🚀</span></div>
                            </div>
                        </div>
                    </div>
                </v-col>
            </v-row>
        </v-container>

        <!-- Animated Multi-Layer Wave Divider -->
        <div class="wave-divider-animated">
            <svg viewBox="0 0 1200 120" preserveAspectRatio="none">
                <!-- Wave Layer 1 (Back) -->
                <path class="wave-layer wave-layer-1"
                    d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z">
                </path>
                <!-- Wave Layer 2 (Middle) -->
                <path class="wave-layer wave-layer-2"
                    d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z">
                </path>
                <!-- Wave Layer 3 (Front) -->
                <path class="wave-layer wave-layer-3"
                    d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z">
                </path>
            </svg>
        </div>

        <!-- Scroll Indicator -->
        <div class="scroll-indicator">
            <div class="scroll-mouse">
                <div class="scroll-wheel"></div>
            </div>
            <span class="scroll-text">Scroll to explore</span>
        </div>
    </section>
</template>

<script>
export default {
    name: 'HeroSection',
    props: {
        heroTitle: {
            type: String,
            default: 'Build, Manage, and Grow Your Digital Business'
        },
        heroSubtitle: {
            type: String,
            default: 'Websites, SEO, email services, and web asset management—delivered with clear planning, measurable results, and long-term support.'
        }
    },
    methods: {
        getParticleStyle(index) {
            const size = Math.random() * 4 + 2;
            const x = Math.random() * 100;
            const y = Math.random() * 100;
            const delay = Math.random() * 20;
            const duration = Math.random() * 20 + 20;

            return {
                width: `${size}px`,
                height: `${size}px`,
                left: `${x}%`,
                top: `${y}%`,
                animationDelay: `${delay}s`,
                animationDuration: `${duration}s`
            };
        }
    }
};
</script>

<style scoped>
/* ===== BASE STYLES ===== */
.hero-section {
    position: relative;
    min-height: 100vh;
    max-height: 100vh;
    display: flex;
    align-items: center;
    overflow: hidden;
    background: var(--brand-gradient-hero);
    padding: 80px 0 100px;
    isolation: isolate;
    will-change: transform;
}

.min-vh-80 {
    min-height: 80vh;
}

/* Performance optimizations */
* {
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}

/* Smooth animations */
@media (prefers-reduced-motion: reduce) {

    *,
    *::before,
    *::after {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
    }
}

/* ===== ANIMATED GRID BACKGROUND ===== */
.grid-background {
    position: absolute;
    inset: 0;
    background-image:
        linear-gradient(rgba(var(--brand-primary-rgb), 0.1) 1px, transparent 1px),
        linear-gradient(90deg, rgba(var(--brand-primary-rgb), 0.1) 1px, transparent 1px);
    background-size: 50px 50px;
    animation: gridMove 20s linear infinite;
    z-index: 1;
}

@keyframes gridMove {
    0% {
        transform: translate(0, 0);
    }

    100% {
        transform: translate(50px, 50px);
    }
}

.gradient-overlay {
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at 30% 20%, rgba(var(--brand-primary-rgb), 0.15) 0%, transparent 50%),
        radial-gradient(circle at 70% 80%, rgba(var(--brand-accent-blue-rgb), 0.15) 0%, transparent 50%);
    z-index: 2;
}

/* ===== PARTICLES ===== */
.particles-container {
    position: absolute;
    inset: 0;
    overflow: hidden;
    z-index: 1;
}

.particle-dot {
    position: absolute;
    background: rgba(var(--brand-primary-rgb), 0.6);
    border-radius: 50%;
    animation: floatParticle 30s infinite ease-in-out;
    pointer-events: none;
    will-change: transform, opacity;
}

@keyframes floatParticle {

    0%,
    100% {
        transform: translate(0, 0) scale(1);
        opacity: 0;
    }

    10% {
        opacity: 1;
    }

    90% {
        opacity: 1;
    }

    100% {
        transform: translate(100px, -100px) scale(0);
        opacity: 0;
    }
}

/* ===== GRADIENT ORBS ===== */
.gradient-orbs {
    position: absolute;
    inset: 0;
    z-index: 1;
}

.orb {
    position: absolute;
    border-radius: 50%;
    filter: blur(80px);
    opacity: 0.4;
    animation: moveOrb 20s ease-in-out infinite;
    will-change: transform;
    transform: translateZ(0);
    backface-visibility: hidden;
}

.orb-1 {
    width: 500px;
    height: 500px;
    background: var(--brand-gradient-purple-glow);
    top: -250px;
    left: -200px;
}

.orb-2 {
    width: 400px;
    height: 400px;
    background: var(--brand-gradient-blue-cyan);
    bottom: -200px;
    right: -150px;
    animation-delay: -10s;
}

.orb-3 {
    width: 300px;
    height: 300px;
    background: linear-gradient(45deg, var(--brand-secondary), var(--brand-accent-blue));
    top: 50%;
    right: 10%;
    animation-delay: -5s;
}

@keyframes moveOrb {

    0%,
    100% {
        transform: translate(0, 0) scale(1);
    }

    33% {
        transform: translate(30px, -30px) scale(1.1);
    }

    66% {
        transform: translate(-20px, 20px) scale(0.9);
    }
}

/* ===== CONTAINER ===== */
.hero-container {
    position: relative;
    z-index: 10;
}

/* ===== HERO CONTENT ===== */
.hero-content {
    color: white;
    animation: fadeInUp 1s ease-out;
    will-change: transform, opacity;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Badge */
.hero-badge {
    display: inline-flex;
    align-items: center;
    padding: 10px 24px;
    background: rgba(var(--brand-primary-rgb), 0.25);
    border: 1.5px solid rgba(var(--brand-primary-rgb), 0.6);
    border-radius: 50px;
    font-size: 14px;
    font-weight: 600;
    letter-spacing: 0.5px;
    position: relative;
    overflow: hidden;
    animation: fadeInScale 0.6s ease-out 0.2s both;
    width: fit-content;
    color: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    box-shadow: 0 4px 15px rgba(var(--brand-primary-rgb), 0.2),
        inset 0 1px 0 rgba(255, 255, 255, 0.1);
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

.hero-badge:hover {
    background: rgba(var(--brand-primary-rgb), 0.35);
    border-color: rgba(var(--brand-primary-rgb), 0.8);
    box-shadow: 0 6px 20px rgba(var(--brand-primary-rgb), 0.3),
        inset 0 1px 0 rgba(255, 255, 255, 0.15);
    transform: translateY(-2px);
}

.hero-badge .v-icon {
    color: rgba(var(--brand-primary-rgb), 1);
    filter: drop-shadow(0 0 8px rgba(var(--brand-primary-rgb), 0.6));
}

@keyframes fadeInScale {
    from {
        opacity: 0;
        transform: scale(0.8);
    }

    to {
        opacity: 1;
        transform: scale(1);
    }
}

.badge-glow {
    position: absolute;
    inset: 0;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
    animation: badgeGlow 3s ease-in-out infinite;
    z-index: 1;
}

.hero-badge span,
.hero-badge .v-icon {
    position: relative;
    z-index: 2;
}

@keyframes badgeGlow {

    0%,
    100% {
        transform: translateX(-100%);
    }

    50% {
        transform: translateX(100%);
    }
}

/* Title */
.hero-title {
    font-size: clamp(1.5rem, 4vw, 2.5rem);
    font-weight: 800;
    line-height: 1.15;
    background: linear-gradient(135deg, #ffffff 0%, #e0e7ff 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    animation: fadeInUp 0.8s ease-out 0.4s both;
}

/* Subtitle */
.hero-subtitle {
    font-size: clamp(0.85rem, 1.5vw, 1rem);
    line-height: 1.6;
    color: rgba(255, 255, 255, 0.8);
    max-width: 580px;
    animation: fadeInUp 0.8s ease-out 0.6s both;
}

/* Feature Pills */
.feature-pills {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    animation: fadeInUp 0.8s ease-out 0.8s both;
}

.feature-pill {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 8px 16px;
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 50px;
    font-size: 14px;
    font-weight: 500;
    backdrop-filter: blur(10px);
    transition: all 0.3s ease;
}

.feature-pill:hover {
    background: var(--brand-overlay-medium);
    border-color: rgba(var(--brand-primary-rgb), 0.5);
    transform: translateY(-2px);
}

/* CTA Buttons */
.hero-actions {
    display: flex;
    gap: 16px;
    flex-wrap: wrap;
    animation: fadeInUp 0.8s ease-out 1s both;
    will-change: transform, opacity;
}

.cta-primary {
    background: var(--brand-gradient-primary) !important;
    color: white !important;
    font-weight: 600 !important;
    letter-spacing: 0.3px;
    padding: 12px 28px !important;
    border-radius: 50px !important;
    position: relative;
    overflow: hidden;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
}

.cta-primary:hover {
    transform: translateY(-3px);
    box-shadow: var(--brand-shadow-hover) !important;
}

.btn-glow-effect {
    position: absolute;
    inset: 0;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
    transform: translateX(-100%);
}

.cta-primary:hover .btn-glow-effect {
    animation: buttonGlow 0.8s ease-out;
}

@keyframes buttonGlow {
    to {
        transform: translateX(100%);
    }
}

.cta-secondary {
    background: transparent !important;
    color: white !important;
    border: 2px solid rgba(255, 255, 255, 0.3) !important;
    font-weight: 600 !important;
    letter-spacing: 0.3px;
    padding: 12px 28px !important;
    border-radius: 50px !important;
    transition: all 0.3s ease !important;
}

.cta-secondary:hover {
    border-color: rgba(var(--brand-primary-rgb), 0.8) !important;
    background: rgba(var(--brand-primary-rgb), 0.1) !important;
    transform: translateY(-3px);
    box-shadow: 0 10px 30px rgba(var(--brand-primary-rgb), 0.2);
}

.arrow-animate {
    transition: transform 0.3s ease;
}

.cta-secondary:hover .arrow-animate {
    transform: translateX(5px);
}

/* ===== HERO VISUAL ===== */
.hero-visual-col {
    position: relative;
}

.hero-visual-wrapper {
    position: relative;
    width: 100%;
    height: 500px;
    animation: fadeInRight 1s ease-out 0.4s both;
}

@keyframes fadeInRight {
    from {
        opacity: 0;
        transform: translateX(50px);
    }

    to {
        opacity: 1;
        transform: translateX(0);
    }
}

/* Main Dashboard Card */
.dashboard-card {
    position: absolute;
    width: 100%;
    max-width: 380px;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: var(--brand-overlay-light);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    border: 1px solid var(--brand-overlay-medium);
    border-radius: 20px;
    padding: 20px;
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
    animation: float 6s ease-in-out infinite, fadeInScale 1s ease-out 0.3s both;
    z-index: 2;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    will-change: transform;
    transform: translate(-50%, -50%) translateZ(0);
    backface-visibility: hidden;
}

.dashboard-card:hover {
    box-shadow: 0 30px 60px rgba(124, 58, 237, 0.4);
}

@keyframes float {

    0%,
    100% {
        transform: translate(-50%, -50%) translateY(0);
    }

    50% {
        transform: translate(-50%, -50%) translateY(-20px);
    }
}

@keyframes fadeInScale {
    from {
        opacity: 0;
        transform: translate(-50%, -50%) scale(0.8);
    }

    to {
        opacity: 1;
        transform: translate(-50%, -50%) scale(1);
    }
}

.card-header {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 24px;
}

.card-dots {
    display: flex;
    gap: 6px;
}

.card-dots span {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.3);
}

.card-title {
    color: white;
    font-weight: 600;
    font-size: 14px;
}

.card-content {
    display: flex;
    flex-direction: column;
    gap: 14px;
}

.metric-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px;
    background: rgba(255, 255, 255, 0.03);
    border-radius: 10px;
    border: 1px solid rgba(255, 255, 255, 0.05);
    transition: all 0.3s ease;
    animation: slideInFromLeft 0.8s ease-out both;
}

.metric-row:nth-child(1) {
    animation-delay: 0.5s;
}

.metric-row:nth-child(2) {
    animation-delay: 0.7s;
}

.metric-row:hover {
    background: rgba(255, 255, 255, 0.06);
    border-color: rgba(124, 58, 237, 0.3);
    transform: translateX(5px);
    box-shadow: 0 4px 12px rgba(124, 58, 237, 0.2);
}

@keyframes slideInFromLeft {
    from {
        opacity: 0;
        transform: translateX(-30px);
    }

    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.metric {
    display: flex;
    align-items: center;
    gap: 16px;
}

.metric v-icon,
.metric .v-icon {
    transition: all 0.3s ease;
    animation: iconFloat 3s ease-in-out infinite;
}

.metric-row:hover .metric v-icon,
.metric-row:hover .metric .v-icon {
    transform: scale(1.1) rotate(5deg);
}

@keyframes iconFloat {

    0%,
    100% {
        transform: translateY(0);
    }

    50% {
        transform: translateY(-3px);
    }
}

.metric-info {
    color: white;
}

.metric-label {
    font-size: 13px;
    opacity: 0.7;
}

.metric-value {
    font-size: 24px;
    font-weight: 700;
}

.chart-mini {
    display: flex;
    align-items: flex-end;
    gap: 6px;
    height: 40px;
}

.chart-bar {
    width: 8px;
    background: var(--brand-gradient-primary);
    border-radius: 4px;
    animation: growBar 2s ease-in-out infinite alternate, barPulse 1.5s ease-out infinite;
    transform-origin: bottom;
    box-shadow: 0 4px 8px rgba(124, 58, 237, 0.3);
}

.chart-bar:nth-child(1) {
    animation-delay: 0s, 0s;
}

.chart-bar:nth-child(2) {
    animation-delay: 0.2s, 0.2s;
}

.chart-bar:nth-child(3) {
    animation-delay: 0.4s, 0.4s;
}

.chart-bar:nth-child(4) {
    animation-delay: 0.6s, 0.6s;
}

@keyframes growBar {
    0% {
        opacity: 0.6;
        transform: scaleY(0.9);
    }

    100% {
        opacity: 1;
        transform: scaleY(1);
    }
}

@keyframes barPulse {

    0%,
    100% {
        box-shadow: 0 4px 8px rgba(124, 58, 237, 0.3);
    }

    50% {
        box-shadow: 0 6px 12px rgba(124, 58, 237, 0.5);
    }
}

.progress-ring {
    width: 40px;
    height: 40px;
    filter: drop-shadow(0 0 8px rgba(124, 58, 237, 0.5));
    animation: ringPulse 2s ease-in-out infinite;
}

@keyframes ringPulse {

    0%,
    100% {
        filter: drop-shadow(0 0 8px rgba(124, 58, 237, 0.5));
    }

    50% {
        filter: drop-shadow(0 0 12px rgba(124, 58, 237, 0.8));
    }
}

.circle-progress {
    stroke: var(--brand-primary);
    stroke-linecap: round;
    animation: progressRotate 3s cubic-bezier(0.4, 0, 0.2, 1) infinite;
    transform-origin: center;
}

@keyframes progressRotate {
    0% {
        stroke-dasharray: 0, 100;
        transform: rotate(0deg);
    }

    50% {
        stroke-dasharray: 85, 100;
        transform: rotate(180deg);
    }

    100% {
        stroke-dasharray: 85, 100;
        transform: rotate(360deg);
    }
}

/* Floating Cards */
.floating-card {
    position: absolute;
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px 16px;
    background: var(--brand-backdrop-blur);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    border: 1px solid var(--brand-overlay-strong);
    border-radius: 14px;
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
    animation: floatCard 4s ease-in-out infinite;
    transition: all 0.3s ease;
    will-change: transform;
    transform: translateZ(0);
    backface-visibility: hidden;
}

.floating-card:hover {
    transform: scale(1.05) translateY(-5px) !important;
    box-shadow: 0 20px 40px rgba(124, 58, 237, 0.3);
    border-color: rgba(124, 58, 237, 0.5);
}

@keyframes floatCard {

    0%,
    100% {
        transform: translateY(0) rotate(0deg);
    }

    25% {
        transform: translateY(-10px) rotate(1deg);
    }

    50% {
        transform: translateY(-15px) rotate(-1deg);
    }

    75% {
        transform: translateY(-10px) rotate(1deg);
    }
}

.card-1 {
    top: 10%;
    right: -20px;
    animation: floatCard 4s ease-in-out infinite, slideInRight 1s ease-out 0.5s both;
    z-index: 3;
}

.card-2 {
    top: 50%;
    left: -30px;
    animation: floatCard 4s ease-in-out infinite 1s, slideInLeft 1s ease-out 0.7s both;
    z-index: 3;
}

.card-3 {
    bottom: 15%;
    right: -10px;
    animation: floatCard 4s ease-in-out infinite 2s, slideInRight 1s ease-out 0.9s both;
    z-index: 3;
}

@keyframes slideInRight {
    from {
        opacity: 0;
        transform: translateX(50px);
    }

    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes slideInLeft {
    from {
        opacity: 0;
        transform: translateX(-50px);
    }

    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.floating-card-content {
    color: white;
}

.floating-card-title {
    font-size: 12px;
    opacity: 0.8;
}

.floating-card-value {
    font-size: 18px;
    font-weight: 700;
}

/* Floating card icon animations */
.floating-card v-icon,
.floating-card .v-icon {
    transition: all 0.3s ease;
}

.floating-card:hover v-icon,
.floating-card:hover .v-icon {
    transform: scale(1.2) rotate(5deg);
}

.card-1 v-icon,
.card-1 .v-icon {
    animation: iconBounce 2s ease-in-out infinite;
}

.card-2 v-icon,
.card-2 .v-icon {
    animation: iconSpin 3s linear infinite;
}

.card-3 v-icon,
.card-3 .v-icon {
    animation: iconPulse 2s ease-in-out infinite;
}

@keyframes iconBounce {

    0%,
    100% {
        transform: translateY(0);
    }

    50% {
        transform: translateY(-5px);
    }
}

@keyframes iconSpin {
    from {
        transform: rotate(0deg);
    }

    to {
        transform: rotate(360deg);
    }
}

@keyframes iconPulse {

    0%,
    100% {
        transform: scale(1);
    }

    50% {
        transform: scale(1.1);
    }
}

/* Code Window */
.code-window {
    position: absolute;
    bottom: 10%;
    left: 10%;
    width: 240px;
    background: rgba(15, 23, 42, 0.98);
    border: 1px solid rgba(124, 58, 237, 0.3);
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4), 0 0 20px rgba(124, 58, 237, 0.2);
    animation: fadeInUp 1.5s ease-out 1s both, pulseGlow 3s ease-in-out 2s infinite;
    z-index: 4;
    transition: all 0.3s ease;
}

.code-window:hover {
    transform: translateY(-5px) scale(1.02);
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.5), 0 0 30px rgba(124, 58, 237, 0.4);
    border-color: rgba(124, 58, 237, 0.6);
}

@keyframes pulseGlow {

    0%,
    100% {
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4), 0 0 20px rgba(124, 58, 237, 0.2);
    }

    50% {
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4), 0 0 30px rgba(124, 58, 237, 0.4);
    }
}

.code-header {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 12px;
    background: rgba(255, 255, 255, 0.05);
    border-bottom: 1px solid rgba(255, 255, 255, 0.05);
}

.code-dots {
    display: flex;
    gap: 6px;
}

.code-dots span {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    animation: dotPulse 2s ease-in-out infinite;
}

.code-dots span:nth-child(1) {
    animation-delay: 0s;
}

.code-dots span:nth-child(2) {
    animation-delay: 0.2s;
}

.code-dots span:nth-child(3) {
    animation-delay: 0.4s;
}

@keyframes dotPulse {

    0%,
    100% {
        opacity: 1;
        transform: scale(1);
    }

    50% {
        opacity: 0.6;
        transform: scale(0.8);
    }
}

.code-title {
    color: rgba(255, 255, 255, 0.7);
    font-size: 12px;
}

.code-content {
    padding: 12px;
    font-family: 'Courier New', monospace;
    font-size: 12px;
}

.code-line {
    color: #e2e8f0;
    margin-bottom: 8px;
    animation: fadeInCode 0.5s ease-out both;
}

.code-line:nth-child(1) {
    animation-delay: 1.5s;
}

.code-line:nth-child(2) {
    animation-delay: 1.7s;
}

.code-line:nth-child(3) {
    animation-delay: 1.9s;
}

@keyframes fadeInCode {
    from {
        opacity: 0;
        transform: translateX(-10px);
    }

    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.code-keyword {
    color: #c792ea;
}

.code-variable {
    color: #82aaff;
}

.code-string {
    color: #c3e88d;
}

.code-function {
    color: #ffcb6b;
}

.code-comment {
    color: #546e7a;
}

/* ===== ANIMATED WAVE DIVIDER ===== */
.wave-divider-animated {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    line-height: 0;
    transform: rotate(180deg);
    z-index: 5;
    overflow: hidden;
}

.wave-divider-animated svg {
    display: block;
    width: calc(100% + 1.3px);
    height: 100px;
    position: relative;
    filter: drop-shadow(0 -6px 12px rgba(0, 0, 0, 0.3));
}

/* Multi-layer wave animation */
.wave-layer {
    fill: #f8fafc;
    stroke: rgba(255, 255, 255, 0.1);
    stroke-width: 0.5;
}

.wave-layer-1 {
    opacity: 0.35;
    fill: #ffffff;
    animation: wave1 10s ease-in-out infinite;
}

.wave-layer-2 {
    opacity: 0.65;
    fill: #f1f5f9;
    animation: wave2 8s ease-in-out infinite;
    animation-delay: -2s;
}

.wave-layer-3 {
    opacity: 1;
    fill: #f8fafc;
    animation: wave3 12s ease-in-out infinite;
    animation-delay: -4s;
}

/* Add glow effect for better visibility */
.wave-divider-animated::before {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 20px;
    background: linear-gradient(to top, rgba(248, 250, 252, 0.2), transparent);
    z-index: -1;
}

/* ===== SCROLL INDICATOR ===== */
.scroll-indicator {
    position: absolute;
    bottom: 120px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 8px;
    z-index: 10;
    animation: fadeInUp 1s ease-out 2s both;
}

.scroll-mouse {
    width: 24px;
    height: 36px;
    border: 2px solid rgba(255, 255, 255, 0.5);
    border-radius: 12px;
    position: relative;
    animation: scrollPulse 2s ease-in-out infinite;
}

.scroll-wheel {
    width: 3px;
    height: 8px;
    background: rgba(255, 255, 255, 0.8);
    border-radius: 2px;
    position: absolute;
    top: 8px;
    left: 50%;
    transform: translateX(-50%);
    animation: scrollWheel 2s ease-in-out infinite;
}

.scroll-text {
    color: rgba(255, 255, 255, 0.7);
    font-size: 12px;
    font-weight: 500;
    letter-spacing: 1px;
    text-transform: uppercase;
}

@keyframes scrollPulse {

    0%,
    100% {
        opacity: 1;
        transform: translateY(0);
    }

    50% {
        opacity: 0.6;
        transform: translateY(5px);
    }
}

@keyframes scrollWheel {
    0% {
        opacity: 1;
        transform: translateX(-50%) translateY(0);
    }

    100% {
        opacity: 0;
        transform: translateX(-50%) translateY(16px);
    }
}

/* Wave animations for depth effect */
@keyframes wave1 {

    0%,
    100% {
        transform: translateX(0) translateY(0);
    }

    25% {
        transform: translateX(-5%) translateY(-3px);
    }

    50% {
        transform: translateX(0) translateY(3px);
    }

    75% {
        transform: translateX(5%) translateY(-2px);
    }
}

@keyframes wave2 {

    0%,
    100% {
        transform: translateX(0) translateY(0);
    }

    25% {
        transform: translateX(4%) translateY(3px);
    }

    50% {
        transform: translateX(0) translateY(-3px);
    }

    75% {
        transform: translateX(-4%) translateY(2px);
    }
}

@keyframes wave3 {

    0%,
    100% {
        transform: translateX(0) translateY(0);
    }

    33% {
        transform: translateX(-3%) translateY(-2px);
    }

    66% {
        transform: translateX(3%) translateY(2px);
    }
}

/* ===== RESPONSIVE ===== */
@media (max-width: 1280px) {
    .floating-card {
        padding: 12px 16px;
    }

    .card-1,
    .card-3 {
        right: 0;
    }

    .card-2 {
        left: -10px;
    }
}

@media (max-width: 1024px) {
    .hero-section {
        padding: 70px 0 90px;
        max-height: none;
    }

    .hero-content {
        text-align: left;
        max-width: 100%;
    }

    .hero-subtitle {
        max-width: 100%;
    }

    .feature-pills {
        justify-content: flex-start;
    }

    .hero-actions {
        justify-content: flex-start;
    }

    .hero-visual-wrapper {
        height: 500px;
        margin-top: 60px;
    }

    .dashboard-card {
        max-width: 380px;
    }

    .floating-card {
        font-size: 14px;
    }

    .code-window {
        width: 240px;
        left: 5%;
        bottom: 5%;
    }
}

@media (max-width: 768px) {
    .hero-section {
        padding: 70px 0 70px;
        min-height: 100vh;
        max-height: 100vh;
        display: flex;
        align-items: center;
    }

    .scroll-indicator {
        display: none;
    }

    .hero-title {
        font-size: 1.65rem;
    }

    .hero-subtitle {
        font-size: 0.875rem;
        line-height: 1.5;
    }

    .hero-badge {
        margin-bottom: 16px !important;
        padding: 8px 18px;
        font-size: 12px;
    }

    .hero-actions {
        flex-direction: column;
        width: 100%;
        gap: 12px;
        margin-bottom: 24px !important;
    }

    .cta-primary,
    .cta-secondary {
        width: 100%;
        justify-content: center;
        padding: 10px 24px !important;
    }

    .feature-pills {
        gap: 8px;
        margin-bottom: 20px !important;
    }

    .feature-pill {
        padding: 6px 12px;
        font-size: 12px;
    }

    .hero-visual-wrapper {
        height: 320px;
        margin-top: 32px;
    }

    .dashboard-card {
        max-width: 280px;
        padding: 14px;
    }

    .metric-row {
        padding: 10px;
    }

    .metric-value {
        font-size: 18px;
    }

    .metric-label {
        font-size: 11px;
    }

    .floating-card {
        padding: 8px 10px;
        font-size: 11px;
    }

    .floating-card-value {
        font-size: 14px;
    }

    .code-window {
        width: 180px;
        left: 0;
        bottom: 0;
    }

    .code-content {
        padding: 10px;
        font-size: 10px;
    }

    .wave-divider-animated svg {
        height: 50px;
        filter: drop-shadow(0 -4px 8px rgba(0, 0, 0, 0.2));
    }
}

@media (max-width: 600px) {
    .hero-section {
        padding: 65px 0 60px;
        min-height: 100vh;
        max-height: 100vh;
    }

    .hero-badge {
        font-size: 11px;
        padding: 7px 16px;
        margin-bottom: 12px !important;
    }

    .hero-title {
        font-size: 1.4rem;
        margin-bottom: 12px !important;
        line-height: 1.2;
    }

    .hero-subtitle {
        font-size: 0.8rem;
        line-height: 1.45;
        margin-bottom: 16px !important;
    }

    .feature-pills {
        margin-bottom: 16px !important;
        gap: 6px;
    }

    .feature-pill {
        padding: 5px 10px;
        font-size: 11px;
    }

    .feature-pill v-icon {
        font-size: 16px;
    }

    .hero-actions {
        margin-bottom: 20px !important;
        gap: 10px;
    }

    .cta-primary,
    .cta-secondary {
        padding: 9px 20px !important;
        font-size: 14px;
    }

    .hero-visual-wrapper {
        height: 260px;
        margin-top: 24px;
    }

    .dashboard-card {
        max-width: 240px;
        padding: 12px;
        border-radius: 16px;
    }

    .card-header {
        margin-bottom: 12px;
    }

    .card-title {
        font-size: 12px;
    }

    .card-content {
        gap: 10px;
    }

    .metric-row {
        padding: 8px;
    }

    .metric-value {
        font-size: 16px;
    }

    .metric-label {
        font-size: 10px;
    }

    .floating-card {
        padding: 7px 9px;
        font-size: 10px;
        gap: 8px;
    }

    .floating-card-title {
        font-size: 10px;
    }

    .floating-card-value {
        font-size: 13px;
    }

    .code-window {
        width: 160px;
        left: 0;
        bottom: 0;
    }

    .code-header {
        padding: 8px;
    }

    .code-content {
        padding: 8px;
        font-size: 9px;
    }

    .code-line {
        margin-bottom: 4px;
    }

    .wave-divider-animated svg {
        height: 40px;
        filter: drop-shadow(0 -3px 6px rgba(0, 0, 0, 0.25));
    }

    .orb {
        filter: blur(50px);
        opacity: 0.25;
    }

    .orb-1 {
        width: 250px;
        height: 250px;
    }

    .orb-2 {
        width: 200px;
        height: 200px;
    }

    .orb-3 {
        width: 150px;
        height: 150px;
    }
}

/* Extra small devices (iPhone SE, small Android phones) */
@media (max-width: 375px) {
    .hero-section {
        padding: 60px 0 55px;
        min-height: 100vh;
        max-height: 100vh;
    }

    .hero-badge {
        font-size: 10px;
        padding: 6px 14px;
        margin-bottom: 10px !important;
    }

    .hero-title {
        font-size: 1.25rem;
        margin-bottom: 10px !important;
    }

    .hero-subtitle {
        font-size: 0.75rem;
        margin-bottom: 14px !important;
        line-height: 1.4;
    }

    .feature-pills {
        margin-bottom: 14px !important;
        gap: 5px;
        flex-wrap: wrap;
    }

    .feature-pill {
        padding: 4px 8px;
        font-size: 10px;
    }

    .hero-actions {
        margin-bottom: 18px !important;
        gap: 8px;
    }

    .cta-primary,
    .cta-secondary {
        padding: 8px 18px !important;
        font-size: 13px;
    }

    .hero-visual-wrapper {
        height: 220px;
        margin-top: 20px;
    }

    .dashboard-card {
        max-width: 200px;
        padding: 10px;
    }

    .card-title {
        font-size: 11px;
    }

    .metric-value {
        font-size: 14px;
    }

    .metric-label {
        font-size: 9px;
    }

    .floating-card {
        padding: 6px 8px;
        font-size: 9px;
    }

    .floating-card-value {
        font-size: 12px;
    }

    .code-window {
        width: 140px;
    }

    .code-content {
        padding: 6px;
        font-size: 8px;
    }

    .wave-divider-animated svg {
        height: 35px;
        filter: drop-shadow(0 -2px 5px rgba(0, 0, 0, 0.3));
    }
}

/* Mobile landscape orientation */
@media (max-width: 900px) and (max-height: 500px) and (orientation: landscape) {
    .hero-section {
        padding: 40px 0 40px;
        min-height: 100vh;
        max-height: none;
    }

    .hero-badge {
        margin-bottom: 8px !important;
        padding: 7px 16px;
        font-size: 11px;
    }

    .hero-title {
        font-size: 1.4rem;
        margin-bottom: 8px !important;
    }

    .hero-subtitle {
        font-size: 0.8rem;
        margin-bottom: 12px !important;
        line-height: 1.4;
    }

    .feature-pills {
        margin-bottom: 12px !important;
        gap: 6px;
    }

    .feature-pill {
        padding: 4px 10px;
        font-size: 11px;
    }

    .hero-actions {
        margin-bottom: 16px !important;
        flex-direction: row !important;
        gap: 12px;
    }

    .cta-primary,
    .cta-secondary {
        width: auto !important;
        padding: 8px 20px !important;
        font-size: 13px;
    }

    .hero-visual-wrapper {
        height: 280px;
        margin-top: 0;
    }

    .dashboard-card {
        max-width: 240px;
        padding: 12px;
    }

    .wave-divider-animated svg {
        height: 30px;
        filter: drop-shadow(0 -2px 4px rgba(0, 0, 0, 0.3));
    }
}
</style>
