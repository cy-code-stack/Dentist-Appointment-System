<template>
    <div class="container-fluid p-3">
        <div class="main-card p-3">
            <p class="fs-5 fw-medium text-primary">Diagnostics</p>
                <div class="d-flex flex-column align-items-center mb-1">
                    <div class="d-flex justify-content-center w-100 mb-3">
                        <!-- Teeth 18 to 11 -->
                        <div v-for="(tooth, index) in firstHalf" :key="index" class="teeth-card p-1 position-relative me-3">
                            <div class="banner bg-primary rounded-5 p-1 text-white position-absolute top-0 start-100 translate-middle">
                                {{ tooth.teeth.teeth_number }}
                            </div>
                            <img :src="tooth.teeth_disease ? getDiseaseUrl(tooth.teeth_disease.disease_img_url) : getImageUrl(tooth.teeth.teeth_url)" height="50" alt="Teeth Image">
                            <div class="dropdown d-flex justify-content-end align-items-center">
                                <div class="dropdown-toggle mb-0" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    <small class="text-small">Condition</small>
                                </div>
                                <ul class="dropdown-menu p-1" aria-labelledby="dropdownMenuButton">
                                    <li v-for="disease in tooth.teeth.diseases" :key="disease.id" class="d-flex align-items-center">
                                        <img :src="getDiseaseUrl(disease.disease_img_url)" alt="Disease Image" width="30" height="30">
                                        <a class="dropdown-item fs-6 m-0" @click="changeImage(tooth, disease.disease_img_url)">
                                            {{ disease.disease_name }}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- Teeth 21 to 28 -->
                        <div v-for="(tooth, index) in secondHalf" :key="index" class="teeth-card p-1 position-relative me-3">
                            <div class="banner bg-primary rounded-5 p-1 text-white position-absolute top-0 start-100 translate-middle">
                                {{ tooth.teeth_number }}
                            </div>
                            <img :src="tooth.teeth_disease ? getDiseaseUrl(tooth.teeth_disease.disease_img_url) : getImageUrl(tooth.teeth.teeth_url)" height="50" alt="Teeth Image">
                            <div class="dropdown d-flex justify-content-end align-items-center">
                                <div class="dropdown-toggle mb-0" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><small class="text-small">Condition</small></div>
                                <ul class="dropdown-menu p-1" aria-labelledby="dropdownMenuButton">
                                    <li v-for="disease in tooth.teeth.diseases" :key="disease.id" class="d-flex align-items-center">
                                        <img :src="getDiseaseUrl(disease.disease_img_url)" alt="Disease Image" width="30" height="30">
                                        <a class="dropdown-item fs-6 m-0" @click="changeImage(tooth, disease.disease_img_url)">
                                            {{ disease.disease_name }}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>


                    <!-- Second row -->
                    <div class="d-flex justify-content-center w-100">
                        <!-- Teeth 48 to 41 -->
                        <div v-for="(tooth, index) in thirdHalf" :key="index" class="teeth-card p-1 position-relative me-3">
                            <div class="banner bg-primary rounded-5 p-1 text-white position-absolute top-0 start-100 translate-middle">
                                {{ tooth.teeth_number }}
                            </div>
                            <img :src="tooth.teeth_disease ? getDiseaseUrl(tooth.teeth_disease.disease_img_url) : getImageUrl(tooth.teeth.teeth_url)" height="50" alt="Teeth Image">
                            <div class="dropdown d-flex justify-content-end align-items-center">
                                <div class="dropdown-toggle mb-0" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><small class="text-small">Condition</small></div>
                                <ul class="dropdown-menu p-1" aria-labelledby="dropdownMenuButton">
                                    <li v-for="disease in tooth.teeth.diseases" :key="disease.id" class="d-flex align-items-center">
                                        <img :src="getDiseaseUrl(disease.disease_img_url)" alt="Disease Image" width="30" height="30">
                                        <a class="dropdown-item fs-6 m-0" @click="changeImage(tooth, disease.disease_img_url)">
                                            {{ disease.disease_name }}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- Teeth 31 to 38 -->
                        <div v-for="(tooth, index) in fourthHalf" :key="index" class="teeth-card p-1 position-relative me-3">
                            <div class="banner bg-primary rounded-5 p-1 text-white position-absolute top-0 start-100 translate-middle">
                                {{ tooth.teeth_number }}
                            </div>
                            <img :src="tooth.teeth_disease ? getDiseaseUrl(tooth.teeth_disease.disease_img_url) : getImageUrl(tooth.teeth.teeth_url)" height="50" alt="Teeth Image">
                            <div class="dropdown d-flex justify-content-end align-items-center">
                                <div class="dropdown-toggle mb-0" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><small class="text-small">Condition</small></div>
                                <ul class="dropdown-menu p-1" aria-labelledby="dropdownMenuButton">
                                    <li v-for="disease in tooth.teeth.diseases" :key="disease.id" class="d-flex align-items-center">
                                        <img :src="getDiseaseUrl(disease.disease_img_url)" alt="Disease Image" width="30" height="30">
                                        <a class="dropdown-item fs-6 m-0" @click="changeImage(tooth, disease.disease_img_url)">
                                            {{ disease.disease_name }}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row align-items-start">
                    <!-- First Column Table -->
                    <div class="table-responsive col">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="col col-sm-3 text-center">Teeth Number</th>
                                    <th scope="col">Comments</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(tooth, index) in firstColumn" :key="index">
                                    <td class="text-center fs-6 fw-semibold">{{ tooth.teeth_number }}</td>
                                    <td>
                                        <input class="form-control form-control-sm mb-2" type="date" v-model="currentDate">
                                        <textarea class="form-control" rows="3" placeholder="Add your comments here" v-model="tooth.comments"></textarea>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Second Column Table -->
                    <div class="table-responsive col">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="col col-sm-3 text-center">Teeth Number</th>
                                    <th scope="col">Comments</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(tooth, index) in secondColumn" :key="index">
                                    <td class="text-center fs-6 fw-semibold">{{ tooth.teeth_number }}</td>
                                    <td>
                                        <input class="form-control form-control-sm mb-2" type="date" v-model="currentDate">
                                        <textarea class="form-control" rows="3" placeholder="Add your comments here" v-model="tooth.comments"></textarea>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="d-flex justify-content-end align-items-center">
                    <button class="btn btn-success" @click="submitForm">Submit</button>
                </div>
            </div>
    </div>
