<template>
    <div class="products-page">
        <!-- Page Header -->
        <v-container class="py-12">
            <v-row justify="center">
                <v-col cols="12" md="10" lg="8">
                    <div class="text-center mb-8">
                        <h1 class="text-h3 text-md-h2 font-weight-bold mb-4">
                            Our Product Catalog
                        </h1>
                        <p class="text-h6 text-grey-darken-1">
                            Discover our comprehensive range of professional-grade products designed for business and
                            industrial applications
                        </p>
                    </div>
                </v-col>
            </v-row>

            <!-- Categories Section -->
            <div class="categories-section mb-8">
                <div class="category-section-wrapper">
                    <div class="category-filter-wrapper">
                        <!-- Scroll indicators -->
                        <div v-if="showLeftArrow" class="scroll-indicator left-indicator"
                            @click="scrollCategories('left')">
                            <v-icon icon="mdi-chevron-left" color="primary" size="small" />
                        </div>
                        <div v-if="showRightArrow" class="scroll-indicator right-indicator"
                            @click="scrollCategories('right')">
                            <v-icon icon="mdi-chevron-right" color="primary" size="small" />
                        </div>

                        <div ref="categoryScroll" class="category-filter" @scroll="checkScroll">
                            <v-btn v-for="category in categories" :key="category.id" variant="flat"
                                :color="activeCategory === category.id ? 'primary' : 'grey-lighten-3'"
                                class="category-btn font-weight-bold text-capitalize rounded-pill flex-shrink-0" :class="{
                                    'category-btn-active': activeCategory === category.id,
                                    'category-btn-inactive': activeCategory !== category.id
                                }" size="small" density="comfortable" @click="setActiveCategory(category.id)"
                                :aria-pressed="activeCategory === category.id">
                                <v-icon v-if="category.icon" :icon="category.icon" size="14" class="mr-1" />
                                <span class="category-text">{{ category.name }}</span>
                            </v-btn>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products List -->
            <v-row v-if="loading" justify="center" class="my-12">
                <v-col cols="12" class="text-center">
                    <v-progress-circular indeterminate color="primary" size="64"></v-progress-circular>
                    <p class="mt-4 text-grey">Loading product catalog...</p>
                </v-col>
            </v-row>

            <v-row v-else-if="advancedFilteredProducts.length > 0">
                <v-col v-for="product in displayedProducts" :key="product.id" cols="12" sm="6" md="4">
                    <ProductCard :product="product" :comparison-disabled="!canAddMore && !isInComparison(product)"
                        @toggle-comparison="handleToggleComparison" />
                </v-col>
            </v-row>

            <v-row v-else>
                <v-col cols="12" class="text-center py-12">
                    <v-icon size="80" color="grey-lighten-1">mdi-package-variant</v-icon>
                    <p class="text-h6 text-grey mt-4">No Products Match Your Criteria</p>
                    <p class="text-body-1 text-grey mb-6">Please adjust your search filters or contact us for assistance
                        finding the right solution.</p>
                    <v-btn variant="outlined" color="primary" @click="clearAllFilters">
                        Reset Filters
                    </v-btn>
                </v-col>
            </v-row>

            <!-- Load More Section (if needed) -->
            <v-row v-if="displayedProducts.length > 0 && hasMoreProducts" justify="center" class="mt-12">
                <v-col cols="12" class="text-center">
                    <v-btn variant="outlined" color="primary" size="large" rounded="pill" class="px-10 font-weight-bold"
                        @click="loadMore" :loading="loadingMore">
                        View More Products
                    </v-btn>
                </v-col>
            </v-row>
        </v-container>

        <!-- CTA Section -->
        <v-container class="py-12 bg-primary-lighten-5">
            <v-row justify="center">
                <v-col cols="12" md="8" class="text-center">
                    <h2 class="text-h4 font-weight-bold mb-4">
                        Need help finding the right product?
                    </h2>
                    <p class="text-h6 mb-6">
                        Our team is here to help you find the perfect solution for your business needs.
                    </p>
                    <v-btn color="primary" size="large" to="/contact" class="mr-2">
                        Contact Us
                    </v-btn>
                    <v-btn color="primary" variant="outlined" size="large" to="/case-studies">
                        View Case Studies
                    </v-btn>
                </v-col>
            </v-row>
        </v-container>

        <!-- Comparison Dialog Component -->
        <ComparisonDialog v-model="showComparison" :products="comparisonProducts" :comparison-specs="comparisonSpecs"
            @remove-product="removeFromComparison" @clear-all="clearComparison" />
    </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted, computed, watch, nextTick } from 'vue';
