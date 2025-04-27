<template>
    <div class="container-fluid">
        <p class="fs-5 fw-semibold mb-0 p-2">Patient Appointment</p>
        <div class="d-flex justify-content-end align-items-center mb-2 gap-1">
            <div class="sort">
                <div class="select-input d-flex justify-content-center align-items-center">
                    <form class="d-flex" role="search">
                        <input class="form-control form-control-sm me-2" type="search" placeholder="Search" v-model="searchQuery" aria-label="Search">
                    </form>
                    <select class="form-control form-control-sm" @change="handleSortChange">
                        <option selected disabled>Filter</option>
                        <option value="Approved">Approved</option>
                        <option value="Pending Approval">Pending Approval</option>
                        <option value="">All</option>
                    </select>
                </div>
            </div>
            <button type="button" class="btn btn-sm btn-primary" @click="addWalkInApplicant">
                <i class="fa-solid fa-plus me-2"></i>
                <small>Walk-in Applicant</small>
            </button>
        </div>
        <div class="table-responsive-lg">
            <table class="table table-bordered table-hover">
                <thead class="bg-info text-white text-center">
                    <tr>
                        <th>Type</th>
                        <th>Name</th>
                        <th>Appointment Schedule</th>
                        <th>Services</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="appoint in listofAppointment" :key="appoint.id" class="text-center align-middle">
                        <td><span>{{ appoint?.type || 'Walk-in' }}</span></td>
                        <td>{{ appoint.patient_name }}</td>
                        <td>
                            Date: {{ formatDate(appoint.sched_date) }} <br> Time: {{ formatTime(appoint.sched_time) }}
                        </td>
                        <td>{{ appoint?.appoint_services?.services_name }}</td>
                        <td :class="{
                            'text-warning': appoint.PendingApproval, 
                            'text-success': appoint.Approved, 
                            'text-primary': appoint.Pending, 
                            'text-info': appoint.Completed, 
                            'text-danger': appoint.Declined,
                            'text-warning': appoint.Payment
                        }">
                            {{ appoint.appnt_status }}
                        </td>
                        <td>
                            <div class="d-flex flex-wrap gap-1 justify-content-center">
                                <router-link :to="`/user/staff/appointment/recomend/${appoint.id}`" v-if="appoint.appnt_status !== 'Pending Approval' && appoint.appnt_status !== 'Payment'">
                                    <button class="btn btn-info btn-sm text-white">
                                        <i class="fa-solid fa-eye me-1"></i> Recommend
                                    </button>
                                </router-link>
                                <router-link :to="`/user/staff/appointment/resched/${appoint.id}`" v-if="appoint.appnt_status !== 'Pending Approval' && appoint.appnt_status !== 'Payment'">
                                    <button class="btn btn-primary btn-sm">
                                        <i class="fa-solid fa-calendar-check me-1"></i> Reschedule
                                    </button>
                                </router-link>
                                <button class="btn btn-primary btn-sm" v-if="appoint.appnt_status === 'Pending Approval'" @click="approvedAppointment(appoint.id)">
                                    Approve
                                </button>
                                <button class="btn btn-danger btn-sm" v-if="appoint.appnt_status !== 'Pending Approval' && appoint.appnt_status !== 'Payment'" @click="abortPatient(appoint)">
                                    <i class="fa-solid fa-ban"></i> Abort
                                </button>
                                <router-link :to="`/user/staff/payment/${appoint.patient?.id}`" v-if="appoint.appnt_status === 'Payment' || appoint.appnt_status === 'Not yet Paid'">
                                    <button class="btn btn-primary btn-sm text-white">
                                        <i class="fa-solid fa-circle-arrow-right me-1"></i> Payment
                                    </button>
                                </router-link>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="container-fluid d-flex justify-content-end align-items-center">
            <nav>
                <ul class="pagination">
                    <li class="page-item" :class="{ disabled: currentPage === 1 }">
                        <a class="page-link" href="#" @click.prevent="changePage(currentPage - 1)">&laquo;</a>
                    </li>
                    <li class="page-item" v-for="page in totalPages" :key="page" :class="{ active: currentPage === page }">
                        <a class="page-link" href="#" @click.prevent="changePage(page)">{{ page }}</a>
                    </li>
                    <li class="page-item" :class="{ disabled: currentPage === totalPages }">
                        <a class="page-link" href="#" @click.prevent="changePage(currentPage + 1)">&raquo;</a>
                    </li>
                </ul>
            </nav>
        </div>
        <abort-patient-modal-vue :selected_abort="selected_abort" @displayAbortApp="displayAppointment"></abort-patient-modal-vue>
        <walkin-modal @displayWalkInApplicant="displayAppointment"></walkin-modal>
    </div>
</template>


<script>
    import axios from 'axios';
    import AbortPatientModalVue from './AbortPatientModal.vue';
    import WalkinModal from './Modal/WalkinModal.vue';
export default {
    components:{
        AbortPatientModalVue,
        WalkinModal,
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
    watch: {
        searchQuery(newQuery) {
            this.displayAppointment(1, null, newQuery);
        }
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
        formatTime(timeString) {
            if (!timeString) return '';
            const [hours, minutes] = timeString.split(':').map(Number);
            const period = hours >= 12 ? 'PM' : 'AM';
            const formattedHours = hours % 12 || 12; 
            return `${formattedHours}:${minutes.toString().padStart(2, '0')} ${period}`;
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
                this.listofAppointment = response.data.data.map((appoint) => ({
                    ...appoint,
                    patient_name: appoint.patient ? `${appoint.patient.firstname} ${appoint.patient.lastname}` : 'No Name',
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

        addWalkInApplicant(){
            $('#walk-in-patient').modal("show");
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
