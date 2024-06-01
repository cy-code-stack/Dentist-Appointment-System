<template>
    <div class="modal fade" id="diagnose-payment-modal" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container">
                        <form @submit.prevent="submitUser">
                            <div class="d-flex justify-content-between w-100">
                                <p class="fs-5 fw-medium">Payment</p>
                                <button type="button" class="btn-close btn-black" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="company-serv card w-100 mb-3 d-flex align-items-between justify-content-between p-3">
                                <p class="fw-medium mb-2">Fill the form for the payment</p>
                                <div class="form-group mb-1 d-flex justify-content-center">
                                    <div class="me-1 w-100">
                                        <label class="form-label mb-0">Firstname</label>
                                        <input type="text" class="form-control" disabled/>
                                    </div>
                                    <div class="w-100">
                                        <label class="form-label mb-0">Lastname</label>
                                        <input type="text" class="form-control" disabled/>
                                    </div>
                                </div>
                                <div class="form-group mb-1 d-flex justify-content-center">
                                    <div class="me-1 w-100">
                                        <label class="form-label mb-0">Services</label>
                                        <input type="text" class="form-control" disabled/>
                                    </div>
                                    <div class="me-1 w-100">
                                        <label class="form-label mb-0">Services Price Range</label>
                                        <input type="text" class="form-control" disabled/>
                                    </div>
                                </div>
                                <div class="form-group mb-1 d-flex justify-content-center">
                                    <div class="me-1 w-100">
                                        <label class="form-label mb-0">Preffered Price</label>
                                        <input type="text" class="form-control"/>
                                    </div>
                                    <div class="me-1 w-100">
                                        <label class="form-label mb-1">Role</label>
                                        <select type="text" class="form-control">
                                            <option selected>Choose Payment Method</option>
                                            <option value="g-cash">G-Cash</option>
                                            <option value="paymaya">Paymaya</option>
                                        </select>
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
import axios from "axios";

export default {
    data() {
        return {};
    },
    methods: {},
    mounted() {},
};
</script>
