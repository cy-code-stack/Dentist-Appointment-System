<template>
    <div class="modal fade" id="add-payment-modal">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container">
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
                                <p class="fw-medium mb-2">Fill the form for adding a payment.</p>
                                <div class="form-group mb-1 w-100">
                                    <label class="form-label">Date</label>
                                    <input type="date" class="form-control" v-model="data.date"/>
                                </div>
                                <div class="form-group mb-1 w-100">
                                    <label class="form-label">Treatment Rendered</label>
                                    <input type="text" class="form-control" v-model="data.treatment_rendered"/>
                                </div>
                                <div class="form-group mb-1 w-100">
                                    <label class="form-label">Fee</label>
                                    <input type="text" class="form-control" v-model="data.fee">
                                </div>
                                <div class="form-group mb-1 w-100">
                                    <label class="form-label mb-1">Payment Method</label>
                                    <select
                                        type="text"
                                        class="form-control"
                                        v-model="data.payment_method"
                                    >
                                        <option selected disabled>Choose</option>
                                        <option value="G-cash">G-cash</option>
                                        <option value="Cash">Cash</option>
                                    </select>
                                </div>
                            </div>
                            <div class="active-btn">
                                <button type="submit" class="btn btn-success text-white btn-md-1 w-100" >Done</button>
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
                date: '',
                treatment_rendered: '',
                fee: '',
                payment_method: '',
            }
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
            this.services = {
                appointment_id: '',
                date: '',
                treatment_rendered: '',
                fee: '',
                payment_method: '',
            };
        },
        setCurrentDate() {
            this.data.date = new Date().toISOString().slice(0, 10);
        },
    },
    watch: {
        payment_user: {
            handler(val) {
                this.data.appointment_id = val.appointment_id;
                this.setCurrentDate();
            },
            deep: true,
        },
    },
    mounted() {
        this.setCurrentDate();
    },
};
</script>
