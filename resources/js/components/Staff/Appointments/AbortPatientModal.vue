<template>
    <div class="modal fade" id="abort-appointment-modal">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container">
                        <div class="d-flex justify-content-between w-100">
                            <p class="fs-5 fw-medium">Archive Appointment</p>
                            <button type="button" class="btn-close btn-black" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="company-serv card w-100 mb-3 d-flex align-items-between justify-content-between p-3">
                            <p class="fs-5 fw-medium mb-2 text-center">Please state your reason</p>
                            <div class="form-group mb-1 d-flex justify-content-between w-100">
                                    <div class="me-1 mb-1">
                                        <label class="form-label mb-0">Firstname</label>
                                        <input type="text" class="form-control" v-model="abortApp.firstname" disabled/>
                                    </div>
                                    <div>
                                        <label class="form-label mb-0">Lastname</label>
                                        <input type="text" class="form-control" v-model="abortApp.lastname" disabled/>
                                    </div>
                                </div>
                                <div class="input-group mb-2">
                                    <textarea class="form-control" v-model="abortApp.abort_reason" style="resize: none; min-height: 300px !important;" aria-label="true"></textarea>
                                </div>
                                <div class="active-btn">
                                    <button type="submit" class="btn btn-danger text-white btn-md-1 w-100" @click="abortAppointment(abortApp.id)">Abort Appointment</button>
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
export default {
    props: ["selected_abort"],
    data() {
        return{
            abortApp: {
                id: '',
                firstname: '',
                lastname: '',
                abort_reason: '',
            },
        }
    },
    methods: {
        abortAppointment(id){
            axios.put('/user/staff/appointment/abort/' + id, this.abortApp).then((response)=>{
                // console.log(response);
                $('#abort-appointment-modal').modal("hide");
                this.abortApp.firstname = '',
                this.abortApp.lastname = '',
                this.abortApp.abort_reason = '',
                Swal.fire("Archive!", "Appointment has been archive.", "success");
                // Swal.fire("Declined!", "Appointment has been declined.", "success").then(() => {location.reload();});
                this.$emit("displayAbortApp");
            }).catch((error)=>{
                console.log(error);
            });
        }
    },
    watch: {
        selected_abort: {
            handler(val) {
                this.abortApp.id = val.id;
                this.abortApp.firstname = val.patient?.firstname;
                this.abortApp.lastname = val.patient?.lastname;
                this.abortApp.abort_reason = val.abort_reason;
            },
            deep: true,
        },
    },
    mounted() {
        // console.log("Component loaded");
    },
};
</script>
