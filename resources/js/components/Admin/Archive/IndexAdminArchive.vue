<template>
    <div class="container-fluid py-3">
        <p class="fs-4 fw-bold text-primary text-center">Archive Management</p>

        <!-- Archive Staff Table -->
        <div class="container mt-4">
            <div class="card shadow-sm p-3">
                <h5 class="card-title text-center text-secondary">Archived Staff</h5>
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered text-center">
                        <caption class="text-muted">List of Archived Staff</caption>
                        <thead class="table-info">
                            <tr>
                                <th>Staff No.</th>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Job</th>
                                <th>Address</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="items in listOfArchieveStaff" :key="items.id">
                                <td>{{ items.id }}</td>
                                <td>{{ items.firstname }}</td>
                                <td>{{ items.lastname }}</td>
                                <td>{{ items.role }}</td>
                                <td>{{ items.home_address }}</td>
                                <td>{{ items.email }}</td>
                                <td>
                                    <span class="badge bg-danger">{{ items.status }}</span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-success rounded-2 shadow-sm" @click="restoreArchieveStaff(items.id)">
                                        <i class="fa-solid fa-trash-can-arrow-up me-2"></i>Restore
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Archive Patients Table -->
        <div class="container mt-4">
            <div class="card shadow-sm p-3">
                <h5 class="card-title text-center text-secondary">Archived Referred Patients</h5>
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered text-center">
                        <caption class="text-muted">List of Archived Patients</caption>
                        <thead class="table-info">
                            <tr>
                                <th>Patient No.</th>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Appointment Schedule</th>
                                <th>Services</th>
                                <th>Email</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="items in listofArchiveRefer" :key="items.id">
                                <td>{{ items.id }}</td>
                                <td>{{ items.patient?.firstname }}</td>
                                <td>{{ items.patient?.lastname }}</td>
                                <td>{{ items.sched_date }} {{ items.sched_time }}</td>
                                <td>{{ items.appoint_services?.services_name }}</td>
                                <td>{{ items.patient?.email }}</td>
                                <td>
                                    <span class="badge bg-danger">{{ items.appnt_status }}</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Archive Services Table -->
        <div class="container mt-4">
            <div class="card shadow-sm p-3">
                <h5 class="card-title text-center text-secondary">Archived Services</h5>
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered text-center">
                        <caption class="text-muted">List of Archived Services</caption>
                        <thead class="table-info">
                            <tr>
                                <th>Services No.</th>
                                <th>Services Name</th>
                                <th>Service Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="servitems in listofArchiveServices" :key="servitems.id">
                                <td>{{ servitems.id }}</td>
                                <td>{{ servitems.services_name }}</td>
                                <td>
                                    <span class="badge bg-danger">{{ servitems.serv_status }}</span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-success rounded-2 shadow-sm" @click="restoreArchieveServices(servitems.id)">
                                        <i class="fa-solid fa-trash-can-arrow-up me-2"></i>Restore
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import Swal from 'sweetalert2';
export default {
    data(){
        return{
            listOfArchieveStaff:[],
            listofArchiveServices:[],
            listofArchiveRefer:[],
        }
    },
    methods:{
        displayStaffArchive(){
            axios.get('/admin/staff/archive/display').then((response)=>{
                this.listOfArchieveStaff = response.data.data;
            }).catch((error)=>{
                console.log(error);
            });
        },

        displayReferArchive(){
            axios.get('/admin/refer/archive').then((response)=>{
                this.listofArchiveRefer = response.data.data;
            }).catch((error)=>{
                console.log(error);
            });
        },

        displaySerViceArchive(){
            axios.get('/admin/services/archive').then((response)=>{
                this.listofArchiveServices = response.data.data;
            }).catch((error)=>{
                console.log(error);
            });
        }, 


        restoreArchieveStaff(id){
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, restore it!",
            })
                .then((data) => {
                    if (data.isConfirmed) {
                        axios
                            .put("/admin/staff/restore/" + id)
                            .then((response) => {
                                Swal.fire("Restore!", "Staff has been restore.", "success");
                                this.displayStaffArchive();
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

        restoreArchieveServices(id){
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, restore it!",
            })
                .then((data) => {
                    if (data.isConfirmed) {
                        axios
                            .put("/admin/services/restore/" + id)
                            .then((response) => {
                                Swal.fire("Restore!", "Services has been restore.", "success");
                                this.displaySerViceArchive();
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
    },
    mounted() {
        this.displayStaffArchive();
        this.displayReferArchive();
        this.displaySerViceArchive();
    },
};
</script>