import { useProducts } from '../../../composables/useProducts';
import { useCategories } from '../../../composables/useCategories';
import { useProductFilters } from '../../../composables/useProductFilters';
import { useProductComparison } from '../../../composables/useProductComparison';
import ProductCard from './ProductCard.vue';
import ComparisonDialog from './ComparisonDialog.vue';

// Pagination constants
const PRODUCTS_PER_PAGE = 12;

// Initialize composables
const { products, loading, fetchProducts } = useProducts();
const { categories, fetchCategories } = useCategories();
const {
    activeCategory,
    searchQuery,
    sortBy,
    sortOptions,
    filteredProducts,
    sortByLabel,
    hasActiveFilters,
    activeFiltersCount,
    setActiveCategory,
    setSortBy,
    setSearchQuery,
    clearFilters
} = useProductFilters(products);

const {
    comparisonProducts,
    showComparison,
    canAddMore,
    isInComparison,
    toggleComparison,
    removeFromComparison,
    clearComparison,
    openComparison,
    getComparisonSpecs
} = useProductComparison(3);

// Pagination state
const displayedCount = ref(PRODUCTS_PER_PAGE);
const loadingMore = ref(false);

// Category scroll functionality
const categoryScroll = ref(null);
const showLeftArrow = ref(false);
const showRightArrow = ref(false);

const checkScroll = () => {
    if (!categoryScroll.value) return;

    const element = categoryScroll.value;
    showLeftArrow.value = element.scrollLeft > 10;
    showRightArrow.value = element.scrollLeft < (element.scrollWidth - element.clientWidth - 10);
};

const scrollCategories = (direction) => {
    if (!categoryScroll.value) return;

    const scrollAmount = 200;
    const element = categoryScroll.value;

    if (direction === 'left') {
        element.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
    } else {
        element.scrollBy({ left: scrollAmount, behavior: 'smooth' });
    }

    setTimeout(checkScroll, 100);
};

// Advanced filter states
const priceRange = ref([0, 100000]);
const availability = ref([]);
const selectedBrands = ref([]);
const minRating = ref(0);
const selectedFeatures = ref([]);
const discount = ref(null);

// Available filter options
const availableBrands = computed(() => {
    // Extract unique brands from products
    const brandsSet = new Set();
    products.value.forEach(product => {
        if (product.brand) {
            brandsSet.add(product.brand);
        }
    });
    return Array.from(brandsSet).sort();
});

const availableFeatures = computed(() => {
    // Icon mapping for known features
    const iconMap = {
        'wireless': 'mdi-wifi',
        'waterproof': 'mdi-water',
        'bluetooth': 'mdi-bluetooth',
        'rechargeable': 'mdi-battery-charging',
        'warranty': 'mdi-shield-check',
        'eco_friendly': 'mdi-leaf'
    };

    // Extract unique features from all products dynamically
    const featuresSet = new Set();
    products.value.forEach(product => {
        if (product.features && Array.isArray(product.features)) {
            product.features.forEach(feature => {
                if (feature) {
                    featuresSet.add(feature);
                }
            });
        }
    });

    // Convert to array and format with labels and icons
    return Array.from(featuresSet).sort().map(feature => {
        return {
            value: feature,
            label: feature.split('_').map(word =>
                word.charAt(0).toUpperCase() + word.slice(1)
            ).join(' '),
            icon: iconMap[feature] || 'mdi-check-circle'
        };
    });
});

