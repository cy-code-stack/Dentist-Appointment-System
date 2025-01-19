<template>
    <div>
    <div class="container-fluid">
        <div class="txt-title mt-2">
            <p class="fs-5 fw-semibold text-black mb-0">Transaction</p>
        </div>
        <div class="d-flex justify-content-end align-items-center mb-2">
            <div class="sort">
                <div class="select-input d-flex justify-content-center align-items-center">
                    <form class="d-flex" role="search">
                        <input class="form-control form-control-sm me-2" v-model="searchQuery" type="search" placeholder="Search" aria-label="Search">
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
                               {{ formatDate(item.sched_date) }} <br> {{ item.sched_time }}
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
                                <button v-if="item.appnt_status === 'Pending'" type="button" class="me-1 rounded-1 btn btn-info text-white btn-sm">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <i class="fa-solid fa-eye me-2"></i>
                                        <span>View</span>
                                    </div>
                                </button>
                            </router-link>
                            <router-link :to="`/user/admin/payment/${item.id}`">
                                <button v-if="item.appnt_status === 'Payment' || item.appnt_status === 'Not yet Paid'" type="button" class="me-1 rounded-1 btn btn-primary text-white btn-sm">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <span class="me-2">Payment</span>
                                        <i class="fa-solid fa-circle-arrow-right"></i>
                                    </div>
                                </button>
                            </router-link>
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
            currentPage: 1,
            totalPages: 1,
            perPage: 10,
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
        diplayVerfiedPatients(page = 1) {
            axios
                .get('/admin/patients/refer', {
                    params: {
                        page: page,
                        limit: this.perPage,
                        search: this.searchQuery,
                    },
                })
                .then((response) => {
                    this.currentPage = response.data.meta.current_page;
                    this.totalPages = response.data.meta.last_page;
                    this.listofVerfiedPatients = response.data.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        changePage(page) {
            if (page > 0 && page <= this.totalPages) {
                this.diplayVerfiedPatients(page);
            }
        },
        handleSearch() {
            this.diplayVerfiedPatients(1);
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
                            .then(() => {
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
