<template>
    <v-dialog v-model="dialog" max-width="400" transition="dialog-bottom-transition" @update:model-value="handleDialogUpdate">
        <v-card class="rounded-lg">
            <v-card-title class="d-flex align-center justify-space-between pa-4">
                <span class="text-h6 font-weight-bold">Share Product</span>
                <v-btn icon="mdi-close" variant="text" size="small" @click="closeDialog" />
            </v-card-title>
            <v-divider />
            <v-card-text class="pa-4">
                <div class="text-body-2 text-medium-emphasis mb-4">
                    Share <strong>{{ title }}</strong> on social media
                </div>
                <div class="d-flex flex-wrap gap-2">
                    <v-btn
                        color="#1877F2"
                        variant="flat"
                        size="large"
                        class="share-btn flex-grow-1"
                        @click="shareOnFacebook">
                        <v-icon icon="mdi-facebook" class="mr-2" />
                        Facebook
                    </v-btn>
                    <v-btn
                        color="#1DA1F2"
                        variant="flat"
                        size="large"
                        class="share-btn flex-grow-1"
                        @click="shareOnTwitter">
                        <v-icon icon="mdi-twitter" class="mr-2" />
                        Twitter
                    </v-btn>
                    <v-btn
                        color="#0077B5"
                        variant="flat"
                        size="large"
                        class="share-btn flex-grow-1"
                        @click="shareOnLinkedIn">
                        <v-icon icon="mdi-linkedin" class="mr-2" />
                        LinkedIn
                    </v-btn>
                    <v-btn
                        color="#25D366"
                        variant="flat"
                        size="large"
                        class="share-btn flex-grow-1"
                        @click="shareOnWhatsApp">
                        <v-icon icon="mdi-whatsapp" class="mr-2" />
                        WhatsApp
                    </v-btn>
                    <v-btn
                        color="primary"
                        variant="outlined"
                        size="large"
                        class="share-btn flex-grow-1"
                        @click="copyLink">
                        <v-icon icon="mdi-link" class="mr-2" />
                        Copy Link
                    </v-btn>
                </div>
            </v-card-text>
        </v-card>
    </v-dialog>

    <!-- Snackbar for notifications -->
    <v-snackbar v-model="showSnackbar" :timeout="3000" color="success" location="top">
        {{ snackbarMessage }}
    </v-snackbar>
</template>

<script setup>
import { ref, computed, watch } from 'vue';

const props = defineProps({
    modelValue: {
        type: Boolean,
        default: false
    },
    title: {
        type: String,
        required: true
    },
    url: {
        type: String,
        required: true
    },
    shareText: {
        type: String,
        default: ''
    }
});

const emit = defineEmits(['update:modelValue']);

const dialog = computed({
    get: () => props.modelValue,
    set: (value) => emit('update:modelValue', value)
});

const showSnackbar = ref(false);
const snackbarMessage = ref('');

const closeDialog = () => {
    dialog.value = false;
};

const handleDialogUpdate = (value) => {
    if (!value) {
        emit('update:modelValue', false);
    }
};

const shareOnFacebook = () => {
    const encodedUrl = encodeURIComponent(props.url);
    const shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodedUrl}`;
    window.open(shareUrl, '_blank', 'width=600,height=400');
    closeDialog();
};

const shareOnTwitter = () => {
    const encodedUrl = encodeURIComponent(props.url);
    const encodedText = encodeURIComponent(props.shareText || props.title);
    const shareUrl = `https://twitter.com/intent/tweet?url=${encodedUrl}&text=${encodedText}`;
    window.open(shareUrl, '_blank', 'width=600,height=400');
    closeDialog();
};

const shareOnLinkedIn = () => {
    const encodedUrl = encodeURIComponent(props.url);
    const shareUrl = `https://www.linkedin.com/sharing/share-offsite/?url=${encodedUrl}`;
    window.open(shareUrl, '_blank', 'width=600,height=400');
    closeDialog();
};

const shareOnWhatsApp = () => {
    const encodedUrl = encodeURIComponent(props.url);
    const encodedText = encodeURIComponent(props.shareText || props.title);
    const shareUrl = `https://wa.me/?text=${encodedText}%20${encodedUrl}`;
    window.open(shareUrl, '_blank');
    closeDialog();
};

const copyLink = async () => {
    // Try modern Clipboard API first
    if (navigator.clipboard && navigator.clipboard.writeText) {
        try {
            await navigator.clipboard.writeText(props.url);
            snackbarMessage.value = 'Link copied to clipboard!';
            showSnackbar.value = true;
            closeDialog();
            return;
        } catch (error) {
            console.warn('Clipboard API failed, trying fallback:', error);
        }
    }

    // Fallback for older browsers or when Clipboard API fails
    try {
        const textArea = document.createElement('textarea');
        textArea.value = props.url;
        textArea.style.position = 'fixed';
        textArea.style.left = '-999999px';
        textArea.style.top = '-999999px';
        textArea.setAttribute('readonly', '');
        document.body.appendChild(textArea);

        // Select and copy
        textArea.select();
        textArea.setSelectionRange(0, props.url.length);

        const successful = document.execCommand('copy');
        document.body.removeChild(textArea);

        if (successful) {
            snackbarMessage.value = 'Link copied to clipboard!';
            showSnackbar.value = true;
            closeDialog();
        } else {
            throw new Error('execCommand failed');
        }
    } catch (err) {
        console.error('Copy failed:', err);
        snackbarMessage.value = 'Failed to copy link. Please copy manually: ' + props.url;
        showSnackbar.value = true;
        // Keep dialog open so user can see the URL
    }
};
</script>

<style scoped>
.share-btn {
    min-width: 140px;
    text-transform: none;
    font-weight: 600;
}

@media (max-width: 600px) {
    .share-btn {
        min-width: 100%;
    }
}
</style>


