<template>
    <div class="container-fluid py-3">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h5>Patient History</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered">
                   <thead>
                        <th>Date</th>
                        <th>Services</th>
                        <th>Price</th>
                        <th>Tooth</th>
                   </thead>
                   <tbody>
                    <tr v-for="(item, index) in patientHistory" :key="index">
                        <td>{{ formatWordyDate(item.created_at) }}</td>
                        <td>{{ item.services?.services_name }}</td>
                        <td>{{ item.fee }}</td>
                        <td>{{ item.tooth }}</td>
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
        return {
            patientHistory:[],      
        };
    },
    methods: {
        displayHistory(){
            const id = this.$route.params.id;
            if (!id) {
                console.error('user ID not found in route params.');
                return;
            }
            axios.get(`/user/view/history/${id}`).then((response)=>{
                console.log(response.data.data);
                this.patientHistory = response.data.data;
            }).catch((error)=>{
                console.log(error);
            });
        },
        formatWordyDate(date) {
            if (!date) return '';
            const options = { year: 'numeric', month: 'long', day: 'numeric' };
            return new Date(date).toLocaleDateString('en-PH', options);
        },
    },
    mounted() {
       this.displayHistory();
    },
};
</script>
