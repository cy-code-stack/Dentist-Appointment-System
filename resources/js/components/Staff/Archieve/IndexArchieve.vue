<template>
    <div class="container-fluid">
        <p class="fs-5 fw-semibold mb-0 p-2">Archive Page</p>

        <div class="container mt-4">
            <p class="fs-6 text-black-50 mb-1">List of Banned Patients</p>
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
            <div class="container-fluid d-flex justify-content-end align-items-center">
                <nav>
                    <ul class="pagination">
                        <li class="page-item" :class="{ disabled: archiveCurrentPage === 1 }">
                            <a class="page-link" href="#" @click.prevent="changePage('Archive', archiveCurrentPage - 1)" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <li class="page-item" 
                            v-for="page in archiveTotalPages" 
                            :key="page" 
                            :class="{ active: archiveCurrentPage === page }">
                            <a class="page-link" href="#" @click.prevent="changePage('Archive', page)">{{ page }}</a>
                        </li>
                        <li class="page-item" :class="{ disabled: archiveCurrentPage === archiveTotalPages }">
                            <a class="page-link" href="#" @click.prevent="changePage('Archive', archiveCurrentPage + 1)" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

        <div class="container mt-2">
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
                        <td>{{ items.appoint_services?.services_name }}</td>
                        <td class="text-break">{{ items.abort_reason }}</td>
                        <td><span class="text-danger fw-medium">{{ items.appnt_status }}</span></td>
                    </tr>
                </tbody>
            </table>
            <div class="container-fluid d-flex justify-content-end align-items-center">
                <nav>
                    <ul class="pagination">
                        <li class="page-item" :class="{ disabled: declinedCurrentPage === 1 }">
                            <a class="page-link" href="#" @click.prevent="changePage('Declined', declinedCurrentPage - 1)" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <li class="page-item" 
                            v-for="page in declinedTotalPages" 
                            :key="page" 
                            :class="{ active: declinedCurrentPage === page }">
                            <a class="page-link" href="#" @click.prevent="changePage('Declined', page)">{{ page }}</a>
                        </li>
                        <li class="page-item" :class="{ disabled: declinedCurrentPage === declinedTotalPages }">
                            <a class="page-link" href="#" @click.prevent="changePage('Declined', declinedCurrentPage + 1)" aria-label="Next">
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
import axios from "axios";
export default {
    data() {
        return {
            listOfArchieveUser: [],
            listofDeclinedAppoint: [],
            archiveCurrentPage: 1,
            archiveTotalPages: 1,
            declinedCurrentPage: 1,
            declinedTotalPages: 1,
            perPage: 5,
        };
    },
    methods: {
        displayArchieve(page = 1) {
            axios.get("/user/staff/archieve/display", {
                params: {
                    page: page,
                    limit: this.perPage,
                },
            }).then((response) => {
                this.listOfArchieveUser = response.data.data;
                this.archiveCurrentPage = response.data.meta.current_page;
                this.archiveTotalPages = response.data.meta.last_page;
            }).catch((error) => {
                console.error(error);
            });
        },
        displayDeclinedAppointment(page = 1) {
            axios.get("/user/staff/appointment/declined", {
                params: {
                    page: page,
                    limit: this.perPage,
                },
            }).then((response) => {
                this.listofDeclinedAppoint = response.data.data;
                this.declinedCurrentPage = response.data.meta.current_page;
                this.declinedTotalPages = response.data.meta.last_page;
            }).catch((error) => {
                console.error(error);
            });
        },
        changePage(type, page) {
            if (type === "Archive" && page > 0 && page <= this.archiveTotalPages) {
                this.displayArchieve(page);
            } else if (type === "Declined" && page > 0 && page <= this.declinedTotalPages) {
                this.displayDeclinedAppointment(page);
            }
        },
        restoreArchieve(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, restore it!",
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.put(`/user/staff/archieve/restore/${id}`).then(() => {
                        Swal.fire("Restored!", "Patient has been restored.", "success");
                        this.displayArchieve();
                    }).catch((error) => {
                        Swal.fire("Error", "Something went wrong!", "error");
                        console.error(error);
                    });
                }
            });
        },
    },
    mounted() {
        this.displayArchieve();
        this.displayDeclinedAppointment();
    },
};
</script>
