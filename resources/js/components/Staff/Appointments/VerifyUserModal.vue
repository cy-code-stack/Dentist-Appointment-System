<template>
    <div class="modal fade" id="verify-appointment-modal">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container">
                        <div class="d-flex justify-content-between w-100">
                            <p class="fs-5 fw-medium">Review Details</p>
                            <button type="button" class="btn-close btn-black" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="company-serv card w-100 mb-3 d-flex align-items-between justify-content-between p-3">
                            <p class="fw-medium mb-2">Please review the details</p>
                                <div class="form-group mb-1 d-flex justify-content-between w-100">
                                    <div class="me-1">
                                        <label class="form-label">Firstname</label>
                                        <input type="text" class="form-control" v-model="user.firstname" disabled/>
                                    </div>
                                    <div>
                                        <label class="form-label">Lastname</label>
                                        <input type="text" class="form-control" v-model="user.lastname" disabled/>
                                    </div>
                                </div>
                                <div class="form-group mb-1">
                                    <label class="form-label mb-1">Home Address </label>
                                    <input type="text" class="form-control" v-model="user.home_address"  disabled/>
                                </div>
                                <div class="form-group mb-1">
                                    <label class="form-label mb-1">Email</label>
                                    <input type="email" class="form-control" v-model="user.email"  disabled/>
                                </div>
                                <div class="form-group mb-1">
                                    <label class="form-label mb-1">Contact Number</label>
                                    <input type="tel" class="form-control" v-model="user.phone_number"  disabled/>
                                </div>
                                <div class="form-group mb-1 d-flex justify-content-between w-100">
                                    <div class="me-1">
                                        <label class="form-label mb-0">Age</label>
                                        <input type="text" class="form-control" v-model="user.age" disabled/>
                                    </div>
                                    <div>
                                        <label class="form-label mb-0">Sex</label>
                                        <input type="text" class="form-control" v-model="user.sex" disabled/>
                                    </div>
                                </div>
                                <div class="form-group mb-1">
                                    <label class="form-label mb-1">Marital Status</label>
                                    <input type="tel" class="form-control" v-model="user.marital_status"  disabled/>
                                </div>
                                <div class="form-group mb-1">
                                    <label class="form-label mb-1">Occupation</label>
                                    <input type="tel" class="form-control" v-model="user.occupation"  disabled/>
                                </div>
                        </div>

                        <div class="active-btn">
                            <button type="submit" class="btn btn-success text-white btn-md-1 w-100" @click="recomendtoDen(user.id)">Recomend to the Dentist</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style>
@import "/resources/css/Patient/indexpatient.css";
</style>

<script>
import axios from 'axios';

export default {
    props: ["selected_user"],
data() {
    return {
        user:{
            id: '',
            firstname: '',
            lastname: '',
            home_address: '',
            email: '',
            phone_number: '',
            age: '',
            sex: '',
            marital_status: '',
            occupation: '',
        },

    };
},
methods: {
   recomendtoDen(id){
    axios.put('/user/staff/recomend/doctor/' + id, this.user).then((response)=>{
        $("#verify-appointment-modal").modal("hide");
        Swal.fire({
            position: "center",
            icon: "success",
            title: "Patient has been verified!",
            showConfirmButton: false,
            timer: 2000,
        });
        this.$emit("displayOngoingPatient");
    }).catch((error)=>{
        console.log(error);
    });
   }
},
watch:{
    selected_user: {
        handler(val) {
            console.log(val);
            this.user.id = val.id;
            this.user.firstname = val.patient?.firstname;
            this.user.lastname = val.patient?.lastname;
            this.user.home_address = val.patient?.home_address;
            this.user.email = val.patient?.email;
            this.user.phone_number = val.patient?.phone_number;
            this.user.age = val.patient?.age;
            this.user.sex = val.patient?.sex;
            this.user.marital_status = val.patient?.marital_status;
            this.user.occupation = val.patient?.occupation;
        },
        deep: true,
    },
},
mounted() {
    console.log("Component loaded");
},
};
</script>
