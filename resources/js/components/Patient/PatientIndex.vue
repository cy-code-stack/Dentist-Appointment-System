<template>
    <div class="container-fluid">
        <div class="container">
            <h1 class="fw-bold mt-5">Book your appointment</h1>
            <p class="fs-6 text-break lh-lg">
                Welcome to Graces Dental Clinic, where scheduling appointments
                is simple and convenient. Whether you're an individual, or anyone
                in need of our service, we've got you covered. <br>The appointment is simple yet effective. Choose your service you
                want, Pick a date and time, and Book your Appointment.
                <br>Note: Please wait for the confirmation email and present it to the Assistant at Graces Dental Clinic for confirmation. This is <b>FIRST COME FIRST SERVE BASIS</b>.
            </p>
            <div class="container-md mt-5">
                <div class="container-fluid d-flex justify-content-center mb-3">
                    <div class="d-flex flex-column">
                        <p class="fs-6 fw-medium mb-2">Pick your service</p>
                        <div class="form-floating me-4">
                            <select class="form-select" v-model="selectedServices">
                                <option selected disabled>Choose here</option>
                                <option v-for="item in services" :key="item.id" :value="item">{{ item.services_name }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex flex-column">
                        <p class="fs-6 fw-medium mb-2">Date</p>
                        <div class="form-floating me-4">
                            <input type="date" name="date" id="date" v-model="appointmentData.sched_date" :min="minDate">
                        </div>
                    </div>
                    <div class="d-flex flex-column">
                        <p class="fs-6 fw-medium mb-2">Time</p>
                        <div class="form-floating">
                            <select class="form-select" v-model="appointmentData.sched_time">
                                <option v-for="time in filteredTimes" :key="time.value" :value="time.value" :disabled="time.disabled">
                                    {{ time.label }}
                                </option>
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
    data() {
        return {
            appointmentData: {
                id: "",
                sched_date: "",
                sched_time: "",
            },
            selectedServices: "",
            services: [],
            minDate: "",
            times: [
                { label: '8:00 AM', value: '08:00' },
                { label: '9:00 AM', value: '09:30' },
                { label: '10:00 AM', value: '10:30' },
                { label: '1:00 PM', value: '1:00' },
                { label: '2:00 PM', value: '14:00' },
                { label: '3:00 PM', value: '15:00' },
                { label: '4:00 PM', value: '16:00' }
            ],
        }
    },
    computed: {
        filteredTimes() {
            const currentDate = new Date();
            const selectedDate = new Date(this.appointmentData.sched_date);
            return this.times.map(time => {
                const [hours, minutes] = time.value.split(':');
                const timeDate = new Date(selectedDate);
                timeDate.setHours(hours, minutes);

                return {
                    ...time,
                    disabled: selectedDate.toDateString() === currentDate.toDateString() && timeDate < currentDate
                };
            });
        }
    },
    methods: {
        submitAppointment() {
            let formData = new FormData();

            formData.append('services_id', this.selectedServices?.id);
            formData.append('sched_date', this.appointmentData?.sched_date);
            formData.append('sched_time', this.appointmentData?.sched_time);

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

            axios.post('/user/patient/setAppointment', formData).then((response) => {
                this.appointmentData.sched_date = "";
                this.appointmentData.sched_time = "";
                this.selectedServices = "";

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

        displayServices() {
            axios.get('/user/patient/displayAppointment').then((response) => {
                this.services = response.data;
            }).catch((error) => {
                console.log(error);
            });
        },

        restrictDate() {
            const today = new Date();
            const yyyy = today.getFullYear();
            const mm = String(today.getMonth() + 1).padStart(2, '0');
            const dd = String(today.getDate()).padStart(2, '0');
            this.minDate = `${yyyy}-${mm}-${dd}`;
        },
    },
    mounted() {
        this.displayServices();
        this.restrictDate();
    },
}
</script>

<style>
    @import "/resources/css/Patient/indexpatient.css";
</style>
