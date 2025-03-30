<template>
    <div class="container-fluid">
        <p class="text-center fs-1 text-primary fw-semibold mb-1">Graces Dental Clinic</p>
        <p class="text-center fs-4 text-success fw-semibold">Patient Information Record</p>
            <div class="card p-3 shadow-sm">
                <div class="title-form mb-3">
                    <p class="fs-5 fw-semibold text-primary">Personal appointment</p>
                </div>
                <div class="container-fluid">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Firstname</label>
                            <input type="text" class="form-control rounded" :value="transData.user.firstname" readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Middle Initial</label>
                            <input type="text" class="form-control rounded" :value="transData.user.middle_initial" readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Lastname</label>
                            <input type="text" class="form-control rounded" :value="transData.user.lastname" readonly>
                        </div>
                    </div>

                    <div class="row g-3 mt-3">
                        <div class="col-md-4">
                            <label class="form-label">Birthdate</label>
                            <input type="date" class="form-control rounded" :value="transData.birthdate" readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Age</label>
                            <input type="text" class="form-control rounded" :value="transData.user.age" readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Religion</label>
                            <input type="text" class="form-control rounded" :value="transData.religion" readonly>
                        </div>
                    </div>

                    <div class="row g-3 mt-3">
                        <div class="col-md-6">
                            <label class="form-label">Place of Birth</label>
                            <input type="text" class="form-control rounded" :value="transData.place_of_birth" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Nationality</label>
                            <input type="text" class="form-control rounded" :value="transData.nationality" readonly>
                        </div>
                    </div>

                    <div class="row g-3 mt-3">
                        <div class="col-md-6">
                            <label class="form-label">Home Address</label>
                            <input type="text" class="form-control rounded" :value="transData.user.home_address" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Contact Number</label>
                            <input type="text" class="form-control rounded" :value="transData.user.phone_number" readonly>
                        </div>
                    </div>

                    <div class="row g-3 mt-3">
                        <div class="col-md-6">
                            <label class="form-label">Occupation</label>
                            <input type="text" class="form-control rounded" :value="transData.user.occupation" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Parents or Guardian</label>
                            <input type="text" class="form-control rounded" :value="transData.guardian" readonly>
                        </div>
                    </div>

                    <div class="row g-3 mt-3">
                        <div class="col-md-6">
                            <label class="form-label">Chief Complaint</label>
                            <input type="text" class="form-control rounded" :value="transData.chief_complaint" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Referred by</label>
                            <input type="text" class="form-control rounded" :value="transData.referred_by" readonly>
                        </div>
                    </div>
                </div>
            </div>

    
            <div class="card p-3 shadow-sm">
                <div class="title-form mb-3">
                    <p class="fs-5 fw-semibold text-primary">Dental History</p>
                </div>
                <div class="container-fluid">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Previous Dentist</label>
                            <input type="text" class="form-control rounded" :value="transData.previous_dentist" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Last Dental Visit</label>
                            <input type="text" class="form-control rounded" :value="transData.last_dental_visit" readonly>
                        </div>
                    </div>
                </div>
            </div>

    
            <div class="card p-3">
                <div class="title-form">
                    <p class="fs-5 mb-1 fw-semibold text-primary">Medical History</p>
                </div>
                <div class="physician-info mb-4">
                <!-- Physician Name and Specialty -->
                <div class="container-fluid d-flex flex-wrap justify-content-between align-items-center mb-3">
                    <!-- Physician Name -->
                    <div class="input-group me-2 mb-3 mb-md-0" style="flex: 1 1 45%">
                        <span class="input-group-text">Name of the Physician</span>
                        <input type="text" class="form-control" :value="transData.physician_name" readonly>
                    </div>
                    <!-- Specialty -->
                    <div class="input-group" style="flex: 1 1 45%">
                        <span class="input-group-text">Specialty (if applicable)</span>
                        <input type="text" class="form-control" :value="transData.specialty" readonly>
                    </div>
                </div>

                <!-- Office Address and Office Number -->
                <div class="container-fluid d-flex flex-wrap justify-content-between align-items-center mb-3">
                    <!-- Office Address -->
                    <div class="input-group me-2 mb-3 mb-md-0" style="flex: 1 1 45%">
                        <span class="input-group-text">Office Address</span>
                        <input type="text" class="form-control" :value="transData.office_address" readonly>
                    </div>
                    <!-- Office Number -->
                    <div class="input-group" style="flex: 1 1 45%">
                        <span class="input-group-text">Office Number</span>
                        <input type="text" class="form-control" :value="transData.office_number" readonly>
                    </div>
                </div>
            </div>

                <small class="mb-0 text-center">Type 'NO' or 'N/A' if you don't encounter the scenario below.</small>
                <div class="container-fluid d-flex justify-content-between align-items-center mb-2">
                    <div class="questions">
                        <p class="fs-6 mb-0">1. Are you in good health?</p>
                    </div>
                    <div class="checkboxs d-flex justify-content-center align-items-center">
                        <div class="form-check me-2">
                            <input class="form-check-input" type="radio" value="Yes" v-model="transData.good_health">
                            <label class="form-check-label">Yes</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="No" v-model="transData.good_health">
                            <label class="form-check-label">No</label>
                        </div>
                    </div>
                </div>
                <div class="container-fluid mb-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="questions">
                            <p class="fs-6 mb-1">2. Are you under medical treatment now?</p>
                        </div>
                    </div>
                    <div class="ms-5 d-flex justify-content-start align-items-center">
                        <p class="fs-6 mb-0">If so, what is the condition being treated?</p>
                        <input type="text" class="text-input ms-3" v-model="transData.medical_treatment" readonly>
                    </div>
                </div>
                <div class="container-fluid mb-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="questions">
                            <p class="fs-6 mb-1">3. Have you ever had serious illness or surgical operation?</p>
                        </div>
                    </div>
                    <div class="ms-5 d-flex justify-content-start align-items-center">
                        <p class="fs-6 mb-0">If so, what illness or operation?</p>
                        <input type="text" class="text-input ms-3" v-model="transData.surgical_operation" readonly>
                    </div>
                </div>
                <div class="container-fluid mb-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="questions">
                            <p class="fs-6 mb-0">4. Have you ever been hospitalized?</p>
                        </div>
                    </div>
                    <div class="ms-5 d-flex justify-content-start align-items-center">
                        <p class="fs-6 mb-0">If so, when and why?</p>
                        <input type="text" class="text-input" v-model="transData.hospitalized" readonly>
                    </div>
                </div>
                <div class="container-fluid mb-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="questions">
                            <p class="fs-6 mb-0">5. Are you taking any prescribtion / non-prescribtion medication?</p>
                        </div>
                    </div>
                    <div class="ms-5 d-flex justify-content-start align-items-center">
                        <p class="fs-6 mb-0">If so, pls. specify?</p>
                        <input type="text" class="text-input ms-3" v-model="transData.prescribtion_non_rescribtion_medication" readonly>
                    </div>
                </div>
                <div class="container-fluid d-flex justify-content-between align-items-center">
                    <div class="questions">
                        <p class="fs-6 mb-0">6. Do you use tabacco products?</p>
                    </div>
                    <div class="checkboxs d-flex justify-content-center align-items-center">
                        <div class="form-check me-2">
                            <input class="form-check-input" type="radio" value="Yes" v-model="transData.tabacco_products">
                            <label class="form-check-label">Yes</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="No" v-model="transData.tabacco_products">
                            <label class="form-check-label">No</label>
                        </div>
                    </div>
                </div>
                <div class="container-fluid d-flex justify-content-between align-items-center">
                    <div class="questions">
                        <p class="fs-6 mb-0">7. Do you use alcohol, cocaine, or other dangerous drugs?</p>
                    </div>
                    <div class="checkboxs d-flex justify-content-center align-items-center">
                        <div class="form-check me-2">
                            <input class="form-check-input" type="radio" value="Yes" v-model="transData.dangerous_drugs">
                            <label class="form-check-label">Yes</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="No" v-model="transData.dangerous_drugs">
                            <label class="form-check-label">No</label>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="questions">
                        <p class="fs-6 mb-1">8. Do you have allergies?</p>
                    </div>
                    <div class="checkboxs ms-5 d-flex justify-content-start align-items-center">
                        <div class="form-check">
                            <label class="form-check-label me-2 mb-1">Include what type of allergies </label>
                            <input type="textarea" class="text-input w-100" v-model="transData.allergy" readonly>
                        </div>
                    </div>
                </div>
                <div class="container-fluid d-flex justify-content-between align-items-center">
                    <div class="questions">
                        <p class="fs-6 mb-0">9. Are you pregnant?</p>
                    </div>
                    <div class="checkboxs d-flex justify-content-center align-items-center">
                        <div class="form-check me-2">
                            <input class="form-check-input" type="radio" value="Yes" v-model="transData.pregnant">
                            <label class="form-check-label">Yes</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="No" v-model="transData.pregnant">
                            <label class="form-check-label">No</label>
                        </div>
                    </div>
                </div>
                <div class="container-fluid d-flex justify-content-between align-items-center">
                    <div class="questions">
                        <p class="fs-6 mb-0">10. Are you nursing mother?</p>
                    </div>
                    <div class="checkboxs d-flex justify-content-center align-items-center">
                        <div class="form-check me-2">
                            <input class="form-check-input" type="radio" value="Yes" v-model="transData.nursing_mother">
                            <label class="form-check-label">Yes</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="No" v-model="transData.nursing_mother">
                            <label class="form-check-label">No</label>
                        </div>
                    </div>
                </div>
                <div class="container-fluid d-flex justify-content-between align-items-center">
                    <div class="questions">
                        <p class="fs-6 mb-0">11. Are you taking birth control pills?</p>
                    </div>
                    <div class="checkboxs d-flex justify-content-center align-items-center">
                        <div class="form-check me-2">
                            <input class="form-check-input" type="radio" value="Yes" v-model="transData.birth_control_pills">
                            <label class="form-check-label">Yes</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="No" v-model="transData.birth_control_pills">
                            <label class="form-check-label">No</label>
                        </div>
                    </div>
                </div>
                <div class="container-fluid d-flex justify-content-start align-items-center mb-1">
                    <p class="fs-6 mb-0">12. Blood Type: </p>
                    <input type="text" class="text-input ms-3" v-model="transData.blood_type" readonly>
                </div>
                <div class="container-fluid d-flex justify-content-start align-items-center">
                    <p class="fs-6 mb-0">13. Blood Pressure: </p>
                    <input type="text" class="text-input ms-3" v-model="transData.blood_pressure" readonly>
                </div>
                <div class="container-fluid mb-1">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="questions">
                            <p class="fs-6 mb-0">14. Do you have any health problem?</p>
                        </div>
                    </div>
                    <div class="ms-5 mb-3 d-flex justify-content-start align-items-center">
                        <p class="fs-6 mb-0">If so, what medications are you taking?</p>
                        <input type="text" class="text-input ms-3" v-model="transData.health_problem" readonly>
                    </div>
                </div>
                <div class="d-flex justify-content-end gap-2">
                    <button type="button" class="rounded-1 btn btn-info text-white" @click="printAppointment(transData.id)">
                        <div class="d-flex justify-content-center align-items-center">
                            <i class="fa-solid fa-print me-2"></i>
                            <span>Print</span>
                        </div>
                    </button>
                    <router-link :to='`/user/staff/record/teeth/${transData.id}`'>
                        <button type="button" class="btn btn-primary">Diagnostics</button>
                    </router-link>
                </div>

            </div>
    </div>
</template>
<script>
import axios from 'axios';
export default {
    data() {
        return {
            transData: {
                user: {},
            }
        };
    },
    methods: {
        getDataBasedOnId() {
            const id = this.$route.params.id;
            if (!id) {
                console.error('user ID not found in route params.');
                return;
            }
            axios.get(`/user/staff/view/${id}`)
                .then(response => {
                    this.transData = response.data.data;
                })
                .catch(error => {
                    console.error('Error fetching user data:', error.response?.data?.message || error.message);
                });
        },
        printAppointment(id) {
            axios.get(`/patient/appointment/print/${id}`)
                .then(response => {
                    const printPath = response.data.path;
                    window.open(printPath, '_blank');
                })
                .catch(error => {
                    console.error("Error printing appointment:", error.response?.data?.message || error.message);
                });
        }
    },
    mounted() {
      this.getDataBasedOnId();
    }
}
</script>


<style scoped>
    .text-input {
        width: 50%;
        box-sizing: border-box;
        height: 30px;
        padding: 5px;
        border: none;
        border-bottom: 1px solid rgb(64, 64, 64);
    }
</style>