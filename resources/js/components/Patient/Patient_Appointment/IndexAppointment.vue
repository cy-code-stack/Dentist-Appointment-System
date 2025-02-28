<template>
  <div class="container-fluid overflow-hidden">
    <div class="appointment-container d-flex flex-column flex-md-row justify-content-center gap-4 p-3">
      <!-- Appointment List -->
      <div class="appointment-list card shadow p-3">
        <h4 class="text-center fw-bold mb-3">Appointments</h4>
        <transition-group name="fade" tag="div">
          <div
            class="appointment-card card p-3 mb-2"
            v-for="item in listofViewAppointment"
            :key="item.id"
            @click="displayAppInfo(item.id)"
            :class="{ 'highlighted': selectedAppointment && selectedAppointment.id === item.id }"
          >
            <div class="d-flex justify-content-between align-items-center">
              <p class="fw-medium text-black-75 mb-0" style="font-size: 13px;">
                <i class="fa-solid fa-calendar-day me-2 text-primary"></i> {{ formatDate(item.sched_date) }}
              </p>
              <span class="badge" :class="statusClass(item.appnt_status)">{{ item.appnt_status }}</span>
            </div>
          </div>
        </transition-group>
      </div>

      <!-- Appointment Details -->
      <div v-if="selectedAppointment" class="appointment-details card shadow p-4">
        <div class="d-flex justify-content-between align-items-center">
          <h3 class="fw-bold text-primary">Graces Dental Clinic</h3>
            <button
            v-if="selectedAppointment.appnt_status !== 'Declined' && selectedAppointment.appnt_status !== 'Completed'"
            class="btn btn-outline-danger btn-sm"
            @click="openCancelModal(selectedAppointment.id)"
            >
            Cancel Appointment
            </button>
        </div>

        <p class="fs-5 fw-semibold text-secondary mt-3">Appointment Details</p>
        <hr>

        <div class="info-section">
          <p class="text-muted small">Services No: {{ selectedAppointment.services_id }}</p>
          <h5 class="fw-bold">{{ selectedAppointment.appoint_services?.services_name }}</h5>
        </div>

        <div class="details-grid mt-3">
          <div class="detail-card">
            <i class="fa-solid fa-user text-secondary"></i>
            <span>{{ selectedAppointment.patient?.firstname }} {{ selectedAppointment.patient?.lastname }}</span>
          </div>
          <div class="detail-card">
            <i class="fa-solid fa-calendar-check text-secondary"></i>
            <span>{{ formatDate(selectedAppointment.sched_date) }}</span>
          </div>
          <div class="detail-card">
            <i class="fa-solid fa-bell text-secondary"></i>
            <span :class="statusClass(selectedAppointment.appnt_status)">
              {{ selectedAppointment.appnt_status }}
            </span>
          </div>
          <div class="detail-card">
            <i class="fa-solid fa-clock text-secondary"></i>
            <span>{{ selectedAppointment.sched_time }}</span>
          </div>
        </div>

        <!-- Reason for Declined Appointment -->
        <div v-if="selectedAppointment.appnt_status === 'Declined'" class="reason-section mt-3">
          <p class="fw-medium">Reason for Decline</p>
          <textarea
            v-model="selectedAppointment.abort_reason"
            class="form-control text-danger"
            disabled
          ></textarea>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal for canceling appointment -->
  <div class="modal fade" id="cancelModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Cancel Appointment</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to cancel the appointment?</p>
          <textarea
            v-model="appointment.abort_reason"
            class="form-control"
            rows="3"
            placeholder="Provide a reason (optional)"
          ></textarea>
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
import axios from "axios";

export default {
  data() {
    return {
      listofViewAppointment: [],
      selectedAppointment: null,
      appointment: {
        id: "",
        abort_reason: "",
      },
    };
  },
  methods: {
    openCancelModal(id) {
      this.appointment.id = id;
      new bootstrap.Modal(document.getElementById("cancelModal")).show();
    },
    cancelAppointment() {
      if (this.appointment.abort_reason.trim() === "") {
        Swal.fire({ icon: "warning", title: "Oops...", text: "Provide a reason for canceling." });
        return;
      }
      Swal.fire({
        title: "Are you sure?",
        text: "You are about to cancel this appointment.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, cancel it!",
      }).then((result) => {
        if (result.isConfirmed) {
          axios.put(`/user/patient/appointment/decline/${this.appointment.id}`, {
            reason: this.appointment.abort_reason,
          })
          .then(() => {
            Swal.fire("Cancelled!", "The appointment has been cancelled.", "success");
            this.appointment.abort_reason = "";
            this.displayAppDate();
          })
          .catch(() => Swal.fire("Error", "Failed to cancel the appointment.", "error"));
        }
      });
    },
    formatDate(dateString) {
      if (!dateString) return "";
      return new Intl.DateTimeFormat("en-PH", { year: "numeric", month: "long", day: "numeric" }).format(new Date(dateString));
    },
    statusClass(status) {
      return {
        "text-warning": status === "Pending Approval",
        "text-success": status === "Completed",
        "text-danger": status === "Declined",
        "text-info": status === "Pending",
        "text-primary": status === "Payment",
      };
    },
    displayAppDate() {
      axios.get("/user/patient/appointment/view")
        .then((response) => {
          this.listofViewAppointment = response.data;
          if (this.listofViewAppointment.length > 0) {
            this.displayAppInfo(this.listofViewAppointment[0].id);
          }
        })
        .catch(console.error);
    },
    displayAppInfo(id) {
      axios.put(`/user/patient/appointment/view/${id}`)
        .then((response) => {
          this.selectedAppointment = response.data;
        })
        .catch(console.error);
    },
  },
  mounted() {
    this.displayAppDate();
  },
};
</script>

<style>
.appointment-container {
  display: flex;
  flex-wrap: wrap;
}

.appointment-list {
  width: 300px;
  max-height: 400px;
  overflow-y: auto;
  border-radius: 10px;
}

.appointment-card {
  cursor: pointer;
  transition: all 0.3s;
}

.appointment-card:hover {
  background-color: #f0f0f0;
}

.appointment-details {
  flex-grow: 1;
  min-width: 400px;
  border-radius: 10px;
}

.details-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
  gap: 10px;
}

.detail-card {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 10px;
  background: #f8f9fa;
  border-radius: 8px;
}

.reason-section textarea {
  border-radius: 8px;
  resize: none;
}
</style>
