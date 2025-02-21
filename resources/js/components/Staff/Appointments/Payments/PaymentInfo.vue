<template>
    <div class="container-fluid py-3">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h5>Tooths Payments</h5>
                <div class="d-flex gap-1">
                    <!-- Trigger Modal -->
                    <button type="button" class="rounded-1 btn btn-sm btn-success" @click="completeAppointment()">
                        <div class="d-flex justify-content-center align-items-center">
                            <span>Complete</span>
                        </div>
                    </button>
                    <button type="button" class="rounded-1 btn btn-sm btn-primary" @click="showModal=true">
                        <div class="d-flex justify-content-center align-items-center">
                            <span>Add Services</span>
                        </div>
                    </button>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered">
                   <thead>
                        <th>ID</th>
                        <th>Service Rendered</th>
                        <th>Tooth</th>
                        <th>Surface</th>
                        <th>Fee</th>
                        <th>Remaining Balance</th>
                        <th>Status</th>
                        <th>Actions</th>
                   </thead>
                   <tbody>
                    <tr v-for="(item, index) in payments" :key="index">
                        <td>{{ item.id }}</td>
                        <td>{{ item.services?.services_name }}</td>
                        <td>{{ item.tooth }}</td>
                        <td>{{ item.surface }}</td>
                        <td>{{ item.fee }}</td>
                        <td>{{ item.balance }}</td>
                        <td>{{ item.status }}</td>
                        <td>
                            <div class="text-center d-flex align-items-center">
                                <router-link :to="{  path: `/user/staff/add/payment/${item.id}`,  query: { fee: item.fee}  }">
                                    <button type="button" v-if="item.balance != 0.00" class="rounded-1 btn btn-primary btn-sm">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <i class="fa-solid fa-peso-sign me-2"></i>
                                            <span>Add Payment</span>
                                        </div>
                                    </button>
                                </router-link>
                            </div>
                        </td>
                    </tr>
                   </tbody>
                </table>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade show" tabindex="-1" style="display: block;" v-if="showModal" aria-labelledby="newToothModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="newToothModalLabel">Payables</h5>
                        <button type="button" class="btn-close" @click="showModal = false"></button>
                    </div>
                    <div class="modal-body overflow-auto">
                        <!-- Modal Form -->
                        <form @submit.prevent="handleSubmit">
                            <div class="mb-3">
                                <label class="form-label">Service</label>
                                <select class="form-select" id="service" v-model="selectedService">
                                    <option v-for="(item, index) in service" :key="index" :value="item">
                                        {{ item.services_name }}
                                    </option>
                                </select>
                                <!-- <input type="text" v-model="newTooth.service" class="form-control"> -->
                            </div>
                            <div class="mb-3">
                                <label for="tooth" class="form-label">Tooth</label>
                                <input type="text" id="tooth" v-model="newTooth.tooth" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="surface" class="form-label">Surface</label>
                                <input type="text" id="surface" v-model="newTooth.surface" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="fee" class="form-label">Fee</label>
                                <input type="number" id="fee" v-model="newTooth.fee" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary float-right">Save</button>
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
    data() {
        return {
            payments: [],            
            showModal: false, 
            newTooth: {
                appointment_id: '',
                user_id: '',
                service_id: '',
                tooth: '',
                surface: '',
                fee: null,
            },
            selectedService: null,
            service: [],
        };
        
    },
    methods: {
        getUrlId(){
            const url = new URL(window.location.href);
            const segments = url.pathname.split('/');
            return segments[segments.length - 1];
        },
        displayPayment(id) {
            axios.get('/user/staff/payment/display/' + id)
                .then(response => {
                    this.payments = response.data.data;
                })
                .catch(error => {
                    console.log(error);
            });
        },
        displayServices(){
            axios.get('/user/staff/services/servDisplay')
                .then(response => {
                    this.service = response.data.data;
                })
                .catch(error => {
                    console.log(error);
            });
        },
        completeAppointment(){
            Swal.fire({
                title: "Completed?",
                text: "You won't be able to revert this!",
                icon: "success",
                showCancelButton: true,
                confirmButtonColor: "#14A44D",
                cancelButtonColor: "#6c757d",
                cancelButtonText: "Cancel",
                confirmButtonText: "Yes, Complete it!",
            }).then((data) => {
                    if (data.isConfirmed) {
                        axios.put("/user/staff/appointment/complete/" + this.getUrlId())
                            .then(() => {
                                Swal.fire("Completed!", "Appointment has been complete.", "success");
                                this.$router.back();
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
        handleSubmit() {
            this.newTooth.user_id = this.getUrlId();
            this.newTooth.service_id = this.selectedService.id;
            axios.post('/user/staff/payment/store', this.newTooth)
            .then(() => {
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Record has been saved!",
                    showConfirmButton: false,
                    timer: 2000,
                }).then(() => {
                    this.clearForm();
                    this.displayPayment(this.getUrlId());
                });
            })
            .catch((error) => {
                console.error(error);
            });
            this.showModal = false;
        },
        clearForm(){
            this.newTooth.tooth = '';
            this.newTooth.service_id = null;
            this.newTooth.surface = '';
            this.newTooth.fee = null;
        },
    },
    mounted() {
        this.displayPayment(this.getUrlId());
        this.displayServices();
    },
};
</script>
