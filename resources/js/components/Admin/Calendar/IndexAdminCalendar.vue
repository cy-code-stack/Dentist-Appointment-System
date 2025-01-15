<template>
    <div class="container-fluid">
        <div class="d-flex justify-content-center align-items-center pb-3">
            <FullCalendar :options="calendarOptions" class="w-100 h-100"/>
        </div>
    </div>
    <admin-event-details-modal :event="selectedEvent" v-if="selectedEvent" @close="selectedEvent = null"></admin-event-details-modal>
</template>

<script>
import FullCalendar from "@fullcalendar/vue3";
import AdminEventDetailsModal from "./AdminEventDetailsModal.vue";
import dayGridPlugin from "@fullcalendar/daygrid";
import interactionPlugin from "@fullcalendar/interaction";
export default {
    components: {
        FullCalendar,
        AdminEventDetailsModal,
    },
    data() {
        return {
            selectedEvent: null, 
            calendarOptions: {
                plugins: [dayGridPlugin, interactionPlugin],
                initialView: "dayGridMonth",
                events: [],
                eventClick: this.handleEventClick,
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
        handleEventClick({ event }) {
            this.selectedEvent = {
                title: event.title,
                start: event.start,
                end: event.end,
                extendedProps: event.extendedProps,
            };
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
                return response.data
                    .filter(appointment => appointment.appnt_status != 'Pending Approval')
                    .map(appointment => ({
                        title: `Appointment ${appointment.patient?.firstname} ${appointment.patient?.lastname}`,
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

