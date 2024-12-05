<template>
    <div class="container-fluid">
        <div class="main-body">
            <div class="container py-2">
                <form @submit.prevent="submitPayment">
                    <div class="company-serv card w-100 mb-3 d-flex align-items-between p-3">
                        <p class="fw-medium mb-2">Fill the form for adding a payment.</p>
                            <div class="d-block">
                                <p class="fw-medium fs-4 mb-1">Payable</p>
                                <div class="d-flex align-items-center justify-content-center mb-3">
                                    <div class="form-group mb-1 w-100 me-2">
                                        <label class="form-label">Fee</label>
                                        <input type="number" class="form-control" :value="fee" readonly/>
                                    </div>
                                    <div class="form-group mb-1 w-100 me-2">
                                        <label class="form-label">Remaining Balance</label>
                                        <input type="number" class="form-control" :value="currentBalance" readonly/>
                                    </div>
                                </div>
                                <p class="fw-medium fs-4 mb-1">Payment</p>
                                <div class="d-flex justify-content-center align-items-center">
                                    <div class="form-group w-100 me-2">
                                        <label class="form-label">Date</label>
                                        <input type="date" class="form-control" v-model="data.payment_date"/>
                                    </div>
                                    <div class="form-group w-100">
                                        <label class="form-label">Amount Paid</label>
                                        <input type="number" class="form-control" v-model="data.paid"/>
                                    </div>
                                </div>
                                <p class="fw-medium fs-4 mb-1">Mode of Payment</p>
                                <div class="d-flex justify-content-center align-items-center">
                                    <div class="form-group w-100 me-2">
                                        <label class="form-label">Method</label>
                                        <select class="form-control" v-model="data.payment_method">
                                            <option selected disabled>Choose</option>
                                            <option value="G-cash">G-cash</option>
                                            <option value="Cash">Cash</option>
                                        </select>
                                    </div>
                                    <div class="form-group w-100" v-if="data.payment_method === 'G-cash'">
                                        <label class="form-label">Reference Number</label>
                                        <input type="text" class="form-control" v-model="data.ref_number"/>
                                    </div>
                                </div>
                            </div>
                            <div class="active-btn">
                                <button type="submit" class="btn btn-success text-white btn-md-1 w-100">Add Payment</button>
                            </div>
                        </div>
                </form>
            </div>

            <div class="table-responsive p-3">
                <p class="fw-medium fs-4 mb-1">Payment History</p>
                <table class="table table-striped table-hover table-bordered">
                   <thead>
                        <th>Payment No.</th>
                        <th>Payment Date</th>
                        <th>Paid</th>
                        <th>New Balance</th>
                        <th>Payment Method</th>
                        <th>Reference Number</th>
                   </thead>
                   <tbody>
                        <tr v-for="(item, index) in historyPayment" :key="index">
                            <td>{{ item.id }}</td>
                            <td>{{ formatDate(item.payment_date) }}</td>
                            <td>{{ item.paid }}</td>
                            <td>{{ item.new_balance }}</td>
                            <td>{{ item.payment_method }}</td>
                            <td>{{ item.ref_number || 'Not G-cash MOP'}}</td>
                        </tr>
                   </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import Swal from "sweetalert2";

export default {
    data() {
        return {
            fee: null,
            currentBalance: 0,
            data: {
                payment_appoitment_id: '',
                payment_date: '',
                paid: '',
                new_balance: '',
                payment_method: '',
                ref_number: '',
            },
            historyPayment: [],
        };
    },
    methods: {
        formatDate(dateString) {
            if (!dateString) return '';
            const date = new Date(dateString);
            return new Intl.DateTimeFormat('en-US', { 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric' 
            }).format(date);
        },
        getUrlId() {
            const url = window.location.href;
            const urlSegments = url.split('/');
            return urlSegments[urlSegments.length - 1].split('?')[0];
        },
        getpaymentHistory(id){
            axios.get('/admin/patients/payment/history/show/' + id)
                .then((response) => {
                    this.historyPayment = response.data.data.items;
                    const lastPayment = this.historyPayment[this.historyPayment.length - 1];
                    this.currentBalance = lastPayment ? lastPayment.new_balance : this.fee;
                })
                .catch((error) => {
                    console.error("Error fetching payment history:", error);
                });
        },
        submitPayment() {
            axios.post('/admin/patients/pay/item', this.data)
                .then((response) => {
                    const id = this.getUrlId();
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Payment has been added!",
                        showConfirmButton: false,
                        timer: 2000,
                    }).then(() => {
                        this.clearData();
                        this.getpaymentHistory(id);
                    });
                })
                .catch((error) => {
                    console.error("Error submitting payment:", error);
                });
        },
        clearData() {
            this.data.paid = '';
            this.data.payment_date = '';
            this.data.payment_method = '';
            this.data.ref_number = '';
        },
    },
    mounted() {
        const id = this.getUrlId();
        if (id) {
            this.getpaymentHistory(id);
            this.data.payment_appoitment_id = id;
        } else {
            console.error("ID not found in URL.");
        }

        this.fee = this.$route.query.fee;
        this.currentBalance = this.fee;
    },
};
</script>

