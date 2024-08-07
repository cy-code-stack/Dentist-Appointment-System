<template>
    <div class="modal fade" id="resched-appointment-modal">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container">
                        <div class="d-flex justify-content-between w-100">
                            <p class="fs-5 fw-medium">Resched Appointment</p>
                            <button type="button" class="btn-close btn-black" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="company-serv card w-100 mb-3 d-flex align-items-between justify-content-between p-3">
                                <div class="form-group mb-1 d-flex justify-content-between w-100">
                                    <div class="me-1">
                                        <label class="form-label">Firstname</label>
                                        <input type="text" class="form-control" v-model="appointment.firstname" disabled/>
                                    </div>
                                    <div>
                                        <label class="form-label">Lastname</label>
                                        <input type="text" class="form-control" v-model="appointment.lastname" disabled/>
                                    </div>
                                </div>
                                <div class="form-group mb-1">
                                    <label class="form-label mb-1">Email</label>
                                    <input type="email" class="form-control" v-model="appointment.email"  disabled/>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <div class="form-group me-2">
                                        <label class="form-label mb-1">Date</label>
                                        <input type="date" class="form-control" v-model="appointment.sched_date"/>
                                    </div>
                                    <div class="form-group w-100">
                                        <label class="form-label mb-1">Time</label>
                                        <select class="form-control" v-model="appointment.sched_time">
                                            <option value="8:00 AM">8:00 AM</option>
                                            <option value="9:00 AM">9:00 AM</option>
                                            <option value="10:00 AM">10:00 AM</option>
                                            <option value="1:00 PM">1:00 PM</option>
                                            <option value="2:00 PM">2:00 PM</option>
                                            <option value="3:00 PM">3:00 PM</option>
                                            <option value="4:00 PM">4:00 PM</option>
                                        </select>
                                    </div>
                                </div>
                        </div>
                        <div class="active-btn">
                            <button type="submit" class="btn btn-success text-white btn-md-1 w-100" @click="reschedAppointment(appointment.id)">Reschedule</button>
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
    props: ["selected_resched"],
    data() {
        return {
            appointment:{
                id: '',
                firstname: '',
                lastname: '',
                email: '',
                sched_date: '',
                sched_time: ''
            },

        };
    },
    methods: {
        reschedAppointment(id){
            axios.put('/user/staff/appointment/resched/' + id, this.appointment).then((response)=>{
                $('#resched-appointment-modal').modal("hide");
                Swal.fire("Rescheduled!", "Appointment has been declined.", "success");
                this.$emit("displayReschedApp");
            }).catch((error)=>{
                console.log(error);
            });
        }
    },
    watch:{
        selected_resched: {
            handler(val) {
                console.log(val);
                this.appointment.id = val.id;
                this.appointment.firstname = val.patient?.firstname;
                this.appointment.lastname = val.patient?.lastname;
                this.appointment.email = val.patient?.email;
                this.appointment.sched_date = val.sched_date;
                this.appointment.sched_time = val.sched_time;
            },
            deep: true,
        },
    },
};
</script>
