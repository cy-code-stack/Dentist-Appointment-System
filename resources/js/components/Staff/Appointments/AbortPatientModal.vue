<template>
    <div class="modal fade" id="abort-appointment-modal">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container">
                        <div class="d-flex justify-content-between w-100 mb-2">
                            <p class="fs-5 fw-medium">Abort Appointment</p>
                            <button type="button" class="btn-close btn-black" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="company-serv card w-100 mb-3 d-flex flex-column p-3">
                            <div class="form-group mb-1 d-flex justify-content-between w-100">
                                <div class="me-1 mb-1">
                                    <label class="form-label mb-0">Firstname</label>
                                    <input type="text" class="form-control" v-model="abortApp.firstname" disabled />
                                </div>
                                <div>
                                    <label class="form-label mb-0">Lastname</label>
                                    <input type="text" class="form-control" v-model="abortApp.lastname" disabled />
                                </div>
                            </div>
                            <div class="input-group mb-1">
                                <textarea
                                    class="form-control"
                                    name="abort_reason"
                                    placeholder="Please state your reason"
                                    v-model="abortApp.abort_reason"
                                    style="resize: none; min-height: 300px !important;"
                                ></textarea>
                            </div>
                            <div v-if="errors.abort_reason" class="text-danger mb-2 mt-1">
                                <small class="fw-medium">{{ errors.abort_reason[0] }}</small>
                            </div>
                            <div class="active-btn">
                                <button
                                    type="button"
                                    class="btn btn-danger text-white btn-md-1 w-100"
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
    </div>
</template>

<style>
    @import "/resources/css/Patient/indexpatient.css";
</style>

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

