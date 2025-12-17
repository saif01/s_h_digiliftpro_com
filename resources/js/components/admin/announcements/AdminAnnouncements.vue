<template>
    <div>
        <div class="page-header">
            <h1 class="text-h4 page-title">Announcements Management</h1>
            <v-btn color="primary" prepend-icon="mdi-plus" @click="openDialog()" class="add-button">
                Create Announcement
            </v-btn>
        </div>

        <!-- Search and Filter -->
        <v-card class="mb-4">
            <v-card-text>
                <v-row>
                    <v-col cols="12" md="3">
                        <v-select v-model="perPage" :items="perPageOptions" label="Items per page"
                            prepend-inner-icon="mdi-format-list-numbered" variant="outlined" density="compact"
                            @update:model-value="onPerPageChange"></v-select>
                    </v-col>
                    <v-col cols="12" md="3">
                        <v-select v-model="statusFilter" :items="statusOptions" label="Filter by Status"
                            prepend-inner-icon="mdi-filter" variant="outlined" density="compact" clearable
                            @update:model-value="loadAnnouncements"></v-select>
                    </v-col>
                    <v-col cols="12" md="3">
                        <v-select v-model="typeFilter" :items="typeOptions" label="Filter by Type"
                            prepend-inner-icon="mdi-tag" variant="outlined" density="compact" clearable
                            @update:model-value="loadAnnouncements"></v-select>
                    </v-col>
                    <v-col cols="12" md="3">
                        <v-text-field v-model="search" label="Search announcements" prepend-inner-icon="mdi-magnify"
                            variant="outlined" density="compact" clearable
                            @update:model-value="loadAnnouncements"></v-text-field>
                    </v-col>
                </v-row>
            </v-card-text>
        </v-card>

        <!-- Announcements Table -->
        <v-card>
            <v-card-title class="d-flex justify-space-between align-center">
                <span>Announcements</span>
                <span class="text-caption text-grey">
                    Total Records: <strong>{{ pagination.total || 0 }}</strong>
                    <span v-if="announcements.length > 0">
                        | Showing {{ ((currentPage - 1) * perPage) + 1 }} to {{ Math.min(currentPage * perPage,
                            pagination.total) }} of {{ pagination.total }}
                    </span>
                </span>
            </v-card-title>
            <v-card-text>
                <v-table>
                    <thead>
                        <tr>
                            <th class="sortable" @click="onSort('title')">
                                <div class="d-flex align-center">
                                    Title
                                    <v-icon :icon="getSortIcon('title')" size="small" class="ml-1"></v-icon>
                                </div>
                            </th>
                            <th>Type</th>
                            <th>Display Type</th>
                            <th class="sortable" @click="onSort('priority')">
                                <div class="d-flex align-center">
                                    Priority
                                    <v-icon :icon="getSortIcon('priority')" size="small" class="ml-1"></v-icon>
                                </div>
                            </th>
                            <th>Date Range</th>
                            <th class="sortable" @click="onSort('is_active')">
                                <div class="d-flex align-center">
                                    Status
                                    <v-icon :icon="getSortIcon('is_active')" size="small" class="ml-1"></v-icon>
                                </div>
                            </th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Skeleton Loaders -->
                        <tr v-if="loading" v-for="n in 5" :key="`skeleton-${n}`">
                            <td><v-skeleton-loader type="text" width="200"></v-skeleton-loader></td>
                            <td><v-skeleton-loader type="chip" width="100"></v-skeleton-loader></td>
                            <td><v-skeleton-loader type="chip" width="100"></v-skeleton-loader></td>
                            <td><v-skeleton-loader type="text" width="60"></v-skeleton-loader></td>
                            <td><v-skeleton-loader type="text" width="150"></v-skeleton-loader></td>
                            <td><v-skeleton-loader type="chip" width="80"></v-skeleton-loader></td>
                            <td>
                                <div class="d-flex">
                                    <v-skeleton-loader type="button" width="32" height="32" class="mr-1"></v-skeleton-loader>
                                    <v-skeleton-loader type="button" width="32" height="32" class="mr-1"></v-skeleton-loader>
                                    <v-skeleton-loader type="button" width="32" height="32"></v-skeleton-loader>
                                </div>
                            </td>
                        </tr>
                        <!-- Actual Announcement Data -->
                        <template v-else>
                            <tr v-for="announcement in announcements" :key="announcement.id">
                                <td>
                                    <div class="font-weight-medium">{{ announcement.title }}</div>
                                    <div class="text-caption text-grey">{{ announcement.slug }}</div>
                                </td>
                                <td>
                                    <v-chip size="small" :color="getTypeColor(announcement.type)">
                                        {{ formatType(announcement.type) }}
                                    </v-chip>
                                </td>
                                <td>
                                    <v-chip size="small" variant="outlined">
                                        {{ formatDisplayType(announcement.display_type) }}
                                    </v-chip>
                                </td>
                                <td>
                                    <v-chip size="small" :color="announcement.priority > 50 ? 'error' : announcement.priority > 20 ? 'warning' : 'info'">
                                        {{ announcement.priority }}
                                    </v-chip>
                                </td>
                                <td>
                                    <div class="text-caption">
                                        <div v-if="announcement.start_date">
                                            <strong>Start:</strong> {{ formatDate(announcement.start_date) }}
                                        </div>
                                        <div v-if="announcement.end_date">
                                            <strong>End:</strong> {{ formatDate(announcement.end_date) }}
                                        </div>
                                        <div v-if="!announcement.start_date && !announcement.end_date" class="text-grey">
                                            No date range
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <v-chip :color="announcement.is_active ? 'success' : 'error'" size="small">
                                        {{ announcement.is_active ? 'Active' : 'Inactive' }}
                                    </v-chip>
                                </td>
                                <td>
                                    <v-btn size="small" icon="mdi-eye" @click="viewAnnouncement(announcement)" 
                                        variant="text" color="info" title="View"></v-btn>
                                    <v-btn size="small" icon="mdi-pencil" @click="editAnnouncement(announcement)" 
                                        variant="text" title="Edit"></v-btn>
                                    <v-btn size="small" :icon="announcement.is_active ? 'mdi-pause' : 'mdi-play'" 
                                        @click="toggleStatus(announcement)" variant="text" 
                                        :color="announcement.is_active ? 'warning' : 'success'" 
                                        :title="announcement.is_active ? 'Deactivate' : 'Activate'"></v-btn>
                                    <v-btn size="small" icon="mdi-delete" @click="deleteAnnouncement(announcement.id)" 
                                        variant="text" color="error" title="Delete"></v-btn>
                                </td>
                            </tr>
                            <tr v-if="announcements.length === 0">
                                <td colspan="7" class="text-center py-4">No announcements found</td>
                            </tr>
                        </template>
                    </tbody>
                </v-table>

                <!-- Pagination -->
                <div class="d-flex flex-column flex-md-row justify-space-between align-center align-md-start gap-3 mt-4">
                    <div class="text-caption text-grey">
                        <span v-if="announcements.length > 0 && pagination.total > 0">
                            Showing <strong>{{ ((currentPage - 1) * perPage) + 1 }}</strong> to 
                            <strong>{{ Math.min(currentPage * perPage, pagination.total) }}</strong> of 
                            <strong>{{ pagination.total.toLocaleString() }}</strong> records
                            <span v-if="pagination.last_page > 1" class="ml-2">
                                (Page {{ currentPage }} of {{ pagination.last_page }})
                            </span>
                        </span>
                        <span v-else>No records found</span>
                    </div>
                    <div v-if="pagination.last_page > 1" class="d-flex align-center gap-2">
                        <v-pagination 
                            v-model="currentPage" 
                            :length="pagination.last_page"
                            :total-visible="7"
                            density="comfortable"
                            @update:model-value="loadAnnouncements">
                        </v-pagination>
                    </div>
                </div>
            </v-card-text>
        </v-card>

        <!-- Announcement Form Dialog -->
        <AnnouncementFormDialog v-model="showDialog" :editing-announcement="editingAnnouncement" 
            @saved="handleAnnouncementSaved" />

        <!-- Announcement Details View Dialog -->
        <AnnouncementDetailsDialog v-model="showDetailsDialog" :announcement-id="selectedAnnouncementId"
            @edit="handleEditFromDetails" />
    </div>
