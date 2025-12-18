<template>
    <v-app-bar app class="main-app-bar px-md-12 transition-all" :class="{ 'scrolled-app-bar': isScrolled }" height="64"
        elevation="0">
        <div class="d-flex align-center w-100 position-relative z-index-2">
            <!-- Logo Area -->
            <router-link to="/" class="text-decoration-none d-flex align-center mr-8 logo-group">
                <div class="logo-box mr-3 elevation-3">
                    <v-img :src="logo || '/assets/logo/default.png'" alt="Logo" cover
                        class="logo-image rounded-logo"></v-img>
                </div>

                <div class="d-flex flex-column logo-text-container">
                    <span class="text-subtitle-1 font-weight-black text-grey-darken-4 lh-1 tracking-tight logo-text">{{
                        siteName.toUpperCase() }}</span>
                    <span class="text-caption font-weight-bold text-primary tracking-widest tagline-text">{{ siteTagline
                    }}</span>
                </div>
            </router-link>

            <v-spacer></v-spacer>

            <!-- Desktop Navigation -->
            <div class="d-none d-md-flex align-center gap-1">
                <router-link v-for="item in menuItems" :key="item.id" :to="item.url"
                    :class="['nav-link', { 'active-nav-link': isActiveRoute(item.url) }]">
                    <template v-if="isActiveRoute(item.url)">
                        <span class="nav-indicator-dot"></span>
                        <span class="nav-link-shimmer"></span>
                        <span class="nav-particle"></span>
                        <span class="nav-particle"></span>
                        <span class="nav-glow-line"></span>
                    </template>
                    {{ item.label }}
                </router-link>
            </div>

            <v-spacer></v-spacer>

            <!-- CTA Button -->
            <div class="d-none d-md-flex">
                <v-btn color="primary" variant="flat" rounded="pill" size="default"
                    class="font-weight-bold px-6 text-capitalize elevation-3 hover-glow cta-btn"
                    :to="{ name: 'Contact' }">
                    Get a Quote
                </v-btn>
            </div>

            <!-- Mobile Menu Button -->
            <v-app-bar-nav-icon class="d-md-none ml-2 mobile-menu-btn" @click="handleDrawerToggle"
                aria-label="Toggle navigation menu"></v-app-bar-nav-icon>
        </div>

        <!-- Gradient Border Bottom (Visible on Scroll) -->
        <div class="app-bar-border"></div>
    </v-app-bar>
</template>

<script>
export default {
    name: 'AppBar',
    props: {
        isScrolled: {
            type: Boolean,
            default: false
        },
        siteName: {
            type: String,
            required: true
        },
        siteTagline: {
            type: String,
            required: true
        },
        menuItems: {
            type: Array,
            required: true
        },
        logo: {
            type: String,
            default: null
        }
    },
    emits: ['toggle-drawer', 'close-drawer'],
    data() {
        return {
            mobileBreakpoint: 960,
            isMobileViewport: typeof window !== 'undefined' ? window.innerWidth < 960 : false
        };
    },
    mounted() {
        this.checkViewport();
        window.addEventListener('resize', this.handleResize);
    },
    beforeUnmount() {
        window.removeEventListener('resize', this.handleResize);
    },
    methods: {
        handleDrawerToggle() {
            // Only toggle the drawer in mobile/tablet view
            if (this.isMobileViewport) {
                this.$emit('toggle-drawer');
            }
        },
        handleResize() {
            const wasMobile = this.isMobileViewport;
            this.checkViewport();

            // If the viewport grows to desktop, make sure the mobile drawer is closed
            if (!this.isMobileViewport && wasMobile) {
                this.$emit('close-drawer');
            }
        },
        checkViewport() {
            if (typeof window !== 'undefined') {
                this.isMobileViewport = window.innerWidth < this.mobileBreakpoint;
            }
        },
        isActiveRoute(url) {
            const currentPath = this.$route.path;
            // For home route, only match exactly "/"
            if (url === '/') {
                return currentPath === '/';
            }
            // For other routes, match if current path starts with the route
            return currentPath.startsWith(url);
        }
    }
};
</script>

<style scoped>
/* Topbar Styles */
.main-app-bar {
    background: rgba(255, 255, 255, 0.0) !important;
    backdrop-filter: blur(0px);
    border-bottom: 1px solid transparent;
}

.scrolled-app-bar {
    background: rgba(255, 255, 255, 0.85) !important;
    backdrop-filter: blur(16px);
    box-shadow: 0 4px 30px rgba(0, 0, 0, 0.05) !important;
}

