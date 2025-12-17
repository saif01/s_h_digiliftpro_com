<template>
    <v-dialog v-model="dialog" max-width="1200" scrollable>
        <v-card>
            <v-card-title class="d-flex align-center justify-space-between bg-info text-white pa-4">
                <div class="d-flex align-center">
                    <v-icon icon="mdi-eye" class="mr-3"></v-icon>
                    <span class="text-h5 font-weight-bold">Announcement Details</span>
                </div>
                <v-btn icon="mdi-close" variant="text" color="white" @click="closeDialog" :disabled="loading"></v-btn>
            </v-card-title>

            <v-card-text class="pa-0">
                <!-- Loading State -->
                <div v-if="loading" class="d-flex align-center justify-center pa-12">
                    <div class="text-center">
                        <v-progress-circular indeterminate color="info" size="64"></v-progress-circular>
                        <p class="text-body-1 text-medium-emphasis mt-4">Loading announcement details...</p>
                    </div>
                </div>

                <!-- Details Content -->
                <div v-else-if="announcement">
                    <v-tabs v-model="tab" color="info" bg-color="grey-lighten-4">
                        <v-tab value="basic">
                            <v-icon icon="mdi-information" class="mr-2"></v-icon>
                            Basic Info
                        </v-tab>
                        <v-tab value="content">
                            <v-icon icon="mdi-text" class="mr-2"></v-icon>
                            Content
                        </v-tab>
                        <v-tab value="settings">
                            <v-icon icon="mdi-cog" class="mr-2"></v-icon>
                            Settings
                        </v-tab>
                        <v-tab value="seo">
                            <v-icon icon="mdi-search-web" class="mr-2"></v-icon>
                            SEO & Meta
                        </v-tab>
                    </v-tabs>

                    <v-divider></v-divider>

                    <v-window v-model="tab" class="pa-6">
                        <!-- Basic Info Tab -->
                        <v-window-item value="basic">
                            <v-row>
                                <v-col cols="12">
                                    <div class="text-subtitle-1 text-medium-emphasis mb-2">Title</div>
                                    <div class="text-h6 font-weight-bold mb-4">{{ announcement.title || '-' }}</div>
                                </v-col>
                                <v-col cols="12" md="6">
                                    <div class="text-subtitle-1 text-medium-emphasis mb-2">Slug</div>
                                    <div class="text-body-1 mb-4">
                                        <v-chip size="small" variant="outlined">{{ announcement.slug || '-' }}</v-chip>
                                    </div>
                                </v-col>
                                <v-col cols="12" md="6">
                                    <div class="text-subtitle-1 text-medium-emphasis mb-2">Type</div>
                                    <div class="text-body-1 mb-4">
                                        <v-chip size="small" :color="getTypeColor(announcement.type)">
                                            {{ formatType(announcement.type) }}
                                        </v-chip>
                                    </div>
                                </v-col>
                                <v-col cols="12" md="6">
                                    <div class="text-subtitle-1 text-medium-emphasis mb-2">Display Type</div>
                                    <div class="text-body-1 mb-4">
                                        <v-chip size="small" variant="outlined">
                                            {{ formatDisplayType(announcement.display_type) }}
                                        </v-chip>
                                    </div>
                                </v-col>
                                <v-col cols="12" md="6">
                                    <div class="text-subtitle-1 text-medium-emphasis mb-2">Priority</div>
                                    <div class="text-body-1 mb-4">
                                        <v-chip size="small" 
                                            :color="announcement.priority > 50 ? 'error' : announcement.priority > 20 ? 'warning' : 'info'">
                                            {{ announcement.priority }}
                                        </v-chip>
                                    </div>
                                </v-col>
                                <v-col cols="12">
                                    <div class="text-subtitle-1 text-medium-emphasis mb-2">Short Description</div>
                                    <div class="text-body-1 mb-4">{{ announcement.short_description || '-' }}</div>
                                </v-col>
                                <v-col cols="12">
                                    <div class="text-subtitle-1 text-medium-emphasis mb-2">Status</div>
                                    <div class="mb-4">
                                        <v-chip :color="announcement.is_active ? 'success' : 'error'" size="small">
                                            {{ announcement.is_active ? 'Active' : 'Inactive' }}
                                        </v-chip>
                                    </div>
                                </v-col>
                                <v-col cols="12" v-if="announcement.language">
                                    <div class="text-subtitle-1 text-medium-emphasis mb-2">Language</div>
                                    <div class="text-body-1 mb-4">{{ announcement.language }}</div>
                                </v-col>
                                <v-col cols="12" v-if="announcement.created_at">
                                    <div class="text-subtitle-1 text-medium-emphasis mb-2">Created At</div>
                                    <div class="text-body-1 mb-4">{{ formatDateTime(announcement.created_at) }}</div>
                                </v-col>
                                <v-col cols="12" v-if="announcement.updated_at">
                                    <div class="text-subtitle-1 text-medium-emphasis mb-2">Updated At</div>
                                    <div class="text-body-1 mb-4">{{ formatDateTime(announcement.updated_at) }}</div>
                                </v-col>
                            </v-row>
                        </v-window-item>

                        <!-- Content Tab -->
                        <v-window-item value="content">
                            <v-row>
                                <v-col cols="12" v-if="announcement.image">
                                    <div class="text-subtitle-1 text-medium-emphasis mb-2">Image</div>
                                    <v-img :src="resolveImageUrl(announcement.image)" max-width="600" max-height="400"
                                        class="rounded elevation-2 mb-4" cover></v-img>
                                </v-col>
                                <v-col cols="12" v-if="announcement.video">
                                    <div class="text-subtitle-1 text-medium-emphasis mb-2">Video</div>
                                    <div class="text-body-1 mb-4">
                                        <a :href="resolveImageUrl(announcement.video)" target="_blank" 
                                            class="text-decoration-none">
                                            {{ announcement.video }}
                                        </a>
                                    </div>
                                </v-col>
                                <v-col cols="12">
                                    <div class="text-subtitle-1 text-medium-emphasis mb-2">Content</div>
                                    <div class="text-body-1" v-html="announcement.content || '-'"></div>
                                </v-col>
                                <v-col cols="12" v-if="announcement.external_link">
                                    <div class="text-subtitle-1 text-medium-emphasis mb-2">External Link</div>
                                    <div class="text-body-1 mb-4">
                                        <a :href="announcement.external_link" 
                                            :target="announcement.open_in_new_tab ? '_blank' : '_self'"
                                            class="text-decoration-none">
                                            {{ announcement.external_link }}
                                            <v-icon icon="mdi-open-in-new" size="small" v-if="announcement.open_in_new_tab"></v-icon>
                                        </a>
                                    </div>
                                </v-col>
                            </v-row>
                        </v-window-item>

                        <!-- Settings Tab -->
                        <v-window-item value="settings">
                            <v-row>
                                <v-col cols="12" md="6" v-if="announcement.start_date">
                                    <div class="text-subtitle-1 text-medium-emphasis mb-2">Start Date & Time</div>
                                    <div class="text-body-1 mb-4">{{ formatDateTime(announcement.start_date) }}</div>
                                </v-col>
                                <v-col cols="12" md="6" v-if="announcement.end_date">
                                    <div class="text-subtitle-1 text-medium-emphasis mb-2">End Date & Time</div>
                                    <div class="text-body-1 mb-4">{{ formatDateTime(announcement.end_date) }}</div>
                                </v-col>
                                <v-col cols="12" v-if="announcement.author">
                                    <div class="text-subtitle-1 text-medium-emphasis mb-2">Author</div>
                                    <div class="text-body-1 mb-4">
                                        {{ announcement.author.name || announcement.author.email || '-' }}
                                    </div>
                                </v-col>
                            </v-row>
                        </v-window-item>

                        <!-- SEO Tab -->
                        <v-window-item value="seo">
                            <v-row>
                                <v-col cols="12">
                                    <div class="text-subtitle-1 text-medium-emphasis mb-2">Meta Title</div>
                                    <div class="text-body-1 mb-4">{{ announcement.meta_title || '-' }}</div>
                                </v-col>
                                <v-col cols="12">
                                    <div class="text-subtitle-1 text-medium-emphasis mb-2">Meta Description</div>
                                    <div class="text-body-1 mb-4">{{ announcement.meta_description || '-' }}</div>
                                </v-col>
                                <v-col cols="12">
                                    <div class="text-subtitle-1 text-medium-emphasis mb-2">Meta Keywords</div>
                                    <div class="text-body-1 mb-4">{{ announcement.meta_keywords || '-' }}</div>
                                </v-col>
                                <v-col cols="12" v-if="announcement.og_image">
                                    <div class="text-subtitle-1 text-medium-emphasis mb-2">Open Graph Image</div>
                                    <v-img :src="resolveImageUrl(announcement.og_image)" max-width="600" max-height="400"
                                        class="rounded elevation-2 mb-4" cover></v-img>
                                </v-col>
                            </v-row>
                        </v-window-item>
                    </v-window>
                </div>
            </v-card-text>

            <v-card-actions class="pa-4 bg-grey-lighten-5">
                <v-spacer></v-spacer>
                <v-btn color="primary" prepend-icon="mdi-pencil" @click="handleEdit">
                    Edit Announcement
                </v-btn>
                <v-btn color="grey" variant="text" @click="closeDialog">Close</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
