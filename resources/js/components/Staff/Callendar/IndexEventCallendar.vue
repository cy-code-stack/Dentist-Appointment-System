<template>
    <div class="container-fluid">
        <div
            class="d-flex justify-content-center align-items-center pb-3"
        >
            <FullCalendar :options="calendarOptions" class="w-100 h-100"/>
        </div>
        <button
            class="btn btn-primary btn-lg rounded-circle position-fixed"
            style="
                min-width: 4.5rem !important;
                min-height: 4.5rem !important;
                bottom: 40px;
                right: 30px;
                z-index: 999;
            "
            @click="addEvent"
        >
            <i class="fa-solid fa-plus fs-3 text-center"></i>
        </button>

        <add-event-callendar-modal @eventAdded="loadAllEvents"></add-event-callendar-modal>
    </div>
</template>

<script>
import AddEventCallendarModal from "./AddEventCallendarModal.vue";
import FullCalendar from "@fullcalendar/vue3";
import dayGridPlugin from "@fullcalendar/daygrid";
import interactionPlugin from "@fullcalendar/interaction";
import { color } from "chart.js/helpers";
export default {
    components: {
        FullCalendar,
        AddEventCallendarModal,
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
        addEvent() {
           $("#add-event-calendar-modal").modal("show");
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
                    .filter(appointment => appointment.appnt_status === 'Approved')
                    .map(appointment => ({
                        title: `Appointment ${appointment.patient?.firstname} ${appointment.patient?.lastname}`,
                        start: appointment.sched_date,
                        end: appointment.sched_date,
                        color: "#004d24",
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

