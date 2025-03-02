<template>
    <div class="container-fluid">
        <h2 class="fw-bold mb-1">Book your appointment</h2>
        <FullCalendar :options="calendarOptions"/>
        <!-- Modal -->
        <div class="modal fade" id="dateModal" tabindex="-1" aria-labelledby="dateModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="dateModalLabel">Book an Appointment</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>You selected: <b>{{ formattedSelectedDate }}</b></p>
                        <p>Remaining Slots: <strong> {{ remainingSlots !== null ? remainingSlots : "N/A" }} </strong></p>
                        <form @submit.prevent="bookAppointment">
                            <div class="mb-3">
                                <label for="service" class="form-label">Service</label>
                                <select class="form-select" id="service" v-model="selectedService">
                                    <option v-for="item in services" :key="item.id" :value="item">
                                        {{ item.services_name }}
                                    </option>
                                </select>
                            </div>
                            <div class="floating mb-3">
                                <label for="service" class="form-label">Time</label>
                                <select class="form-select" v-model="appointmentData.sched_time">
                                    <option v-for="time in filteredTimes" :key="time.value" :value="time.value" :disabled="time.disabled">
                                        {{ time.label }}
                                    </option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Confirm Appointment</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import FullCalendar from "@fullcalendar/vue3";
import dayGridPlugin from "@fullcalendar/daygrid";
import interactionPlugin from "@fullcalendar/interaction";
import axios from "axios";
import * as bootstrap from "bootstrap";
import Swal from "sweetalert2";

