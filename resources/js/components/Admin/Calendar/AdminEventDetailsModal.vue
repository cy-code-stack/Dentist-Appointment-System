<template>
    <div class="modal fade show" tabindex="-1" style="background: rgba(0,0,0,0.5);">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ event.title }}</h5>
                    <button type="button" class="btn-close" aria-label="Close" @click="$emit('close')"></button>
                </div>
                <div class="modal-body">
                    <p v-if="event.extendedProps?.patientDetails">
                        <strong>Patient:</strong> {{ event.extendedProps.patientDetails.firstname }} {{ event.extendedProps.patientDetails.lastname }}
                    </p>
                    <p v-if="event.extendedProps?.service">
                        <strong>Services Rendered:</strong> {{ event.extendedProps.service.services_name }}
                    </p>
                    <p><strong>Appointment Status: </strong><span>{{ event.extendedProps?.status }}</span></p>
                    <p><strong>When:</strong> {{ event.start }}</p>
                    <p><strong>Time:</strong> {{ event.extendedProps?.time }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click="$emit('close')">Close</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        event: {
            type: Object,
            required: true,
        },
    },
};
</script>

<style>
.modal.fade.show {
    display: block !important;
}
</style>
