<template>
    <v-menu v-model="menuOpen" :close-on-content-click="false" location="bottom start" transition="scale-transition">
        <template #activator="{ props }">
            <v-text-field v-bind="props" :model-value="displayValue" :label="label" :hint="hint"
                :persistent-hint="persistentHint" :variant="variant" :readonly="true" :clearable="clearable"
                :prepend-inner-icon="prependIcon" density="compact" @click:clear="clearDate">
            </v-text-field>
        </template>

        <v-card class="pa-2" max-width="320">
            <v-card-title class="text-subtitle-2 py-1 px-2 d-flex align-center">
                <v-icon size="small" class="mr-2" icon="mdi-calendar"></v-icon>
                <span>{{ title || 'Select Date' }}</span>
            </v-card-title>
            <v-card-text class="py-1 px-2">
                <v-date-picker v-model="selectedDate" hide-header show-adjacent-months color="primary"
                    @update:model-value="onSelect" density="compact"></v-date-picker>
            </v-card-text>
            <v-card-actions class="py-1 px-2">
                <v-spacer></v-spacer>
                <v-btn variant="text" size="small" @click="clearDate">Clear</v-btn>
                <v-btn variant="flat" color="primary" size="small" @click="menuOpen = false">OK</v-btn>
            </v-card-actions>
        </v-card>
    </v-menu>
</template>

<script>
export default {
    name: 'DatePicker',
    props: {
        modelValue: {
            type: String,
            default: ''
        },
        label: {
            type: String,
            default: 'Date'
        },
        hint: {
            type: String,
            default: ''
        },
        persistentHint: {
            type: Boolean,
            default: false
        },
        variant: {
            type: String,
            default: 'outlined'
        },
        clearable: {
            type: Boolean,
            default: true
        },
        prependIcon: {
            type: String,
            default: 'mdi-calendar'
        },
        title: {
            type: String,
            default: ''
        }
    },
    emits: ['update:modelValue'],
    data() {
        return {
            menuOpen: false,
            selectedDate: ''
        };
    },
    computed: {
        displayValue() {
            if (!this.selectedDate) return '';
            return this.formatDateForDisplay(this.selectedDate);
        }
    },
    watch: {
        modelValue: {
            immediate: true,
            handler(val) {
                this.selectedDate = this.formatDateForStorage(val);
            }
        }
    },
    methods: {
        onSelect(val) {
            this.selectedDate = this.formatDateForStorage(val);
            this.$emit('update:modelValue', this.selectedDate);
            this.menuOpen = false;
        },
        clearDate() {
            this.selectedDate = '';
            this.$emit('update:modelValue', '');
            this.menuOpen = false;
        },
        formatDateForStorage(val) {
            if (!val) return '';
            // Ensure YYYY-MM-DD format regardless of timezone
            const date = new Date(val);
            if (isNaN(date.getTime())) {
                // If it's already in YYYY-MM-DD format, return as is
                if (/^\d{4}-\d{2}-\d{2}$/.test(val)) {
                    return val;
                }
                return '';
            }
            const year = date.getFullYear();
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const day = String(date.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`;
        },
        formatDateForDisplay(val) {
            if (!val) return '';
            // Convert YYYY-MM-DD to DD-MMM-YYYY format
            const date = new Date(val);
            if (isNaN(date.getTime())) {
                // If already in display format or invalid, return as is
                return val;
            }
            const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
            const day = String(date.getDate()).padStart(2, '0');
            const month = months[date.getMonth()];
            const year = date.getFullYear();
            return `${day}-${month}-${year}`;
        }
    }
};
</script>

<style scoped>
:deep(.v-date-picker) {
    width: 100%;
}
</style>
