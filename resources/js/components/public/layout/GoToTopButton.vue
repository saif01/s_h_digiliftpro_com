<template>
    <div v-show="showButton" class="go-to-top-container" :class="{ 'show': showButton }">
        <button @click="scrollToTop" class="go-to-top-btn" aria-label="Scroll to top">
            <div class="btn-background"></div>
            <div class="btn-content">
                <svg class="arrow-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 19V5M12 5L5 12M12 5L19 12" stroke="currentColor" stroke-width="2.5"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
            <div class="ripple-effect"></div>
        </button>
        <div class="pulse-ring"></div>
    </div>
</template>

<script>
export default {
    name: 'GoToTopButton',
    data() {
        return {
            showButton: false
        };
    },
    mounted() {
        window.addEventListener('scroll', this.handleScroll);
        // Check initial scroll position
        this.handleScroll();
    },
    beforeUnmount() {
        window.removeEventListener('scroll', this.handleScroll);
    },
    methods: {
        handleScroll() {
            // Show button when user scrolls down more than 300px
            this.showButton = window.scrollY > 300;
        },
        scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }
    }
};
</script>

<style scoped>
.go-to-top-container {
    position: fixed;
    bottom: 40px;
    left: 40px;
    z-index: 1000;
    opacity: 0;
    transform: translateY(30px) scale(0.8);
    pointer-events: none;
    transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
}

.go-to-top-container.show {
    opacity: 1;
    transform: translateY(0) scale(1);
    pointer-events: auto;
}

.go-to-top-btn {
    position: relative;
    width: 60px;
    height: 60px;
    border: none;
    border-radius: 50%;
    background: transparent;
    cursor: pointer;
    padding: 0;
    overflow: visible;
    transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    outline: none;
}

.btn-background {
    position: absolute;
    inset: 0;
    border-radius: 50%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    box-shadow:
        0 8px 32px rgba(102, 126, 234, 0.4),
        0 0 0 0 rgba(102, 126, 234, 0.5),
        inset 0 1px 0 rgba(255, 255, 255, 0.2);
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
}

.btn-content {
    position: relative;
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 2;
    color: white;
}

.arrow-icon {
    width: 28px;
    height: 28px;
    transition: transform 0.3s ease;
    filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.2));
}

.ripple-effect {
    position: absolute;
    inset: -10px;
    border-radius: 50%;
    background: rgba(102, 126, 234, 0.3);
    opacity: 0;
    transform: scale(0.8);
    transition: all 0.6s ease;
    pointer-events: none;
}

.pulse-ring {
    position: absolute;
    inset: -15px;
    border-radius: 50%;
    border: 2px solid rgba(102, 126, 234, 0.4);
    opacity: 0;
    animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    pointer-events: none;
}

/* Hover Effects */
.go-to-top-btn:hover {
    transform: translateY(-8px) scale(1.05);
}

.go-to-top-btn:hover .btn-background {
    background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
    box-shadow:
        0 12px 40px rgba(102, 126, 234, 0.6),
        0 0 0 8px rgba(102, 126, 234, 0.2),
        inset 0 1px 0 rgba(255, 255, 255, 0.3);
    transform: scale(1.05);
}

.go-to-top-btn:hover .arrow-icon {
    transform: translateY(-2px);
}

.go-to-top-btn:hover .ripple-effect {
    opacity: 1;
    transform: scale(1.3);
}

/* Active/Press Effect */
.go-to-top-btn:active {
    transform: translateY(-4px) scale(0.95);
}

.go-to-top-btn:active .btn-background {
    box-shadow:
        0 4px 20px rgba(102, 126, 234, 0.5),
        0 0 0 4px rgba(102, 126, 234, 0.3),
        inset 0 2px 4px rgba(0, 0, 0, 0.2);
}

.go-to-top-btn:active .arrow-icon {
    transform: translateY(0);
}

/* Pulse Animation */
@keyframes pulse {
    0% {
        transform: scale(0.8);
        opacity: 1;
    }

    50% {
        transform: scale(1.2);
        opacity: 0.5;
    }

    100% {
        transform: scale(1.5);
        opacity: 0;
    }
}

/* Focus Styles for Accessibility */
.go-to-top-btn:focus-visible {
    outline: 3px solid rgba(102, 126, 234, 0.5);
    outline-offset: 4px;
}

/* Responsive Styles */
@media (max-width: 768px) {
    .go-to-top-container {
        bottom: 30px;
        left: 30px;
    }

    .go-to-top-btn {
        width: 56px;
        height: 56px;
    }

    .arrow-icon {
        width: 24px;
        height: 24px;
    }
}

@media (max-width: 600px) {
    .go-to-top-container {
        bottom: 20px;
        left: 20px;
    }

    .go-to-top-btn {
        width: 52px;
        height: 52px;
    }

    .arrow-icon {
        width: 22px;
        height: 22px;
    }

    .pulse-ring {
        inset: -12px;
    }
}

/* Dark mode support (optional) */
@media (prefers-color-scheme: dark) {
    .btn-background {
        background: linear-gradient(135deg, #7c3aed 0%, #a855f7 100%);
        box-shadow:
            0 8px 32px rgba(124, 58, 237, 0.5),
            0 0 0 0 rgba(124, 58, 237, 0.6),
            inset 0 1px 0 rgba(255, 255, 255, 0.2);
    }

    .go-to-top-btn:hover .btn-background {
        background: linear-gradient(135deg, #a855f7 0%, #7c3aed 100%);
        box-shadow:
            0 12px 40px rgba(124, 58, 237, 0.7),
            0 0 0 8px rgba(124, 58, 237, 0.3),
            inset 0 1px 0 rgba(255, 255, 255, 0.3);
    }

    .pulse-ring {
        border-color: rgba(124, 58, 237, 0.5);
    }

    .ripple-effect {
        background: rgba(124, 58, 237, 0.4);
    }
}
</style>
