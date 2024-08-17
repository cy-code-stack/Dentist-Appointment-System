<template>
  <div class="container-fluid overflow-hidden">
    <div class="appoitment_cont d-flex justify-content-center">
      <div class="appointment_list container p-3">
        <transition-group name="fade" tag="div">
          <div
            class="appnt-card card p-4 mb-3"
            v-for="item in listofViewAppointment"
            :key="item.id"
            @click="displayAppInfo(item.id)"
            :class="{ 'highlighted': selectedAppointment && selectedAppointment.id === item.id }"
          >
            <p class="fw-semibold fs-5 mb-0 text-black-75">
              Appointment for {{ item.sched_date }}
            </p>
          </div>
        </transition-group>
      </div>
      <div v-if="selectedAppointment" class="appointment_details container p-3 card">
        <p class="mb-3 fs-1 fw-bold">Graces Dental Clinic</p>
        <p class="mb-0 fs-3 fw-semibold">Appointment Details</p>
        <hr class="text-black-75 mb-2">
        <div class="p-2">
          <p class="fs-6 fw-semibold mb-1">Services no: {{ selectedAppointment.services_id }}</p>
          <p class="mb-0 fs-3 fw-semibold">{{ selectedAppointment.appoint_services?.services_name }}</p>
        </div>
        <div class="d-flex justify-content-between align-items-center m-3 mb-0">
          <div class="appointment_details_card container card me-2">
            <i class="fa-solid fa-user fs-4 fw-semibold text-black-50">
              <span class="fs-5 fw-medium mb-0 ms-3 text-black">{{ selectedAppointment.patient?.firstname}} {{ selectedAppointment.patient?.lastname }}</span>
            </i>
          </div>
          <div class="appointment_details_card container card me-2">
            <i class="fa-solid fa-calendar-check fs-4 fw-semibold text-black-50">
              <span class="fs-5 fw-medium mb-0 ms-3 text-black">{{ selectedAppointment.sched_date }}</span>
            </i>
          </div>
        </div>
        <div class="d-flex justify-content-between align-items-center m-3">
          <div class="appointment_details_card container card me-2">
            <i class="fa-solid fa-bell fs-4 fw-semibold text-black-50">
              <span class="fs-5 fw-medium mb-0 ms-3"
                :class="{
                  'text-warning': selectedAppointment.appnt_status === 'Pending',
                  'text-success': selectedAppointment.appnt_status === 'Completed',
                  'text-danger': selectedAppointment.appnt_status === 'Declined',
                  'text-info': selectedAppointment.appnt_status === 'Ongoing',
                }"
              >
                {{ selectedAppointment.appnt_status }}
              </span>
            </i>
          </div>
          <div class="appointment_details_card container card me-2">
            <i class="fa-solid fa-calendar-day fs-4 fw-semibold text-black-50">
              <span class="fs-5 fw-medium mb-0 ms-3 text-black">{{ selectedAppointment.sched_time  }}</span>
            </i>
          </div>
        </div>
        <div v-if="selectedAppointment.appnt_status === 'Declined'" class="reason-cont mt-1 p-1 w-100">
          <p class="fs-5 fw-medium mb-1">Reason</p>
          <textarea name="reason" id="reason" class="form-control text-danger overflow-scroll" v-model="selectedAppointment.abort_reason" style="min-height: 100px; resize: none; font-weight: 600;" disabled></textarea>
        </div>
      </div>
    </div>
  </div>
</template>

  
<script>
import axios from 'axios';

export default {
  data() {
    return {
      listofViewAppointment: [],
      selectedAppointment: null,
      appointment: {
        id: "",
        patient_id: "",
        services_id: "",
        sched_date: "",
        sched_time: "",
        abort_reason: "",
        appnt_status: ""
      }
    };
  },
  methods: {
    displayAppDate() {
      axios.get('/user/patient/appointment/view')
        .then((response) => {
          this.listofViewAppointment = response.data;
          if (this.listofViewAppointment.length > 0) {
            this.selectFirstAppointment();
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    displayAppInfo(id) {
      axios.put(`/user/patient/appointment/view/${id}`, this.appointment)
        .then((response) => {
          this.selectedAppointment = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    selectFirstAppointment() {
      if (this.listofViewAppointment.length > 0) {
        const firstAppointment = this.listofViewAppointment[0];
        this.displayAppInfo(firstAppointment.id);
      }
    },
    beforeEnter(el) {
      el.style.opacity = 0;
    },
    enter(el, done) {
      el.offsetHeight; 
      el.style.transition = 'opacity 0.5s ease';
      el.style.opacity = 1;
      done();
    },
    leave(el, done) {
      el.style.transition = 'opacity 0.5s ease';
      el.style.opacity = 0;
      done();
    }
  },
  mounted() {
    this.displayAppDate();
  },
}
</script>


  
  
<style>
  @import '../../../../css/Patient/view_appointment.css';
</style>
