<template>
    <div class="container-fluid">
        <p class="fs-5 fw-semibold mb-0 p-2">Archive Page</p>

        <div class="container mt-4">
            <table class="table table-hover text-center caption-top">
                <caption>List of Archive Staffs</caption>
                <thead>
                    <tr>
                        <th scope="col">Staff No.</th>
                        <th scope="col">Firstname</th>
                        <th scope="col">Lastname</th>
                        <th scope="col">Job</th>
                        <th scope="col">Address</th>
                        <th scope="col">Email</th>
                        <th scope="col">Status</th>
                        <th scope="col">Actions</th>
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
                        <td><span class="text-danger fw-medium">{{ items.status }}</span></td>
                        <td>
                            <div class="text-center d-flex justify-content-center">
                                <!-- <button type="button" class="me-1 rounded-1 btn btn-info btn-sm text-white">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <i class="fa-solid fa-eye me-2"></i>
                                        <span>View</span>
                                    </div>
                                </button> -->
                                <button type="button" class="rounded-1 btn btn-success btn-sm" @click="restoreArchieveStaff(items.id)">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <i class="fa-solid fa-trash-can-arrow-up me-2"></i>
                                        <span>Restore Staff</span>
                                    </div>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="container mt-3">
            <table class="table table-hover text-center caption-top">
                <caption>List of Archive Refer Patients</caption>
                <thead>
                    <tr>
                        <th scope="col">Patient No.</th>
                        <th scope="col">Firstname</th>
                        <th scope="col">Lastname</th>
                        <th scope="col">Appointment Schedule</th>
                        <th scope="col">Services</th>
                        <th scope="col">Email</th>
                        <th scope="col">Status</th>
                        <!-- <th scope="col">Actions</th> -->
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="items in listofArchiveRefer" :key="items.id">
                        <td>{{ items.id }}</td>
                        <td>{{ items.patient?.firstname }}</td>
                        <td>{{ items.patient?.lastname }}</td>
                        <td>{{ items.sched_date }} {{ items.sched_time }}</td>
                        <td>{{ items.services?.services_name }}</td>
                        <td>{{ items.patient?.email }}</td>
                        <td><span class="text-danger fw-medium">{{ items.appnt_status }}</span></td>
                        <!-- <td>
                            <div class="text-center d-flex justify-content-center">
                                <button type="button" class="me-1 rounded-1 btn btn-info btn-sm text-white">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <i class="fa-solid fa-eye me-2"></i>
                                        <span>View</span>
                                    </div>
                                </button>
                                <button type="button" class="rounded-1 btn btn-success btn-sm">
                                    <div class="d-flex justify-content-center align-items-center" @click="restoreArchieveRefer(items.id)">
                                        <i class="fa-solid fa-trash-can-arrow-up me-2"></i>
                                        <span>Restore Patient</span>
                                    </div>
                                </button>
                            </div>
                        </td> -->
                    </tr>
                </tbody>
            </table>
        </div>
        
        <div class="container mt-3">
            <table class="table table-hover text-center caption-top">
                <caption>List of Archive Services</caption>
                <thead>
                    <tr>
                        <th scope="col">Services No.</th>
                        <th scope="col">Services Name</th>
                        <th scope="col">Services Requirements</th>
                        <th scope="col">Services Duration</th>
                        <th scope="col">Servies Price</th>
                        <th scope="col">Servies Status</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="servitems in listofArchiveServices" :key="servitems.id">
                        <td>{{ servitems.id }}</td>
                        <td>{{ servitems.services_name }}</td>
                        <td>{{ servitems.services_requirements }}</td>
                        <td>{{ servitems.services_duration }}</td>
                        <td>{{ servitems.services_price }}</td>
                        <td><span class="text-danger fw-medium">{{ servitems.serv_status }}</span></td>
                        <td>
                            <div class="text-center d-flex justify-content-center">
                                <!-- <button type="button" class="me-1 rounded-1 btn btn-info btn-sm text-white">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <i class="fa-solid fa-eye me-2"></i>
                                        <span>View</span>
                                    </div>
                                </button> -->
                                <button type="button" class="rounded-1 btn btn-success btn-sm" @click="restoreArchieveServices(servitems.id)">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <i class="fa-solid fa-trash-can-arrow-up me-2"></i>
                                        <span>Restore Services</span>
                                    </div>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
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

        // restoreArchieveRefer(id){
        //     Swal.fire({
        //         title: "Are you sure?",
        //         text: "You won't be able to revert this!",
        //         icon: "warning",
        //         showCancelButton: true,
        //         confirmButtonColor: "#3085d6",
        //         cancelButtonColor: "#d33",
        //         confirmButtonText: "Yes, restore it!",
        //     })
        //         .then((data) => {
        //             if (data.isConfirmed) {
        //                 axios
        //                     .put("/admin/refer/restore/" + id)
        //                     .then((response) => {
        //                         Swal.fire("Restore!", "Patient has been restore.", "success");
        //                         this.displayReferArchive();
        //                     });
        //             }
        //         })
        //         .catch((error) => {
        //             Swal.fire({
        //                 icon: "error",
        //                 text: "Something went wrong!",
        //             });
        //             console.log(error);
        //         });
        // },

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
