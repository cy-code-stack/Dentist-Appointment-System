<template>
    <div class="container-fluid py-3">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h5>Patient Record</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered">
                   <thead>
                        <th>Appointment No.</th>
                        <th>Name</th>
                        <th>Services</th>
                        <th>Schedule Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                   </thead>
                   <tbody>
                    <tr v-for="(item, index) in patients" :key="index">
                        <td>{{ item.id }}</td>
                        <td>{{ item.patient?.firstname }} {{ item.patient?.middle_initial }} {{ item.patient?.lastname }}</td>
                        <td>{{ item.appoint_services?.services_name }}</td>
                        <td>{{ item.sched_date }}</td>
                        <td>{{ item.appnt_status }}</td>
                        <td>
                            <div class="text-center d-flex align-items-center">
                                <router-link :to="`/user/admin/record/view/${item.id}`">
                                    <button type="button" class="rounded-1 btn btn-primary btn-sm">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <span>View Form</span>
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
    </div>
</template>

<script>
import axios from 'axios';
export default {
    data() {
        return{
            patients: [],
        }
    },
    methods: {
        displayPatients(){
            axios.get('/user/staff/display').then((response) =>{
                this.patients = response.data.data;
            }).catch((error) =>{
                console.log(error);
            });
        },
    },
    mounted() {
        this.displayPatients();
    },
};
</script>
