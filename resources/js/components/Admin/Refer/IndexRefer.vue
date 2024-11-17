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
                <div class="text-center col-lg-2">
                    <p class="fs-6 fw-semibold mb-0">Appointment Schedule</p>
                </div>
                <div class="text-center col-lg-2">
                    <p class="fs-6 fw-semibold mb-0">Services</p>
                </div>
                <div class="text-center col-lg-2">
                    <p class="fs-6 fw-semibold mb-0">Status</p>
                </div>
                <div class="text-center col-lg-2">
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
                        <div class="text-center col-lg-2">
                            <p class="fs-6 mb-0 fw-medium text-black-50">
                               {{ item.sched_date }} {{ item.sched_time }}
                            </p>
                        </div>
                        <div class="text-center col-lg-2">
                            <p class="fs-6 mb-0 fw-medium text-black-50">
                                {{ item.appoint_services?.services_name }}
                            </p>
                        </div>
                        <div
                            class="text-center justify-content-center col-lg-2">
                            <p class="fs-6 mb-0 fw-medium text-primary">
                                {{ item.appnt_status }}
                            </p>
                        </div>
                        <div class="text-center d-flex justify-content-center align-items-center col-lg-2">
                            <router-link :to="`/user/admin/view/${item.id}`">
                                <button v-if="item.appnt_status === 'Ongoing'" type="button" class="me-1 rounded-1 btn btn-info text-white btn-sm">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <i class="fa-solid fa-eye me-2"></i>
                                        <span>View</span>
                                    </div>
                                </button>
                            </router-link>
                            <button v-if="item.appnt_status === 'Payment' || item.appnt_status === 'Not yet Paid'" type="button" class="me-1 rounded-1 btn btn-warning text-white btn-sm" @click="addPayment(item)">
                                <div class="d-flex justify-content-center align-items-center">
                                    <i class="fa-solid fa-peso-sign me-2"></i>
                                    <span>Payment</span>
                                </div>
                            </button>
                            <button type="button" class="rounded-1 btn btn-danger btn-sm" @click="archiveReferPatients(item.id)">
                                <div class="d-flex justify-content-center align-items-center">
                                    <i class="fa-solid fa-box-archive me-2"></i>
                                    <span>Archive</span>
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
    <add-payment-modal :payment_user="payment_user" @displayPayment="diplayVerfiedPatients"></add-payment-modal>
</div>
</template>

<script>
import axios from 'axios';
import AddPaymentModal from './Modal/PaymentModal.vue';
export default {
    components:{
        AddPaymentModal,
    },
    data() {
        return {
            listofVerfiedPatients:[],
            payment_user : {},
        };
    },

    methods:{
        diplayVerfiedPatients(){
            axios.get('/admin/patients/refer').then((response)=>{
                this.listofVerfiedPatients = response.data.data;
            }).catch((error)=>{
                console.log(error);
            });
        },
        archiveReferPatients(id){
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, archive it!",
            })
                .then((data) => {
                    if (data.isConfirmed) {
                        axios
                            .put("/admin/patient/archive/" + id)
                            .then((response) => {
                                Swal.fire("Archive!", "Patient has been archive.", "success");
                                this.diplayVerfiedPatients();
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

        addPayment(payment_user){
            this.payment_user = {
                appointment_id: payment_user.id,
                treatment_rendered: payment_user.appoint_services.services_name,
            };
            $("#add-payment-modal").modal("show");
        }
        
    },
    mounted(){
        this.diplayVerfiedPatients();
    }
};
</script>