export default {
    components: {
        FullCalendar,
    },
    data() {
        return {
            calendarOptions: {
                plugins: [dayGridPlugin, interactionPlugin],
                initialView: "dayGridMonth",
                aspectRatio: 1.5,
                height: '100%',
                height: "auto",
                dateClick: this.handleDateClick,
                events: [], 
                dayCellDidMount: (info) => {
                    const today = new Date().setHours(0, 0, 0, 0);
                    const cellDate = new Date(info.date).setHours(0, 0, 0, 0);

                    // Check if the date is in the past
                    if (cellDate < today) {
                        info.el.classList.add("past-date");
                    }

                    // Check if it's a Sunday (0 = Sunday)
                    if (info.date.getDay() === 0) {
                        info.el.classList.add("disabled-day");
                        info.el.style.pointerEvents = "none";
                        info.el.style.opacity = "0.5"; 
                    }
                },
            },
            appointmentData: {
                id: "",
                sched_date: null,
                sched_time: null,
            },
            services: [],
            selectedService: null,
            times: [
                { label: "8:00 AM", value: "8:00 AM" },
                { label: "9:00 AM", value: "9:00 AM" },
                { label: "10:00 AM", value: "10:00 AM" },
                { label: "1:00 PM", value: "1:00 PM" },
                { label: "2:00 PM", value: "2:00 PM" },
                { label: "3:00 PM", value: "3:00 PM" },
                { label: "4:00 PM", value: "4:00 PM" },
            ],
            remainingSlots: null,
            bookedSlots: [],
        };
    },
    watch: {
        "appointmentData.sched_date": function (newDate) {
            if (newDate) this.fetchRemainingSlots();
        },
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

                const isDisabled = selectedDate.toDateString() === currentDate.toDateString() && timeDate < currentDate || this.bookedSlots.includes(time.value);

                return {
                    ...time,
                    disabled: isDisabled,
                };
            });
        },
        formattedSelectedDate() {
            if (!this.appointmentData.sched_date) return "";
            const date = new Date(this.appointmentData.sched_date);
            return new Intl.DateTimeFormat("en-PH", {
                weekday: "long",
                year: "numeric",
                month: "long",
                day: "numeric",
            }).format(date);
        },
    },
    methods: {
        async filterTimeAppointment() {
            try {
                const response = await axios.get('/user/patient/filterTime', {
                    params: { sched_date: this.appointmentData.sched_date }
                });
                this.bookedSlots = Array.isArray(response.data.available_times) ? response.data.available_times : [];
            } catch (error) {
                console.error("Error filtering time appointments:", error);
                this.bookedSlots = [];
            }
        },

        async fetchRemainingSlots() {
            try {
                if (!this.appointmentData.sched_date) {
                    this.remainingSlots = null;
                    return;
                }
                const response = await axios.get("/user/patient/countAppointment", {
                    params: { sched_date: this.appointmentData.sched_date },
                });
                const clickedDate = new Date(this.appointmentData.sched_date);
                const eventResponse = await axios.get("/user/patient/display/event");
                const clickedEvent = eventResponse.data.find((event) => {
                    const eventStartDate = new Date(event.start_date);
                    const eventEndDate = new Date(event.end_date);
                    return clickedDate >= eventStartDate && clickedDate <= eventEndDate;
                });

                if (clickedEvent) {
                    this.remainingSlots = clickedEvent.slot <= 0 ? response.data.remaining_slots || {} : clickedEvent.slot;
                } else {
                    this.remainingSlots = response.data.remaining_slots || {};
                }
            } catch (error) {
                console.error("Error fetching remaining slots:", error);
                this.remainingSlots = "Error";
            }
        },
        async handleDateClick(info) {
            const currentDate = new Date();
            const clickedDate = new Date(info.dateStr);
            this.appointmentData.sched_date = info.dateStr;
            this.filterTimeAppointment();

            // Check if the clicked date is a Sunday (0 = Sunday)
            if (clickedDate.getDay() === 0) {
                Swal.fire("Invalid!", "Appointments are not available on Sundays.", "error");
                return; // Stop further execution
            }
            
            if (clickedDate < currentDate) {
                Swal.fire("Invalid!", "Date is not Available", "error");
                return;
            }

            try {
                const response = await axios.get("/user/patient/display/event");
                const clickedEvent = response.data.find((event) => {
                    const eventStartDate = new Date(event.start_date);
                    const eventEndDate = new Date(event.end_date);
                    return clickedDate >= eventStartDate && clickedDate <= eventEndDate;
                });
                if (clickedEvent && clickedEvent.is_appointment === 1) {
                    Swal.fire(
                        "Warning!",
                        "Dentist Prior Appointment.",
                        "warning"
                    );
                    return;
                }
                const modalElement = document.getElementById("dateModal");
                const modalInstance = new bootstrap.Modal(modalElement);
                modalInstance.show();
            } catch (error) {
                console.error("Error fetching events:", error);
            }
        },
        async bookAppointment() {
            if (!this.selectedService) {
                Swal.fire("Error", "Please select a service.", "error");
                return;
            }

            try {
                Swal.fire({
                    title: "Booking your appointment...",
                    allowOutsideClick: false,
                    icon: "info",
                    showConfirmButton: false,
                    didOpen: () => {
                        Swal.showLoading();
                    },
                });

                const formData = new FormData();
                formData.append("services_id", this.selectedService.id);
                formData.append("sched_date", this.appointmentData.sched_date);
                formData.append("sched_time", this.appointmentData.sched_time);

                const response = await axios.post(
                    "/user/patient/setAppointment",
                    formData
                );

                const modalElement = document.getElementById("dateModal");
                const modalInstance = bootstrap.Modal.getInstance(modalElement);
                modalInstance.hide();

                Swal.fire(
                    "Success",
                    response.data.message || "Appointment booked successfully!",
                    "success"
                );

                this.selectedService = null;
                this.appointmentData = { id: "", sched_date: null, sched_time: null };

                this.fetchRemainingSlots();
                this.loadAllEvents();
            } catch (error) {
                Swal.fire("Error", "Failed to book appointment. Please try again.", "error");
                console.error("Error booking appointment:", error);
            }
        },
        async displayAppointment() {
            try {
                const response = await axios.get("/user/patient/display/appointment");
                const currentDate = new Date().setHours(0, 0, 0, 0);

                return response.data.map((appointment) => {
                    const appointmentDate = new Date(appointment.sched_date).setHours(0, 0, 0, 0); 
                    return {
                        title: `Appointment for ${appointment.appoint_services?.services_name}`,
                        start: appointment.sched_date,
                        end: appointment.sched_date,
                        color: appointmentDate < currentDate ? "#6c757d" : "#14A44D", 
                    };
                });
            } catch (error) {
                console.error("Error fetching user appointments:", error);
                return [];
            }
        },
        async displayEvent() {
            try {
                const response = await axios.get("/user/patient/display/event");
                const currentDate = new Date().setHours(0, 0, 0, 0);

                return response.data.map((event) => {
                    const eventDate = new Date(event.start_date).setHours(0, 0, 0, 0); 

                    return {
                        id: event.id,
                        title: event.event_name,
                        start: event.start_date,
                        end: event.end_date,
                        color: eventDate < currentDate ? "#D3D3D3" : (event.is_appointment === 1 ? "#FAA0A0" : "#14A44D"), 
                    };
                });
            } catch (error) {
                console.error("Error fetching events:", error);
                return [];
            }
        },

        async loadAllEvents() {
            try {
                const appointmentEvents = await this.displayAppointment();
                const calendarEvent = await this.displayEvent();
                const allEvents = [...calendarEvent, ...appointmentEvents];

                this.calendarOptions.events = allEvents;
            } catch (error) {
                console.error("Error loading all events:", error);
            }
        },
        async displayServices() {
            try {
                const response = await axios.get("/user/patient/displayAppointment");
                this.services = response.data || [];
            } catch (error) {
                console.error("Error fetching services:", error);
            }
        },
    },
    mounted() {
        this.displayServices();
        this.displayEvent().then(() => {
            this.loadAllEvents();
        });
    },
};
</script>


<style scoped>
    .disabled-day {
        background-color: #efa4aa !important; 
        color: #721c24 !important;
    }
    .calendar-container {
        width: 100%;
        width: 100%;
        margin: 0 auto;
    }
    .past-date {
        background-color: #121111 !important;
        pointer-events: none;
        cursor: not-allowed;
    }
    .fc {
        width: 100% !important;
    }
    @media (max-width: 768px) {
        .calendar-container {
            padding: 0 1rem;
        }
    }
</style>
