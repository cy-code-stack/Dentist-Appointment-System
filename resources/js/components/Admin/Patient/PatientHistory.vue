<template>
    <div class="container-fluid py-4">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h5>Patient History</h5>
                <button type="button" class="rounded-1 btn btn-success btn-sm text-white" @click="printHistory($route.params.id)">
                    <div class="d-flex justify-content-center align-items-center">
                        <i class="fa-solid fa-print me-2"></i>
                        <span>Print</span>
                    </div>
                </button>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered">
                   <thead>
                        <th>Date</th>
                        <th>Services</th>
                        <th>Tooth</th>
                        <th>Surface</th>
                   </thead>
                   <tbody>
                    <tr v-for="(item, index) in patientHistory" :key="index">
                        <td>{{ formatWordyDate(item.created_at) }}</td>
                        <td>{{ item.services?.services_name }}</td>
                        <td>{{ item.tooth }}</td>
                        <td>{{ item.surface }}</td>
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
        printHistory(id) {
            axios
                .get(`/patient/patient-history/print/${id}`)
                .then((response) => {
                    const url = response.data.path;
                    window.open(url, "_blank");
                })
                .catch((error) => {
                    console.error("Error printing invoice:", error);
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
