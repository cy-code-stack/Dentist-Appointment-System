<template>
    <div class="modal fade" id="add-event-calendar-modal">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container">
                        <form @submit.prevent="submitEvent">
                            <div class="d-flex justify-content-between w-100">
                                <p class="fs-5 fw-medium">Add Event</p>
                                <button
                                    type="button"
                                    class="btn-close btn-black"
                                    data-bs-dismiss="modal"
                                    aria-label="Close"
                                ></button>
                            </div>
                            <div class="company-serv card w-100 mb-3 d-flex align-items-between justify-content-between p-3">
                                <div class="form-group mb-1">
                                    <label class="form-label mb-1">Event Name</label>
                                    <input type="text" name="event_name" class="form-control" v-model="event.event_name"/>
                                    <div v-if="errors.event_name" class="text-danger">
                                        <small class="fw-medium">{{ errors.event_name[0] }}</small>
                                    </div>
                                </div>
                                <div class="form-group w-100 mb-1">
                                    <label class="form-label mb-1">Start Date</label>
                                    <input type="date" class="form-control" name="start_date" :min="minDate" v-model="event.start_date"/>
                                    <div v-if="errors.start_date" class="text-danger">
                                        <small class="fw-medium">{{ errors.start_date[0] }}</small>
                                    </div>
                                </div>
                                <div class="form-group w-100">
                                    <label class="form-label mb-1">End Date</label>
                                    <input type="date" class="form-control" name="end_date" :min="event.start_date" v-model="event.end_date"/>
                                    <div v-if="errors.end_date" class="text-danger">
                                        <small class="fw-medium">{{ errors.end_date[0] }}</small>
                                    </div>
                                </div>
                                <div class="active-btn">
                                    <button type="submit" class="btn btn-success text-white btn-md-1 w-100">
                                        Add Event
                                    </button>
                                </div>
                            </div>
                        </form>
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
            event: {
                event_name: '',
                start_date: '',
                end_date: '',
            },
            minDate: "",
            errors: {},
        };
    },
    methods: {
        restrictDate() {
            const today = new Date();
            const yyyy = today.getFullYear();
            const mm = String(today.getMonth() + 1).padStart(2, '0');
            const dd = String(today.getDate()).padStart(2, '0');
            this.minDate = `${yyyy}-${mm}-${dd}`;
        },
        closeModal() {
            $("#add-event-calendar-modal").modal("hide");
        },
        resetForm() {
            this.event = {
                event_name: '',
                start_date: '',
                end_date: '',
            };
            this.errors = {};
        },
        async submitEvent() {
            try {
                const response = await axios.post('/user/staff/event/store', this.event);
                this.resetForm();
                this.closeModal();
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Event has been added!",
                    showConfirmButton: false,
                    timer: 1500,
                });
                this.$emit("eventAdded", response.data);
            } catch (error) {
                if (error.response && error.response.data.errors) {
                    this.errors = error.response.data.errors;
                } else {
                    console.error("An error occurred:", error);
                }
            }
        },
    },
    mounted() {
        this.restrictDate();
    }
};
</script>
