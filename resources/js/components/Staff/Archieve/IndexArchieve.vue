<template>
    <div class="container-fluid p-4">
        <p class="fs-4 fw-semibold text-primary mb-3">Archive Page</p>

        <!-- Banned Patients Table -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white border-bottom">
                <p class="fs-5 text-secondary mb-0">List of Banned Patients</p>
            </div>
            <div class="card-body p-3">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover text-center align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Patient No.</th>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Address</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="items in listOfArchieveUser" :key="items.id">
                                <td>{{ items.id }}</td>
                                <td>{{ items.firstname }}</td>
                                <td>{{ items.lastname }}</td>
                                <td>{{ items.home_address }}</td>
                                <td>{{ items.email }}</td>
                                <td><span class="badge bg-danger">{{ items.status }}</span></td>
                                <td>
                                    <button type="button" class="btn btn-success btn-sm d-flex align-items-center gap-2"
                                        @click="restoreArchieve(items.id)">
                                        <i class="fa-solid fa-trash-can-arrow-up"></i>
                                        Restore
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <nav class="d-flex justify-content-end mt-3">
                    <ul class="pagination gap-2">
                        <li class="page-item" :class="{ disabled: archiveCurrentPage === 1 }">
                            <a class="page-link" href="#" @click.prevent="changePage('Archive', archiveCurrentPage - 1)">
                                &laquo;
                            </a>
                        </li>
                        <li class="page-item" v-for="page in archiveTotalPages" :key="page"
                            :class="{ active: archiveCurrentPage === page }">
                            <a class="page-link" href="#" @click.prevent="changePage('Archive', page)">{{ page }}</a>
                        </li>
                        <li class="page-item" :class="{ disabled: archiveCurrentPage === archiveTotalPages }">
                            <a class="page-link" href="#" @click.prevent="changePage('Archive', archiveCurrentPage + 1)">
                                &raquo;
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

        <!-- Declined Appointments Table -->
        <div class="card shadow-sm">
            <div class="card-header bg-white border-bottom">
                <p class="fs-5 text-secondary mb-0">List of Declined Appointments</p>
            </div>
            <div class="card-body p-3">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover text-center align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Appointment No.</th>
                                <th>Name</th>
                                <th>Appointment Schedule</th>
                                <th>Services</th>
                                <th>Reason</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="items in listofDeclinedAppoint" :key="items.id">
                                <td>{{ items.id }}</td>
                                <td>{{ items.patient?.firstname }} {{ items.patient?.lastname }}</td>
                                <td>{{ items.sched_date }} {{ items.sched_time }}</td>
                                <td>{{ items.appoint_services?.services_name }}</td>
                                <td class="text-break">{{ items.abort_reason }}</td>
                                <td><span class="badge bg-danger">{{ items.appnt_status }}</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <nav class="d-flex justify-content-end mt-3">
                    <ul class="pagination gap-2">
                        <li class="page-item" :class="{ disabled: declinedCurrentPage === 1 }">
                            <a class="page-link" href="#" @click.prevent="changePage('Declined', declinedCurrentPage - 1)">
                                &laquo;
                            </a>
                        </li>
                        <li class="page-item" v-for="page in declinedTotalPages" :key="page"
                            :class="{ active: declinedCurrentPage === page }">
                            <a class="page-link" href="#" @click.prevent="changePage('Declined', page)">{{ page }}</a>
                        </li>
                        <li class="page-item" :class="{ disabled: declinedCurrentPage === declinedTotalPages }">
                            <a class="page-link" href="#" @click.prevent="changePage('Declined', declinedCurrentPage + 1)">
                                &raquo;
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
