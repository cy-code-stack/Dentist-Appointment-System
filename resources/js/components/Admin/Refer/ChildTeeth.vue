<template>
    <div class="container-fluid p-3">
        <p class="fs-5 fw-medium text-primary">Diagnostics</p>
            <div class="d-flex flex-column align-items-center mb-1">
                    <div class="d-flex justify-content-center w-100">
                        <!-- Teeth 55 to 51 -->
                        <div v-for="(tooth, index) in firstHalf" :key="index" class="p-1 position-relative me-4">
                            <div class="banner bg-primary rounded-5 p-1 text-white position-absolute top-0 start-100 translate-middle">
                                {{ tooth.teeth_number }}
                            </div>
                            <img :src="tooth.teeth_disease ? getDiseaseUrl(tooth.teeth_disease.disease_img_url) : getImageUrl(tooth.teeth.teeth_url)" height="50" alt="Teeth Image">
                            <div class="dropdown d-flex justify-content-end align-items-center">
                                <div class="dropdown-toggle mb-0" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    <small>Condition</small>
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

                        <!-- Teeth 61 to 65 -->
                        <div v-for="(tooth, index) in secondHalf" :key="index" class="p-1 position-relative me-4">
                            <div class="banner bg-primary rounded-5 p-1 text-white position-absolute top-0 start-100 translate-middle">
                                {{ tooth.teeth_number }}
                            </div>
                            <img :src="tooth.teeth_disease ? getDiseaseUrl(tooth.teeth_disease.disease_img_url) : getImageUrl(tooth.teeth.teeth_url)" height="50" alt="Teeth Image">
                            <div class="dropdown d-flex justify-content-end align-items-center">
                                <div class="dropdown-toggle mb-0" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><small>Condition</small></div>
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
                        <!-- Teeth 75 to 71 -->
                        <div v-for="(tooth, index) in thirdHalf" :key="index" class="p-1 position-relative me-4">
                            <div class="banner bg-primary rounded-5 p-1 text-white position-absolute top-0 start-100 translate-middle">
                                {{ tooth.teeth_number }}
                            </div>
                            <img :src="tooth.teeth_disease ? getDiseaseUrl(tooth.teeth_disease.disease_img_url) : getImageUrl(tooth.teeth.teeth_url)" height="50" alt="Teeth Image">
                            <div class="dropdown d-flex justify-content-end align-items-center">
                                <div class="dropdown-toggle mb-0" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><small>Condition</small></div>
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

                        <!-- Teeth 81 to 85 -->
                        <div v-for="(tooth, index) in fourthHalf" :key="index" class="p-1 position-relative me-4">
                            <div class="banner bg-primary rounded-5 p-1 text-white position-absolute top-0 start-100 translate-middle">
                                {{ tooth.teeth_number }}
                            </div>
                            <img :src="tooth.teeth_disease ? getDiseaseUrl(tooth.teeth_disease.disease_img_url) : getImageUrl(tooth.teeth.teeth_url)" height="50" alt="Teeth Image">
                            <div class="dropdown d-flex justify-content-end align-items-center">
                                <div class="dropdown-toggle mb-0" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><small>Condition</small></div>
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
                                        <textarea class="comment-input form-control" v-model="tooth.comments"></textarea>
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
                                        <textarea class="comment-input form-control" v-model="tooth.comments"></textarea>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="d-flex justify-content-end align-items-center mb-2">
                    <button class="btn btn-sm btn-primary" @click="submitForm">Submit</button>
                </div>
            </div>
</template>
<script>
import axios from 'axios';

export default {
    props: true,
    data() {
        return {
            childTeeth: [],
            selectedDiseaseImage: null, 
            teethData: {},
            created_at: null,
            patientInformationId: null,
        };
    },
    computed: {
        firstHalf() {
            return this.childTeeth.filter(tooth => tooth.teeth_number >= 51 && tooth.teeth_number <= 55).reverse();
        },
        secondHalf() {
            return this.childTeeth.filter(tooth => tooth.teeth_number >= 61 && tooth.teeth_number <= 65);
        },
        thirdHalf() {
            return this.childTeeth.filter(tooth => tooth.teeth_number >= 71 && tooth.teeth_number <= 75).reverse();
        },
        fourthHalf() {
            return this.childTeeth.filter(tooth => tooth.teeth_number >= 81 && tooth.teeth_number <= 85);
        },
        firstColumn() {
            return this.childTeeth.slice(0, Math.ceil(this.childTeeth.length / 2));
        },
        secondColumn() {
            return this.childTeeth.slice(Math.ceil(this.childTeeth.length / 2));
        }
    },
    methods: {
        fetchDiagnostics() {
            const recordId = this.$route.params.id;
            if (!recordId) {
                console.error('Patient ID not found in route params.');
                return;
            }
            axios.get(`/admin/patients/child/${recordId}`)
                .then(response => {
                    this.childTeeth = response.data.map(tooth => ({
                        ...tooth,
                        selectedDiseaseImage: tooth.teeth_disease ? this.getDiseaseUrl(tooth.teeth_disease.disease_img_url) : null,
                        teeth_number: tooth.teeth.teeth_number,
                        comments: tooth.comments || '', 
                        created_at: this.formatDate(tooth.created_at),
                    }));

                    console.log(response);
                    
                })
                .catch(error => {
                    console.error('Error fetching diagnostics:', error);
                });
        },

        formatDate(date) {
            if (!date) return '';
            const d = new Date(date);
            if (isNaN(d)) return '';
            return d.toISOString().split('T')[0];
        },

        getUrlId(){
            const url = window.location.href;
            const urlSegments = url.split('/');
            return urlSegments[urlSegments.length - 1];
        },

        getImageUrl(imageName) {
            return `/storage/child/${imageName}`;
        },
        getDiseaseUrl(diseaseName){
            return `/storage/child_disease/${diseaseName}`;
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
            this.teethData = this.childTeeth.map(tooth => ({
                teeth_id: tooth.id,
                disease_id: tooth.disease_id || null, 
                comments: tooth.comments || null, 
                information_id: this.getUrlId(),
                created_at: tooth.created_at,
            }));
            const id = this.getUrlId();
            axios.put(`/admin/patients/child/store/${id}`, this.teethData)
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
                }).catch(error => {
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
    .teeth-number {
        font-size: 12px;
        font-weight: bold;
        padding: 5px;
        min-width: 28px;
    }

    .tooth-img {
        height: 55px;
        object-fit: contain;
    }

    .disease-img {
        width: 25px;
        height: 25px;
        margin-right: 8px;
    }

    .comment-input {
        height: 60px !important;
        resize: none;
    }

    .btn-success {
        font-size: 16px;
        padding: 8px 20px;
    }

    .dropdown-toggle {
        font-size: 14px;
    }

    .table thead th {
        background-color: #f8f9fa;
        text-align: center;
    }

    @media (max-width: 768px) {
        .teeth-card {
            width: 60px;
        }

        .tooth-img {
            height: 45px;
        }

        .disease-img {
            width: 20px;
            height: 20px;
        }

        .comment-input {
            height: 50px !important;
        }
    }
</style>