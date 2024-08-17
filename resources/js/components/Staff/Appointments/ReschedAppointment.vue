<template>
    <div class="modal fade" id="resched-appointment-modal">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container">
                        <div class="d-flex justify-content-between w-100">
                            <p class="fs-5 fw-medium">Resched Appointment</p>
                            <button type="button" class="btn-close btn-black" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="company-serv card w-100 mb-3 d-flex align-items-between justify-content-between p-3">
                            <div class="form-group mb-1 d-flex justify-content-between w-100">
                                <div class="me-1">
                                    <label class="form-label">Firstname</label>
                                    <input type="text" class="form-control" v-model="appointment.firstname" disabled/>
                                </div>
                                <div>
                                    <label class="form-label">Lastname</label>
                                    <input type="text" class="form-control" v-model="appointment.lastname" disabled/>
                                </div>
                            </div>
                            <div class="form-group mb-1">
                                <label class="form-label mb-1">Email</label>
                                <input type="email" class="form-control" v-model="appointment.email" disabled/>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <div class="form-group me-2">
                                    <label class="form-label mb-1">Date</label>
                                    <input type="date" class="form-control" v-model="appointment.sched_date" :min="todayDate" @change="updateAvailableTimes"/>
                                </div>
                                <div class="form-group w-100">
                                    <label class="form-label mb-1">Time</label>
                                    <select class="form-control" v-model="appointment.sched_time">
                                        <option v-for="time in availableTimes" :key="time" :value="time">{{ time }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="active-btn">
                            <button type="submit" class="btn btn-success text-white btn-md-1 w-100" @click="reschedAppointment(appointment.id)">Reschedule</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style>
@import "/resources/css/Patient/indexpatient.css";
</style>

<script>
import axios from 'axios';
import Swal from 'sweetalert2';

export default {
    props: ["selected_resched"],
    data() {
        return {
            appointment: {
                id: '',
                firstname: '',
                lastname: '',
                email: '',
                sched_date: '',
                sched_time: ''
            },
            todayDate: new Date().toISOString().split('T')[0], // Sets the minimum date to today
            availableTimes: []
        };
    },
    methods: {
        reschedAppointment(id) {
            const selectedDate = new Date(this.appointment.sched_date);
            const dayOfWeek = selectedDate.getDay(); 
            
            if (dayOfWeek === 0 || dayOfWeek === 6) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Invalid Date',
                    text: 'Appointments cannot be scheduled on Saturdays or Sundays.',
                    confirmButtonText: 'Okay'
                });
                return;
            }

            Swal.fire({
                title: "Please wait...",
                text: "Rescheduling an appointment.",
                allowOutsideClick: false,
                icon: "warning",
                showLoaderOnConfirm: true,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                },
            });
            axios.put('/user/staff/appointment/resched/' + id, this.appointment)
                .then((response) => {
                    $('#resched-appointment-modal').modal("hide");
                    Swal.fire({
                        icon: "success",
                        title: "Rescheduling Appointment Done",
                    });
                    this.$emit("displayReschedApp");
                }).catch((error) => {
                    console.log(error);
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Something went wrong! Please try again later.",
                    });
                });
        },
        updateAvailableTimes() {
            const now = new Date();
            const selectedDate = new Date(this.appointment.sched_date);
            const times = ["8:00 AM", "9:00 AM", "10:00 AM", "1:00 PM", "2:00 PM", "3:00 PM", "4:00 PM"];
            
            if (selectedDate.toDateString() === now.toDateString()) {
                const currentHour = now.getHours();
                const currentMinute = now.getMinutes();
                
                // Filter out times that have already passed
                this.availableTimes = times.filter(time => {
                    const [hour, period] = time.split(' ');
                    const hour24 = period === 'PM' && hour !== '12' ? parseInt(hour) + 12 : parseInt(hour);
                    return hour24 > currentHour || (hour24 === currentHour && currentMinute < 0);
                });
            } else {
                this.availableTimes = times;
            }
        }
    },
    watch: {
        selected_resched: {
            handler(val) {
                this.appointment.id = val.id;
                this.appointment.firstname = val.patient?.firstname;
                this.appointment.lastname = val.patient?.lastname;
                this.appointment.email = val.patient?.email;
                this.appointment.sched_date = val.sched_date;
                this.appointment.sched_time = val.sched_time;
                this.updateAvailableTimes(); // Update available times when the selected date changes
            },
            deep: true
        }
    }
};
</script>
