<template>
    <div class="container py-4">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-primary text-white text-center">
                <h5 class="mb-0">
                    <i class="fa-solid fa-user-md me-2"></i> Grace's Dental Clinic<br>
                    <small class="fw-light">Patient History</small>
                </h5>
            </div>

            <div class="card-body">
                <div v-if="loading" class="text-center py-4">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>

                <div v-else-if="error" class="alert alert-danger text-center">
                    Failed to load patient history. Please try again.
                </div>

                <div v-else>
                    <div v-if="patientHistory.length === 0" class="text-center py-4">
                        <p class="text-muted">No records found.</p>
                    </div>

                    <div v-else class="table-responsive">
                        <table class="table table-hover table-bordered align-middle">
                            <thead class="table-primary text-center">
                                <tr>
                                    <th>Date</th>
                                    <th>Services</th>
                                    <th>Tooth</th>
                                    <th>Surface</th>
                                    <th>Fee</th>
                                    <th>Balance</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <tr v-for="(item, index) in patientHistory" :key="index">
                                    <td>{{ formatWordyDate(item?.created_at) }}</td>
                                    <td>{{ item.services?.services_name || 'N/A' }}</td>
                                    <td>{{ item?.tooth || '-' }}</td>
                                    <td>{{ item?.surface || '-' }}</td>
                                    <td class="fw-bold">₱{{ formatCurrency(item?.fee) }}</td>
                                    <td :class="{'text-danger fw-bold': item?.balance > 0}">
                                        ₱{{ formatCurrency(item?.balance) }}
                                    </td>
                                    <td>
                                        <span :class="statusClass(item?.status)">{{ item?.status }}</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
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
            patientHistory: [],
            loading: true,
            error: false
        };
    },
    methods: {
        async displayHistory() {
            try {
                const response = await axios.get('/user/patient/history/get');
                this.patientHistory = response.data.data;
            } catch (error) {
                console.error("Error fetching history:", error);
                this.error = true;
            } finally {
                this.loading = false;
            }
        },
        formatWordyDate(date) {
            if (!date) return '-';
            return new Date(date).toLocaleDateString('en-PH', {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });
        },
        formatCurrency(value) {
            return value ? parseFloat(value).toLocaleString('en-PH', { minimumFractionDigits: 2 }) : '0.00';
        },
        statusClass(status) {
            return status === 'Already Paid' ? 'badge bg-success' : 'badge bg-danger';
        }
    },
    mounted() {
        this.displayHistory();
    }
};
</script>

<style scoped>
.table-hover tbody tr:hover {
    background-color: rgba(13, 110, 253, 0.1);
    transition: background 0.2s ease-in-out;
}
</style>
