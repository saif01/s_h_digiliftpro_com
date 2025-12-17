<template>
    <v-dialog :model-value="modelValue" @update:model-value="$emit('update:modelValue', $event)" max-width="600" scrollable>
        <v-card v-if="subscription">
            <v-card-title class="d-flex justify-space-between align-center bg-primary text-white">
                <div class="d-flex align-center">
                    <v-icon icon="mdi-email" class="mr-2"></v-icon>
                    <span>Subscription Details</span>
                </div>
                <v-btn icon="mdi-close" variant="text" @click="close" color="white"></v-btn>
            </v-card-title>

            <v-card-text class="pa-6">
                <v-row>
                    <v-col cols="12">
                        <div class="mb-4">
                            <div class="text-caption text-grey mb-1">Email</div>
                            <div class="text-body-1">
                                <a :href="`mailto:${subscription.email}`"
                                    class="text-primary text-decoration-none">
                                    {{ subscription.email }}
                                </a>
                            </div>
                        </div>
                    </v-col>
                    <v-col cols="12" md="6">
                        <div class="mb-4">
                            <div class="text-caption text-grey mb-1">Status</div>
                            <div class="text-body-1">
                                <v-chip :color="getStatusColor(subscription.status)" size="small">
                                    {{ subscription.status }}
                                </v-chip>
                            </div>
                        </div>
                    </v-col>
                    <v-col cols="12" md="6">
                        <div class="mb-4">
                            <div class="text-caption text-grey mb-1">Subscribed At</div>
                            <div class="text-body-2">{{ formatDateTime(subscription.subscribed_at) }}</div>
                        </div>
                    </v-col>
                    <v-col cols="12" md="6" v-if="subscription.unsubscribed_at">
                        <div class="mb-4">
                            <div class="text-caption text-grey mb-1">Unsubscribed At</div>
                            <div class="text-body-2">{{ formatDateTime(subscription.unsubscribed_at) }}</div>
                        </div>
                    </v-col>
                    <v-col cols="12" md="6">
                        <div class="mb-4">
                            <div class="text-caption text-grey mb-1">Created At</div>
                            <div class="text-body-2">{{ formatDateTime(subscription.created_at) }}</div>
                        </div>
                    </v-col>
                </v-row>
            </v-card-text>

            <v-card-actions class="pa-4 bg-grey-lighten-5">
                <v-spacer></v-spacer>
                <v-btn v-if="subscription.status === 'active'" color="error"
                    prepend-icon="mdi-email-remove" @click="handleUnsubscribe" :loading="loading">
                    Unsubscribe
                </v-btn>
                <v-btn v-else color="success" prepend-icon="mdi-email-check" @click="handleResubscribe" :loading="loading">
                    Resubscribe
                </v-btn>
                <v-btn color="grey" variant="text" @click="close">Close</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
export default {
    name: 'SubscriptionDetailsDialog',
    props: {
        modelValue: {
            type: Boolean,
            default: false
        },
        subscription: {
            type: Object,
            default: null
        },
        loading: {
            type: Boolean,
            default: false
        }
    },
    emits: ['update:modelValue', 'unsubscribe', 'resubscribe', 'close'],
    methods: {
        close() {
            this.$emit('update:modelValue', false);
            this.$emit('close');
        },
        handleUnsubscribe() {
            this.$emit('unsubscribe', this.subscription);
        },
        handleResubscribe() {
            this.$emit('resubscribe', this.subscription);
        },
        getStatusColor(status) {
            switch (status) {
                case 'active':
                    return 'success';
                case 'unsubscribed':
                    return 'error';
                default:
                    return 'grey';
            }
        },
        formatDateTime(date) {
            if (!date) return '-';
            return new Date(date).toLocaleString();
        }
    }
};
</script>

