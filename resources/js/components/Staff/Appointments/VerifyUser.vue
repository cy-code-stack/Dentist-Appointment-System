<template>
    <div class="container-fluid">
        <p class="text-center fs-1 text-primary fw-semibold mb-1">Graces Dental Clinic</p>
        <p class="text-center fs-4 text-success fw-semibold">Patient Information Record</p>

        <form @submit.prevent="recomendDentist">
            <div class="card p-3 shadow-sm">
                <div class="title-form mb-3">
                    <p class="fs-5 fw-semibold text-primary">Personal Information</p>
                </div>
                <div class="container-fluid">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Firstname</label>
                            <input type="text" class="form-control rounded" v-model="patientData.patient.firstname" readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Middle Initial</label>
                            <input type="text" class="form-control rounded" v-model="patientData.patient.middle_initial" readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Lastname</label>
                            <input type="text" class="form-control rounded" v-model="patientData.patient.lastname" readonly>
                        </div>
                    </div>

                    <div class="row g-3 mt-3">
                        <div class="col-md-4">
                            <label class="form-label">Birthdate</label>
                            <input type="date" class="form-control rounded" v-model="patientData.patient.birthdate" readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Age</label>
                            <input type="text" class="form-control rounded" v-model="patientData.patient.age" readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Religion</label>
                            <input type="text" class="form-control rounded" v-model="information.religion">
                            <div v-if="errors.religion" class="text-danger mt-1"><small>{{ errors.religion[0] }}</small></div>
                        </div>
                    </div>

                    <div class="row g-3 mt-3">
                        <div class="col-md-6">
                            <label class="form-label">Place of Birth</label>
                            <input type="text" class="form-control rounded" v-model="information.place_of_birth">
                            <div v-if="errors.place_of_birth" class="text-danger mt-1"><small>{{ errors.place_of_birth[0] }}</small></div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Nationality</label>
                            <input type="text" class="form-control rounded" v-model="information.nationality">
                            <div v-if="errors.nationality" class="text-danger mt-1"><small>{{ errors.nationality[0] }}</small></div>
                        </div>
                    </div>

                    <div class="row g-3 mt-3">
                        <div class="col-md-6">
                            <label class="form-label">Home Address</label>
                            <input type="text" class="form-control rounded" v-model="patientData.patient.home_address" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Contact Number</label>
                            <input type="text" class="form-control rounded" v-model="patientData.patient.phone_number" readonly>
                        </div>
                    </div>

                    <div class="row g-3 mt-3">
                        <div class="col-md-6">
                            <label class="form-label">Occupation</label>
                            <input type="text" class="form-control rounded" v-model="patientData.patient.occupation" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Parents or Guardian</label>
                            <input type="text" class="form-control rounded" v-model="information.guardian">
                            <div v-if="errors.guardian" class="text-danger mt-1"><small>{{ errors.guardian[0] }}</small></div>
                        </div>
                    </div>

                    <div class="row g-3 mt-3">
                        <div class="col-md-6">
                            <label class="form-label">Chief Complaint</label>
                            <input type="text" class="form-control rounded" v-model="information.chief_complaint">
                            <div v-if="errors.chief_complaint" class="text-danger mt-1"><small>{{ errors.chief_complaint[0] }}</small></div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Referred by</label>
                            <input type="text" class="form-control rounded" v-model="information.referred_by">
                            <div v-if="errors.referred_by" class="text-danger mt-1"><small>{{ errors.referred_by[0] }}</small></div>
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
                            <input type="text" class="form-control rounded" v-model="information.previous_dentist">
                            <div v-if="errors.previous_dentist" class="text-danger mt-1">
                                <small class="fw-medium">{{ errors.previous_dentist[0] }}</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Last Dental Visit</label>
                            <input type="text" class="form-control rounded" v-model="information.last_dental_visit">
                            <div v-if="errors.last_dental_visit" class="text-danger mt-1">
                                <small class="fw-medium">{{ errors.last_dental_visit[0] }}</small>
                            </div>
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
                        <input type="text" class="form-control" v-model="information.physician_name">
                        <div v-if="errors.physician_name" class="text-danger"><small class="fw-medium">{{ errors.physician_name[0] }}</small></div>
                    </div>
                    <!-- Specialty -->
                    <div class="input-group" style="flex: 1 1 45%">
                        <span class="input-group-text">Specialty (if applicable)</span>
                        <input type="text" class="form-control" v-model="information.specialty">
                        <div v-if="errors.specialty" class="text-danger"><small class="fw-medium">{{ errors.specialty[0] }}</small></div>
                    </div>
                </div>

                <!-- Office Address and Office Number -->
                <div class="container-fluid d-flex flex-wrap justify-content-between align-items-center mb-3">
                    <!-- Office Address -->
                    <div class="input-group me-2 mb-3 mb-md-0" style="flex: 1 1 45%">
                        <span class="input-group-text">Office Address</span>
                        <input type="text" class="form-control" v-model="information.office_address">
                        <div v-if="errors.office_address" class="text-danger"><small class="fw-medium">{{ errors.office_address[0] }}</small></div>
                    </div>
                    <!-- Office Number -->
                    <div class="input-group" style="flex: 1 1 45%">
                        <span class="input-group-text">Office Number</span>
                        <input type="text" class="form-control" v-model="information.office_number">
                        <div v-if="errors.office_number" class="text-danger"><small class="fw-medium">{{ errors.office_number[0] }}</small></div>
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
                            <input class="form-check-input" type="radio" value="Yes" v-model="information.good_health">
                            <label class="form-check-label">Yes</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="No" v-model="information.good_health">
                            <label class="form-check-label">No</label>
                        </div>
                        <div v-if="errors.good_health" class="text-danger d-block"><small class="fw-medium">{{ errors.good_health[0] }}</small></div>
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
                        <input type="text" class="text-input ms-3" v-model="information.medical_treatment">
                        <div v-if="errors.medical_treatment" class="text-danger"><small class="fw-medium">{{ errors.medical_treatment[0] }}</small></div>
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
                        <input type="text" class="text-input ms-3" v-model="information.surgical_operation">
                        <div v-if="errors.surgical_operation" class="text-danger"><small class="fw-medium">{{ errors.surgical_operation[0] }}</small></div>
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
                        <input type="text" class="text-input" v-model="information.hospitalized">
                        <div v-if="errors.hospitalized" class="text-danger"><small class="fw-medium">{{ errors.hospitalized[0] }}</small></div>
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
                        <input type="text" class="text-input ms-3" v-model="information.prescribtion_non_rescribtion_medication">
                        <div v-if="errors.prescribtion_non_rescribtion_medication" class="text-danger"><small class="fw-medium">{{ errors.prescribtion_non_rescribtion_medication[0] }}</small></div>
                    </div>
                </div>
                <div class="container-fluid d-flex justify-content-between align-items-center">
                    <div class="questions">
                        <p class="fs-6 mb-0">6. Do you use tabacco products?</p>
                    </div>
                    <div class="checkboxs d-flex justify-content-center align-items-center">
                        <div class="form-check me-2">
                            <input class="form-check-input" type="radio" v-model="information.tabacco_products" value="Yes">
                            <label class="form-check-label">Yes</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" v-model="information.tabacco_products" value="No">
                            <label class="form-check-label">No</label>
                        </div>
                        <div v-if="errors.tabacco_products" class="text-danger d-block"><small class="fw-medium">{{ errors.tabacco_products[0] }}</small></div>
                    </div>
                </div>
                <div class="container-fluid d-flex justify-content-between align-items-center">
                    <div class="questions">
                        <p class="fs-6 mb-0">7. Do you use alcohol, cocaine, or other dangerous drugs?</p>
                    </div>
                    <div class="checkboxs d-flex justify-content-center align-items-center">
                        <div class="form-check me-2">
                            <input class="form-check-input" type="radio" value="Yes" v-model="information.dangerous_drugs">
                            <label class="form-check-label">Yes</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="No" v-model="information.dangerous_drugs">
                            <label class="form-check-label">No</label>
                        </div>
                        <div v-if="errors.dangerous_drugs" class="text-danger d-block"><small class="fw-medium">{{ errors.dangerous_drugs[0] }}</small></div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="questions">
                        <p class="fs-6 mb-1">8. Do you have allergies?</p>
                    </div>
                    <div class="checkboxs ms-5 d-flex justify-content-start align-items-center">
                        <div class="form-check">
                            <label class="form-check-label me-2 mb-1">Include what type of allergies </label>
                            <input type="textarea" class="text-input w-100" v-model="information.allergy" placeholder="Type N/A if no allergies">
                            <div v-if="errors.allergy" class="text-danger"><small class="fw-medium">{{ errors.allergy[0] }}</small></div>
                        </div>
                    </div>
                </div>
                <div class="container-fluid d-flex justify-content-between align-items-center">
                    <div class="questions">
                        <p class="fs-6 mb-0">9. Are you pregnant?</p>
                    </div>
                    <div class="checkboxs d-flex justify-content-center align-items-center">
                        <div class="form-check me-2">
                            <input class="form-check-input" type="radio" value="Yes" v-model="information.pregnant">
                            <label class="form-check-label">Yes</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="No" v-model="information.pregnant">
                            <label class="form-check-label">No</label>
                        </div>
                        <div v-if="errors.pregnant" class="text-danger"><small class="fw-medium">{{ errors.pregnant[0] }}</small></div>
                    </div>
                </div>
                <div class="container-fluid d-flex justify-content-between align-items-center">
                    <div class="questions">
                        <p class="fs-6 mb-0">10. Are you nursing mother?</p>
                    </div>
                    <div class="checkboxs d-flex justify-content-center align-items-center">
                        <div class="form-check me-2">
                            <input class="form-check-input" type="radio" value="Yes" v-model="information.nursing_mother">
                            <label class="form-check-label">Yes</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="No" v-model="information.nursing_mother">
                            <label class="form-check-label">No</label>
                        </div>
                        <div v-if="errors.nursing_mother" class="text-danger"><small class="fw-medium">{{ errors.nursing_mother[0] }}</small></div>
                    </div>
                </div>
                <div class="container-fluid d-flex justify-content-between align-items-center">
                    <div class="questions">
                        <p class="fs-6 mb-0">11. Are you taking birth control pills?</p>
                    </div>
                    <div class="checkboxs d-flex justify-content-center align-items-center">
                        <div class="form-check me-2">
                            <input class="form-check-input" type="radio" value="Yes" v-model="information.birth_control_pills">
                            <label class="form-check-label">Yes</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="No" v-model="information.birth_control_pills">
                            <label class="form-check-label">No</label>
                        </div>
                        <div v-if="errors.birth_control_pills" class="text-danger"><small class="fw-medium">{{ errors.birth_control_pills[0] }}</small></div>
                    </div>
                </div>
                <div class="container-fluid d-flex justify-content-start align-items-center mb-1">
                    <p class="fs-6 mb-0">12. Blood Type: </p>
                    <input type="text" class="text-input ms-3" v-model="information.blood_type">
                    <div v-if="errors.blood_type" class="text-danger"><small class="fw-medium">{{ errors.blood_type[0] }}</small></div>
                </div>
                <div class="container-fluid d-flex justify-content-start align-items-center">
                    <p class="fs-6 mb-0">13. Blood Pressure: </p>
                    <input type="text" class="text-input ms-3" v-model="information.blood_pressure">
                    <div v-if="errors.blood_pressure" class="text-danger"><small class="fw-medium">{{ errors.blood_pressure[0] }}</small></div>
                </div>
                <div class="container-fluid mb-1">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="questions">
                            <p class="fs-6 mb-0">14. Do you have any health problem?</p>
                        </div>
                    </div>
                    <div class="ms-5 mb-3 d-flex justify-content-start align-items-center">
                        <p class="fs-6 mb-0">If so, what medications are you taking?</p>
                        <input type="text" class="text-input ms-3" v-model="information.health_problem">
                        <div v-if="errors.health_problem" class="text-danger"><small class="fw-medium">{{ errors.health_problem[0] }}</small></div>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary btn-sm">Recomend to Dentist</button>
                </div>
            </div>
        </form>
    </div>
