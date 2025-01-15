<template>
    <div class="reschedule-appointment-container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title">Reschedule Appointment</h5>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-center align-items-center pb-3">
                    <FullCalendar :options="calendarOptions" class="w-100 h-100"/>
                </div>
                <form>
                    <!-- Firstname and Lastname -->
                    <div class="row g-1">
                        <div class="col-md-6">
                            <label class="form-label">Firstname</label>
                            <input type="text" class="form-control" v-model="appointment.firstname" disabled/>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Lastname</label>
                            <input type="text" class="form-control" v-model="appointment.lastname" disabled/>
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

                    <div class="mt-2 text-center">
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
</template>

<script>
import axios from 'axios';
import Swal from 'sweetalert2';
import FullCalendar from "@fullcalendar/vue3";
import dayGridPlugin from "@fullcalendar/daygrid";
import interactionPlugin from "@fullcalendar/interaction";

export default {
    components: {
        FullCalendar
    },
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
            availableTimes: [],
            calendarOptions: {
                plugins: [dayGridPlugin, interactionPlugin],
                initialView: "dayGridMonth",
                events: [],
            },
        };
    },
    mounted(){
        this.fetchAppointmentData();
        this.loadAllEvents();
    },
    methods: {
        onEventAdded(event) {
            this.calendarOptions.events.push({
                title: event.event_name,
                start: event.start_date,
                end: event.end_date,
            });
        },
        async displayEvent(){
            try {
                const response = await axios.get('/user/staff/event/display');
                return response.data.map(event => ({
                    title: event.event_name,
                    start: event.start_date,
                    end: event.end_date,
                    color: event.is_appointment === 1 ? '#FFC107' : '#14A44D',
                }));
            } catch (error) {
                console.error("Error fetching events:", error);
                return [];
            }
        },
        async displayAppointment() {
            try {
                const response = await axios.get('/user/staff/calendar/display/appointment');
                return response.data
                    .filter(appointment => appointment.appnt_status != 'Pending Approval')
                    .map(appointment => ({
                        title: `Appointment for ${appointment.patient?.firstname} ${appointment.patient?.lastname}`,
                        start: appointment.sched_date,
                        end: appointment.sched_date,
                        color: "#004d24",
                        extendedProps: {
                            patientDetails: appointment.patient,
                            status: appointment.appnt_status,
                            time: appointment.sched_time,
                            service: appointment.appoint_services
                        },
                    }));
            } catch (error) {
                console.error("Error fetching user appointments:", error);
                return [];
            }
        },
        async loadAllEvents() {
            try {
                const calendarEvents = await this.displayEvent();
                const appointmentEvents = await this.displayAppointment();
                const allEvents = [...calendarEvents, ...appointmentEvents];
                
                this.calendarOptions.events = allEvents;
            } catch (error) {
                console.error("Error loading all events:", error);
            }
        },
        fetchAppointmentData() {
            const appointId = this.$route.params.id;
            axios.get(`/user/staff/appointment/resched/view/${appointId}`)
                .then((response) => {
                    const data = response.data;
                    this.appointment = {
                        id: data.id,
                        firstname: data.firstname,
                        lastname: data.lastname,
                        email: data.email,
                        sched_date: data.sched_date,
                        sched_time: data.sched_time,
                    };
                    this.updateAvailableTimes();
                })
                .catch((error) => {
                    console.error('Error fetching appointment data:', error);
                });
        },
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
                .then(() => {
                    Swal.fire({
                        icon: "success",
                        title: "Rescheduling Appointment Done",
                        showConfirmButton: false,
                        timer: 2000,
                    }).then(() =>{
                        this.$emit("displayReschedApp");
                        this.$router.push(`/user/staff/appointment`);
                    });
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
};
</script>

<style>
.reschedule-appointment-container {
    margin: 20px;
    padding: 20px;
}
.card {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    overflow: hidden;
}
</style>