import { resolveUploadUrl } from '../../../../utils/uploads';

export default {
    name: 'AnnouncementDetailsDialog',
    props: {
        modelValue: {
            type: Boolean,
            default: false
        },
        announcementId: {
            type: [Number, String],
            default: null
        }
    },
    emits: ['update:modelValue', 'edit'],
    data() {
        return {
            loading: false,
            announcement: null,
            tab: 'basic'
        };
    },
    computed: {
        dialog: {
            get() {
                return this.modelValue;
            },
            set(value) {
                this.$emit('update:modelValue', value);
            }
        }
    },
    watch: {
        modelValue(newVal) {
            if (newVal && this.announcementId) {
                this.loadAnnouncement();
            }
        },
        announcementId() {
            if (this.dialog && this.announcementId) {
                this.loadAnnouncement();
            }
        }
    },
    methods: {
        resolveImageUrl(value) {
            return resolveUploadUrl(value);
        },
        async loadAnnouncement() {
            if (!this.announcementId) return;

            this.loading = true;
            this.announcement = null;
            this.tab = 'basic';

            try {
                const response = await this.$axios.get(`/api/v1/announcements/${this.announcementId}`, {
                    headers: this.getAuthHeaders()
                });

                const data = response.data;
                if (!data) {
                    throw new Error('No announcement data received');
                }

                this.announcement = data;
            } catch (error) {
                console.error('Failed to load announcement details:', error);
                this.showError('Failed to load announcement details. Please try again.');
                this.closeDialog();
            } finally {
                this.loading = false;
            }
        },
        closeDialog() {
            this.dialog = false;
            this.announcement = null;
            this.tab = 'basic';
        },
        handleEdit() {
            if (this.announcement) {
                this.$emit('edit', this.announcement);
                this.closeDialog();
            }
        },
        getAuthHeaders() {
            const token = localStorage.getItem('admin_token');
            return {
                Authorization: `Bearer ${token}`
            };
        },
        formatDateTime(date) {
            if (!date) return '-';
            return new Date(date).toLocaleString();
        },
        formatType(type) {
            const types = {
                'company_news': 'Company News',
                'offers_promotions': 'Offers / Promotions',
                'events': 'Events',
                'holidays': 'Holidays',
                'urgent_alerts': 'Urgent Alerts'
            };
            return types[type] || type;
        },
        getTypeColor(type) {
            const colors = {
                'company_news': 'primary',
                'offers_promotions': 'success',
                'events': 'info',
                'holidays': 'warning',
                'urgent_alerts': 'error'
            };
            return colors[type] || 'grey';
        },
        formatDisplayType(displayType) {
            const types = {
                'slider_banner': 'Slider Banner',
                'popup': 'Popup',
                'sidebar_ticker': 'Sidebar Ticker',
                'page_section': 'Page Section'
            };
            return types[displayType] || displayType;
        },
        showError(message) {
            if (this.$swal) {
                this.$swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: message
                });
            } else {
                alert(message);
            }
        }
    }
};
</script>

