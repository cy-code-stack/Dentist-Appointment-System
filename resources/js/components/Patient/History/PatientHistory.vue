<template>
    <div class="container-fluid py-4">
        <div class="container">
            <h5 class="text-center"><b>Grace's Dental Clinic</b><br><br>Patient History</h5><br>
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered">
                   <thead>
                        <tr>
                            <th>Date</th>
                            <th>Services</th>
                            <th>Tooth</th>
                            <th>Surface</th>
                            <th>Fee</th>
                            <th>Balance</th>
                            <th>Status</th>
                        </tr>
                   </thead>
                   <tbody>
                        <tr v-for="(item, index) in patientHistory" :key="index">
                            <td>{{ formatWordyDate(item?.created_at) }}</td>
                            <td>{{ item.services?.services_name }}</td>
                            <td>{{ item?.tooth }}</td>
                            <td>{{ item?.surface }}</td>
                            <td>{{ item?.fee }}</td>
                            <td>{{ item?.balance }}</td>
                            <td>{{ item?.status }}</td>
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
            patientHistory: [],      
        };
    },
    methods: {
        displayHistory() {
            axios.get('/user/patient/history/get')
                .then((response) => {
                    this.patientHistory = response.data.data;
                })
                .catch((error) => {
                    console.error(error);
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
