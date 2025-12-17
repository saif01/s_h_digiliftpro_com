<template>
    <v-navigation-drawer v-model="localDrawer" location="right" temporary
        :class="['mobile-drawer', { 'mobile-drawer--open': localDrawer }]" @keydown.esc="closeDrawer">
        <div class="pa-6">
            <div class="d-flex align-center mb-8">
                <div class="logo-box mr-3">
                    <v-img :src="logo || '/assets/logo/default.png'" alt="Logo" cover class="logo-image rounded-logo"
                        :aspect-ratio="1"></v-img>
                </div>
                <span class="text-h6 font-weight-black text-grey-darken-4">{{ siteName.toUpperCase() }}</span>
                <v-spacer></v-spacer>
                <v-btn icon="mdi-close" variant="text" @click="closeDrawer"></v-btn>
            </div>

            <v-list nav class="bg-transparent">
                <v-list-item v-for="item in menuItems" :key="item.id" :to="item.url" :active="isActiveRoute(item.url)"
                    class="mb-2 rounded-xl premium-nav-item"
                    :class="{ 'premium-nav-item-active': isActiveRoute(item.url) }" @click="handleNavigate">
                    <!-- Active State Effects -->
                    <template v-if="isActiveRoute(item.url)">
                        <span class="active-indicator-bar">
                            <span class="indicator-pulse"></span>
                        </span>
                        <div class="active-shimmer"></div>
                        <span class="active-dot-top"></span>
                        <span class="active-dot-bottom"></span>
                    </template>

                    <v-list-item-title class="font-weight-bold">{{ item.label }}</v-list-item-title>
                </v-list-item>
            </v-list>

            <div class="mt-8">
                <v-btn block color="primary" size="large" rounded="lg" :to="{ name: 'Contact' }" class="elevation-4"
                    @click="handleNavigate">
                    Get a Quote
                </v-btn>
            </div>
        </div>
    </v-navigation-drawer>
</template>

