<template>
    <div class="container-fluid">
        <div class="container">
            <h1 class="fw-bold mt-5">Book your appointment</h1>
            <p class="fs-6 text-break lh-lg">
                Welcome to Graces Dental Clinic, where scheduling appointments
                is simple and convenient. Whether you're a individual, or anyone
                in needs our service, we've got you covered. <br>The appointment is simple yet effective. Choose your service you
                want, Pick a date and time, and Book your Appointment.
                <br>Note: Please wait for the confirmation email and present it to the Assistant at Graces Dental Clinic for confirmation. This is <b>FIRST COME FIRST SERVE BASIS</b>.
            </p>
            <div class="container-md mt-5">
                <div class="container-fluid d-flex justify-content-center mb-3">
                    <div class="d-flex flex-column">
                        <p class="fs-6 fw-medium mb-2">Pick your service</p>
                        <!-- <div v-if="appoint_error.services_id" class="text-danger"><small class="fw-medium">{{ appoint_error.services_id[0] }}</small></div> -->
                        <div class="form-floating me-4">
                            <select class="form-select" v-model="selectedServices">
                                <option selected disabled>Choose here</option>
                                <option v-for="item in services" :key="item.id" :value="item">{{ item.services_name }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex flex-column">
                        <p class="fs-6 fw-medium mb-2">Date</p>
                        <!-- <div v-if="appoint_error.sched_date" class="text-danger"><small class="fw-medium">{{ appoint_error.sched_date[0] }}</small></div> -->
                        <div class="form-floating me-4">
                            <input type="date" name="date" id="date" v-model="appointmentData.sched_date" :min="minDate">
                        </div>
                    </div>
                    <div class="d-flex flex-column">
                        <p class="fs-6 fw-medium mb-2">Time</p>
                        <!-- <div v-if="appoint_error.sched_time" class="text-danger"><small class="fw-medium">{{ appoint_error.sched_time[0] }}</small></div> -->
                        <div class="form-floating">
                            <select class="form-select" v-model="appointmentData.sched_time">
                                <option disabled>Morning</option>
                                <option selected>8:00 AM</option>
                                <option> 8:30 AM - 9:30 AM</option>
                                <option> 9:30 AM - 10:30 AM</option>
                                <option> 10:30 AM - 11:30 AM</option>
                                <option disabled>Afternoon</option>
                                <option> 1:00 PM - 2:00 PM</option>
                                <option> 2:00 PM - 3:00 PM</option>
                                <option> 3:00 PM - 4:00 PM</option>
                                <option> 4:00 PM - 5:00 PM</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="container-fluid d-flex flex-column justify-content-end align-items-center">
                    <div class="form-floating">
                        <button type="submit" class="btn btn-info text-white" @click="submitAppointment">Book Appointment</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data(){
        return{
            appointmentData:{
                id : "",
                sched_date : "",
                sched_time : "",
            },
            selectedServices: "",
            services:[],
            minDate: "",
        }
    },
    methods :{
        submitAppointment() {
            let formData = new FormData();

            formData.append('services_id', this.selectedServices?.id);
            formData.append('sched_date', this.appointmentData?.sched_date);
            formData.append('sched_time', this.appointmentData?.sched_time);

            // Show the waiting alert
            Swal.fire({
                title: 'Please wait...',
                text: 'Booking your appointment.',
                allowOutsideClick: false,
                icon: 'warning',
                showLoaderOnConfirm: true,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            axios.post('/user/patient/setAppoitment', formData).then((response) => {
                this.appointmentData.sched_date = "";
                this.appointmentData.sched_time = "";
                this.selectedServices = "";

                // Close the waiting alert and show the success alert
                Swal.fire({
                    icon: 'success',
                    title: 'Booking Appointment Done',
                    text: 'You may check your registered email address for confirmation.',
                });
            }).catch((error) => {
                console.log(error);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong! Please try again later.',
                });
            });
        },


       displayServices(){
        axios.get('/user/patient/displayAppointment').then((response)=>{
            // console.log(response);
            this.services = response.data;
        }).catch((error)=>{
            console.log(error);
        });
       }
    },
    mounted(){
        console.log('Component loaded');
        this.displayServices();

        // Set the minimum date to today
        const today = new Date();
        const yyyy = today.getFullYear();
        const mm = String(today.getMonth() + 1).padStart(2, '0'); 
        const dd = String(today.getDate()).padStart(2, '0');
        this.minDate = `${yyyy}-${mm}-${dd}`;
    },
}
</script>

<style>
    @import "/resources/css/Patient/indexpatient.css";
</style>
