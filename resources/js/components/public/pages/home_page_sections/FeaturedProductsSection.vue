<template>
    <section class="py-20 bg-surface">
        <v-container>
            <div class="d-flex flex-column flex-sm-row justify-space-between align-end mb-12">
                <div>
                    <div class="text-overline text-primary font-weight-bold mb-2 tracking-widest">{{ overline ||
                        defaultOverline }}</div>
                    <h2 class="text-h3 font-weight-bold text-grey-darken-3">{{ title || defaultTitle }}</h2>
                </div>
                <v-btn variant="outlined" color="primary" :to="buttonLink || defaultButtonLink"
                    class="mt-4 mt-sm-0 rounded-pill px-6 font-weight-bold">
                    {{ buttonText || defaultButtonText }}
                </v-btn>
            </div>

            <v-row v-if="limitedProducts.length > 0" justify="center">
                <v-col v-for="product in limitedProducts" :key="product.id" cols="12" sm="6" md="3">
                    <ProductCard :product="product" :comparison-disabled="true"
                        @toggle-comparison="handleToggleComparison" />
                </v-col>
            </v-row>
        </v-container>
    </section>
</template>

<script>
import ProductCard from '../../products/ProductCard.vue';

export default {
    name: 'FeaturedProductsSection',
    components: {
        ProductCard
    },
    props: {
        overline: {
            type: String,
            default: 'OUR PRODUCTS'
        },
        title: {
            type: String,
            default: 'Featured Power Systems'
        },
        buttonText: {
            type: String,
            default: 'View All Products'
        },
        buttonLink: {
            type: String,
            default: '/products'
        },
        products: {
            type: Array,
            default: () => []
        }
    },
    data() {
        return {
            defaultOverline: 'OUR PRODUCTS',
            defaultTitle: 'Featured Power Systems',
            defaultButtonText: 'View All Products',
            defaultButtonLink: '/products'
        };
    },
    computed: {
        limitedProducts() {
            return this.products.slice(0, 4);
        }
    },
    methods: {
        handleToggleComparison(product) {
            // Comparison is disabled in featured section, but we handle the event to prevent errors
            console.log('Comparison toggle requested for:', product.title);
        }
    }
};
</script>

<style scoped>
/* Styles moved to ProductCard component */
</style>
