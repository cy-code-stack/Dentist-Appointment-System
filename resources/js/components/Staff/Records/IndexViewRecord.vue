<template>
    <div class="container-fluid py-3">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h5>Appointment History</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <th>Appointment No.</th>
                        <th>Name</th>
                        <th>Services</th>
                        <th>Schedule Date</th>
                        <th>Date Visit</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in patients" :key="index">
                            <td>{{ item.id }}</td>
                            <td>
                                {{ item.patient?.firstname }}
                                {{ item.patient?.middle_initial }}
                                {{ item.patient?.lastname }}
                            </td>
                            <td>{{ item.appoint_services?.services_name }}</td>
                            <td>{{ formatWordyDate(item.sched_date) }}</td>
                            <td>{{ formatWordyDate(item.visit_date) }}</td>
                            <td>{{ item.appnt_status }}</td>
                            <td>
                                <div class="text-center d-flex align-items-center">
                                    <router-link :to="`/user/staff/record/view/${item.id}`">
                                        <button type="button" class="rounded-1 btn btn-primary btn-sm">
                                            <div class="d-flex justify-content-center align-items-center">
                                                <span>View Form</span>
                                            </div>
                                        </button>
                                    </router-link>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="container-fluid d-flex justify-content-end align-items-center">
                    <nav>
                        <ul class="pagination">
                            <li class="page-item" :class="{ disabled: currentPage === 1 }">
                                <a class="page-link" @click.prevent="changePage(currentPage - 1)" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <li class="page-item" v-for="page in totalPages" :key="page" :class="{ active: currentPage === page }">
                                <a class="page-link" href="#" @click.prevent="changePage(page)">{{ page }}</a>
                            </li>
                            <li class="page-item" :class="{ disabled: currentPage === totalPages }">
                                <a class="page-link" @click.prevent="changePage(currentPage + 1)" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
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
                    params: {
                        page: page,
                        limit: this.perPage,
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