// Computed properties
const comparisonSpecs = computed(() => {
    return getComparisonSpecs();
});

// Apply advanced filters to filteredProducts
const advancedFilteredProducts = computed(() => {
    let filtered = [...filteredProducts.value];

    // Price range filter
    if (priceRange.value[0] > 0 || priceRange.value[1] < 100000) {
        filtered = filtered.filter(product => {
            const price = parseFloat(product.price) || 0;
            return price >= priceRange.value[0] && price <= priceRange.value[1];
        });
    }

    // Availability filter
    if (availability.value.length > 0) {
        filtered = filtered.filter(product => {
            return availability.value.includes(product.availability);
        });
    }

    // Brand filter
    if (selectedBrands.value.length > 0) {
        filtered = filtered.filter(product => {
            return selectedBrands.value.includes(product.brand);
        });
    }

    // Rating filter
    if (minRating.value > 0) {
        filtered = filtered.filter(product => {
            const rating = parseFloat(product.rating) || 0;
            return rating >= minRating.value;
        });
    }

    // Features filter
    if (selectedFeatures.value.length > 0) {
        filtered = filtered.filter(product => {
            if (!product.features || !Array.isArray(product.features)) return false;
            return selectedFeatures.value.some(feature => product.features.includes(feature));
        });
    }

    // Discount filter
    if (discount.value) {
        filtered = filtered.filter(product => {
            const discountPercent = parseFloat(product.discount_percent) || 0;
            if (discount.value === 'any') return discountPercent > 0;
            return discountPercent >= parseFloat(discount.value);
        });
    }

    return filtered;
});

// Display only the first N products from filtered results
const displayedProducts = computed(() => {
    return advancedFilteredProducts.value.slice(0, displayedCount.value);
});

// Check if there are more products to load
const hasMoreProducts = computed(() => {
    return advancedFilteredProducts.value.length > displayedCount.value;
});

// Advanced filter setter methods
const setPriceRange = (range) => {
    priceRange.value = range;
};

const setAvailability = (availabilityValue) => {
    availability.value = availabilityValue;
};

const setSelectedBrands = (brands) => {
    selectedBrands.value = brands;
};

const setMinRating = (rating) => {
    minRating.value = rating;
};

const setSelectedFeatures = (features) => {
    selectedFeatures.value = features;
};

const setDiscount = (discountValue) => {
    discount.value = discountValue;
};

// Methods
const handleToggleComparison = (product) => {
    const success = toggleComparison(product);
    if (!success && !isInComparison(product)) {
        // Show error message - product limit reached
        console.warn('Cannot add more than 3 products to comparison');
        // You can integrate with a toast notification system here
    }
};

const loadMore = () => {
    loadingMore.value = true;
    // Simulate a small delay for better UX (optional)
    setTimeout(() => {
        displayedCount.value += PRODUCTS_PER_PAGE;
        loadingMore.value = false;
    }, 200);
};

// Enhanced clear filters function
const clearAllFilters = () => {
    clearFilters(); // Clear basic filters
    priceRange.value = [0, 100000];
    availability.value = [];
    selectedBrands.value = [];
    minRating.value = 0;
    selectedFeatures.value = [];
    discount.value = null;
};

// Reset pagination when filters change
watch([activeCategory, searchQuery, sortBy, priceRange, availability, selectedBrands, minRating, selectedFeatures, discount], () => {
    displayedCount.value = PRODUCTS_PER_PAGE;
}, { deep: true });


// Handle window resize
const handleResize = () => {
    // Update scroll indicators on resize
    nextTick(() => {
        setTimeout(() => {
            checkScroll();
        }, 100);
    });
};

