<template>
    <div class="modal fade" id="add-payment-modal" role="dialog">
        <div class="modal-dialog modal-fullscreen" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container-fluid">
                        <form @submit.prevent="storePayment">
                            <div class="d-flex justify-content-between w-100">
                                <p class="fs-5 fw-medium">Add Payment</p>
                                <button type="button" class="btn-close btn-black" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="company-serv card w-100 mb-3 d-flex align-items-between p-3">
                                <p class="fw-medium mb-2">Fill the form for adding a payment.</p>
                                <div class="d-flex align-items-center justify-content-end mb-2">
                                    <button type="button" class="btn btn-primary text-white btn-sm" @click="addPaymentEntry">
                                        <i class="fa-solid fa-plus text-white me-2"></i>New Payment
                                    </button>
                                </div>
                                <!-- loop -->
                                <div v-for="(entry, entryIndex) in data" :key="entryIndex">
                                    <input type="text" v-model="entry.appointment_id"/>
                                    <p class="fs-4 fw-medium mb-2">New Payment</p>
                                    <div class="d-flex justify-content-evenly align-items-center mb-3">
                                        <div class="form-group mb-1 w-100 me-2">
                                            <label class="form-label">Date</label>
                                            <input type="date" class="form-control" v-model="entry.date" />
                                        </div>
                                        <div class="form-group mb-1 w-100 me-2">
                                            <label class="form-label">Tooth</label>
                                            <input type="text" class="form-control" v-model="entry.tooth" />
                                        </div>
                                        <div class="form-group mb-1 w-100 me-2">
                                            <label class="form-label">Surface</label>
                                            <input type="text" class="form-control" v-model="entry.surface" />
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-end">
                                        <button type="button" class="btn btn-primary text-white btn-sm" @click="addPaymentItem(entryIndex)">
                                            <i class="fa-solid fa-plus text-white me-2"></i>Add
                                        </button>
                                    </div>
                                    <div class="d-block" v-for="(item, index) in entry.payment_items" :key="index">
                                        <div class="d-flex align-items-center justify-content-center mb-3">
                                            <div class="form-group mb-1 w-100 me-2">
                                                <label class="form-label">Payment Date</label>
                                                <input type="date" class="form-control" v-model="item.payment_date" />
                                            </div>
                                            <div class="form-group mb-1 w-100 me-2">
                                                <label class="form-label">Treatment Rendered</label>
                                                <input type="text" class="form-control" v-model="item.treatment_rendered" />
                                            </div>
                                            <div class="form-group mb-1 w-100 me-2">
                                                <label class="form-label">Fee</label>
                                                <input type="number" class="form-control" v-model="item.fee" />
                                            </div>
                                            <div class="form-group mb-1 w-100 me-2">
                                                <label class="form-label">Paid</label>
                                                <input type="number" class="form-control" v-model="item.paid" />
                                            </div>
                                            <div class="form-group mb-1 w-100 me-2">
                                                <label class="form-label">Balance</label>
                                                <input type="number" class="form-control" v-model="item.balance" readonly />
                                            </div>
                                        </div>
                                        <div class="d-block align-items-center">
                                            <div class="form-group w-100 me-2">
                                                <label class="form-label">Payment Method</label>
                                                <select class="form-control" v-model="item.payment_method">
                                                    <option selected disabled>Choose</option>
                                                    <option value="G-cash">G-cash</option>
                                                    <option value="Cash">Cash</option>
                                                </select>
                                            </div>
                                            <div class="form-group w-100" v-if="item.payment_method === 'G-cash'">
                                                <label class="form-label">Ref Number</label>
                                                <input type="text" class="form-control" v-model="item.ref_number" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="divider py-1 bg-dark mt-2 rounded-5 mb-2"></div>
                                </div>
                            </div>
                            <div class="active-btn">
                                <button type="submit" class="btn btn-success text-white btn-md-1 w-100">
                                    Done
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    props: ["payment_user"],
    data() {
        return {
            data: [
                {
                    appointment_id: "",
                    date: "",
                    tooth: "",
                    surface: "",
                    payment_items: [
                        {
                            payment_date: "",
                            treatment_rendered: "",
                            fee: "",
                            paid: "",
                            balance: "",
                            payment_method: "",
                            ref_number: "",
                        },
                    ],
                },
            ],
        };
    },
    methods: {
        storePayment() {
            console.log("Submitting data:", this.data);
            axios
                .post("/admin/patients/payment/store", this.data)
                .then((response) => {
                    console.log("Response:", response);
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
                })
                .catch((error) => {
                    console.error("Error:", error);
                });
        },
        clearForm() {
            this.data = [
                {
                    date: "",
                    tooth: "",
                    surface: "",
                    payment_items: [
                        {
                            payment_date: "",
                            treatment_rendered: "",
                            fee: "",
                            paid: "",
                            balance: "",
                            payment_method: "",
                            ref_number: "",
                        },
                    ],
                },
            ];
        },
        addPaymentItem(entryIndex) {
            this.data[entryIndex].payment_items.push({
                payment_date: "",
                treatment_rendered: this.payment_user?.treatment_rendered || "",
                fee: "",
                paid: "",
                balance: "",
                payment_method: "",
                ref_number: "",
            });
        },
        addPaymentEntry() {
            this.data.push({
                appointment_id: this.payment_user?.appointment_id || "", 
                date: "",
                tooth: "",
                surface: "",
                payment_items: [
                    {
                        payment_date: "",
                        treatment_rendered: this.payment_user?.treatment_rendered || "",
                        fee: "",
                        paid: "",
                        balance: "",
                        payment_method: "",
                        ref_number: "",
                    },
                ],
            });
        },
    },
    watch: {
        data: {
            handler(newData) {
                newData.forEach((entry) => {
                    entry.payment_items.forEach((item) => {
                        const fee = parseFloat(item.fee) || 0;
                        const paid = parseFloat(item.paid) || 0;
                        item.balance = (fee - paid).toFixed(2);
                    });
                });
            },
            deep: true,
        },
        payment_user: {
            handler(val) {
                this.data.forEach((entry) => {
                    entry.appointment_id = val.appointment_id || entry.appointment_id;
                    entry.payment_items.forEach((item) => {
                        item.treatment_rendered = val.treatment_rendered;
                    });
                });
            },
            deep: true,
        },
    },
};
</script>