.app-bar-border {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 1px;
    background: linear-gradient(90deg, transparent, rgba(0, 0, 0, 0.1), transparent);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.scrolled-app-bar .app-bar-border {
    opacity: 1;
}

/* Logo Area */
.logo-group {
    transition: transform 0.3s ease;
}

.logo-box {
    width: 40px;
    height: 40px;
    border-radius: 8px;
    overflow: hidden;
    transition: transform 0.3s ease;
}

.logo-icon {
    transition: transform 0.3s ease;
}

.logo-group:hover .logo-icon {
    transform: scale(1.1);
}

.logo-group:hover .logo-box {
    transform: scale(1.05);
}

.logo-text-container {
    line-height: 1;
}

.logo-text {
    font-size: 1rem;
    line-height: 1.1;
}

.tagline-text {
    font-size: 0.65rem;
    margin-top: 2px;
}

.logo-image {
    transition: transform 0.3s ease;
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.rounded-logo {
    border-radius: 8px !important;
    overflow: hidden;
}

.logo-group:hover .logo-image {
    transform: scale(1.05);
}

/* ============================================
   NAVIGATION LINKS - PREMIUM ACTIVE STATE
   ============================================ */

.nav-link {
    text-decoration: none;
    position: relative;
    padding: 10px 18px;
    margin: 0 2px;
    border-radius: 50px;
    overflow: visible;
    transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    color: var(--brand-gray);
}

.nav-link:hover {
    color: var(--brand-gray-dark) !important;
    transform: translateY(-2px);
}

/* Simple underline for hover on non-active links */
.nav-link:not(.active-nav-link)::after {
    content: '';
    position: absolute;
    bottom: 6px;
    left: 50%;
    width: 0;
    height: 2px;
    background: linear-gradient(90deg, var(--brand-primary), var(--brand-primary-light));
    transition: all 0.3s ease;
    transform: translateX(-50%);
    border-radius: 2px;
    opacity: 0;
}

.nav-link:not(.active-nav-link):hover::after {
    width: 60%;
    opacity: 0.5;
}

/* ============================================
   ACTIVE MENU - OUTSTANDING DESIGN
   ============================================ */

.active-nav-link {
    color: var(--brand-white) !important;
    font-weight: 700 !important;
    position: relative;
    z-index: 10;
    padding: 11px 20px;
}

/* Multi-layer Background System for Active State */
.active-nav-link::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, var(--brand-primary) 0%, var(--brand-primary-light) 50%, var(--brand-secondary) 100%);
    border-radius: 50px;
    z-index: -1;
    box-shadow:
        0 4px 15px rgba(var(--brand-primary-rgb), 0.4),
        0 2px 8px rgba(var(--brand-primary-rgb), 0.3),
        inset 0 1px 0 rgba(255, 255, 255, 0.3);
    animation: activeGlow 3s ease-in-out infinite;
}

@keyframes activeGlow {

    0%,
    100% {
        box-shadow:
            0 4px 15px rgba(var(--brand-primary-rgb), 0.4),
            0 2px 8px rgba(var(--brand-primary-rgb), 0.3),
            inset 0 1px 0 rgba(255, 255, 255, 0.3);
    }

    50% {
        box-shadow:
            0 6px 25px rgba(var(--brand-primary-rgb), 0.6),
            0 3px 12px rgba(var(--brand-primary-rgb), 0.5),
            inset 0 1px 0 rgba(255, 255, 255, 0.4);
    }
}

/* Animated Gradient Overlay */
.active-nav-link::after {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg,
            rgba(255, 255, 255, 0.3) 0%,
            transparent 40%,
            transparent 60%,
            rgba(var(--brand-accent-cyan-rgb), 0.2) 100%);
    border-radius: 50px;
    z-index: -1;
    animation: gradientShift 4s ease-in-out infinite;
}

@keyframes gradientShift {

    0%,
    100% {
        background: linear-gradient(135deg,
                rgba(255, 255, 255, 0.3) 0%,
                transparent 40%,
                transparent 60%,
                rgba(var(--brand-accent-cyan-rgb), 0.2) 100%);
    }

    50% {
        background: linear-gradient(135deg,
                rgba(var(--brand-accent-cyan-rgb), 0.2) 0%,
                transparent 40%,
                transparent 60%,
                rgba(255, 255, 255, 0.3) 100%);
    }
}

/* Shimmer Effect on Active Link */
.active-nav-link .nav-link-shimmer {
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg,
            transparent,
            rgba(255, 255, 255, 0.6),
            transparent);
    animation: shimmerMove 3s ease-in-out infinite;
    z-index: 1;
    pointer-events: none;
}

@keyframes shimmerMove {
    0% {
        left: -100%;
    }

    50%,
    100% {
        left: 200%;
    }
}

/* Pulsing Indicator Dot */
.active-nav-link .nav-indicator-dot {
    position: absolute;
    top: -6px;
    left: 50%;
    transform: translateX(-50%);
    width: 6px;
    height: 6px;
    background: linear-gradient(135deg, var(--brand-accent-cyan), var(--brand-accent-blue));
    border-radius: 50%;
    box-shadow:
        0 0 10px rgba(var(--brand-accent-cyan-rgb), 0.8),
        0 0 20px rgba(var(--brand-accent-cyan-rgb), 0.4);
    animation: indicatorPulse 2s ease-in-out infinite;
    z-index: 2;
}