</template>
<script>
import axios from 'axios';
import Swal from 'sweetalert2';

export default {
    data() {
        return {
            patientData: {
                patient: {} 
            },
            information: {
                user: {},
                user_id: '',
                appointment_id: null,
                birthdate: '',
                religion: '',
                place_of_birth: '',
                nationality: '',
                guardian: '',
                referred_by: '',
                chief_complaint: '',
                previous_dentist: '',
                last_dental_visit: '',
                physician_name: '',
                specialty: '',
                office_address: '',
                office_number: '',
                good_health: '',
                medical_treatment: '',
                surgical_operation: '',
                hospitalized: '',
                prescribtion_non_rescribtion_medication: '',
                tabacco_products: '',
                dangerous_drugs: '',
                allergy: '',
                pregnant: '',
                nursing_mother: '',
                birth_control_pills: '',
                blood_type: '',
                blood_pressure: '',
                health_problem: '',
            },
            errors: {},
        };
    },
    methods: {
        getUrlId(){
            const url = window.location.href;
            const urlSegments = url.split('/').filter(Boolean)
            return urlSegments[urlSegments.length - 1];
        },
        getPatientById() {
            const patientId = this.$route.params.id;
            if (!patientId) {
                console.error('Patient ID not found in route params.');
                return;
            }
            axios.get(`/user/staff/appointment/patient/view/${patientId}`)
                .then((response) => {
                 
                    
                    if (response.data && response.data.data) {
                      
                        const data = response.data.data[0];
                        console.log(data);
                        
                        if (data.hasOwnProperty('user_id')) {
                            console.log('test3');
                            // Data is PatientInformationRecord
                            this.information = {
                                ...this.information,
                                ...data
                            };
                            if (data.user) {
                                this.patientData.patient = data.user;
                            }
                        } else if (data.hasOwnProperty('id')) {
                            // Display Data ni User
                            this.patientData.patient = data;
                        }
                    } else {
                        console.error('Unexpected response format:', response);
                    }

        
                }).catch((error) => {
                    if (error.response && error.response.status === 404) {
                        console.error('Record not found:', error.response.data.message);
                        Swal.fire({
                            icon: 'error',
                            title: 'Record Not Found',
                            text: error.response.data.message,
                        });
                    } else {
                        console.error('Error fetching patient data:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'An unexpected error occurred while fetching data.',
                        });
                    }
                });
        },

        recomendDentist(){
            if (!this.patientData.patient.id) {
                Swal.fire({
                    icon: "error",
                    title: "Missing Patient ID",
                    text: "Please select a patient before submitting the form.",
                });
                return;
            }
             // Ensure patient and appointment IDs are set
            const id = this.getUrlId();
            if (!id) {
                Swal.fire({
                    icon: "error",
                    title: "Missing Appointment ID",
                    text: "Cannot proceed without a valid appointment ID.",
                });
                return;
            }
            this.information.user_id = this.patientData.patient.id;
            this.information.appointment_id = this.getUrlId();
            axios.put(`/user/staff/recomend/doctor/${id}`, this.information)
                .then(() => {
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Record has been added!",
                        showConfirmButton: false,
                        timer: 2000,
                    }).then(() => {
                        this.$router.push(`/user/staff/appointment`);
                    });
                }).catch((error) => {
                    if (error.response && error.response.data && error.response.data.errors) {
                        this.errors = error.response.data.errors;
                    } else {
                        console.error('Error submitting information:', error);
                        Swal.fire({
                            icon: "error",
                            title: "Submission Failed",
                            text: "An unexpected error occurred. Please try again later.",
                        });
                    }
                });
        }
    },
    mounted() {
        this.getPatientById();
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