<template>
    <div class="container-fluid py-3">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h5 class="fw-bold">Appointment History</h5>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered text-center">
                    <thead class="table table-info text-white">
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
                                    class="badge"
                                    :class="{
                                        'bg-success': item.appnt_status === 'Completed',
                                        'bg-warning': item.appnt_status === 'Pending',
                                        'bg-danger': item.appnt_status === 'Cancelled',
                                    }"
                                >
                                    {{ item.appnt_status }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <router-link :to="`/user/staff/record/view/${item.patient?.id}`">
                                        <button type="button" class="btn btn-primary btn-sm mx-1">
                                            <i class="fas fa-eye"></i> View Form
                                        </button>
                                    </router-link>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

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
        };
    },
    methods: {
        displayPatients(page = 1) {
            axios
                .get("/user/staff/display", {
                    params: { page, limit: this.perPage },
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
    vertical-align: middle;
    padding: 12px;
}

.badge {
    font-size: 0.9rem;
    padding: 5px 10px;
    border-radius: 12px;
}

.page-link {
    color: #007bff;
    cursor: pointer;
}

.page-item.active .page-link {
    background-color: #007bff;
    border-color: #007bff;
    color: white;
}

.page-item.disabled .page-link {
    cursor: not-allowed;
    opacity: 0.6;
}
</style>
