<template>
    <div class="modal fade" id="walk-in-patient" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg p-2">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-between align-items-center">
                    <h5 class="modal-title">Walk-in Applicant</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body overflow-auto">
                    <form @submit.prevent="submitApplicant">
                        <p class="fw-medium mb-3">Fill the form for adding an applicant.</p>
                        
                        <div class="mb-3">
                            <label for="patient_id" class="form-label">Patient</label>
                            <select v-model="data.patient_id" class="form-control" aria-placeholder="Select" required>
                                <option selected disabled>Choose Patient</option>
                                <option v-for="item in patients" :key="item.id" :value="item.id">
                                    {{ item.firstname }} {{ item.middle_initial }} {{ item.lastname }}
                                </option>
                            </select>
                            <span v-if="errors.patient_id" class="text-danger">{{ errors.patient_id }}</span>
                        </div>

                        <div class="mb-3">
                            <label for="services_id" class="form-label">Service</label>
                            <select v-model="data.services_id" class="form-control" required>
                                <option selected disabled>Choose Service</option>
                                <option v-for="item in services" :key="item.id" :value="item.id">{{ item.services_name }}</option>
                            </select>
                            <span v-if="errors.services_id" class="text-danger">{{ errors.services_id }}</span>
                        </div>

                        <div class="mb-3">
                            <label for="sched_date" class="form-label">Schedule Date</label>
                            <input type="date" v-model="data.sched_date" class="form-control" required>
                            <span v-if="errors.sched_date" class="text-danger">{{ errors.sched_date }}</span>
                        </div>

                        <div class="mb-3">
                            <label for="sched_time" class="form-label">Schedule Time</label>
                            <input type="time" v-model="data.sched_time" class="form-control" required>
                            <span v-if="errors.sched_time" class="text-danger">{{ errors.sched_time }}</span>
                        </div>

                        <div class="mt-3 d-grid">
                            <button type="submit" class="btn btn-success text-white" :disabled="loading">
                                {{ loading ? 'Submitting...' : 'Add Applicant' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            data: {
                patient_id: "",
                services_id: "",
                sched_date: "",
                sched_time: ""
            },
            errors: {},
            patients: [],
            services: [],
            loading: false,
        };
    },
    mounted() {
        this.fetchPatients();
        this.fetchServices();
        this.setCurrentDateTime();
    },
    methods: {
        setCurrentDateTime() {
            const now = new Date();

            // Get current date
            const year = now.getFullYear();
            const month = String(now.getMonth() + 1).padStart(2, '0'); 
            const day = String(now.getDate()).padStart(2, '0');
            this.data.sched_date = `${year}-${month}-${day}`;

            // Get current time in am and pm format
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            this.data.sched_time = `${hours}:${minutes}`;
        },
        async fetchPatients() {
            try {
                const response = await axios.get("/user/staff/patient/show");
                this.patients = response.data.data;
            } catch (error) {
                console.error("Error fetching patients:", error);
            }
        },
        async fetchServices() {
            try {
                const response = await axios.get("/user/staff/service/show");
                this.services = response.data.data;
            } catch (error) {
                console.error("Error fetching services:", error);
            }
        },
        async submitApplicant() {
            this.loading = true;
            this.errors = {};

            // Show loading alert
            Swal.fire({
                title: "Submitting...",
                text: "Please wait while we process the application.",
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                },
            });
            try {
                const response = await axios.post("/user/staff/walkin/applicant/add", this.data);
                Swal.fire({
                    icon: "success",
                    title: "Success!",
                    text: response.data.message,
                    timer: 2000,
                    showConfirmButton: false,
                });
                this.data = { patient_id: "", services_id: "", sched_date: "", sched_time: "" };
                $('#walk-in-patient').modal("hide");
                this.$emit("displayWalkInApplicant");
            } catch (error) {
                if (error.response && error.response.data.errors) {
                    this.errors = error.response.data.errors;
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "Please check the form for errors.",
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Submission Failed",
                        text: "An unexpected error occurred. Please try again.",
                    });
                }
            } finally {
                this.loading = false;
            }
        },
    }
};
</script>
