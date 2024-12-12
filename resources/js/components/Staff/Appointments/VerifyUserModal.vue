<template>
    <!-- Modal -->
    <div class="modal fade" id="verify-appointment-modal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Review Details</h5>
                    <button type="button" class="btn-close btn-black" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body overflow-auto">
                    <div class="container-fluid">
                        <p class="fw-medium">Please review the details</p>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12 col-md-4 mb-2">
                                    <label class="form-label">Firstname</label>
                                    <input type="text" class="form-control" v-model="user.firstname" disabled />
                                </div>
                                <div class="col-12 col-md-4 mb-2">
                                    <label class="form-label">Lastname</label>
                                    <input type="text" class="form-control" v-model="user.lastname" disabled />
                                </div>
                                <div class="col-12 col-md-4 mb-2">
                                    <label class="form-label">Middle Initial</label>
                                    <input type="text" class="form-control" :value="displayMiddleInitial" disabled />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Home Address</label>
                            <input type="text" class="form-control" v-model="user.home_address" disabled />
                        </div>

                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" v-model="user.email" disabled />
                        </div>

                        <div class="form-group">
                            <label class="form-label">Contact Number</label>
                            <input type="tel" class="form-control" v-model="user.phone_number" disabled />
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-12 col-md-4 mb-2">
                                    <label class="form-label">Age</label>
                                    <input type="text" class="form-control" v-model="user.age" disabled />
                                </div>
                                <div class="col-12 col-md-4 mb-2">
                                    <label class="form-label">Sex</label>
                                    <input type="text" class="form-control" v-model="user.sex" disabled />
                                </div>
                                <div class="col-12 col-md-4 mb-2">
                                    <label class="form-label">Marital Status</label>
                                    <input type="text" class="form-control" v-model="user.marital_status" disabled />
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label">Occupation</label>
                            <input type="text" class="form-control" v-model="user.occupation" disabled />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="active-btn">
                        <button type="submit" class="btn btn-success text-white btn-md-1 w-100" @click="recomendtoDen(user.id)">Recommend to the Dentist</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
import axios from 'axios';

export default {
    props: ["selected_user"],
data() {
    return {
        user:{
            id: '',
            firstname: '',
            middle_initial: null,
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
            title: "Patient has been confirm!",
            showConfirmButton: false,
            timer: 2000,
        });
        this.$emit("displayOngoingPatient");
    }).catch((error)=>{
        console.log(error);
    });
   }
},
computed:{
    displayMiddleInitial() {
      return this.user.middle_initial || 'None';
    }
},
watch:{
    selected_user: {
        handler(val) {
            console.log(val);
            this.user.id = val.id;
            this.user.firstname = val.patient?.firstname;
            this.user.middle_initial = val.patient?.middle_initial;
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
