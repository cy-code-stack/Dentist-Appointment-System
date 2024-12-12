<template>
    <div class="modal fade" id="resched-appointment-modal" tabindex="-1" aria-labelledby="reschedModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reschedModalLabel">Reschedule Appointment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body overflow-auto">
                    <form>
                        <!-- Firstname and Lastname -->
                        <div class="row g-1">
                            <div class="col-md-6">
                                <label class="form-label">Firstname</label>
                                <input type="text" class="form-control" v-model="appointment.firstname" disabled/>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Lastname</label>
                                <input type="text" class="form-control"  v-model="appointment.lastname" disabled/>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="mt-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" v-model="appointment.email" disabled/>
                        </div>

                        <!-- Date and Time -->
                        <div class="row g-3 mt-1">
                            <div class="col-md-6">
                                <label class="form-label">Date</label>
                                <input type="date" class="form-control" v-model="appointment.sched_date" :min="todayDate" @change="updateAvailableTimes"/>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Time</label>
                                <select class="form-control" v-model="appointment.sched_time">
                                    <option v-for="time in availableTimes" :key="time" :value="time">{{ time }}</option>
                                </select>
                            </div>
                        </div>
                        <div class=" mt-2 text-center">
                            <button 
                                type="button" 
                                class="btn btn-success text-white w-100" 
                                @click="reschedAppointment(appointment.id)">
                                Reschedule
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>


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
            todayDate: new Date().toISOString().split('T')[0],
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
                this.updateAvailableTimes();
            },
            deep: true
        }
    }
};
</script>
