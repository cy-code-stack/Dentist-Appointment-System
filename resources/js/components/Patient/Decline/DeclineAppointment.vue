<template>
    <div class="container py-4">
        <div class="card shadow-lg border-0">
            <!-- Card Header -->
            <div class="card-header bg-danger text-white d-flex align-items-center justify-content-between">
                <h5 class="mb-0 d-flex align-items-center">
                    Declined Appointments
                </h5>
                <i class="fa-solid fa-calendar-xmark fs-4"></i>
            </div>

            <!-- Card Body -->
            <div class="card-body">
                <!-- Loading Spinner -->
                <div v-if="loading" class="text-center py-4">
                    <div class="spinner-border text-danger" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>

                <!-- Error Message -->
                <div v-else-if="error" class="alert alert-danger text-center">
                    <i class="fa-solid fa-exclamation-circle me-2"></i>
                    Failed to load declined appointments. Please try again.
                </div>

                <!-- No Appointments Found -->
                <div v-else-if="listDecline.length === 0" class="text-center py-4">
                    <p class="text-muted"><i class="fa-solid fa-calendar-times me-2"></i> No declined appointments found.</p>
                </div>

                <!-- Table of Declined Appointments -->
                <div v-else class="table-responsive">
                    <table class="table table-hover table-bordered align-middle">
                        <thead class="table-danger text-center">
                            <tr>
                                <th>Appointment No.</th>
                                <th>Patient Name</th>
                                <th>Service</th>
                                <th>Schedule Date</th>
                                <th>Reason</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <tr v-for="(item, index) in listDecline" :key="index" class="table-light">
                                <td class="fw-bold">{{ item.id }}</td>
                                <td class="text-capitalize">
                                    {{ item.patient?.firstname }} {{ item.patient?.middle_initial }} {{ item.patient?.lastname }}
                                </td>
                                <td>{{ item.appoint_services?.services_name }}</td>
                                <td class="fw-medium">{{ formatDate(item.sched_date) }}</td>
                                <td class="text-danger fw-semibold">{{ item.abort_reason }}</td>
                                <td class="fw-bold text-danger">{{ item.appnt_status }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            listDecline: [],
            loading: true,
            error: false
        };
    },
    methods: {
        async fetchDeclinedAppointments() {
            try {
                const response = await axios.get('/user/patient/appointment/view/decline');
                this.listDecline = response.data;
            } catch (error) {
                console.error("Error fetching declined appointments:", error);
                this.error = true;
            } finally {
                this.loading = false;
            }
        },
        formatDate(date) {
            return new Date(date).toLocaleDateString('en-US', {
                weekday: 'short', year: 'numeric', month: 'short', day: 'numeric'
            });
        }
    },
    mounted() {
        this.fetchDeclinedAppointments();
    }
};
</script>

<style scoped>
/* Table Hover Effect */
.table-hover tbody tr:hover {
    background-color: rgba(220, 53, 69, 0.1);
    transition: background 0.2s ease-in-out;
}

/* Responsive Table */
@media (max-width: 768px) {
    .table-responsive {
        overflow-x: auto;
    }
}
</style>
