<template>
    <div class="container-fluid p-3">
        <div class="card p-3">
            <p class="fs-5 fw-medium text-primary">Diagnostics</p>
            <div class="d-flex flex-column align-items-center mb-1">
                    <div class="d-flex justify-content-center w-100">
                    <!-- Teeth 18 to 11 -->
                    <div v-for="(tooth, index) in firstHalf" :key="index" class="teeth-card card p-1 position-relative me-4">
                        <div class="banner bg-primary rounded-5 p-1 text-white position-absolute top-0 start-100 translate-middle">
                            {{ tooth.teeth_number }}
                        </div>
                        <img :src="tooth.selectedDiseaseImage || getImageUrl(tooth.teeth_url)" height="50" alt="Teeth Image">
                        <div class="dropdown d-flex justify-content-end align-items-center">
                            <div class="dropdown-toggle mb-0" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                <small>Pick</small>
                            </div>
                            <ul class="dropdown-menu p-1" aria-labelledby="dropdownMenuButton">
                                <li v-for="disease in tooth.diseases" :key="disease.id" class="d-flex align-items-center">
                                    <img :src="getDiseaseUrl(disease.disease_img_url)" alt="Disease Image" width="30" height="30">
                                    <a class="dropdown-item fs-6 m-0" @click="changeImage(tooth, disease.disease_img_url)">
                                        {{ disease.disease_name }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                        <!-- Teeth 21 to 28 -->
                        <div v-for="(tooth, index) in secondHalf" :key="index" class="teeth-card card p-1 position-relative me-4">
                            <div class="banner bg-primary rounded-5 p-1 text-white position-absolute top-0 start-100 translate-middle">
                                {{ tooth.teeth_number }}
                            </div>
                            <img :src="tooth.selectedDiseaseImage || getImageUrl(tooth.teeth_url)" height="50" alt="Teeth Image">
                            <div class="dropdown d-flex justify-content-end align-items-center">
                                <div class="dropdown-toggle mb-0" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><small>Pick</small></div>
                                <ul class="dropdown-menu p-1" aria-labelledby="dropdownMenuButton">
                                    <li v-for="disease in tooth.diseases" :key="disease.id" class="d-flex align-items-center">
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
                        <div v-for="(tooth, index) in thirdHalf" :key="index" class="teeth-card card p-1 position-relative me-4">
                            <div class="banner bg-primary rounded-5 p-1 text-white position-absolute top-0 start-100 translate-middle">
                                {{ tooth.teeth_number }}
                            </div>
                            <img :src="tooth.selectedDiseaseImage || getImageUrl(tooth.teeth_url)" height="50" alt="Teeth Image">
                            <div class="dropdown d-flex justify-content-end align-items-center">
                                <div class="dropdown-toggle mb-0" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><small>Pick</small></div>
                                <ul class="dropdown-menu p-1" aria-labelledby="dropdownMenuButton">
                                    <li v-for="disease in tooth.diseases" :key="disease.id" class="d-flex align-items-center">
                                        <img :src="getDiseaseUrl(disease.disease_img_url)" alt="Disease Image" width="30" height="30">
                                        <a class="dropdown-item fs-6 m-0" @click="changeImage(tooth, disease.disease_img_url)">
                                            {{ disease.disease_name }}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- Teeth 31 to 38 -->
                        <div v-for="(tooth, index) in fourthHalf" :key="index" class="teeth-card card p-1 position-relative me-4">
                            <div class="banner bg-primary rounded-5 p-1 text-white position-absolute top-0 start-100 translate-middle">
                                {{ tooth.teeth_number }}
                            </div>
                            <img :src="tooth.selectedDiseaseImage || getImageUrl(tooth.teeth_url)" height="50" alt="Teeth Image">
                            <div class="dropdown d-flex justify-content-end align-items-center">
                                <div class="dropdown-toggle mb-0" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><small>Pick</small></div>
                                <ul class="dropdown-menu p-1" aria-labelledby="dropdownMenuButton">
                                    <li v-for="disease in tooth.diseases" :key="disease.id" class="d-flex align-items-center">
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
                <div class="d-flex justify-content-end align-items-center">
                    <button class="btn btn-success" @click="submitForm">Submit</button>
                </div>
            </div>
    </div>
</template>
<script>
import axios from 'axios';

export default {
    data() {
        return {
            adultTeeth: [],
            selectedDiseaseImage: null, 
            teethData: {}
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
            axios.get('/admin/patients/diagnostic')
                .then(response => {
                    this.adultTeeth = response.data.map(tooth => ({
                        ...tooth,
                        selectedDiseaseImage: null,
                        comments: tooth.comments || '', 
                    }));
                })
                .catch(error => {
                    console.error('Error fetching diagnostics:', error);
                });
        },

        getImageUrl(imageName) {
            return `/storage/adult/${imageName}`;
        },
        getDiseaseUrl(diseaseName){
            return `/storage/adult_disease/${diseaseName}`;
        },
        changeImage(tooth, diseaseName) {
            tooth.selectedDiseaseImage = this.getDiseaseUrl(diseaseName);
            tooth.disease_id = tooth.diseases.find(disease => disease.disease_img_url === diseaseName).id;
        },
        submitForm() {

            this.teethData = this.adultTeeth.map(tooth => ({
                teeth_id: tooth.id,
                disease_id: tooth.disease_id || null, 
                comments: tooth.comments || null, 
            }));

            console.log(this.teethData); 
            axios.post('/admin/patients/diagnostic/store', this.teethData)
                .then(response => {
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Disease has been saved!",
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
.teeth-card {
    cursor: pointer;
    width: 60px;
}
.comment-input {
    resize: none;
    height: 20px !important;
}
</style>
