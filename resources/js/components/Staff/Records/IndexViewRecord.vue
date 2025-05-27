<template>
    <div class="container-fluid py-3 bg-light min-vh-100">
        <div class="container bg-white rounded shadow-sm p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h5 class="fw-bold text-primary mb-0">Appointment History</h5>
                <div style="width: 300px;">
                    <input class="form-control form-control-sm" v-model="searchQuery" type="search" placeholder="Search" aria-label="Search">
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle text-center">
                    <thead class="table-info text-white">
                        <tr>
                            <th>Appointment No.</th>
                            <th>Name</th>
                            <th>Services</th>
                            <th>Schedule Date</th>
                            <th>Date Visit</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in patients" :key="index">
                            <td>{{ item.id }}</td>
                            <td>
                                {{ item.patient?.firstname }} {{ item.patient?.middle_initial }} {{ item.patient?.lastname }}
                            </td>
                            <td>{{ item.appoint_services?.services_name }}</td>
                            <td>{{ formatWordyDate(item.sched_date) }}</td>
                            <td>{{ formatWordyDate(item.sched_date) }}</td>
                            <td>
                                <span
                                    class="badge px-3 py-2"
                                    :class="{
                                        'bg-success': item.appnt_status === 'Completed',
                                        'bg-warning text-dark': item.appnt_status === 'Pending',
                                        'bg-danger': item.appnt_status === 'Cancelled',
                                    }"
                                >
                                    {{ item.appnt_status }}
                                </span>
                            </td>
                            <td>
                                <router-link :to="`/user/staff/record/view/${item.patient?.id}`">
                                    <button type="button" class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-eye me-1"></i> View Form
                                    </button>
                                </router-link>
                            </td>
                        </tr>
                        <tr v-if="patients.length === 0">
                            <td colspan="7" class="text-muted py-4">No records found.</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end align-items-center mt-3">
                <nav>
                    <ul class="pagination mb-0">
                        <li class="page-item" :class="{ disabled: currentPage === 1 }">
                            <a class="page-link" @click.prevent="changePage(currentPage - 1)">
                                <i class="fas fa-angle-left"></i>
                            </a>
                        </li>
                        <li
                            class="page-item"
                            v-for="page in totalPages"
                            :key="page"
                            :class="{ active: currentPage === page }"
                        >
                            <a class="page-link" @click.prevent="changePage(page)">{{ page }}</a>
                        </li>
                        <li class="page-item" :class="{ disabled: currentPage === totalPages }">
                            <a class="page-link" @click.prevent="changePage(currentPage + 1)">
                                <i class="fas fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</template>


<script>
import axios from "axios";

export default {
    data() {
        return {
            patients: [],
            currentPage: 1,
            totalPages: 1,
            perPage: 10,
            searchQuery: '',
        };
    },
    watch: {
        searchQuery(newQuery) {
            this.displayPatients(1, newQuery);
        }
    },
    methods: {
        displayPatients(page = 1, query = '') {
            axios.get("/user/staff/display", {
                    params: { 
                        page, 
                        limit: this.perPage,
                        search: query,
                    },
                })
                .then((response) => {
                    this.patients = response.data.data;
                    this.currentPage = response.data.meta.current_page;
                    this.totalPages = response.data.meta.last_page;
                })
                .catch((error) => {
                    console.error("Error fetching patients:", error);
                });
        },
        changePage(page) {
            if (page > 0 && page <= this.totalPages) {
                this.displayPatients(page);
            }
        },
        formatWordyDate(date) {
            if (!date) return "";
            const options = { year: "numeric", month: "long", day: "numeric" };
            return new Date(date).toLocaleDateString("en-PH", options);
        },
    },
    mounted() {
        this.displayPatients();
    },
};
</script>

<style scoped>

.table th,
.table td {
    padding: 0.75rem;
}

.badge {
    font-size: 0.875rem;
    border-radius: 20px;
}

.table thead th {
    vertical-align: middle;
    font-weight: 600;
    font-size: 0.95rem;
}

.page-link {
    cursor: pointer;
}

.page-item.active .page-link {
    background-color: #0d6efd;
    border-color: #0d6efd;
    color: #fff;
}

.page-item.disabled .page-link {
    cursor: not-allowed;
    opacity: 0.5;
}

</style>
