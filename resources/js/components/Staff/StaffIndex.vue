<template>
    <div class="main-container-card container-fluid p-3 mt-2">
        <div class="main-card card p-3 bg-info bg-gradient" style="min-width: 300px; border: none">
            <div class="card-title">
                <p class="fs-5 fw-semibold mb-1">Patient Catered</p>
            </div>
            <div class="card-icon d-flex justify-content-around align-items-center">
                <div class="col col-lg-3">
                    <i class="fa-solid fa-hospital-user fs-1"></i>
                </div>
                <div class="col col-md-8">
                    <p class="fs-2 fw-semibold mb-0">{{ appCount }}</p>
                    <p class="fs-6 fw-medium mb-0">Total Catered</p>
                </div>
            </div>
        </div>
        <div class="main-card card p-3 bg-success bg-gradient" style="min-width: 300px; border: none">
            <div class="card-title">
                <p class="fs-5 fw-semibold mb-1">Medical Services</p>
            </div>
            <div class="card-icon d-flex justify-content-around align-items-center">
                <div class="col col-lg-3">
                    <i class="fa-solid fa-list-check fs-1"></i>
                </div>
                <div class="col col-md-8">
                    <p class="fs-2 fw-semibold mb-0">{{ servicesCount }}</p>
                    <p class="fs-6 fw-medium mb-0">Total Services</p>
                </div>
            </div>
        </div>
        <div class="main-card card p-3 bg-primary bg-gradient" style="min-width: 300px; border: none">
            <div class="card-title">
                <p class="fs-5 fw-semibold mb-1">Pending Appointments</p>
            </div>
            <div class="card-icon d-flex justify-content-around align-items-center">
                <div class="col col-lg-3">
                    <i class="fa-solid fa-calendar-check fs-1"></i>
                </div>
                <div class="col col-md-8">
                    <p class="fs-2 fw-semibold mb-0">{{ ongoingCount }}</p>
                    <p class="fs-6 fw-medium mb-0">Total Appointments</p>
                </div>
            </div>
        </div>
        <div class="main-card card p-3 bg-danger bg-gradient" style="min-width: 300px; border: none">
            <div class="card-title">
                <p class="fs-5 fw-semibold mb-1">Patient Decline</p>
            </div>
            <div class="card-icon d-flex justify-content-around align-items-center">
                <div class="col col-lg-3">
                    <i class="fa-solid fa-ban fs-1"></i>
                </div>
                <div class="col col-md-8">
                    <p class="fs-2 fw-semibold mb-0">{{ declinedCount }}</p>
                    <p class="fs-6 fw-medium mb-0">Total Decline</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="d-flex justify-content-center">
            <div class="col">
                <div class="active-card card p-3">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <p class="fs-4 fw-semibold mb-0">
                            Current Transactions
                        </p>
                        <div class="sort">
                            <div class="select-input d-flex justify-content-center align-items-center">
                                <select class="form-control form-control-sm" @change="handleSortChange">
                                    <option selected disabled>Sort by</option>
                                    <option value="Approved">Approved</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Payment">Payment</option>
                                    <option value="Completed">Completed</option>
                                    <option value="Declined">Decline</option>
                                    <option value="">All</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive-lg">
                        <div class="header d-flex p-2 justify-content-between align-items-center bg-info bg-gradient rounded-1 mb-2">
                            <div class="text-center col-lg-3">
                                <p class="fs-6 fw-semibold mb-0">Name</p>
                            </div>
                            <div class="text-center col-lg-3">
                                <p class="fs-6 fw-semibold mb-0">Appointment Schedule</p>
                            </div>
                            <div class="text-center col-lg-3">
                                <p class="fs-6 fw-semibold mb-0">Services</p>
                            </div>
                            <div class="text-center col-lg-3">
                                <p class="fs-6 fw-semibold mb-0">Status</p>
                            </div>
                        </div>
                        <div class="main-table-body">
                            <div class="table-row card mb-2" v-for="(item, index) in appointment" :key="index">
                                <div class="d-flex p-2 justify-content-between align-items-center bg-light bg-gradient rounded-1">
                                    <div class="text-center col-lg-3">
                                        <p class="fs-6 mb-0 fw-medium text-black-50">{{ item.patient?.firstname }} {{ item.patient?.middle_initial }} {{ item.patient?.lastname }}</p>
                                    </div>
                                    <div class="text-center col-lg-3">
                                        <p class="fs-6 mb-0 fw-medium text-black-50">{{ formatWordyDate(item.sched_date) }} - {{ item.sched_time }}</p>
                                    </div>
                                    <div class="text-center col-lg-3">
                                        <p class="fs-6 mb-0 fw-medium text-black-50">{{ item.appoint_services?.services_name }}</p>
                                    </div>
                                    <div class="text-center justify-content-center col-lg-3 rounded-1" 
                                            :class="{
                                                'text-warning': item.appnt_status === 'Pending',
                                                'text-info':    item.appnt_status === 'Approved',
                                                'text-danger':  item.appnt_status === 'Declined',
                                                'text-success': item.appnt_status === 'Completed',
                                                'text-warning': item.appnt_status === 'Pending Approval'
                                            }">
                                        <p class="fs-6 fw-medium mb-0">{{ item.appnt_status }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="container-fluid d-flex justify-content-end align-items-center">
                            <nav>
                                <ul class="pagination">
                                    <li class="page-item" :class="{ disabled: currentPage === 1 }">
                                        <a class="page-link" href="#" @click.prevent="changePage(currentPage - 1)" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                    <li class="page-item" 
                                        v-for="page in totalPages" 
                                        :key="page" 
                                        :class="{ active: currentPage === page }">
                                        <a class="page-link" href="#" @click.prevent="changePage(page)">{{ page }}</a>
                                    </li>
                                    <li class="page-item" :class="{ disabled: currentPage === totalPages }">
                                        <a class="page-link" href="#" @click.prevent="changePage(currentPage + 1)" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
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
            appCount: 0,
            servicesCount: 0,
            ongoingCount: 0,
            declinedCount: 0,
            appointment: [],
            currentPage: 1,
            totalPages: 1,
            perPage: 10,
            selectedStatus: null,
        };
    },
    methods: {
        fetchCount(url, targetProperty) {
            axios.get(url)
                .then((response) => {
                    this[targetProperty] = response.data.data;
                })
                .catch((error) => {
                    console.error(`Error fetching ${targetProperty}:`, error);
                });
        },
        handleSortChange(event) {
            this.selectedStatus = event.target.value;
            this.displayAppointment(1, this.selectedStatus);
        },
        displayAppointment(page = 1, status = null) {
            axios.get('/user/staff/appointment/dashboardDisplay', {
                params: {
                    page: page,        
                    limit: this.perPage, 
                    status: status,   
                },
            })
            .then((response) => {
                this.appointment = response.data.data; 
                this.currentPage = response.data.meta.current_page;
                this.totalPages = response.data.meta.last_page;  
            })
            .catch((error) => {
                console.error('Appointment error', error);
            });
        },
        changePage(page) {
            if (page > 0 && page <= this.totalPages) {
                this.displayAppointment(page);
            }
        },
        formatWordyDate(date) {
            if (!date) return '';
            const options = { year: 'numeric', month: 'long', day: 'numeric' };
            return new Date(date).toLocaleDateString('en-US', options);
        },
        displayPatientCount() {
            this.fetchCount('/user/staff/patient/appointmentCount', 'appCount');
        },
        countServices() {
            this.fetchCount('/user/staff/services/servicesCount', 'servicesCount');
        },
        ongoingAppointmentCount() {
            this.fetchCount('/user/staff/appointment/ongoingCount', 'ongoingCount');
        },
        declinedAppointmentCount() {
            this.fetchCount('/user/staff/appointment/declinedCount', 'declinedCount');
        },
        initializeCounts() {
            this.displayPatientCount();
            this.countServices();
            this.ongoingAppointmentCount();
            this.declinedAppointmentCount();
        }
    },
    mounted() {
        this.initializeCounts();
        this.displayAppointment();
    }
};
</script>

<style scoped>
    .main-container-card {
        display: flex !important;
        justify-content: space-evenly;
        flex-wrap: wrap;
    }
    .main-card {
        cursor: default;
    }
    .active-card {
        min-height: 72vh;
        margin-bottom: 0;
        border: none;
        background-color: transparent !important;
        box-shadow: none;
    }
    .select-input {
        width: 10rem !important;
    }
    .table-row {
        border: none;
        background-color: #d6ebff;
        border-radius: 0;
    }
</style>
