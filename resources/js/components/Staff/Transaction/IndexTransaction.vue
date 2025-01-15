<template>
    <div class="container-fluid">
        <div class="txt-title mt-2">
            <p class="fs-5 fw-semibold mb-0">Transaction History</p>
        </div>
        <div class="table-responsive-lg">
            <div class="header d-flex p-2 justify-content-between align-items-center bg-info bg-gradient rounded-1 mb-2">
                <div class="text-center col-lg-3">
                    <p class="fs-6 fw-semibold mb-0">Name</p>
                </div>
                <div class="text-center col-lg-2">
                    <p class="fs-6 fw-semibold mb-0">Occupation</p>
                </div>
                <div class="text-center col-lg-3">
                    <p class="fs-6 fw-semibold mb-0">Services</p>
                </div>
                <div class="text-center col-lg-1">
                    <p class="fs-6 fw-semibold mb-0">Status</p>
                </div>
                <div class="text-center col-lg-1"></div>
            </div>
            <div class="main-table-body">
                <div class="table-row card mb-2" v-for="item in transaction" :key="item.id">
                    <div class="d-flex p-2 justify-content-between align-items-center bg-light bg-gradient rounded-1">
                        <div class="text-center col-lg-3">
                            <p class="fs-6 mb-0 fw-medium text-black-50">{{ item.patient?.lastname }}, {{ item.patient?.firstname }} {{ item.patient?.middle_initial }}.</p>
                        </div>
                        <div class="text-center col-lg-2">
                            <p class="fs-6 mb-0 fw-medium text-black-50">{{ item.patient?.occupation }}</p>
                        </div>
                        <div class="text-center col-lg-3">
                            <p class="fs-6 mb-0 fw-medium text-black-50">{{ item.appoint_services?.services_name }}</p>
                        </div>
                        <div class="text-center justify-content-center col-lg-1">
                            <p class="fs-6 fw-medium mb-0 text-success">{{ item.appnt_status }}</p>
                        </div>
                        <div class="text-center d-flex justify-content-center col-lg-1">
                            <button class="btn btn-success btn-sm" type="button" @click="printInvoice(item.id)">
                                <i class="fa-solid fa-print me-2"></i>Invoice
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid d-flex justify-content-end align-items-center">
                <nav>
                    <ul class="pagination">
                        <li class="page-item" :class="{ disabled: currentPage === 1 }">
                            <button class="page-link" @click.prevent="changePage(currentPage - 1)" aria-label="Previous" :disabled="currentPage === 1">
                                <span aria-hidden="true">&laquo;</span>
                            </button>
                        </li>
                        <li class="page-item" v-for="page in totalPages" :key="page" :class="{ active: currentPage === page }">
                            <button class="page-link" @click.prevent="changePage(page)">{{ page }}</button>
                        </li>
                        <li class="page-item" :class="{ disabled: currentPage === totalPages }">
                            <button class="page-link" @click.prevent="changePage(currentPage + 1)" aria-label="Next" :disabled="currentPage === totalPages">
                                <span aria-hidden="true">&raquo;</span>
                            </button>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            transaction: [],
            currentPage: 1,
            totalPages: 1,
            perPage: 10,
        };
    },
    methods: {
        displayTransaction(page = 1) {
            axios
                .get("/user/staff/transaction/display", {
                    params: {
                        page,
                        limit: this.perPage,
                    },
                })
                .then((response) => {
                    const { data, meta } = response.data;
                    if (data && meta) {
                        this.transaction = data;
                        this.currentPage = meta.current_page || 1;
                        this.totalPages = meta.last_page || 1;
                    }
                })
                .catch((error) => {
                    console.error("Error fetching transactions:", error);
                });
        },
        changePage(page) {
            if (page >= 1 && page <= this.totalPages) {
                this.displayTransaction(page);
            }
        },
        printInvoice(id) {
            axios
                .get(`/patient/invoice/print/${id}`)
                .then((response) => {
                    const url = response.data.path;
                    window.open(url, "_blank");
                })
                .catch((error) => {
                    console.error("Error printing invoice:", error);
                });
        },
    },
    mounted() {
        this.displayTransaction();
    },
};
</script>
