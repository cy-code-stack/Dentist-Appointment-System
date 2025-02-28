<template>
    <div class="container-fluid">
        <FullCalendar :options="calendarOptions"/>
        <button
            class="btn btn-primary btn-lg rounded-circle position-fixed"
            style="min-width: 4.5rem !important; min-height: 4.5rem !important; bottom: 40px; right: 30px; z-index: 999;"
            @click="addEvent">
            <i class="fa-solid fa-plus fs-3 text-center"></i>
        </button>

        <add-event-callendar-modal @eventAdded="loadAllEvents"></add-event-callendar-modal>
        <event-details-modal :event="selectedEvent" v-if="selectedEvent" @close="selectedEvent = null"></event-details-modal>
    </div>
</template>

<script>
import AddEventCallendarModal from "./AddEventCallendarModal.vue";
import EventDetailsModal from "./EventDetailsModal.vue";
import FullCalendar from "@fullcalendar/vue3";
import dayGridPlugin from "@fullcalendar/daygrid";
import interactionPlugin from "@fullcalendar/interaction";
export default {
    components: {
        FullCalendar,
        AddEventCallendarModal,
        EventDetailsModal,
    },
    data() {
        return {
            selectedEvent: null, 
            calendarOptions: {
                plugins: [dayGridPlugin, interactionPlugin],
                initialView: "dayGridMonth",
                height: 650,
                events: [],
                eventClick: this.handleEventClick,
            },
        };
    },
    methods: {
         addEvent() {
           $("#add-event-calendar-modal").modal("show");
        },

        handleEventClick({ event }) {
            this.selectedEvent = {
                title: event.title,
                start: event.start,
                end: event.end,
                extendedProps: event.extendedProps,
            };
        },
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
        }
    },
    mounted() {
        this.loadAllEvents();
    }
};
</script>
<style>
.fc-event {
    cursor: pointer;
}
</style>
