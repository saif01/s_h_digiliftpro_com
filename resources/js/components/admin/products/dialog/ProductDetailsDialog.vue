<template>
    <v-dialog :model-value="modelValue" @update:model-value="$emit('update:modelValue', $event)" max-width="1400"
        scrollable>
        <v-card>
            <v-card-title class="d-flex align-center justify-space-between bg-info text-white pa-4">
                <div class="d-flex align-center">
                    <v-icon icon="mdi-eye" class="mr-3"></v-icon>
                    <span class="text-h5 font-weight-bold">Product Details</span>
                </div>
                <v-btn icon="mdi-close" variant="text" color="white" @click="close" :disabled="loading"></v-btn>
            </v-card-title>

            <v-card-text class="pa-0">
                <!-- Loading State -->
                <div v-if="loading" class="d-flex align-center justify-center pa-12">
                    <div class="text-center">
                        <v-progress-circular indeterminate color="info" size="64"></v-progress-circular>
                        <p class="text-body-1 text-medium-emphasis mt-4">Loading product details...</p>
                    </div>
                </div>

                <!-- Details Content -->
                <div v-else-if="productDetails">
                    <v-tabs v-model="detailsTab" color="info" bg-color="grey-lighten-4">
                        <v-tab value="basic">
                            <v-icon icon="mdi-information" class="mr-2"></v-icon>
                            Basic Info
                        </v-tab>
                        <v-tab value="media">
                            <v-icon icon="mdi-image" class="mr-2"></v-icon>
                            Media
                        </v-tab>
                        <v-tab value="pricing">
                            <v-icon icon="mdi-cash" class="mr-2"></v-icon>
                            Pricing
                        </v-tab>
                        <v-tab value="categories">
                            <v-icon icon="mdi-folder" class="mr-2"></v-icon>
                            Categories & Tags
                        </v-tab>
                        <v-tab value="specs">
                            <v-icon icon="mdi-cog" class="mr-2"></v-icon>
                            Specifications
                        </v-tab>
                        <v-tab value="features">
                            <v-icon icon="mdi-star" class="mr-2"></v-icon>
                            Features
                        </v-tab>
                        <v-tab value="downloads">
                            <v-icon icon="mdi-download" class="mr-2"></v-icon>
                            Downloads
                        </v-tab>
                        <v-tab value="faq">
                            <v-icon icon="mdi-help-circle" class="mr-2"></v-icon>
                            FAQs
                        </v-tab>
                        <v-tab value="warranty">
                            <v-icon icon="mdi-shield-check" class="mr-2"></v-icon>
                            Warranty & Service
                        </v-tab>
                        <v-tab value="seo">
                            <v-icon icon="mdi-search-web" class="mr-2"></v-icon>
                            SEO
                        </v-tab>
                        <v-tab value="settings">
                            <v-icon icon="mdi-cog-outline" class="mr-2"></v-icon>
                            Settings
                        </v-tab>
                    </v-tabs>

                    <v-divider></v-divider>

                    <v-window v-model="detailsTab" class="pa-6">
                        <!-- Basic Info Tab -->
                        <v-window-item value="basic">
                            <v-row>
                                <v-col cols="12">
                                    <div class="text-subtitle-1 text-medium-emphasis mb-2">Product Title</div>
                                    <div class="text-h6 font-weight-bold mb-4">{{ productDetails.title || '-' }}
                                    </div>
                                </v-col>
                                <v-col cols="12" md="6">
                                    <div class="text-subtitle-1 text-medium-emphasis mb-2">Slug</div>
                                    <div class="text-body-1 mb-4">{{ productDetails.slug || '-' }}</div>
                                </v-col>
                                <v-col cols="12">
                                    <div class="text-subtitle-1 text-medium-emphasis mb-2">Short Description</div>
                                    <div class="text-body-1 mb-4">{{ productDetails.short_description || '-' }}
                                    </div>
                                </v-col>
                                <v-col cols="12">
                                    <div class="text-subtitle-1 text-medium-emphasis mb-2">Full Description</div>
                                    <div class="text-body-1" v-html="productDetails.description || '-'"></div>
                                </v-col>
                            </v-row>
                        </v-window-item>

                        <!-- Media Tab -->
                        <v-window-item value="media">
                            <v-row>
                                <v-col cols="12">
                                    <div class="text-subtitle-1 text-medium-emphasis mb-2">Thumbnail</div>
                                    <div v-if="productDetails.thumbnail" class="mb-4">
                                        <v-img :src="resolveImageUrl(productDetails.thumbnail)" max-height="300" contain
                                            class="rounded elevation-2"></v-img>
                                        <div class="text-caption text-medium-emphasis mt-2">{{
                                            productDetails.thumbnail }}</div>
                                    </div>
                                    <div v-else class="text-body-1 text-medium-emphasis">No thumbnail</div>
                                </v-col>
                                <v-col cols="12">
                                    <div class="text-subtitle-1 text-medium-emphasis mb-2">Product Images (Gallery)
                                    </div>
                                    <div v-if="productDetails.images && productDetails.images.length > 0"
                                        class="d-flex flex-wrap gap-3">
                                        <v-card v-for="(img, index) in productDetails.images" :key="index"
                                            class="elevation-2" style="max-width: 200px;">
                                            <v-img :src="resolveImageUrl(img)" height="150" cover></v-img>
                                            <v-card-text class="pa-2">
                                                <div class="text-caption text-truncate">{{ img }}</div>
                                            </v-card-text>
                                        </v-card>
                                    </div>
                                    <div v-else class="text-body-1 text-medium-emphasis">No images</div>
                                </v-col>
                            </v-row>
                        </v-window-item>

                        <!-- Pricing Tab -->
                        <v-window-item value="pricing">
                            <v-row>
                                <v-col cols="12" md="6">
                                    <div class="text-subtitle-1 text-medium-emphasis mb-2">Price</div>
                                    <div class="text-h6 font-weight-bold mb-4">
                                        {{ formatPrice(productDetails.price) }}
                                    </div>
                                </v-col>
                                <v-col cols="12" md="6">
                                    <div class="text-subtitle-1 text-medium-emphasis mb-2">Price Range</div>
                                    <div class="text-body-1 mb-4">{{ formatPriceRange(productDetails.price_range) }}
                                    </div>
                                </v-col>
                                <v-col cols="12">
                                    <div class="text-subtitle-1 text-medium-emphasis mb-2">Show Price on Website
                                    </div>
                                    <v-chip :color="productDetails.show_price ? 'success' : 'error'" size="small">
                                        {{ productDetails.show_price ? 'Yes' : 'No' }}
                                    </v-chip>
                                </v-col>
                            </v-row>
                        </v-window-item>

                        <!-- Categories & Tags Tab -->
                        <v-window-item value="categories">
                            <v-row>
                                <v-col cols="12">
                                    <div class="text-subtitle-1 text-medium-emphasis mb-2">Categories</div>
                                    <div v-if="productDetails.categories && productDetails.categories.length > 0"
                                        class="d-flex flex-wrap gap-2 mb-4">
                                        <v-chip v-for="cat in productDetails.categories" :key="cat.id" color="primary"
                                            variant="tonal">
                                            {{ cat.name }}
                                        </v-chip>
                                    </div>
                                    <div v-else class="text-body-1 text-medium-emphasis mb-4">No categories</div>
                                </v-col>
                                <v-col cols="12">
                                    <div class="text-subtitle-1 text-medium-emphasis mb-2">Tags</div>
                                    <div v-if="productDetails.tags && productDetails.tags.length > 0"
                                        class="d-flex flex-wrap gap-2">
                                        <v-chip v-for="tag in productDetails.tags" :key="tag.id" color="info"
                                            variant="outlined">
                                            {{ tag.name }}
                                        </v-chip>
                                    </div>
                                    <div v-else class="text-body-1 text-medium-emphasis">No tags</div>
                                </v-col>
                            </v-row>
                        </v-window-item>

                        <!-- Specifications Tab -->
                        <v-window-item value="specs">
                            <div v-if="specificationsList.length > 0">
                                <v-table>
                                    <thead>
                                        <tr>
                                            <th>Specification</th>
                                            <th>Value</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(spec, index) in specificationsList" :key="index">
                                            <td class="font-weight-medium">{{ spec.key }}</td>
                                            <td>{{ spec.value }}</td>
                                        </tr>
                                    </tbody>
                                </v-table>
                            </div>
                            <div v-else class="text-center py-8">
                                <v-icon icon="mdi-cog" size="48" color="grey-lighten-1" class="mb-4"></v-icon>
                                <p class="text-body-1 text-medium-emphasis">No specifications available</p>
                            </div>
                        </v-window-item>

                        <!-- Features Tab -->
                        <v-window-item value="features">
                            <div v-if="featuresList.length > 0">
                                <v-list>
                                    <v-list-item v-for="(feature, index) in featuresList" :key="index"
                                        prepend-icon="mdi-check-circle" color="success">
                                        <v-list-item-title>{{ feature }}</v-list-item-title>
                                    </v-list-item>
                                </v-list>
                            </div>
                            <div v-else class="text-center py-8">
                                <v-icon icon="mdi-star-outline" size="48" color="grey-lighten-1" class="mb-4"></v-icon>
                                <p class="text-body-1 text-medium-emphasis">No features available</p>
                            </div>
                        </v-window-item>

                        <!-- Downloads Tab -->
                        <v-window-item value="downloads">
                            <div v-if="downloadsList.length > 0">
                                <v-list>
                                    <v-list-item v-for="(download, index) in downloadsList" :key="index"
                                        :title="download.title"
                                        :subtitle="`${download.type} - ${download.size || 'N/A'}`"
                                        prepend-icon="mdi-download" append-icon="mdi-open-in-new">
                                        <template v-slot:append>
                                            <v-btn icon="mdi-open-in-new" variant="text" size="small"
                                                @click="window.open(download.url, '_blank')"></v-btn>
                                        </template>
                                    </v-list-item>
                                </v-list>
                            </div>
                            <div v-else class="text-center py-8">
                                <v-icon icon="mdi-download-off" size="48" color="grey-lighten-1" class="mb-4"></v-icon>
                                <p class="text-body-1 text-medium-emphasis">No downloads available</p>
                            </div>
                        </v-window-item>

                        <!-- FAQs Tab -->
                        <v-window-item value="faq">
                            <div v-if="faqsList.length > 0">
                                <v-expansion-panels>
                                    <v-expansion-panel v-for="(faq, index) in faqsList" :key="index">
                                        <v-expansion-panel-title>
                                            <div class="font-weight-medium">{{ faq.question }}</div>
                                        </v-expansion-panel-title>
                                        <v-expansion-panel-text>
                                            <div class="text-body-1">{{ faq.answer }}</div>
                                        </v-expansion-panel-text>
                                    </v-expansion-panel>
                                </v-expansion-panels>
                            </div>
                            <div v-else class="text-center py-8">
                                <v-icon icon="mdi-help-circle-outline" size="48" color="grey-lighten-1"
                                    class="mb-4"></v-icon>
                                <p class="text-body-1 text-medium-emphasis">No FAQs available</p>
                            </div>
                        </v-window-item>

                        <!-- Warranty & Service Tab -->
                        <v-window-item value="warranty">
                            <v-row>
                                <v-col cols="12">
                                    <div class="text-subtitle-1 text-medium-emphasis mb-2">Warranty Period</div>
                                    <div class="text-h6 font-weight-bold mb-4">
                                        {{ warrantyInfo.period || '-' }}
                                    </div>
                                </v-col>
                                <v-col cols="12">
                                    <div class="text-subtitle-1 text-medium-emphasis mb-2">What's Covered</div>
                                    <div v-if="warrantyInfo.coverage && warrantyInfo.coverage.length > 0">
                                        <v-list>
                                            <v-list-item v-for="(item, index) in warrantyInfo.coverage" :key="index"
                                                prepend-icon="mdi-check" color="success">
                                                <v-list-item-title>{{ item }}</v-list-item-title>
                                            </v-list-item>
                                        </v-list>
                                    </div>
                                    <div v-else class="text-body-1 text-medium-emphasis mb-4">No coverage items
                                    </div>
                                </v-col>
                                <v-col cols="12">
                                    <div class="text-subtitle-1 text-medium-emphasis mb-2">Terms & Conditions</div>
                                    <div class="text-body-1">{{ warrantyInfo.terms || '-' }}</div>
                                </v-col>
                            </v-row>
                        </v-window-item>

                        <!-- SEO Tab -->
                        <v-window-item value="seo">
                            <v-row>
                                <v-col cols="12">
                                    <div class="text-subtitle-1 text-medium-emphasis mb-2">Meta Title</div>
                                    <div class="text-body-1 mb-4">{{ productDetails.meta_title || '-' }}</div>
                                </v-col>
                                <v-col cols="12">
                                    <div class="text-subtitle-1 text-medium-emphasis mb-2">Meta Description</div>
                                    <div class="text-body-1 mb-4">{{ productDetails.meta_description || '-' }}</div>
                                </v-col>
                                <v-col cols="12">
                                    <div class="text-subtitle-1 text-medium-emphasis mb-2">Meta Keywords</div>
                                    <div class="text-body-1 mb-4">{{ productDetails.meta_keywords || '-' }}</div>
                                </v-col>
                                <v-col cols="12">
                                    <div class="text-subtitle-1 text-medium-emphasis mb-2">Open Graph Image</div>
                                    <div v-if="productDetails.og_image" class="mb-2">
                                        <v-img :src="resolveImageUrl(productDetails.og_image)" max-height="200" contain
                                            class="rounded"></v-img>
                                    </div>
                                    <div class="text-body-1">{{ productDetails.og_image || '-' }}</div>
                                </v-col>
                            </v-row>
                        </v-window-item>

                        <!-- Settings Tab -->
                        <v-window-item value="settings">
                            <v-row>
                                <v-col cols="12" md="6">
                                    <div class="text-subtitle-1 text-medium-emphasis mb-2">Published Status</div>
                                    <v-chip :color="productDetails.published ? 'success' : 'error'" size="default"
                                        class="mb-4">
                                        {{ productDetails.published ? 'Published' : 'Draft' }}
                                    </v-chip>
                                </v-col>
                                <v-col cols="12" md="6">
                                    <div class="text-subtitle-1 text-medium-emphasis mb-2">Featured Product</div>
                                    <v-chip :color="productDetails.featured ? 'amber' : 'grey'" size="default"
                                        class="mb-4">
                                        {{ productDetails.featured ? 'Featured' : 'Not Featured' }}
                                    </v-chip>
                                </v-col>
                                <v-col cols="12" md="6">
                                    <div class="text-subtitle-1 text-medium-emphasis mb-2">Stock Quantity</div>
                                    <div class="text-body-1 mb-4">{{ productDetails.stock !== null ?
                                        productDetails.stock : '-' }}</div>
                                </v-col>
                                <v-col cols="12" md="6">
                                    <div class="text-subtitle-1 text-medium-emphasis mb-2">Display Order</div>
                                    <div class="text-body-1 mb-4">{{ productDetails.order || 0 }}</div>
                                </v-col>
                                <v-col cols="12" md="6">
                                    <div class="text-subtitle-1 text-medium-emphasis mb-2">Created At</div>
                                    <div class="text-body-1 mb-4">
                                        {{ productDetails.created_at ? new
                                            Date(productDetails.created_at).toLocaleString() : '-' }}
                                    </div>
                                </v-col>
                                <v-col cols="12" md="6">
                                    <div class="text-subtitle-1 text-medium-emphasis mb-2">Updated At</div>
                                    <div class="text-body-1 mb-4">
                                        {{ productDetails.updated_at ? new
                                            Date(productDetails.updated_at).toLocaleString() : '-' }}
                                    </div>
                                </v-col>
                            </v-row>
                        </v-window-item>
                    </v-window>
                </div>
            </v-card-text>

            <v-card-actions class="pa-4 bg-grey-lighten-4" v-if="!loading && productDetails">
                <v-spacer></v-spacer>
                <v-btn variant="text" @click="close">Close</v-btn>
                <v-btn color="primary" variant="flat" @click="handleEdit">
                    <v-icon icon="mdi-pencil" class="mr-2"></v-icon>
                    Edit Product
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
import { resolveUploadUrl } from '../../../../utils/uploads';
import { formatNumber as formatNumberUtil, formatPrice as formatPriceUtil, formatPriceRange as formatPriceRangeUtil } from '../../../../utils/formatters';

