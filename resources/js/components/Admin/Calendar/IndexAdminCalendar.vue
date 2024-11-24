<template>
    <div class="container-fluid">
        <div
            class="d-flex justify-content-center align-items-center pb-3"
        >
            <FullCalendar :options="calendarOptions" class="w-100 h-100"/>
        </div>
    </div>
</template>

<script>
import FullCalendar from "@fullcalendar/vue3";
import dayGridPlugin from "@fullcalendar/daygrid";
import interactionPlugin from "@fullcalendar/interaction";
export default {
    components: {
        FullCalendar,
    },
    data() {
        return {
            calendarOptions: {
                plugins: [dayGridPlugin, interactionPlugin],
                initialView: "dayGridMonth",
                events: []
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
        async displayEventAdmin() {
            try {
                const response = await axios.get('/admin/calendar/display/events');
                const adminEvents = response.data.map(event => ({
                    title: event.event_name,
                    start: event.start_date,
                    end: event.end_date,
                }));
                return adminEvents;
            } catch (error) {
                console.error("Error fetching events:", error);
                return [];
            }
        },
        async displayAppointment() {
            try {
                const response = await axios.get('/admin/calendar/display/appointments');
                console.log(response);
                
                const appointmentEvents = response.data.map(appointment => ({
                    // for ${appointment.patient?.firstname} ${appointment.patient?.lastname}
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
                const adminEvents = await this.displayEventAdmin();
                const appointmentEvents = await this.displayAppointment();
                const allEvents = [...adminEvents, ...appointmentEvents];
                
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

