<template>
    <div class="modal fade" id="add-payment-modal">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container-fluid">
                        <form @submit.prevent="storePayment">
                            <input type="hidden" v-model="data.appointment_id">
                            <div class="d-flex justify-content-between w-100">
                                <p class="fs-5 fw-medium">Add Payment</p>
                                <button
                                    type="button"
                                    class="btn-close btn-black"
                                    data-bs-dismiss="modal"
                                    aria-label="Close"
                                ></button>
                            </div>
                            <div class="company-serv card w-100 mb-3 d-flex align-items-between p-3">
                                    <p class="fw-medium mb-0">Fill the form for adding a payment.</p>
                                <div class="d-flex align-items-center justify-content-end">
                                    <button type="button" class="btn btn-primary text-white btn-sm" @click="addPaymentItem"><i class="fa-solid fa-plus text-white me-2"></i>Add</button>
                                </div>
                                <div v-for="(item, index) in data.payment_items" :key="index" class="d-flex align-items-center justify-content-center mb-3">
                                    <div class="form-group mb-1 w-100 me-2">
                                        <label class="form-label">Date</label>
                                        <input type="date" class="form-control" v-model="item.date"/>
                                    </div>
                                    <div class="form-group mb-1 w-100 me-2">
                                        <label class="form-label">Tooth</label>
                                        <input type="text" class="form-control" v-model="item.tooth">
                                    </div>
                                    <div class="form-group mb-1 w-100 me-2">
                                        <label class="form-label">Surface</label>
                                        <input type="text" class="form-control" v-model="item.surface">
                                    </div>
                                    <div class="form-group mb-1 w-100 me-2"> 
                                        <label class="form-label">Treatment Rendered</label>
                                        <input type="text" class="form-control" v-model="item.treatment_rendered"/>
                                    </div>
                                    <div class="form-group mb-1 w-100 me-2">
                                        <label class="form-label">Fee</label>
                                        <input type="text" class="form-control" v-model="item.fee">
                                    </div>
                                    <div class="form-group mb-1 w-100 me-2">
                                        <label class="form-label">Paid</label>
                                        <input type="text" class="form-control" v-model="item.paid">
                                    </div>
                                    <div class="form-group mb-1 w-100 me-2">
                                        <label class="form-label">Balance</label>
                                        <input type="text" class="form-control" v-model="item.balance">
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="form-group w-100 me-2">
                                        <label class="form-label">Payment Method</label>
                                        <select
                                            type="text"
                                            class="form-control"
                                            v-model="data.payment_method">
                                            <option selected disabled>Choose</option>
                                            <option value="G-cash">G-cash</option>
                                            <option value="Cash">Cash</option>
                                        </select>
                                    </div>
                                    <div class="form-group w-100" v-if="data.payment_method === 'G-cash'">
                                        <label class="form-label">Ref Number</label>
                                        <input type="text" class="form-control" v-model="data.ref_number">
                                    </div>
                                </div>
                            </div>
                            <div class="active-btn">
                                <button type="submit" class="btn btn-success text-white btn-md-1 w-100">Done</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    props: ["payment_user"],
    data() {
        return {
            data: {
                appointment_id: '',
                payment_items: [{
                    date: '',
                    tooth: '',
                    surface: '',
                    treatment_rendered: '',
                    fee: '',
                    paid: '',
                    balance: '',
                }],
                payment_method: '',
                ref_number: '',
            },
        };
    },
    methods: {
        storePayment(){
            axios.post("/admin/patients/payment/store", this.data).then((response)=> {
                console.log(response);
                this.clearForm();
                $("#add-payment-modal").modal("hide");
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Payment has been added!",
                    showConfirmButton: false,
                    timer: 1500,
                });
                this.$emit("displayPayment");
            }).catch((error)=>{
                console.log(error);
            });
        },
        clearForm(){
            this.data = {
                appointment_id: '',
                payment_items: [{
                    date: '',
                    tooth: '',
                    surface: '',
                    treatment_rendered: '',
                    fee: '',
                    paid: '',
                }]
            };
        },
        addPaymentItem() {
            this.data.payment_items.push({
                date: '',
                tooth: '',
                surface: '',
                treatment_rendered: this.payment_user?.treatment_rendered || '',
                fee: '',
                paid: '',
            });
        },
    },
    watch: {
        payment_user: {
            handler(val) {
                this.data.appointment_id = val.appointment_id;
                this.data.payment_items.forEach(item => {
                    item.treatment_rendered = val.treatment_rendered;
                });
            },
            deep: true,
        },
    },
};
</script>