</template>

<script>
import adminPaginationMixin from '../../../mixins/adminPaginationMixin';
import AnnouncementFormDialog from './dialog/AnnouncementFormDialog.vue';
import AnnouncementDetailsDialog from './dialog/AnnouncementDetailsDialog.vue';

export default {
    components: {
        AnnouncementFormDialog,
        AnnouncementDetailsDialog
    },
    mixins: [adminPaginationMixin],
    data() {
        return {
            announcements: [],
            showDialog: false,
            editingAnnouncement: null,
            showDetailsDialog: false,
            selectedAnnouncementId: null,
            statusFilter: null,
            statusOptions: [
                { title: 'Active', value: true },
                { title: 'Inactive', value: false }
            ],
            typeFilter: null,
            typeOptions: [
                { title: 'Company News', value: 'company_news' },
                { title: 'Offers / Promotions', value: 'offers_promotions' },
                { title: 'Events', value: 'events' },
                { title: 'Holidays', value: 'holidays' },
                { title: 'Urgent Alerts', value: 'urgent_alerts' }
            ]
        };
    },
    async mounted() {
        await this.loadAnnouncements();
    },
    methods: {
        async loadAnnouncements() {
            try {
                this.loading = true;
                const params = this.buildPaginationParams();

                if (this.search) {
                    params.search = this.search;
                }

                if (this.statusFilter !== null) {
                    params.is_active = this.statusFilter;
                }

                if (this.typeFilter) {
                    params.type = this.typeFilter;
                }

                const response = await this.$axios.get('/api/v1/announcements', {
                    params,
                    headers: this.getAuthHeaders()
                });

                this.announcements = response.data.data || [];
                this.updatePagination(response.data);
            } catch (error) {
                this.handleApiError(error, 'Failed to load announcements');
            } finally {
                this.loading = false;
            }
        },
        openDialog(announcement = null) {
            this.editingAnnouncement = announcement;
            this.showDialog = true;
        },
        editAnnouncement(announcement) {
            this.openDialog(announcement);
        },
        viewAnnouncement(announcement) {
            this.selectedAnnouncementId = announcement.id;
            this.showDetailsDialog = true;
        },
        handleEditFromDetails(announcement) {
            this.showDetailsDialog = false;
            this.$nextTick(() => {
                this.openDialog(announcement);
            });
        },
        handleAnnouncementSaved() {
            this.loadAnnouncements();
        },
        async toggleStatus(announcement) {
            try {
                await this.$axios.put(`/api/v1/announcements/${announcement.id}/toggle-status`, {}, {
                    headers: this.getAuthHeaders()
                });
                this.showSuccess('Announcement status updated successfully');
                await this.loadAnnouncements();
            } catch (error) {
                this.handleApiError(error, 'Error updating announcement status');
            }
        },
        async deleteAnnouncement(id) {
            const confirmed = await this.$swal.fire({
                title: 'Are you sure?',
                text: 'This action cannot be undone!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            });

            if (confirmed.isConfirmed) {
                try {
                    await this.$axios.delete(`/api/v1/announcements/${id}`, {
                        headers: this.getAuthHeaders()
                    });
                    this.showSuccess('Announcement deleted successfully');
                    await this.loadAnnouncements();
                } catch (error) {
                    this.handleApiError(error, 'Error deleting announcement');
                }
            }
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
        formatDate(dateString) {
            if (!dateString) return '';
            const date = new Date(dateString);
            return date.toLocaleDateString() + ' ' + date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
        },
        onPerPageChange() {
            this.resetPagination();
            this.loadAnnouncements();
        },
        onSort(field) {
            this.handleSort(field);
            this.loadAnnouncements();
        }
    }
};
</script>

