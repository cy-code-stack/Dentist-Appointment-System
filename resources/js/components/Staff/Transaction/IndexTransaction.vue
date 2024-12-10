<template>
    <div class="container-fluid">
        <div class="txt-title mt-2">
            <p class="fs-5 fw-semibold  mb-0">Transaction History</p>
        </div>
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
            <div class="header d-flex p-2 justify-content-between align-items-center bg-info bg-gradient rounded-1 mb-2">
                <div class="text-center col-lg-2">
                    <p class="fs-6 fw-semibold mb-0">Name</p>
                </div>
                <div class="text-center col-lg-2">
                    <p class="fs-6 fw-semibold mb-0">Email</p>
                </div>
                <div class="text-center col-lg-2">
                    <p class="fs-6 fw-semibold mb-0">Occupation</p>
                </div>
                <div class="text-center col-lg-2">
                    <p class="fs-6 fw-semibold mb-0">Services</p>
                </div>
                <div class="text-center col-lg-1">
                    <p class="fs-6 fw-semibold mb-0">Status</p>
                </div>
                <div class="text-center col-lg-1">
                    <!-- <p class="fs-6 fw-semibold mb-0">Actions</p> -->
                </div>
            </div>
            <div class="main-table-body">
                <div class="table-row card mb-2" v-for="item in transaction" :key="item.id">
                    <div class="d-flex p-2 justify-content-between align-items-center bg-light bg-gradient rounded-1">
                        <div class="text-center col-lg-2">
                            <p class="fs-6 mb-0 fw-medium text-black-50">{{ item.patient?.lastname }}, {{ item.patient?.firstname }} {{ item.patient?.middle_initial }}.</p>
                        </div>
                        <div class="text-center col-lg-2">
                            <p class="fs-6 mb-0 fw-medium text-black-50">{{ item.patient?.email }}</p>
                        </div>
                        <div class="text-center col-lg-2">
                            <p class="fs-6 mb-0 fw-medium text-black-50">{{ item.patient?.occupation }}</p>
                        </div>
                        <div class="text-center col-lg-2">
                            <p class="fs-6 mb-0 fw-medium text-black-50">{{item.appoint_services?.services_name}}</p>
                        </div>
                        <div class="text-center justify-content-center col-lg-1">
                            <p class="fs-6 fw-medium mb-0 text-success">{{ item.appnt_status }}</p>
                        </div>
                        <div class="text-center d-flex justify-content-center col-lg-1">
                            <button class="btn btn-success btn-sm" type="button" @click="printInvoice(item.id)">
                                <i hre class="fa-solid fa-print me-2"></i>Invoice
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid d-flex p-0 justify-content-end align-items-center">
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
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            transaction: [],
        };
    },
    methods:{
        displayTransaction(){
          axios.get('/user/staff/transaction/display').then((response)=>{
            this.transaction = response.data.data;
          }).catch((error)=>{
            console.log(error);
          });
        },
        printInvoice(id) {
            axios.get(`/patient/invoice/print/` + id, {
                params: { id }
            })
            .then((response) => {
                const url = response.data.path;
                window.open(url)
            })
            .catch((error) => {
                console.error("Error downloading invoice:", error);
            });
        }
    },  
    mounted(){
        this.displayTransaction();
    }
};
</script>
