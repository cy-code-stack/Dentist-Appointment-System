<template>
    <div class="container-fluid">
            <p class="fs-5 fw-semibold mb-0 p-2">Patient Appointment</p>
        <div class="d-flex justify-content-end align-items-center mb-2">
            <div class="sort">
                <div class="select-input d-flex justify-content-center align-items-center">
                    <form class="d-flex" role="search">
                        <input class="form-control form-control-sm me-2" type="search" placeholder="Search"  v-model="searchQuery" aria-label="Search">
                    </form>
                    <select class="form-control form-control-sm" @change="handleSortChange">
                        <option selected disabled>Filter</option>
                        <option value="Approved">Approved</option>
                        <option value="Pending Approval">Pending Approval</option>
                        <option value="">All</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="table-responsive-lg">
            <div class="header d-flex p-2 justify-content-between align-items-center bg-info bg-gradient rounded-1 mb-2">
                <div class="text-center col-lg-2">
                    <p class="fs-6 fw-semibold mb-0">Name</p>
                </div>
                <div class="text-center col-lg-3">
                    <p class="fs-6 fw-semibold mb-0">Appointment Schedule</p>
                </div>
                <div class="text-center col-lg-2">
                    <p class="fs-6 fw-semibold mb-0">Services</p>
                </div>
                <div class="text-center col-lg-2">
                    <p class="fs-6 fw-semibold mb-0">Status</p>
                </div>
                <div class="text-center col-lg-3">
                    <p class="fs-6 fw-semibold mb-0">Actions</p>
                </div>
            </div>
            <div class="main-table-body">
                <div class="table-row card mb-2" v-for="appoint in listofAppointment" :key="appoint.id">
                    <div class="d-flex p-2 justify-content-between align-items-center bg-light bg-gradient rounded-1">
                        <div class="text-center col-lg-2">
                            <p class="fs-6 mb-0 fw-medium text-black-50">
                                {{ appoint?.patient?.firstname }} {{ appoint?.patient?.lastname }}
                            </p>
                        </div>
                        <div class="text-center col-lg-3">
                            <p class="fs-6 mb-0 fw-medium text-black-50">
                                Date: {{ formatDate(appoint.sched_date) }} <br> Time: {{ appoint.sched_time }}
                            </p>
                        </div>
                        <div class="text-center col-lg-2">
                            <p class="fs-6 mb-0 fw-medium text-black-50">
                                {{ appoint?.appoint_services?.services_name }}
                            </p>
                        </div>
                        <div class="text-center justify-content-center col-lg-2">
                            <p :class="{
                                'fs-6 fw-medium mb-0 text-warning': appoint.PendingApproval, 
                                'fs-6 fw-medium mb-0 text-info': appoint.Approved, 
                                'fs-6 fw-medium mb-0 text-primary': appoint.Pending, 
                                'fs-6 fw-medium mb-0 text-success': appoint.Completed, 
                                'fs-6 fw-medium mb-0 text-danger': appoint.Declined,
                                'fs-6 fw-medium mb-0 text-info': appoint.Payment,
                            }">
                                {{ appoint.appnt_status }}
                            </p>
                        </div>
                        <div class="text-center d-flex justify-content-center align-items-center col-lg-3">
                            <router-link :to="`/user/staff/appointment/recomend/${appoint.id}`" v-if="appoint.appnt_status !== 'Pending Approval' && appoint.appnt_status !== 'Payment'">
                                <button type="button" class="me-2 rounded-1 btn btn-info text-white btn-sm">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <i class="fa-solid fa-eye me-1"></i>
                                        <span>Recomend</span>
                                    </div>
                                </button>
                            </router-link>
                            <router-link :to="`/user/staff/appointment/resched/${appoint.id}`" v-if="appoint.appnt_status !== 'Pending Approval' && appoint.appnt_status !== 'Payment'">
                                <button type="button" class="rounded-1 btn btn-success btn-sm me-2">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <i class="fa-solid fa-calendar-check me-1"></i>
                                        <span>Reschedule</span>
                                    </div>
                                </button>
                            </router-link>
                            <button type="button" class="rounded-1 btn btn-success btn-sm me-2" v-if="appoint.appnt_status === 'Pending Approval'" @click="approvedAppointment(appoint.id)">
                                <div class="d-flex justify-content-center align-items-center">
                                    <span>Approved Appointment</span>
                                </div>
                            </button>
                            <button type="button" class="rounded-1 btn btn-danger btn-sm" v-if="appoint.appnt_status !== 'Pending Approval' && appoint.appnt_status !== 'Payment'" @click="abortPatient(appoint)">
                                <div class="d-flex justify-content-center align-items-center">
                                    <i class="fa-solid fa-ban me-1"></i>
                                    <span>Abort</span>
                                </div>
                            </button>
                            <router-link :to="`/user/staff/payment/${appoint.patient?.id}`">
                                <button v-if="appoint.appnt_status === 'Payment' || appoint.appnt_status === 'Not yet Paid'" type="button" class="me-1 rounded-1 btn btn-primary text-white btn-sm">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <span class="me-2">Payment</span>
                                        <i class="fa-solid fa-circle-arrow-right"></i>
                                    </div>
                                </button>
                            </router-link>
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
        <abort-patient-modal-vue :selected_abort="selected_abort" @displayAbortApp="displayAppointment"></abort-patient-modal-vue>
    </div>
