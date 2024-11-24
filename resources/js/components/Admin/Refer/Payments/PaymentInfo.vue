<template>
    <div class="container-fluid py-3">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h5>Tooths Payments</h5>
                <!-- Trigger Modal -->
                <button 
                    type="button" 
                    class="rounded-1 btn btn-primary"
                    @click="showModal = true"
                >
                    <div class="d-flex justify-content-center align-items-center">
                        <span>New Tooth</span>
                    </div>
                </button>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered">
                   <thead>
                        <th>ID</th>
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
                        <td>{{ item.tooth }}</td>
                        <td>{{ item.surface }}</td>
                        <td>{{ item.fee }}</td>
                        <td>{{ item.balance }}</td>
                        <td>{{ item.status }}</td>
                        <td>
                            <div class="text-center d-flex align-items-center">
                                <router-link
                                    :to="{ 
                                            path: `/user/admin/payment/add/${item.id}`, 
                                            query: { fee: item.fee} 
                                        }"
                                >
                                    <button type="button" class="rounded-1 btn btn-primary btn-sm">
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
        <div 
            class="modal fade show" 
            tabindex="-1" 
            style="display: block;" 
            v-if="showModal" 
            aria-labelledby="newToothModalLabel" 
            aria-hidden="true"
        >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="newToothModalLabel">Add New Tooth</h5>
                        <button 
                            type="button" 
                            class="btn-close" 
                            @click="showModal = false"
                        ></button>
                    </div>
                    <div class="modal-body">
                        <!-- Modal Form -->
                        <form @submit.prevent="handleSubmit">
                            <div class="mb-3">
                                <label for="tooth" class="form-label">Tooth</label>
                                <input 
                                    type="text" 
                                    id="tooth" 
                                    v-model="newTooth.tooth" 
                                    class="form-control"
                                >
                            </div>
                            <div class="mb-3">
                                <label for="surface" class="form-label">Surface</label>
                                <input 
                                    type="text" 
                                    id="surface" 
                                    v-model="newTooth.surface" 
                                    class="form-control"
                                >
                            </div>
                            <div class="mb-3">
                                <label for="fee" class="form-label">Fee</label>
                                <input 
                                    type="number" 
                                    id="fee" 
                                    v-model="newTooth.fee" 
                                    class="form-control"
                                >
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
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
                tooth: '',
                surface: '',
                fee: null,
            },
        };
    },
    methods: {
        getUrlId(){
            const url = window.location.href;
            const urlSegments = url.split('/');
            return urlSegments[urlSegments.length - 1];
        },
        displayPayment() {
            axios.get('/admin/patients/payment/show')
                .then(response => {
                    this.payments = response.data.data;
                })
                .catch(error => {
                    console.log(error);
                });
        },
        handleSubmit() {
            this.newTooth.appointment_id = this.getUrlId();
            axios.post('/admin/patients/pay/store', this.newTooth)
                .then((response) => {
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Record has been saved!",
                        showConfirmButton: false,
                        timer: 2000,
                    });
                    this.displayPayment();
                })
                .catch((error) => {
                    console.error(error);
                });
            this.showModal = false;
        },
    },
    mounted() {
        this.displayPayment();
    },
};
</script>
