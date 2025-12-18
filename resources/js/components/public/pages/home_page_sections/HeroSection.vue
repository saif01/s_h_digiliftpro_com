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
                        <div class="hero-badge mb-6">
                            <div class="badge-glow"></div>
                            <v-icon icon="mdi-lightning-bolt" size="16" class="mr-2"></v-icon>
                            <span>Transforming Ideas into Digital Reality</span>
                        </div>

                        <!-- Main Heading -->
                        <h1 class="hero-title mb-6">
                            {{ heroTitle }}
                        </h1>

                        <!-- Subtitle -->
                        <p class="hero-subtitle mb-8">
                            {{ heroSubtitle }}
                        </p>

                        <!-- Feature Pills -->
                        <div class="feature-pills mb-8">
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
                        <div class="hero-actions mb-10">
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

        <!-- Modern Wave Divider -->
        <div class="wave-divider-modern">
            <svg viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path
                    d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z"
                    class="shape-fill"></path>
            </svg>
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
    display: flex;
    align-items: center;
    overflow: hidden;
    background: var(--brand-gradient-hero);
    padding: 120px 0 140px;
}

.min-vh-80 {
    min-height: 80vh;
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
    padding: 8px 20px;
    background: rgba(var(--brand-primary-rgb), 0.2);
    border: 1px solid rgba(var(--brand-primary-rgb), 0.4);
    border-radius: 50px;
    font-size: 13px;
    font-weight: 600;
    letter-spacing: 0.5px;
    position: relative;
    overflow: hidden;
    animation: fadeInScale 0.6s ease-out 0.2s both;
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
    background: linear-gradient(90deg, transparent, rgba(var(--brand-primary-rgb), 0.5), transparent);
    animation: badgeGlow 3s ease-in-out infinite;
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
    font-size: clamp(2rem, 5vw, 3.5rem);
    font-weight: 800;
    line-height: 1.2;
    background: linear-gradient(135deg, #ffffff 0%, #e0e7ff 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    animation: fadeInUp 0.8s ease-out 0.4s both;
}

/* Subtitle */
.hero-subtitle {
    font-size: clamp(1rem, 2vw, 1.25rem);
    line-height: 1.7;
    color: rgba(255, 255, 255, 0.8);
    max-width: 600px;
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
}

.cta-primary {
    background: var(--brand-gradient-primary) !important;
    color: white !important;
    font-weight: 600 !important;
    letter-spacing: 0.3px;
    padding: 14px 32px !important;
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
    padding: 14px 32px !important;
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
    height: 600px;
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
    max-width: 450px;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: var(--brand-overlay-light);
    backdrop-filter: blur(20px);
    border: 1px solid var(--brand-overlay-medium);
    border-radius: 24px;
    padding: 24px;
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
    animation: float 6s ease-in-out infinite;
    z-index: 2;
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
    gap: 20px;
}

.metric-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 16px;
    background: rgba(255, 255, 255, 0.03);
    border-radius: 12px;
    border: 1px solid rgba(255, 255, 255, 0.05);
}

.metric {
    display: flex;
    align-items: center;
    gap: 16px;
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
    animation: growBar 1.5s ease-out infinite alternate;
}

.chart-bar:nth-child(1) {
    animation-delay: 0s;
}

.chart-bar:nth-child(2) {
    animation-delay: 0.2s;
}

.chart-bar:nth-child(3) {
    animation-delay: 0.4s;
}

.chart-bar:nth-child(4) {
    animation-delay: 0.6s;
}

@keyframes growBar {
    0% {
        opacity: 0.5;
    }

    100% {
        opacity: 1;
    }
}

.progress-ring {
    width: 40px;
    height: 40px;
}

.circle-progress {
    stroke: var(--brand-primary);
    stroke-linecap: round;
    animation: progressRotate 2s ease-in-out infinite;
}

@keyframes progressRotate {
    0% {
        stroke-dasharray: 0, 100;
    }

    50% {
        stroke-dasharray: 85, 100;
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
    gap: 12px;
    padding: 16px 20px;
    background: var(--brand-backdrop-blur);
    backdrop-filter: blur(20px);
    border: 1px solid var(--brand-overlay-strong);
    border-radius: 16px;
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
    animation: floatCard 4s ease-in-out infinite;
}

@keyframes floatCard {

    0%,
    100% {
        transform: translateY(0);
    }

    50% {
        transform: translateY(-15px);
    }
}

.card-1 {
    top: 10%;
    right: -20px;
    animation-delay: 0s;
    z-index: 3;
}

.card-2 {
    top: 50%;
    left: -30px;
    animation-delay: 1s;
    z-index: 3;
}

.card-3 {
    bottom: 15%;
    right: -10px;
    animation-delay: 2s;
    z-index: 3;
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

/* Code Window */
.code-window {
    position: absolute;
    bottom: 10%;
    left: 10%;
    width: 280px;
    background: rgba(var(--brand-dark-primary), 0.95);
    border: 1px solid var(--brand-overlay-medium);
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
    animation: fadeInUp 1.5s ease-out 1s both;
    z-index: 4;
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
}

.code-title {
    color: rgba(255, 255, 255, 0.7);
    font-size: 12px;
}

.code-content {
    padding: 16px;
    font-family: 'Courier New', monospace;
    font-size: 13px;
}

.code-line {
    color: #e2e8f0;
    margin-bottom: 8px;
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

/* ===== WAVE DIVIDER ===== */
.wave-divider-modern {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    line-height: 0;
    transform: rotate(180deg);
    z-index: 5;
}

.wave-divider-modern svg {
    display: block;
    width: 100%;
    height: 100px;
}

.wave-divider-modern .shape-fill {
    fill: rgb(var(--v-theme-surface));
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
        padding: 100px 0 120px;
    }

    .hero-content {
        text-align: center;
        max-width: 100%;
    }

    .hero-subtitle {
        margin-left: auto;
        margin-right: auto;
    }

    .feature-pills {
        justify-content: center;
    }

    .hero-actions {
        justify-content: center;
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
        padding: 80px 0 100px;
        min-height: auto;
    }

    .hero-title {
        font-size: 2rem;
    }

    .hero-subtitle {
        font-size: 1rem;
    }

    .hero-actions {
        flex-direction: column;
        width: 100%;
    }

    .cta-primary,
    .cta-secondary {
        width: 100%;
        justify-content: center;
    }

    .hero-visual-wrapper {
        height: 400px;
        margin-top: 40px;
    }

    .dashboard-card {
        max-width: 320px;
        padding: 16px;
    }

    .metric-row {
        padding: 12px;
    }

    .metric-value {
        font-size: 20px;
    }

    .floating-card {
        padding: 10px 12px;
        font-size: 12px;
    }

    .floating-card-value {
        font-size: 16px;
    }

    .code-window {
        width: 200px;
        left: 0;
        bottom: 0;
    }

    .code-content {
        padding: 12px;
        font-size: 11px;
    }

    .wave-divider-modern svg {
        height: 60px;
    }
}

@media (max-width: 600px) {
    .hero-badge {
        font-size: 11px;
        padding: 6px 16px;
    }

    .hero-actions {
        margin-bottom: 32px;
    }

    .orb {
        filter: blur(60px);
        opacity: 0.3;
    }

    .orb-1 {
        width: 300px;
        height: 300px;
    }

    .orb-2 {
        width: 250px;
        height: 250px;
    }

    .orb-3 {
        width: 200px;
        height: 200px;
    }
}
</style>