@keyframes indicatorPulse {

    0%,
    100% {
        transform: translateX(-50%) scale(1);
        opacity: 1;
    }

    50% {
        transform: translateX(-50%) scale(1.5);
        opacity: 0.7;
    }
}

/* Bottom Glow Line */
.active-nav-link .nav-glow-line {
    position: absolute;
    bottom: -8px;
    left: 50%;
    transform: translateX(-50%);
    width: 60%;
    height: 3px;
    background: linear-gradient(90deg,
            transparent,
            rgba(var(--brand-primary-rgb), 0.8),
            rgba(var(--brand-accent-cyan-rgb), 0.8),
            transparent);
    border-radius: 3px;
    filter: blur(2px);
    animation: glowLineExpand 2s ease-in-out infinite;
}

@keyframes glowLineExpand {

    0%,
    100% {
        width: 60%;
        opacity: 0.8;
    }

    50% {
        width: 80%;
        opacity: 1;
    }
}

/* Particle Effects around Active Link */
.active-nav-link .nav-particle {
    position: absolute;
    width: 3px;
    height: 3px;
    background: radial-gradient(circle, rgba(255, 255, 255, 0.8), transparent);
    border-radius: 50%;
    pointer-events: none;
    z-index: 2;
}

.active-nav-link .nav-particle:nth-child(1) {
    top: 20%;
    left: 10%;
    animation: floatParticle1 3s ease-in-out infinite;
}

.active-nav-link .nav-particle:nth-child(2) {
    top: 60%;
    right: 15%;
    animation: floatParticle2 3.5s ease-in-out infinite;
}

@keyframes floatParticle1 {

    0%,
    100% {
        transform: translate(0, 0) scale(1);
        opacity: 0;
    }

    50% {
        transform: translate(-3px, -5px) scale(1.2);
        opacity: 1;
    }
}

@keyframes floatParticle2 {

    0%,
    100% {
        transform: translate(0, 0) scale(1);
        opacity: 0;
    }

    50% {
        transform: translate(3px, -5px) scale(1.2);
        opacity: 1;
    }
}

/* Hover effect on active link */
.active-nav-link:hover {
    transform: translateY(-3px) scale(1.05);
}

.active-nav-link:hover::before {
    box-shadow:
        0 8px 30px rgba(var(--brand-primary-rgb), 0.6),
        0 4px 15px rgba(var(--brand-primary-rgb), 0.5),
        inset 0 1px 0 rgba(255, 255, 255, 0.4);
}

.cta-btn {
    height: 40px !important;
    font-size: 0.875rem !important;
}

.hover-glow {
    transition: all 0.3s ease;
}

.hover-glow:hover {
    box-shadow: 0 0 15px rgba(var(--brand-primary-rgb), 0.4) !important;
    transform: translateY(-2px);
}

.mobile-menu-btn {
    color: var(--brand-dark-primary) !important;
    border-radius: 12px;
}

.mobile-menu-btn:hover {
    background-color: rgba(15, 23, 42, 0.06);
}

/* Transitions */
.transition-all {
    transition: all 0.3s ease;
}

/* Responsive Styles */
@media (max-width: 960px) {
    .main-app-bar {
        height: 60px !important;
        padding-left: 16px !important;
        padding-right: 16px !important;
    }

    .logo-box {
        width: 36px;
        height: 36px;
    }

    .logo-text {
        font-size: 0.875rem !important;
    }

    .tagline-text {
        font-size: 0.6rem !important;
    }

    .logo-icon {
        font-size: 20px !important;
    }

}

@media (max-width: 600px) {
    .main-app-bar {
        height: 56px !important;
        padding-left: 12px !important;
        padding-right: 12px !important;
    }

    .logo-box {
        width: 32px;
        height: 32px;
        margin-right: 8px !important;
    }

    .logo-text {
        font-size: 0.75rem !important;
    }

    .tagline-text {
        font-size: 0.55rem !important;
    }

    .logo-icon {
        font-size: 18px !important;
    }

    .mr-8 {
        margin-right: 8px !important;
    }

    .mobile-menu-btn {
        padding: 6px;
        margin-left: 4px !important;
    }
}

@media (max-width: 360px) {
    .main-app-bar {
        height: 52px !important;
        padding-left: 8px !important;
        padding-right: 8px !important;
    }

    .logo-box {
        width: 28px;
        height: 28px;
        margin-right: 6px !important;
    }

    .logo-text {
        font-size: 0.7rem !important;
    }

    .tagline-text {
        font-size: 0.5rem !important;
    }
}
</style>