export default {
    name: 'ProductDetailsDialog',
    props: {
        modelValue: {
            type: Boolean,
            default: false
        },
        productDetails: {
            type: Object,
            default: null
        },
        loading: {
            type: Boolean,
            default: false
        },
        specificationsList: {
            type: Array,
            default: () => []
        },
        featuresList: {
            type: Array,
            default: () => []
        },
        downloadsList: {
            type: Array,
            default: () => []
        },
        faqsList: {
            type: Array,
            default: () => []
        },
        warrantyInfo: {
            type: Object,
            default: () => ({
                period: '2 Years',
                coverage: [],
                terms: ''
            })
        }
    },
    emits: ['update:modelValue', 'edit'],
    data() {
        return {
            detailsTab: 'basic'
        };
    },
    methods: {
        close() {
            this.$emit('update:modelValue', false);
        },
        handleEdit() {
            this.$emit('edit');
        },
        resolveImageUrl(imageValue) {
            return resolveUploadUrl(imageValue);
        },
        formatNumber(value) {
            return formatNumberUtil(value);
        },
        formatPrice(price) {
            return formatPriceUtil(price, '-');
        },
        formatPriceRange(priceRange) {
            return formatPriceRangeUtil(priceRange, '-');
        }
    },
    watch: {
        modelValue(newVal) {
            if (!newVal) {
                this.detailsTab = 'basic';
            }
        }
    }
};
</script>