</template>
<script>
import axios from 'axios';

export default {
    props: true,
    data() {
        return {
            adultTeeth: [],
            selectedDiseaseImage: null,
            teethData: {},
            currentDate: new Date().toISOString().split("T")[0],
            patientInformationId: null,
        };
    },
    computed: {
        firstHalf() {
            return this.adultTeeth.filter(tooth => tooth.teeth_number >= 11 && tooth.teeth_number <= 18).reverse();
        },
        secondHalf() {
            return this.adultTeeth.filter(tooth => tooth.teeth_number >= 21 && tooth.teeth_number <= 28);
        },
        thirdHalf() {
            return this.adultTeeth.filter(tooth => tooth.teeth_number >= 41 && tooth.teeth_number <= 48).reverse();
        },
        fourthHalf() {
            return this.adultTeeth.filter(tooth => tooth.teeth_number >= 31 && tooth.teeth_number <= 38);
        },
        firstColumn() {
            return this.adultTeeth.slice(0, Math.ceil(this.adultTeeth.length / 2));
        },
        secondColumn() {
            return this.adultTeeth.slice(Math.ceil(this.adultTeeth.length / 2));
        }
    },
    methods: {
        fetchDiagnostics() {
            const recordId = this.$route.params.id;
            if (!recordId) {
                console.error('Patient ID not found in route params.');
                return;
            }
            axios.get(`/admin/patients/diagnostic/${recordId}`)
                .then(response => {
                    this.adultTeeth = response.data.map(tooth => ({
                        ...tooth,
                        selectedDiseaseImage: tooth.teeth_disease ? this.getDiseaseUrl(tooth.teeth_disease.disease_img_url) : null,
                        teeth_number: tooth.teeth.teeth_number,
                        comments: tooth.comments || '', 
                        created_at: this.currentDate,
                    }));
                })
                .catch(error => {
                    console.error('Error fetching diagnostics:', error);
                });
        },

        getUrlId(){
            const url = window.location.href;
            const urlSegments = url.split('/');
            return urlSegments[urlSegments.length - 1];
        },

        getImageUrl(imageName) {
            return `/storage/adult/${imageName}`;
        },
        getDiseaseUrl(diseaseName){
            return `/storage/adult_disease/${diseaseName}`;
        },
        changeImage(tooth, diseaseName) {
            tooth.selectedDiseaseImage = this.getDiseaseUrl(diseaseName);
            const selectedDisease = tooth.teeth.diseases.find(disease => disease.disease_img_url === diseaseName);
            if (selectedDisease) {
            tooth.teeth_disease = selectedDisease;
            tooth.disease_id = selectedDisease.id;
            }
        },

        submitForm() {
            this.teethData = this.adultTeeth.map(tooth => ({
                teeth_id: tooth.teeth.id,
                disease_id: tooth.teeth_disease ? tooth.teeth_disease.id : null,
                comments: tooth.comments || null,
                patient_information_id: this.getUrlId(),
                created_at: this.currentDate,
            }));
            const id = this.getUrlId();
            console.log(this.teethData);
            axios.put(`/admin/patients/diagnostic/store/${id}`, this.teethData)
                .then(response => {
                    this.patientInformationId = response.data.id;
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Diagnostic has been saved!",
                        showConfirmButton: false,
                        timer: 2000,
                    }).then(() => {
                        this.$router.push('/user/admin/refer');
                    });
                })
                .catch(error => {
                    console.error('Error saving diagnostics:', error);
                });
        },
    },
    mounted() {
        this.fetchDiagnostics();
    }
}
</script>

<style>
.teeth-card {
    cursor: pointer;
    width: 60px;
}
.text-small{
    font-size: 8px;
}
.main-card {
  border: 1px solid #dee2e6;
  border-radius: 0.375rem;
  box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
  background-color: #fff;
  transition: transform 0.2s ease, box-shadow 0.2s ease;
}
</style>
