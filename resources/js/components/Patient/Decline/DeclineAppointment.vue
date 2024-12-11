<template>
    <div class="container-fluid py-3">
        <div class="container-fluid">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h5>Decline Appointment</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered">
                   <thead class="text-center">
                        <th>Appointment No.</th>
                        <th>Name</th>
                        <th>Services</th>
                        <th>Schedule Date</th>
                        <th>Status</th>
                   </thead>
                   <tbody class="text-center">
                        <tr v-for="(item, index) in listDecline" :key="index">
                            <td>{{ item.id }}</td>
                            <td>{{ item.patient?.firstname }} {{ item.patient?.middle_initial }} {{ item.patient?.lastname }}</td>
                            <td>{{ item.appoint_services.services_name }}</td>
                            <td>{{ item.sched_date }}</td>
                            <td class="text-danger fw-medium">{{ item.appnt_status }}</td>
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
            listDecline: [],
        }
    },
    methods: {
        decline(){
            axios.get('/user/patient/appointment/view/decline').then((response)=>{
                console.log(response);
                this.listDecline = response.data;
            }).catch((error) =>{
                console.log(error);
            });
        },
    },
    mounted() {
        this.decline();
    },
};
</script>
