<template>
    <div class="container-fluid">
            <p class="fs-5 fw-semibold mb-0 p-2">Patient Appointment</p>
        <div class="d-flex justify-content-end align-items-center mb-2">
            <div class="sort">
                <div class="select-input d-flex justify-content-center align-items-center">
                    <form class="d-flex" role="search">
                        <input class="form-control form-control-sm me-2" type="search" placeholder="Search" aria-label="Search">
                    </form>
                    <select class="form-control form-control-sm">
                        <option selected disabled>Filter</option>
                        <option value="">Pending</option>
                        <option value="">Completed</option>
                        <option value="">Decline</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="table-responsive-lg">
            <div
                class="header d-flex p-2 justify-content-between align-items-center bg-info bg-gradient rounded-1 mb-2"
            >
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
                                Date: {{ appoint.sched_date }} <br> Time: {{ appoint.sched_time }}
                            </p>
                        </div>
                        <div class="text-center col-lg-2">
                            <p class="fs-6 mb-0 fw-medium text-black-50">
                                {{ appoint?.appoint_services?.services_name }}
                            </p>
                        </div>
                        <div
                            class="text-center justify-content-center col-lg-2">
                            <p :class="{'fs-6 fw-medium mb-0 text-warning': appoint.Pending, 'fs-6 fw-medium mb-0 text-primary': appoint.Ongoing, 'fs-6 fw-medium mb-0 text-success': appoint.Completed, 'fs-6 fw-medium mb-0 text-danger': appoint.Declined}">
                                {{ appoint.appnt_status }}
                            </p>
                        </div>
                        <div class="text-center d-flex justify-content-center align-items-center col-lg-3">
                            <button type="button" class="me-2 rounded-1 btn btn-info text-white btn-sm" v-if="appoint.Pending || appoint.Completed" @click="recomendDentist(appoint)">
                                <div class="d-flex justify-content-center align-items-center">
                                    <i class="fa-solid fa-eye me-1"></i>
                                    <span>Confirm</span>
                                </div>
                            </button>
                            <button type="button" class="rounded-1 btn btn-success btn-sm me-2" @click="reschedPatient(appoint)">
                                <div class="d-flex justify-content-center align-items-center">
                                    <i class="fa-solid fa-calendar-check me-1"></i>
                                    <span>Reschedule</span>
                                </div>
                            </button>
                            <button type="button" class="rounded-1 btn btn-danger btn-sm" v-if="appoint.Pending" @click="abortPatient(appoint)">
                                <div class="d-flex justify-content-center align-items-center">
                                    <i class="fa-solid fa-ban me-1"></i>
                                    <span>Abort</span>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid d-flex justify-content-end align-items-center">
                <nav>
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">1</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">2</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">3</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <verify-appointment-modal :selected_user="selected_user" @displayOngoingPatient="displayAppointment"></verify-appointment-modal>
        <abort-patient-modal-vue :selected_abort="selected_abort" @displayAbortApp="displayAppointment"></abort-patient-modal-vue>
        <resched-appointment :selected_resched="selected_resched" @displayReschedApp="displayAppointment"></resched-appointment>
    </div>
</template>

<script>
    import axios from 'axios';
    import VerifyAppointmentModal from './VerifyUserModal.vue';
    import ReschedAppointment from './ReschedAppointment.vue';
    import AbortPatientModalVue from './AbortPatientModal.vue';
export default {
    components:{
        VerifyAppointmentModal,
        AbortPatientModalVue,
        ReschedAppointment,
    },
    data() {
        return {
            listofAppointment:[],
            selected_user: {},
            selected_abort: {},
            selected_resched: {}
        };
    },
    methods:{
        displayAppointment(){
            axios.get('/user/staff/appointment/display').then((response)=>{
                // console.log(response);
                this.listofAppointment = response.data.map((appoint)=> ({
                    ...appoint,
                    Pending: appoint.appnt_status === "Pending",
                    Ongoing: appoint.appnt_status === "Ongoing",
                    Completed: appoint.appnt_status === "Completed",
                    Declined: appoint.appnt_status === "Declined",
                }));
            }).catch((error)=>{
                console.log(error);
            });
        },

        recomendDentist(selected_user) {
            this.selected_user = selected_user;
            $("#verify-appointment-modal").modal("show");
        },

        abortPatient(selected_abort){
            this.selected_abort = selected_abort;
            $('#abort-appointment-modal').modal("show");
        },
        
        reschedPatient(selected_resched){
            this.selected_resched = selected_resched;
            $('#resched-appointment-modal').modal("show");
        }


        // abortAppointment(id){
        //     Swal.fire({
        //         title: "Are you sure?",
        //         text: "You won't be able to revert this!",
        //         icon: "warning",
        //         showCancelButton: true,
        //         confirmButtonColor: "#3085d6",
        //         cancelButtonColor: "#d33",
        //         confirmButtonText: "Yes, decline it!",
        //     }).then((data) => {
        //         if (data.isConfirmed) {
        //             axios
        //                 .put("/user/staff/appointment/declined/" + id)
        //                 .then((response) => {
        //                     Swal.fire("Declined!", "Appointment has been decline.", "success");
        //                     this.displayAppointment();
        //                 });
        //         }
        //     }).catch((error) => {
        //         Swal.fire({
        //             icon: "error",
        //             text: "Something went wrong!",
        //         });
        //         console.log(error);
        //     });
        // },
    },
    mounted(){
        this.displayAppointment();
    }
};
</script>
