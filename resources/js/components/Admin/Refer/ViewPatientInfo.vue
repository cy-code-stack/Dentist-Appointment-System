<template>
    <div class="container-fluid">
        <p class="text-center fs-1 text-primary fw-semibold mb-1">Graces Dental Clinic</p>
        <p class="text-center fs-4 text-success fw-semibold">Patient Information Record</p>

        <form @submit.prevent="submitInformation">
            <div class="card p-3">
                <div class="title-form">
                    <p class="fs-5 mb-1 fw-semibold text-primary">Personal Information</p>
                </div>
               
                <div class="container-fluid d-flex justify-content-between align-items-center mb-2">
                    <div class="input-group me-2">
                        <span class="input-group-text">Firstname</span>
                        <input type="text" class="form-control" v-model="patientData.patient.firstname" readonly>
                    </div>
                    <div class="input-group me-2">
                        <span class="input-group-text">Middle Initial</span>
                        <input type="text" class="form-control" v-model="patientData.patient.middle_initial" readonly>
                    </div>
                    <div class="input-group">
                        <span class="input-group-text">Lastname</span>
                        <input type="text" class="form-control" v-model="patientData.patient.lastname" readonly>
                    </div>
                </div>
                <div class="container-fluid d-flex justify-content-between align-items-center mb-2">
                    <div class="input-group me-2">
                        <span class="input-group-text">Birthdate</span>
                        <input type="date" class="form-control" v-model="information.birthdate">
                    </div>
                    <div class="input-group me-2">
                        <span class="input-group-text">Age</span>
                        <input type="text" class="form-control" v-model="patientData.patient.age" readonly>
                    </div>
                    <div class="input-group me-2">
                        <span class="input-group-text">Religion</span>
                        <input type="text" class="form-control" v-model="information.religion">
                    </div>
                    <div class="input-group">
                        <span class="input-group-text">Nationality</span>
                        <input type="text" class="form-control" v-model="information.nationality">
                    </div>
                </div>
                <div class="container-fluid d-flex justify-content-between align-items-center mb-2">
                    <div class="input-group me-2">
                        <span class="input-group-text">Place of Birth</span>
                        <input type="text" class="form-control" v-model="information.place_of_birth">
                    </div>
                    <div class="input-group">
                        <span class="input-group-text">Home Address</span>
                        <input type="text" class="form-control" v-model="patientData.patient.home_address" readonly>
                    </div>
                </div>
                <div class="container-fluid d-flex justify-content-between align-items-center mb-2">
                    <div class="input-group me-2">
                        <span class="input-group-text">Contact Number</span>
                        <input type="text" class="form-control" v-model="patientData.patient.phone_number" readonly>
                    </div>
                    <div class="input-group">
                        <span class="input-group-text">Occupation</span>
                        <input type="text" class="form-control" v-model="patientData.patient.occupation" readonly>
                    </div>
                </div>
                <div class="container-fluid d-flex justify-content-between align-items-center mb-2">
                    <div class="input-group">
                        <span class="input-group-text">Parents or Guardian</span>
                        <input type="text" class="form-control" v-model="information.guardian">
                    </div>
                </div>
                <div class="container-fluid d-flex justify-content-between align-items-center mb-2">
                    <div class="input-group me-2">
                        <span class="input-group-text">Referred by</span>
                        <input type="text" class="form-control" v-model="information.referred_by">
                    </div>
                    <div class="input-group">
                        <span class="input-group-text">Chief Complaint</span>
                        <input type="text" class="form-control" v-model="information.chief_complaint">
                    </div>
                </div>
            </div>
    
            <div class="card p-3">
                <div class="title-form">
                    <p class="fs-5 mb-1 fw-semibold text-primary">Dental History</p>
                </div>
                <div class="container-fluid d-flex justify-content-between align-items-center mb-2">
                    <div class="input-group me-2">
                        <span class="input-group-text">Previous Dentist</span>
                        <input type="text" class="form-control" v-model="information.previous_dentist">
                    </div>
                    <div class="input-group">
                        <span class="input-group-text">Last Dental Visit</span>
                        <input type="text" class="form-control" v-model="information.last_dental_visit">
                    </div>
                </div>
            </div>
    
            <div class="card p-3">
                <div class="title-form">
                    <p class="fs-5 mb-1 fw-semibold text-primary">Medical History</p>
                </div>
                <div class="physician-info mb-4">
                    <div class="container-fluid d-flex justify-content-between align-items-center mb-2">
                        <div class="input-group me-2">
                            <span class="input-group-text">Name of the Physician</span>
                            <input type="text" class="form-control" v-model="information.physician_name">
                        </div>
                        <div class="input-group">
                            <span class="input-group-text">Specialty (if applicable)</span>
                            <input type="text" class="form-control" v-model="information.specialty">
                        </div>
                    </div>
                    <div class="container-fluid d-flex justify-content-between align-items-center mb-2">
                        <div class="input-group me-2">
                            <span class="input-group-text">Office Address</span>
                            <input type="text" class="form-control" v-model="information.office_address">
                        </div>
                        <div class="input-group">
                            <span class="input-group-text">Office Number</span>
                            <input type="text" class="form-control" v-model="information.office_number">
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
                    </div>
                </div>
                <div class="container-fluid mb-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="questions">
                            <p class="fs-6 mb-1">3. Have you ever had serious illness or surgical operation?</p>
                        </div>
                        <!-- <div class="checkboxs d-flex justify-content-center align-items-center">
                            <div class="form-check me-2">
                                <input class="form-check-input" type="checkbox" value="Yes">
                                <label class="form-check-label">Yes</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="No">
                                <label class="form-check-label">No</label>
                            </div>
                        </div> -->
                    </div>
                    <div class="ms-5 d-flex justify-content-start align-items-center">
                        <p class="fs-6 mb-0">If so, what illness or operation?</p>
                        <input type="text" class="text-input ms-3" v-model="information.surgical_operation">
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
                    </div>
                </div>
                <div class="container-fluid d-flex justify-content-start align-items-center mb-1">
                    <p class="fs-6 mb-0">12. Blood Type: </p>
                    <input type="text" class="text-input ms-3" v-model="information.blood_type">
                </div>
                <div class="container-fluid d-flex justify-content-start align-items-center">
                    <p class="fs-6 mb-0">13. Blood Pressure: </p>
                    <input type="text" class="text-input ms-3" v-model="information.blood_pressure">
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
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary btn-sm">Next Page</button>
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
                user_id: '',
                appointment_id: '',
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
                health_problem: ''
            }
        };
    },
    methods: {
        getUrlId(){
            const url = window.location.href;
            const urlSegments = url.split('/').filter(Boolean)
            return urlSegments[urlSegments.length - 1];
        },
        submitInformation() {
            if (!this.patientData.patient.id) {
                console.error('Patient ID is missing.');
                return;
            }
            this.information.user_id = this.patientData.patient.id;
            this.information.appointment_id = this.getUrlId();
            axios.post('/admin/patients/information', this.information)
                .then((response) => {
                    Swal.fire({
                       position: "center",
                        icon: "success",
                        title: "Information has been added!",
                        showConfirmButton: false,
                        timer: 2000,
                    }).then(() => {
                        const patientAge = this.patientData.patient.age;
                        if (patientAge < 12) {
                            this.$router.push(`/user/admin/child/${response.data.data.id}`);
                        }else {
                            this.$router.push(`/user/admin/diagnose/${response.data.data.id}`);
                        }
                    });
                })
                .catch((error) => {
                    console.error('Error submitting information:', error);
                });
        },
        getPatientBasedOnId() {
            const patientId = this.$route.params.id;
            if (!patientId) {
                console.error('Patient ID not found in route params.');
                return;
            }
            axios.get(`/admin/patients/index/${patientId}`)
                .then(response => {
                    this.patientData = response.data;
                    console.log('Patient data loaded:', this.patientData);
                })
                .catch(error => {
                    console.error('Error fetching patient data:', error);
                });
        }
    },
    mounted() {
        this.getPatientBasedOnId();
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