<template>
    <div class="container-fluid p-3">
        <div class="card p-3">
            <p class="fs-5 fw-medium text-primary">Diagnostics</p>
            <div class="d-flex flex-column align-items-center mb-1">
                <div class="d-flex justify-content-center w-100">
                    <!-- Teeth 18 to 11 -->
                    <div v-for="(tooth, index) in firstHalf" :key="index" class="teeth-card card p-1 position-relative me-4">
                        <div class="banner bg-primary rounded-5 p-1 text-white position-absolute top-0 start-100 translate-middle">
                            {{ tooth.teeth.teeth_number }}
                        </div>
                        <img :src="tooth.teeth_disease ? getDiseaseUrl(tooth.teeth_disease.disease_img_url) : getImageUrl(tooth.teeth.teeth_url)" 
                            height="50" alt="Teeth Image">
                    </div>

                    <!-- Teeth 21 to 28 -->
                    <div v-for="(tooth, index) in secondHalf" :key="index" class="teeth-card card p-1 position-relative me-4">
                        <div class="banner bg-primary rounded-5 p-1 text-white position-absolute top-0 start-100 translate-middle">
                            {{ tooth.teeth.teeth_number }}
                        </div>
                        <img :src="tooth.teeth_disease ? getDiseaseUrl(tooth.teeth_disease.disease_img_url) : getImageUrl(tooth.teeth.teeth_url)" 
                            height="50" alt="Teeth Image">
                    </div>
                </div>


                <!-- Second row -->
                <div class="d-flex justify-content-center w-100">
                    <!-- Teeth 48 to 41 -->
                    <div v-for="(tooth, index) in thirdHalf" :key="index" class="teeth-card card p-1 position-relative me-4">
                        <div class="banner bg-primary rounded-5 p-1 text-white position-absolute top-0 start-100 translate-middle">
                            {{ tooth.teeth.teeth_number }}
                        </div>
                        <img :src="tooth.teeth_disease ? getDiseaseUrl(tooth.teeth_disease.disease_img_url) : getImageUrl(tooth.teeth.teeth_url)" 
                            height="50" alt="Teeth Image">
                    </div>

                        <!-- Teeth 31 to 38 -->
                    <div v-for="(tooth, index) in fourthHalf" :key="index" class="teeth-card card p-1 position-relative me-4">
                        <div class="banner bg-primary rounded-5 p-1 text-white position-absolute top-0 start-100 translate-middle">
                            {{ tooth.teeth.teeth_number }}
                        </div>
                        <img :src="tooth.teeth_disease ? getDiseaseUrl(tooth.teeth_disease.disease_img_url) : getImageUrl(tooth.teeth.teeth_url)" 
                            height="50" alt="Teeth Image">
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
                                        <textarea class="comment-input form-control" v-model="tooth.comments" disabled></textarea>
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
                                        <textarea class="comment-input form-control" v-model="tooth.comments" disabled></textarea>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
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
        };
    },
    computed: {
        firstHalf() {
            return this.adultTeeth.filter(tooth => tooth.teeth.teeth_number >= 11 && tooth.teeth.teeth_number <= 18).reverse();
        },
        secondHalf() {
            return this.adultTeeth.filter(tooth => tooth.teeth.teeth_number >= 21 && tooth.teeth.teeth_number <= 28);
        },
        thirdHalf() {
            return this.adultTeeth.filter(tooth => tooth.teeth.teeth_number >= 41 && tooth.teeth.teeth_number <= 48).reverse();
        },
        fourthHalf() {
            return this.adultTeeth.filter(tooth => tooth.teeth.teeth_number >= 31 && tooth.teeth.teeth_number <= 38);
        },
        firstColumn() {
            const half = Math.floor(this.adultTeeth.length / 2);
            return this.adultTeeth.slice(0, half);
        },
        secondColumn() {
            const half = Math.floor(this.adultTeeth.length / 2);
            return this.adultTeeth.slice(half);
        }
    },
    methods: {
        fetchDiagnostics() {
            const id = this.$route.params.id;
            axios.get(`/user/staff/diagnostic/${id}`)
                .then(response => {
                    this.adultTeeth = response.data.data.map(tooth => ({
                        ...tooth,
                        selectedDiseaseImage: tooth.teeth_disease ? this.getDiseaseUrl(tooth.teeth_disease.disease_img_url) : null,
                        teeth_number: tooth.teeth.teeth_number,
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
        getDiseaseUrl(diseaseName) {
            return `/storage/adult_disease/${diseaseName}`;
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
