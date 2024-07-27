<template>
    <div class="container-fluid">
        <p class="fs-5 fw-semibold mb-0 p-2">Archive Page</p>

        <div class="container mt-4">
            <p class="fs-6 text-black-50 mb-1">List of Archive Patients</p>
            <table class="table table-hover text-center mb-1">
                <thead>
                    <tr>
                        <th scope="col">Patient No.</th>
                        <th scope="col">Firstname</th>
                        <th scope="col">Lastname</th>
                        <th scope="col">Address</th>
                        <th scope="col">Email</th>
                        <th scope="col">Status</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="items in listOfArchieveUser" :key="items.id">
                        <td>{{ items.id }}</td>
                        <td>{{ items.firstname }}</td>
                        <td>{{ items.lastname }}</td>
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
                                <button type="button" class="rounded-1 btn btn-success btn-sm" @click="restoreArchieve(items.id)">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <i class="fa-solid fa-trash-can-arrow-up me-2"></i>
                                        <span>Restore</span>
                                    </div>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="container-fluid d-flex justify-content-end align-items-center mb-0 p-0">
                <nav>
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">1</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">2</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">3</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

        <div class="container mt-2 ">
            <p class="fs-6 text-black-50 mb-1">List of Declined Appointments</p>
            <table class="table table-hover text-center mb-1">
                <thead>
                    <tr>
                        <th scope="col">Appointment No.</th>
                        <th scope="col">Name</th>
                        <th scope="col">Appointment Schedule</th>
                        <th scope="col">Services</th>
                        <th scope="col">Reason</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="items in listofDeclinedAppoint" :key="items.id">
                        <td>{{ items.id }}</td>
                        <td>{{ items.patient?.firstname }} {{ items.patient?.lastname }}</td>
                        <td>{{ items.sched_date }} {{ items.sched_time }}</td>
                        <td>{{ items.services?.services_name }}</td>
                        <td>{{ items.abort_reason}}</td>
                        <td><span class="text-danger fw-medium">{{ items.appnt_status }}</span></td>
                    </tr>
                </tbody>
            </table>
            <div class="container-fluid d-flex justify-content-end align-items-center mb-0 p-0">
                <nav>
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">1</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">2</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">3</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        
    </div>
</template>

<script>
import axios from 'axios';
export default {
    data(){
        return{
            listOfArchieveUser:[],
            listofDeclinedAppoint: [],
        }
    },
    methods:{
        displayArchieve(){
            axios.get('/user/staff/archieve/display').then((response)=>{
                this.listOfArchieveUser = response.data;
            }).catch((error)=>{
                console.log(error);
            });
        },
        displayDeclinedAppointment(){
            axios.get('/user/staff/appointment/declined').then((response)=>{
                this.listofDeclinedAppoint = response.data;
            }).catch((error)=>{
                console.log(error);
            });
        },
        restoreArchieve(id){
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
                            .put("/user/staff/archieve/restore/" + id)
                            .then((response) => {
                                Swal.fire("Restore!", "Patient has been restore.", "success");
                                this.displayArchieve();
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
        console.log("Component Loaded");
        this.displayArchieve();
        this. displayDeclinedAppointment();
    },
};
</script>
