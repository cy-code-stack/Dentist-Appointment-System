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
              Appointment for {{ formatDate(item.sched_date) }}
            </p>
          </div>
        </transition-group>
      </div>
      <div v-if="selectedAppointment" class="appointment_details container p-3 card">
        <div class="d-flex justify-content-between align-items center">
          <p class="mb-3 fs-1 fw-bold">Graces Dental Clinic</p>
          <div v-if="selectedAppointment.appnt_status !== 'Declined'">
            <button type="button" class="btn btn-outline-danger btn-sm" style="font-size: 12px; padding: 9px 20px; height: 45px;" @click="openCancelModal(selectedAppointment.id)">
              Cancel Appointment
            </button>
          </div>
        </div>
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
              <span class="fs-5 fw-medium mb-0 ms-3 text-black">{{ formatDate(selectedAppointment.sched_date) }}</span>
            </i>
          </div>
        </div>
        <div class="d-flex justify-content-between align-items-center m-3">
          <div class="appointment_details_card container card me-2">
            <i class="fa-solid fa-bell fs-4 fw-semibold text-black-50">
              <span class="fs-5 fw-medium mb-0 ms-3"
                :class="{
                  'text-warning': selectedAppointment.appnt_status === 'Pending Approval',
                  'text-success': selectedAppointment.appnt_status === 'Completed',
                  'text-danger': selectedAppointment.appnt_status === 'Declined',
                  'text-info': selectedAppointment.appnt_status === 'Pending',
                  'text-primary': selectedAppointment.appnt_status === 'Payment',
                }"
              >
                {{ selectedAppointment.appnt_status }}
              </span>
            </i>
          </div>
          <div class="appointment_details_card container card me-2">
            <i class="fa-solid fa-calendar-day fs-4 fw-semibold text-black-50">
              <span class="fs-5 fw-medium mb-0 ms-3 text-black">{{ selectedAppointment.sched_time }}</span>
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

  <!-- Modal for canceling appointment -->
  <div class="modal fade" id="cancelModal" tabindex="-1" aria-labelledby="cancelModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="cancelModalLabel">Cancel Appointment</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to cancel the appointment?</p>
          <textarea v-model="appointment.abort_reason" class="form-control" rows="3" placeholder="Please provide a reason (optional)"></textarea>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-danger" @click="cancelAppointment">Cancel Appointment</button>
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
        appnt_status: "",
      },
    };
  },
  methods: {
    openCancelModal(id) {
      this.appointment.id = id;
      const cancelModal = new bootstrap.Modal(document.getElementById('cancelModal'));
      cancelModal.show();
    },
    cancelAppointment() {
      if (this.appointment.abort_reason.trim() === "") {
        Swal.fire({
          icon: 'warning',
          title: 'Oops...',
          text: 'Please provide a reason for canceling.',
        });
        return;
      }
      Swal.fire({
        title: 'Are you sure?',
        text: 'You are about to cancel this appointment.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, cancel it!',
      }).then((result) => {
        if (result.isConfirmed) {
          axios.put(`/user/patient/appointment/decline/${this.appointment.id}`, {
            reason: this.appointment.abort_reason,
          })
          .then(response => {
            Swal.fire({
              icon: 'success',
              title: 'Cancelled!',
              text: 'The appointment has been cancelled successfully.',
            });
            const cancelModal = new bootstrap.Modal(document.getElementById('cancelModal'));
            cancelModal.hide();
            cancelModal.dispose();

            this.appointment.abort_reason = '';

            this.displayAppDate();
          })
          .catch(error => {
            console.error(error);
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: 'Failed to cancel the appointment.',
            });
          });
        }
      });
    },
    formatDate(dateString) {
      if (!dateString) return '';
      const date = new Date(dateString);
      return new Intl.DateTimeFormat('en-PH', {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
      }).format(date);
    },
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
    }
  },
  mounted() {
    this.displayAppDate();
  },
}
</script>
<style>
  @import '../../../../css/Patient/view_appointment.css';
  .modal-content {
    padding: 15px;
  }
  .modal-body {
    max-height: 300px;
  }
</style>