<template>
    <div>
    <div class="container-fluid">
        <div class="txt-title mt-2">
            <p class="fs-5 fw-semibold text-black mb-0">Refer Patients</p>
        </div>
        <div class="d-flex justify-content-end align-items-center mb-2">
            <div class="sort">
                <div class="select-input d-flex justify-content-center align-items-center">
                    <form class="d-flex" role="search">
                        <input class="form-control form-control-sm me-2" type="search" placeholder="Search" aria-label="Search">
                    </form>
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
                <div class="table-row card mb-2" v-for="item in listofVerfiedPatients" :key="item.id">
                    <div class="d-flex p-2 justify-content-between align-items-center bg-light bg-gradient rounded-1">
                        <div class="text-center col-lg-2">
                            <p class="fs-6 mb-0 fw-medium text-black-50">
                               {{ item.patient?.firstname }} {{ item?.patient?.lastname }}
                            </p>
                        </div>
                        <div class="text-center col-lg-3">
                            <p class="fs-6 mb-0 fw-medium text-black-50">
                               {{ item.sched_date }} {{ item.sched_time }}
                            </p>
                        </div>
                        <div class="text-center col-lg-2">
                            <p class="fs-6 mb-0 fw-medium text-black-50">
                                {{ item.services?.services_name }}
                            </p>
                        </div>
                        <div
                            class="text-center justify-content-center col-lg-2">
                            <p class="fs-6 mb-0 fw-medium text-primary">
                                {{ item.appnt_status }}
                            </p>
                        </div>
                        <div class="text-center d-flex justify-content-center align-items-center col-lg-3">
                            <button type="button" class="me-1 rounded-1 btn btn-info text-white btn-sm" @click="patientModalShow(item)">
                                <div class="d-flex justify-content-center align-items-center">
                                    <i class="fa-solid fa-eye me-2"></i>
                                    <span>View</span>
                                </div>
                            </button>
                            <button type="button" class="rounded-1 btn btn-danger btn-sm">
                                <div class="d-flex justify-content-center align-items-center">
                                    <i class="fa-solid fa-trash me-2"></i>
                                    <span>Delete</span>
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
    </div>
    <view-patient-modal :selected_patient="selected_patient"></view-patient-modal>
</div>
</template>

<script>
import axios from 'axios';
import ViewPatientModal from './ViewPatientModal.vue'
export default {
    components:{
        ViewPatientModal,
    },
    data() {
        return {
            listofVerfiedPatients:[],
            selected_patient: {},
        };
    },

    methods:{
        diplayVerfiedPatients(){
            axios.get('/admin/patients/refer').then((response)=>{
                console.log(response);
                this.listofVerfiedPatients = response.data.data;
            }).catch((error)=>{
                console.log(error);
            });
        },
        patientModalShow(selected_patient){
            // console.log("clicked");
            this.selected_patient = selected_patient;
            $('#view-appointment-modal').modal('show');
        },
    },
    mounted(){
        this.diplayVerfiedPatients();
    }
};
</script>
