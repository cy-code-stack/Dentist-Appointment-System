<template>
    <div class="container-fluid">
        <div class="container">
            <h1 class="fw-bold mt-5">Book your appointment</h1>
            <div class="container-md mt-5">
                <div class="container-fluid d-flex justify-content-center mb-3">
                    <div class="d-flex flex-column">
                        <p class="fs-6 fw-medium mb-2">Pick your service</p>
                        <div class="form-floating me-4">
                            <select class="form-select" v-model="selectedServices">
                                <option selected disabled>Choose here</option>
                                <option v-for="item in services" :key="item.id" :value="item">
                                    {{ item.services_name }}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex flex-column">
                        <p class="fs-6 fw-medium mb-2">Date</p>
                        <div class="form-floating me-4">
                            <input type="date" name="date" id="date" v-model="appointmentData.sched_date" :min="minDate" :max="maxDate" @input="onDateChange"/>
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
                        <button type="submit" class="btn btn-primary text-white" @click="submitAppointment">
                        <p class="fs-5 fw-medium text-center mb-0">Book Appointment</p>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import Swal from "sweetalert2";

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
            maxDate: "",
            times: [
                { label: "8:00 AM", value: "8:00 AM" },
                { label: "9:00 AM", value: "9:00 AM" },
                { label: "10:00 AM", value: "10:00 AM" },
                { label: "1:00 PM", value: "1:00 PM" },
                { label: "2:00 PM", value: "2:00 PM" },
                { label: "3:00 PM", value: "3:00 PM" },
                { label: "4:00 PM", value: "4:00 PM" },
            ],
        };
    },
    computed: {
        filteredTimes() {
            const currentDate = new Date();
            const selectedDate = new Date(this.appointmentData.sched_date);
            return this.times.map((time) => {
                const [hours, minutesPeriod] = time.value.split(":");
                const [minutes, period] = minutesPeriod.split(" ");
                const timeDate = new Date(selectedDate);
                timeDate.setHours(
                    period === "PM" ? parseInt(hours) + 12 : parseInt(hours),
                    parseInt(minutes)
                );

                return {
                    ...time,
                    disabled:
                        selectedDate.toDateString() ===
                            currentDate.toDateString() &&
                        timeDate < currentDate,
                };
            });
        },
    },
    methods: {
        isWeekend(date) {
            const day = new Date(date).getDay();
            return day === 0 || day === 6;
        },
        submitAppointment() {
            let formData = new FormData();

            formData.append("services_id", this.selectedServices?.id);
            formData.append("sched_date", this.appointmentData?.sched_date);
            formData.append("sched_time", this.appointmentData?.sched_time);

            Swal.fire({
                title: "Please wait...",
                text: "Booking your appointment.",
                allowOutsideClick: false,
                icon: "warning",
                showLoaderOnConfirm: true,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                },
            });

            axios
                .post("/user/patient/setAppointment", formData)
                .then((response) => {
                    this.appointmentData.sched_date = "";
                    this.appointmentData.sched_time = "";
                    this.selectedServices = "";

                    Swal.fire({
                        icon: "success",
                        title: "Booking Appointment Done",
                        text: "You may check your registered email address for confirmation.",
                    });
                })
                .catch((error) => {
                    console.log(error);
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Something went wrong! Please try again later.",
                    });
                });
        },

        displayServices() {
            axios
                .get("/user/patient/displayAppointment")
                .then((response) => {
                    this.services = response.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },

        restrictDate() {
            const today = new Date();
            const yyyy = today.getFullYear();
            const mm = String(today.getMonth() + 1).padStart(2, "0");
            const dd = String(today.getDate()).padStart(2, "0");
            this.minDate = `${yyyy}-${mm}-${dd}`;

            let futureDate = new Date(today);
            futureDate.setDate(today.getDate() + 30); // Example: 30 days into the future
            this.maxDate = `${futureDate.getFullYear()}-${String(
                futureDate.getMonth() + 1
            ).padStart(2, "0")}-${String(futureDate.getDate()).padStart(
                2,
                "0"
            )}`;

            const dateInput = document.getElementById("date");
            dateInput.addEventListener("input", (event) => {
                const selectedDate = new Date(event.target.value);
                if (this.isWeekend(selectedDate)) {
                    event.target.value = ""; 
                    Swal.fire({
                        icon: 'error',
                        title: 'Invalid Date',
                        text: 'Please set your appointment on weekdays; otherwise, your appointment will not be accommodated by the clinic.',
                    }).then(() => {
                        dateInput.value = ""; 
                    });
                }
            });
        },
    },
    mounted() {
        this.displayServices();
        this.restrictDate();
    },
};
</script>

<style>
@import "/resources/css/Patient/indexpatient.css";
</style>
