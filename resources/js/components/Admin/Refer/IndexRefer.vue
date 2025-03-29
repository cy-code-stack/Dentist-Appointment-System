<template>
    <div class="container-fluid">
        <div class="txt-title mt-2">
            <p class="fs-5 fw-semibold text-black mb-0">Transaction</p>
        </div>
        <div class="d-flex justify-content-end align-items-center mb-2">
            <div class="sort">
                <form class="d-flex" role="search">
                    <input class="form-control form-control-sm me-2" v-model="searchQuery" type="search" placeholder="Search" aria-label="Search">
                </form>
            </div>
        </div>
        <div class="table-responsive-lg">
            <table class="table table-striped table-bordered">
                <thead class="bg-info bg-gradient text-center">
                    <tr>
                        <th>Name</th>
                        <th>Appointment Schedule</th>
                        <th>Services</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in listofVerfiedPatients" :key="item.id">
                        <td class="text-center">{{ item.patient?.firstname }} {{ item?.patient?.lastname }}</td>
                        <td class="text-center">{{ formatDate(item.sched_date) }} <br> {{ formatTime(item.sched_time) }}</td>
                        <td class="text-center">{{ item.appoint_services?.services_name }}</td>
                        <td class="text-center text-primary">{{ item.appnt_status }}</td>
                        <td class="text-center">
                            <router-link :to="`/user/admin/view/${item.id}`">
                                <button v-if="item.appnt_status === 'Pending'" class="btn btn-info btn-sm text-white me-1">
                                    <i class="fa-solid fa-eye me-2"></i> View
                                </button>
                            </router-link>
                            <router-link :to="`/user/admin/payment/${item.patient?.id}`">
                                <button v-if="item.appnt_status === 'Payment' || item.appnt_status === 'Not yet Paid'" class="btn btn-primary btn-sm text-white me-1">
                                    <span class="me-2">Payment</span> <i class="fa-solid fa-circle-arrow-right"></i>
                                </button>
                            </router-link>
                            <button class="btn btn-danger btn-sm" @click="archiveReferPatients(item.id)">
                                <i class="fa-solid fa-box-archive me-2"></i> Archive
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="d-flex justify-content-end">
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
        formatTime(timeString) {
            if (!timeString) return '';
            const [hours, minutes] = timeString.split(':').map(Number);
            const period = hours >= 12 ? 'PM' : 'AM';
            const formattedHours = hours % 12 || 12; 
            return `${formattedHours}:${minutes.toString().padStart(2, '0')} ${period}`;
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
