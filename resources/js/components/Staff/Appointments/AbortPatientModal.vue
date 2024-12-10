<template>
    <div class="modal fade" id="abort-appointment-modal" tabindex="-1" aria-labelledby="abort-appointment-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-sm" :class="{'modal-dialog-sm': isSmallScreen}">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <p class="fs-5 fw-medium mb-0">Abort Appointment</p>
                            <button type="button" class="btn-close btn-black" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                            <div class="form-group mb-3">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <label class="form-label">Firstname</label>
                                        <input type="text" class="form-control" v-model="abortApp.firstname" disabled />
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <label class="form-label">Lastname</label>
                                        <input type="text" class="form-control" v-model="abortApp.lastname" disabled />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <label class="form-label">Reason for Abortion</label>
                                <textarea class="form-control" v-model="abortApp.abort_reason" placeholder="Please state your reason"></textarea>
                            </div>
                            <div v-if="errors.abort_reason" class="text-danger mb-3">
                                <small>{{ errors.abort_reason[0] }}</small>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button
                                    type="button"
                                    class="btn btn-danger text-white w-100"
                                    @click="abortAppointment(abortApp.id)"
                                >
                                    Abort Appointment
                                </button>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import Swal from 'sweetalert2';

export default {
    props: ["selected_abort"],
    data() {
        return {
            abortApp: {
                id: '',
                firstname: '',
                lastname: '',
                abort_reason: '',
            },
            errors: {},
        };
    },
    computed: {
        isSmallScreen() {
            return window.innerWidth <= 576; // Adjust this threshold if needed
        }
    },
    methods: {
        async abortAppointment(id) {
            this.errors = {}; 

            if (!this.abortApp.abort_reason) {
                this.errors.abort_reason = ["This field is required."];
            }

            if (Object.keys(this.errors).length > 0) {
                Swal.fire({
                    icon: 'error',
                    text: this.errors.abort_reason[0],
                });
                return;
            }

            Swal.fire({
                title: "Please wait...",
                text: "Declining an appointment.",
                allowOutsideClick: false,
                icon: "warning",
                showLoaderOnConfirm: true,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                },
            });

            try {
                await axios.put(`/user/staff/appointment/abort/${id}`, this.abortApp);
                this.resetForm();
                $('#abort-appointment-modal').modal("hide");
                Swal.fire("Declined!", "Appointment has been declined.", "success");
                this.$emit("displayAbortApp");
            } catch (error) {
                console.error(error);
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Something went wrong! Please try again later.",
                });
            }
        },

        resetForm() {
            this.abortApp = {
                id: '',
                firstname: '',
                lastname: '',
                abort_reason: '',
            };
            this.errors = {};
        },
    },
    watch: {
        selected_abort: {
            handler(val) {
                this.abortApp.id = val.id || '';
                this.abortApp.firstname = val.patient?.firstname || '';
                this.abortApp.lastname = val.patient?.lastname || '';
                this.abortApp.abort_reason = val.abort_reason || '';
            },
            deep: true,
        },
    },
};
</script>
