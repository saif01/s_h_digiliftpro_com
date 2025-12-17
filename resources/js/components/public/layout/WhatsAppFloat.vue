<template>
    <a v-if="whatsappUrl" :href="whatsappUrl" target="_blank" rel="noopener noreferrer" class="whatsapp-float-container"
        aria-label="Contact us on WhatsApp">
        <div class="whatsapp-float">
            <div class="btn-background"></div>
            <div class="btn-content">
                <svg class="whatsapp-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"
                        fill="currentColor" />
                </svg>
            </div>
            <div class="ripple-effect"></div>
        </div>
        <div class="pulse-ring"></div>
        <div class="notification-badge" v-if="showNotification">
            <span>1</span>
        </div>
    </a>
</template>

<script>
export default {
    name: 'WhatsAppFloat',
    data() {
        return {
            whatsappUrl: '',
            settings: {
                whatsapp_number: '',
                contact_phone: ''
            },
            showNotification: true
        };
    },
    async mounted() {
        await this.loadSettings();
        this.updateWhatsAppUrl();
        // Hide notification after 5 seconds
        setTimeout(() => {
            this.showNotification = false;
        }, 5000);
    },
    methods: {
        async loadSettings() {
            try {
                const response = await this.$axios.get('/api/openapi/settings');
                const data = response.data;

                // Update settings
                if (data.whatsapp_number !== undefined) {
                    this.settings.whatsapp_number = data.whatsapp_number;
                }
                if (data.contact_phone !== undefined) {
                    this.settings.contact_phone = data.contact_phone;
                }
            } catch (error) {
                console.error('Error loading WhatsApp settings:', error);
            }
        },
        updateWhatsAppUrl() {
            // Use whatsapp_number if available, otherwise use contact_phone
            const phone = this.settings.whatsapp_number || this.settings.contact_phone || '';
            if (!phone) {
                this.whatsappUrl = '';
                return;
            }
            // Remove any non-digit characters except + for WhatsApp URL
            const cleanPhone = phone.replace(/[^\d+]/g, '');
            this.whatsappUrl = `https://wa.me/${cleanPhone}`;
        }
    },
    watch: {
        'settings.whatsapp_number'() {
            this.updateWhatsAppUrl();
        },
        'settings.contact_phone'() {
            this.updateWhatsAppUrl();
        }
    }
};
</script>

<style scoped>
.whatsapp-float-container {
    position: fixed;
    bottom: 40px;
    right: 40px;
    z-index: 1000;
    text-decoration: none;
    display: block;
}

.whatsapp-float {
    position: relative;
    width: 64px;
    height: 64px;
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
    background: linear-gradient(135deg, #25d366 0%, #128c7e 100%);
    box-shadow:
        0 8px 32px rgba(37, 211, 102, 0.4),
        0 0 0 0 rgba(37, 211, 102, 0.5),
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

.whatsapp-icon {
    width: 32px;
    height: 32px;
    transition: transform 0.3s ease;
    filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.2));
}

.ripple-effect {
    position: absolute;
    inset: -10px;
    border-radius: 50%;
    background: rgba(37, 211, 102, 0.3);
    opacity: 0;
    transform: scale(0.8);
    transition: all 0.6s ease;
    pointer-events: none;
}

.pulse-ring {
    position: absolute;
    inset: -15px;
    border-radius: 50%;
    border: 2px solid rgba(37, 211, 102, 0.4);
    opacity: 0;
    animation: pulse-whatsapp 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    pointer-events: none;
}

.notification-badge {
    position: absolute;
    top: -5px;
    right: -5px;
    width: 24px;
    height: 24px;
    background: linear-gradient(135deg, #ff4757 0%, #ff3838 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 3;
    box-shadow: 0 2px 8px rgba(255, 71, 87, 0.4);
    animation: bounce-badge 1s ease-in-out;
}

.notification-badge span {
    color: white;
    font-size: 12px;
    font-weight: bold;
    line-height: 1;
}

/* Hover Effects */
.whatsapp-float-container:hover .whatsapp-float {
    transform: translateY(-8px) scale(1.05);
}

.whatsapp-float-container:hover .btn-background {
    background: linear-gradient(135deg, #128c7e 0%, #25d366 100%);
    box-shadow:
        0 12px 40px rgba(37, 211, 102, 0.6),
        0 0 0 8px rgba(37, 211, 102, 0.2),
        inset 0 1px 0 rgba(255, 255, 255, 0.3);
    transform: scale(1.05);
}

.whatsapp-float-container:hover .whatsapp-icon {
    transform: translateY(-2px) scale(1.1);
}

.whatsapp-float-container:hover .ripple-effect {
    opacity: 1;
    transform: scale(1.3);
}

/* Active/Press Effect */
.whatsapp-float-container:active .whatsapp-float {
    transform: translateY(-4px) scale(0.95);
}

.whatsapp-float-container:active .btn-background {
    box-shadow:
        0 4px 20px rgba(37, 211, 102, 0.5),
        0 0 0 4px rgba(37, 211, 102, 0.3),
        inset 0 2px 4px rgba(0, 0, 0, 0.2);
}

.whatsapp-float-container:active .whatsapp-icon {
    transform: translateY(0) scale(1);
}

/* Pulse Animation */
@keyframes pulse-whatsapp {
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

/* Badge Bounce Animation */
@keyframes bounce-badge {

    0%,
    100% {
        transform: scale(1);
    }

    50% {
        transform: scale(1.2);
    }
}

/* Focus Styles for Accessibility */
.whatsapp-float-container:focus-visible {
    outline: 3px solid rgba(37, 211, 102, 0.5);
    outline-offset: 4px;
    border-radius: 50%;
}

/* Responsive Styles */
@media (max-width: 768px) {
    .whatsapp-float-container {
        bottom: 30px;
        right: 30px;
    }

    .whatsapp-float {
        width: 60px;
        height: 60px;
    }

    .whatsapp-icon {
        width: 28px;
        height: 28px;
    }

    .notification-badge {
        width: 22px;
        height: 22px;
        top: -3px;
        right: -3px;
    }

    .notification-badge span {
        font-size: 11px;
    }
}

@media (max-width: 600px) {
    .whatsapp-float-container {
        bottom: 20px;
        right: 20px;
    }

    .whatsapp-float {
        width: 56px;
        height: 56px;
    }

    .whatsapp-icon {
        width: 26px;
        height: 26px;
    }

    .pulse-ring {
        inset: -12px;
    }

    .notification-badge {
        width: 20px;
        height: 20px;
        top: -2px;
        right: -2px;
    }

    .notification-badge span {
        font-size: 10px;
    }
}

/* Dark mode support */
@media (prefers-color-scheme: dark) {
    .btn-background {
        background: linear-gradient(135deg, #25d366 0%, #075e54 100%);
        box-shadow:
            0 8px 32px rgba(37, 211, 102, 0.5),
            0 0 0 0 rgba(37, 211, 102, 0.6),
            inset 0 1px 0 rgba(255, 255, 255, 0.2);
    }

    .whatsapp-float-container:hover .btn-background {
        background: linear-gradient(135deg, #075e54 0%, #25d366 100%);
        box-shadow:
            0 12px 40px rgba(37, 211, 102, 0.7),
            0 0 0 8px rgba(37, 211, 102, 0.3),
            inset 0 1px 0 rgba(255, 255, 255, 0.3);
    }

    .pulse-ring {
        border-color: rgba(37, 211, 102, 0.5);
    }

    .ripple-effect {
        background: rgba(37, 211, 102, 0.4);
    }
}
</style>