<script>
export default {
    name: 'MobileDrawer',
    props: {
        modelValue: {
            type: Boolean,
            default: false
        },
        siteName: {
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
    emits: ['update:modelValue'],
    watch: {
        // Close the drawer when route changes to avoid stale open state
        $route() {
            this.closeDrawer();
        }
    },
    computed: {
        localDrawer: {
            get() {
                return this.modelValue;
            },
            set(value) {
                this.$emit('update:modelValue', value);
            }
        }
    },
    methods: {
        closeDrawer() {
            this.$emit('update:modelValue', false);
        },
        handleNavigate() {
            // Defer close slightly to allow navigation to start
            this.$nextTick(() => this.closeDrawer());
        },
        isActiveRoute(url) {
            if (!url) return false;

            const currentPath = this.$route.path || '/';

            // Normalize paths - remove trailing slashes for comparison (except root)
            const normalizedUrl = url === '/' ? '/' : url.replace(/\/$/, '');
            const normalizedPath = currentPath === '/' ? '/' : currentPath.replace(/\/$/, '');

            // For home route, only match exactly "/"
            if (normalizedUrl === '/') {
                return normalizedPath === '/';
            }

            // For other routes, match if current path starts with the route
            // Ensure it's a complete segment match (e.g., '/services' matches '/services' and '/services/detail')
            if (normalizedPath === normalizedUrl) {
                return true;
            }

            // Check if path starts with the route followed by '/' or end of string
            if (normalizedPath.startsWith(normalizedUrl + '/')) {
                return true;
            }

            return false;
        }
    }
};
</script>

<style scoped>
/* logo-box styles moved to app.css */

.logo-image {
    width: 100% !important;
    height: 100% !important;
    object-fit: cover !important;
    display: block;
}

.rounded-logo {
    border-radius: 8px !important;
    overflow: hidden;
}

/* ============================================
   PREMIUM NAV ITEM STYLES
   ============================================ */

.premium-nav-item {
    position: relative;
    overflow: visible !important;
    transition: all 0.3s ease;
}

/* ============================================
   ACTIVE MENU - OUTSTANDING DESIGN
   ============================================ */

.premium-nav-item-active {
    background: linear-gradient(135deg, #2563eb 0%, #3b82f6 50%, #60a5fa 100%) !important;
    color: #ffffff !important;
    box-shadow:
        0 8px 20px rgba(37, 99, 235, 0.4),
        0 4px 12px rgba(37, 99, 235, 0.3),
        inset 0 1px 0 rgba(255, 255, 255, 0.3) !important;
    position: relative;
    animation: activeMenuGlow 3s ease-in-out infinite;
}

@keyframes activeMenuGlow {

    0%,
    100% {
        box-shadow:
            0 8px 20px rgba(37, 99, 235, 0.4),
            0 4px 12px rgba(37, 99, 235, 0.3),
            inset 0 1px 0 rgba(255, 255, 255, 0.3);
    }

    50% {
        box-shadow:
            0 12px 30px rgba(37, 99, 235, 0.6),
            0 6px 16px rgba(37, 99, 235, 0.5),
            inset 0 1px 0 rgba(255, 255, 255, 0.4);
    }
}

.premium-nav-item-active::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg,
            rgba(255, 255, 255, 0.3) 0%,
            transparent 40%,
            transparent 60%,
            rgba(245, 158, 11, 0.2) 100%);
    border-radius: inherit;
    pointer-events: none;
    animation: gradientWave 4s ease-in-out infinite;
}

@keyframes gradientWave {

    0%,
    100% {
        background: linear-gradient(135deg,
                rgba(255, 255, 255, 0.3) 0%,
                transparent 40%,
                transparent 60%,
                rgba(245, 158, 11, 0.2) 100%);
    }

    50% {
        background: linear-gradient(135deg,
                rgba(245, 158, 11, 0.2) 0%,
                transparent 40%,
                transparent 60%,
                rgba(255, 255, 255, 0.3) 100%);
    }
}

.premium-nav-item-active .v-list-item-title {
    color: #ffffff !important;
    font-weight: 700 !important;
}

/* Active Indicator Bar (Left Side) */
.active-indicator-bar {
    position: absolute;
    left: -8px;
    top: 50%;
    transform: translateY(-50%);
    width: 4px;
    height: 60%;
    background: linear-gradient(180deg, #f59e0b, #fbbf24);
    border-radius: 4px;
    box-shadow: 0 0 12px rgba(245, 158, 11, 0.6);
    z-index: 10;
}

.indicator-pulse {
    position: absolute;
    inset: 0;
    background: inherit;
    border-radius: inherit;
    animation: barPulse 2s ease-in-out infinite;
}

@keyframes barPulse {

    0%,
    100% {
        transform: scaleY(1);
        opacity: 1;
    }

    50% {
        transform: scaleY(1.2);
        opacity: 0.7;
    }
}

/* Shimmer Effect */
.active-shimmer {
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg,
            transparent,
            rgba(255, 255, 255, 0.5),
            transparent);
    animation: shimmerSweep 3s ease-in-out infinite;
    pointer-events: none;
    z-index: 1;
}

@keyframes shimmerSweep {
    0% {
        left: -100%;
    }

    50%,
    100% {
        left: 200%;
    }
}

/* Decorative Dots */
.active-dot-top,
.active-dot-bottom {
    position: absolute;
    right: 12px;
    width: 6px;
    height: 6px;
    background: radial-gradient(circle, rgba(255, 255, 255, 0.8), transparent);
    border-radius: 50%;
    animation: dotFloat 2s ease-in-out infinite;
}

.active-dot-top {
    top: 12px;
    animation-delay: 0s;
}

.active-dot-bottom {
    bottom: 12px;
    animation-delay: 1s;
}

@keyframes dotFloat {

    0%,
    100% {
        transform: translateY(0) scale(1);
        opacity: 0.4;
    }

    50% {
        transform: translateY(-4px) scale(1.3);
        opacity: 1;
    }
}

/* Hover Effect on Active Item */
.premium-nav-item-active:hover {
    transform: translateX(4px) scale(1.02);
    box-shadow:
        0 12px 32px rgba(37, 99, 235, 0.6),
        0 6px 18px rgba(37, 99, 235, 0.5),
        inset 0 1px 0 rgba(255, 255, 255, 0.4) !important;
}

/* Hide drawer on desktop */
@media (min-width: 961px) {
    .mobile-drawer {
        display: none !important;
    }
}

/* Responsive Styles - Mobile Only */
@media (max-width: 960px) {
    .mobile-drawer {
        position: fixed !important;
        top: 0 !important;
        right: 0 !important;
        height: 100vh !important;
        max-width: 320px !important;
        width: min(320px, 90vw) !important;
        z-index: 3000 !important;
    }

    .mobile-drawer .logo-box {
        width: 42px;
        height: 42px;
        min-width: 42px;
        min-height: 42px;
        flex-shrink: 0;
    }

    /* Hide drawer by default when closed - override Vuetify's default behavior */
    .mobile-drawer:not(.v-navigation-drawer--active):not(.mobile-drawer--open) {
        transform: translateX(110%) !important;
        transition: transform 0.28s ease !important;
    }

    /* Show drawer when open */
    .mobile-drawer.v-navigation-drawer--active,
    .mobile-drawer--open {
        transform: translateX(0) !important;
        transition: transform 0.28s ease !important;
    }
}

@media (max-width: 600px) {
    .mobile-drawer {
        width: 280px !important;
    }

    .mobile-drawer .logo-box {
        width: 36px !important;
        height: 36px !important;
        min-width: 36px !important;
        min-height: 36px !important;
    }

    .text-h6 {
        font-size: 0.875rem !important;
    }
}
</style>
