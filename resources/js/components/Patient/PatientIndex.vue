<template>
    <div class="container-fluid">
        <div class="container">
            <h1 class="fw-bold mt-5">Book your appointment</h1>
            <p class="fs-6 text-break lh-lg">
                Welcome to Graces Dental Clinic, where scheduling appointments
                is simple and convenient. Whether you're a individual, or anyone
                in needs our service, we've got you covered. <br>The appointment is simple yet effective. Choose your service you
                want, Choose doctor, Pick a date and time, and Put your credentials.
                <br>Note: Present the confirmation email to your desired doctor at Graces Dental Clinic.
            </p>
            <div class="container-md mt-5">
                <div class="container-fluid d-flex justify-content-center mb-3">
                    <div class="d-flex flex-column">
                        <p class="fs-6 fw-medium mb-2">Pick your service</p>
                        <div class="form-floating me-4">
                            <select class="form-select">
                                <option selected disabled>Choose here</option>
                                <option value="1">Service 1</option>
                                <option value="2">Service 2</option>
                                <option value="3">Service 3</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex flex-column">
                        <p class="fs-6 fw-medium mb-2">Choose your doctor</p>
                        <div class="form-floating me-4">
                            <select class="form-select">
                                <option selected disabled>Choose here</option>
                                <option value="1">Doctor 1</option>
                                <option value="2">Doctor 2</option>
                                <option value="3">Doctor 3</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex flex-column">
                        <p class="fs-6 fw-medium mb-2">Date</p>
                        <div class="form-floating me-4">
                            <input type="date" name="date" id="date">
                        </div>
                    </div>
                </div>
                <div class="container-fluid d-flex justify-content-center align-items-center">
                    <div class="d-flex flex-column me-4">
                        <p class="fs-6 fw-medium">Time</p>
                        <div class="form-floating">
                            <select class="form-select">
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
                    <div class="form-floating">
                        <button type="submit" class="btn btn-info text-white">Book Appointment</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- <appointment-modal></appointment-modal> -->
        <!-- <book-appointment-modal></book-appointment-modal> -->
    </div>
</template>

<script>
import BookAppointmentModal from './BookAppointmentModal.vue';
export default {
    components:{
        BookAppointmentModal,
    },
    data(){
        return{
            
        }
    },
    methods :{
       
    },
    mounted(){
        console.log('Component loaded');
    },
}
</script>

<style>
@import "/resources/css/Patient/indexpatient.css";
</style>
