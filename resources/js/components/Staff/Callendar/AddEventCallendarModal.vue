<template>
    <div class="modal fade" id="add-event-calendar-modal" tabindex="-1" aria-labelledby="addEventLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addEventLabel">Add Event</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body overflow-auto">
                    <form @submit.prevent="submitEvent">
                        <div class="form-check form-switch d-flex align-items-center mb-3">
                            <input class="form-check-input me-2" v-model="event.is_appointment" type="checkbox" role="switch">
                            <label class="form-check-label">Allow Appointment</label>
                        </div>
                        <div class="mb-3">
                            <label for="eventName" class="form-label">Event Name</label>
                            <input
                                type="text"
                                id="eventName"
                                class="form-control"
                                v-model="event.event_name"
                                :class="{ 'is-invalid': errors.event_name }"
                            />
                            <div v-if="errors.event_name" class="invalid-feedback">
                                {{ errors.event_name[0] }}
                            </div>
                        </div>
                        <div class="row g-3 mb-2">
                            <div class="col-md-6">
                                <label for="startDate" class="form-label">Start Date</label>
                                <input
                                    type="date"
                                    id="startDate"
                                    class="form-control"
                                    v-model="event.start_date"
                                    :min="minDate"
                                    :class="{ 'is-invalid': errors.start_date }"
                                />
                                <div v-if="errors.start_date" class="invalid-feedback">
                                    {{ errors.start_date[0] }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="endDate" class="form-label">End Date</label>
                                <input
                                    type="date"
                                    id="endDate"
                                    class="form-control"
                                    v-model="event.end_date"
                                    :min="event.start_date"
                                    :class="{ 'is-invalid': errors.end_date }"
                                />
                                <div v-if="errors.end_date" class="invalid-feedback">
                                    {{ errors.end_date[0] }}
                                </div>
                            </div>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" id="editSlotCheckbox" v-model="isEditingSlot">
                            <label class="form-check-label" for="editSlotCheckbox">Edit Appointment Slot</label>
                        </div>
                        <div v-if="isEditingSlot" class="form"> 
                            <label for="slot" class="form-label">Appointment Slot</label>
                            <input type="number" id="slot" class="form-control" v-model="event.slot"/>
                        </div>
                        <div class="d-grid mt-3">
                            <button type="submit" class="btn btn-success">Add Event</button>
                        </div>
                    </form>
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
                start_date: new Date().toISOString().split('T')[0],
                end_date: '',
                is_appointment: '',
                slot: '',
            },
            isEditingSlot: false,
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
                is_appointment: false,
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
    },
};
</script>

<style scoped>
.modal-title {
    font-weight: 600;
    color: #333;
}
.modal-body {
    padding: 1.5rem;
}
.form-label {
    font-weight: 500;
}
.btn-success {
    background-color: #28a745;
    border-color: #28a745;
}
.btn-success:hover {
    background-color: #218838;
    border-color: #1e7e34;
}
.is-invalid {
    border-color: #dc3545;
}
.invalid-feedback {
    font-size: 0.875rem;
}

</style>
