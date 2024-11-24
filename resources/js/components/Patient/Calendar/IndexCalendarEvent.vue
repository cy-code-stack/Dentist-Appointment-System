<template>
    <div class="container-fluid">
        <div class="d-flex justify-content-center align-items-center p-3">
            <FullCalendar :options="calendarOptions" class="w-100 h-100"/>
        </div>
    </div>
</template>

<script>
import FullCalendar from "@fullcalendar/vue3";
import dayGridPlugin from "@fullcalendar/daygrid";
import interactionPlugin from "@fullcalendar/interaction";
import axios from 'axios';

export default {
    components: {
        FullCalendar
    },
    data() {
        return {
            calendarOptions: {
                plugins: [dayGridPlugin, interactionPlugin],
                initialView: "dayGridMonth",
                events: [],
            },
        };
    },
    methods: {
        onEventAdded(event) {
            this.calendarOptions.events.push({
                title: event.event_name,
                start: event.start_date,
                end: event.end_date,
            });
        },
        async displayAppointment() {
            try {
                const response = await axios.get('/user/patient/display/appointment');
                const appointmentEvents = response.data.map(appointment => ({
                    title: `Appointment for ${appointment.appoint_services?.services_name}`,
                    start: appointment.sched_date,
                    end: appointment.sched_date,
                    color: appointment.color || '#14A44D',
                }));
                return appointmentEvents;
            } catch (error) {
                console.error("Error fetching user appointments:", error);
                return [];
            }
        },
        async loadAllEvents() {
            try {
                // const patientEvents = await this.displayEventPatient();
                const appointmentEvents = await this.displayAppointment();
                const allEvents = [...appointmentEvents];
                
                this.calendarOptions.events = allEvents;
            } catch (error) {
                console.error("Error loading all events:", error);
            }
        }
    },
    mounted() {
        this.loadAllEvents();
    }
};
</script>
