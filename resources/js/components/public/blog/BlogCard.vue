<template>
    <v-hover v-slot="{ isHovering, props: hoverProps }">
        <v-card 
            v-bind="hoverProps" 
            :elevation="isHovering ? 8 : 2"
            class="blog-card h-100 bg-white rounded-xl overflow-hidden transition-all"
            :to="`/blog/${post.slug}`"
        >
            <!-- Featured Image -->
            <div 
                v-if="post.featured_image" 
                class="blog-image-container position-relative bg-grey-lighten-4"
                style="height: 240px; overflow: hidden;"
            >
                <v-img 
                    :src="post.featured_image || '/assets/img/default.jpg'" 
                    :alt="post.title" 
                    height="100%" 
                    cover
                    class="blog-img transition-transform" 
                    :class="{ 'scale-110': isHovering }"
                />
                <div class="image-overlay position-absolute bottom-0 left-0 right-0 pa-4">
                    <div class="d-flex align-center gap-2 flex-wrap">
                        <v-chip 
                            v-for="category in post.categories?.slice(0, 2)" 
                            :key="category.id"
                            size="small" 
                            color="primary" 
                            variant="flat"
                            class="font-weight-bold"
                        >
                            {{ category.name }}
                        </v-chip>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="pa-5">
                <!-- Meta Info -->
                <div class="d-flex align-center justify-space-between mb-3">
                    <div class="d-flex align-center gap-2 text-caption text-medium-emphasis">
                        <v-icon icon="mdi-calendar" size="small" />
                        <span>{{ formatDate(post.published_at) }}</span>
                    </div>
                    <div v-if="post.views" class="d-flex align-center gap-1 text-caption text-medium-emphasis">
                        <v-icon icon="mdi-eye" size="small" />
                        <span>{{ formatViews(post.views) }}</span>
                    </div>
                </div>

                <!-- Title -->
                <h3 class="text-h6 font-weight-bold text-grey-darken-4 mb-3 lh-tight" style="min-height: 56px;">
                    {{ post.title }}
                </h3>

                <!-- Excerpt -->
                <p 
                    v-if="post.excerpt" 
                    class="text-body-2 text-medium-emphasis mb-4 line-clamp-3"
                    style="min-height: 60px;"
                >
                    {{ post.excerpt }}
                </p>

                <!-- Author -->
                <div v-if="post.author" class="d-flex align-center gap-3 mb-4">
                    <v-avatar size="32" color="primary">
                        <v-icon icon="mdi-account" color="white" size="small" />
                    </v-avatar>
                    <div>
                        <div class="text-body-2 font-weight-medium">
                            {{ post.author.name || post.author.email }}
                        </div>
                    </div>
                </div>

                <!-- Tags -->
                <div v-if="post.tags && post.tags.length > 0" class="d-flex flex-wrap gap-2 mb-4">
                    <v-chip 
                        v-for="tag in post.tags.slice(0, 3)" 
                        :key="tag.id"
                        size="x-small" 
                        variant="outlined"
                        color="primary"
                    >
                        {{ tag.name }}
                    </v-chip>
                    <v-chip 
                        v-if="post.tags.length > 3"
                        size="x-small" 
                        variant="text"
                        color="grey"
                    >
                        +{{ post.tags.length - 3 }} more
                    </v-chip>
                </div>

                <!-- Read More -->
                <v-btn 
                    variant="text" 
                    color="primary" 
                    class="px-0 font-weight-bold text-capitalize"
                    :to="`/blog/${post.slug}`"
                >
                    Read More
                    <v-icon icon="mdi-arrow-right" size="small" class="ml-1" />
                </v-btn>
            </div>
        </v-card>
    </v-hover>
</template>

<script setup>
import { defineProps } from 'vue';

const props = defineProps({
    post: {
        type: Object,
        required: true
    }
});

const formatDate = (date) => {
    if (!date) return '';
    const d = new Date(date);
    return d.toLocaleDateString('en-US', { 
        year: 'numeric', 
        month: 'long', 
        day: 'numeric' 
    });
};

const formatViews = (views) => {
    if (!views) return '0';
    if (views >= 1000) {
        return (views / 1000).toFixed(1) + 'K';
    }
    return views.toString();
};
</script>

<style scoped>
.blog-card {
    transition: all 0.3s ease;
    cursor: pointer;
}

.blog-card:hover {
    transform: translateY(-4px);
}

.blog-image-container {
    position: relative;
}

.image-overlay {
    background: linear-gradient(to top, rgba(0, 0, 0, 0.7) 0%, transparent 100%);
}

.blog-img {
    transition: transform 0.4s ease;
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>