</template>

<script>
    import axios from 'axios';
    import AbortPatientModalVue from './AbortPatientModal.vue';
export default {
    components:{
        AbortPatientModalVue,
    },
    data() {
        return {
            listofAppointment:[],
            selected_user: {},
            selected_abort: {},
            selected_resched: {},
            currentPage: 1,
            totalPages: 1,
            perPage: 10,
            selectedStatus: null,
            searchQuery: '',
        };
    },
    methods:{
        formatDate(dateString) {
            if (!dateString) return '';
            const date = new Date(dateString);
            return new Intl.DateTimeFormat('en-US', { 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric' 
            }).format(date);
        },
        displayAppointment(page = 1, status = null, query = ''){
            axios.get('/user/staff/appointment/display', {
                params: {
                    page: page,        
                    limit: this.perPage, 
                    status: status,
                    search: query,
                },
            }).then((response)=>{
                this.currentPage = response.data.meta.current_page;
                this.totalPages = response.data.meta.last_page;
                this.listofAppointment = response.data.data.map((appoint)=> ({
                    ...appoint,
                    PendingApproval: appoint.appnt_status === "Pending Approval",
                    Approved: appoint.appnt_status === "Approved",
                    Pending: appoint.appnt_status === "Pending",
                    Completed: appoint.appnt_status === "Completed",
                    Declined: appoint.appnt_status === "Declined",
                    Payment: appoint.appnt_status === "Payment",
                }));
            }).catch((error)=>{
                console.log(error);
            });
        },
        changePage(page) {
            if (page > 0 && page <= this.totalPages) {
                this.displayAppointment(page);
            }
        },
        handleSortChange(event) {
            this.selectedStatus = event.target.value;
            this.displayAppointment(1, this.selectedStatus);
        },

        abortPatient(selected_abort){
            this.selected_abort = selected_abort;
            $('#abort-appointment-modal').modal("show");
        },
    
        approvedAppointment(id) {
            Swal.fire({
                title: "Approved?",
                text: "You won't be able to revert this!",
                icon: "success",
                confirmButtonColor: "#14A44D",
                confirmButtonText: "Yes, Approved it!",
            })
                .then((data) => {
                    if (data.isConfirmed) {
                        axios.put("/user/staff/appointment/approved/" + id)
                            .then((response) => {
                                Swal.fire("Approved!", "Appointment has been approved.", "success");
                                this.displayAppointment();
                            });
                    }
                })
                .catch((error) => {
                    Swal.fire({
                        icon: "error",
                        text: "Something went wrong!",
                    });
                    console.log(error);
                });
        },
    },
    mounted(){
        this.displayAppointment();
    }
};
</script>