// Lifecycle hooks
onMounted(async () => {
    // Update scroll indicators on mount
    handleResize();
    // Add resize listener
    window.addEventListener('resize', handleResize);

    await Promise.all([
        fetchCategories(),
        fetchProducts()
    ]);

    // Check scroll indicators on mount and when categories change
    nextTick(() => {
        setTimeout(() => {
            checkScroll();
        }, 100);
    });
});

// Watch categories to update scroll indicators
watch(() => categories.value, () => {
    nextTick(() => {
        setTimeout(() => {
            checkScroll();
        }, 100);
    });
}, { deep: true });

onUnmounted(() => {
    window.removeEventListener('resize', handleResize);
});
</script>

<style scoped>
.products-page {
    min-height: 60vh;
}

/* Categories Section Styles */
.categories-section {
    position: relative;
}

.category-section-wrapper {
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
}

.category-section-heading {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.eyebrow {
    display: inline-flex;
    align-items: center;
    font-size: 0.75rem;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    font-weight: 700;
}

.subcopy {
    font-size: 0.82rem;
    display: flex;
    align-items: center;
    margin-top: 2px;
}

.category-filter-wrapper {
    position: relative;
    width: 100%;
    max-width: 100%;
    padding: 0 4px;
    display: flex;
    justify-content: center;
}

.category-filter {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    scroll-behavior: smooth;
    -webkit-overflow-scrolling: touch;
    overflow-x: auto;
    overflow-y: hidden;
    width: 100%;
    padding: 8px 0 10px;
    scrollbar-width: thin;
    scrollbar-color: rgba(var(--v-theme-primary), 0.3) rgba(0, 0, 0, 0.05);
}

.category-filter::-webkit-scrollbar {
    height: 6px;
    display: block;
}

.category-filter::-webkit-scrollbar-track {
    background: rgba(0, 0, 0, 0.04);
    border-radius: 10px;
    margin: 0 4px;
}

.category-filter::-webkit-scrollbar-thumb {
    background: linear-gradient(90deg, rgba(var(--v-theme-primary), 0.4), rgba(var(--v-theme-primary), 0.6));
    border-radius: 10px;
    transition: background 0.3s ease;
}

.category-filter::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(90deg, rgba(var(--v-theme-primary), 0.6), rgba(var(--v-theme-primary), 0.8));
}

/* Scroll Indicators */
.scroll-indicator {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 32px;
    height: 32px;
    background: rgba(255, 255, 255, 0.95);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    z-index: 2;
    transition: all 0.3s ease;
    backdrop-filter: blur(8px);
}

.scroll-indicator:hover {
    background: white;
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
    transform: translateY(-50%) scale(1.1);
}

.left-indicator {
    left: -8px;
}

.right-indicator {
    right: -8px;
}

@media (max-width: 1280px) {
    .scroll-indicator {
        display: none;
    }
}

.category-btn {
    white-space: nowrap;
    transition: all 0.25s ease;
    text-transform: none !important;
    letter-spacing: 0.1px;
    font-size: 0.8rem;
    min-height: 32px;
    padding: 7px 12px !important;
    flex-shrink: 0;
    min-width: auto;
}

.category-text {
    font-size: inherit;
}

.category-btn-active {
    box-shadow: 0 10px 20px -12px rgba(var(--v-theme-primary), 0.6) !important;
    transform: translateY(-1px);
}

.category-btn-inactive {
    color: #475569 !important;
}

.category-btn-inactive:hover {
    background-color: #e2e8f0 !important;
    transform: translateY(-1px);
    box-shadow: 0 8px 18px -12px rgba(0, 0, 0, 0.15) !important;
}

@media (max-width: 960px) {
    .categories-section {
        margin-bottom: 24px !important;
    }
}

@media (max-width: 600px) {
    .categories-section {
        margin-bottom: 16px !important;
    }

    .category-filter {
        padding: 6px 0 8px;
    }
}
</style>
