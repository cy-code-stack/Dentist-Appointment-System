<template>
    <div class="modal fade" id="add-user-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-between align-items-center">
                    <h5 class="modal-title">Add Patient</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body overflow-auto">
                    <form @submit.prevent="submitUser">
                        <p class="fw-medium mb-3">Fill the form for adding a user.</p>

                        <div class="row g-2">
                            <div class="col-md-4">
                                <label class="form-label">Firstname</label>
                                <input type="text" class="form-control" v-model="user.firstname" />
                                <div v-if="errors.firstname" class="text-danger">
                                    <small>{{ errors.firstname[0] }}</small>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Middle Initial</label>
                                <input type="text" class="form-control" v-model="user.middle_initial" />
                                <div v-if="errors.middle_initial" class="text-danger">
                                    <small>{{ errors.middle_initial[0] }}</small>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Lastname</label>
                                <input type="text" class="form-control" v-model="user.lastname" />
                                <div v-if="errors.lastname" class="text-danger">
                                    <small>{{ errors.lastname[0] }}</small>
                                </div>
                            </div>

                            <div class="col-4">
                                <label class="form-label">Home Address</label>
                                <input type="text" class="form-control" v-model="user.home_address" />
                                <div v-if="errors.home_address" class="text-danger">
                                    <small>{{ errors.home_address[0] }}</small>
                                </div>
                            </div>

                            <div class="col-4">
                                <label class="form-label">Occupation</label>
                                <input type="text" class="form-control" v-model="user.occupation" />
                                <div v-if="errors.occupation" class="text-danger">
                                    <small>{{ errors.occupation[0] }}</small>
                                </div>
                            </div>

                            <div class="col-4">
                                <label class="form-label">Birthdate</label>
                                <input type="date" class="form-control" v-model="user.birthdate" />
                                <div v-if="errors.birthdate" class="text-danger">
                                    <small>{{ errors.birthdate[0] }}</small>
                                </div>
                            </div>

                            <div class="col-4">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" v-model="user.email" />
                                <div v-if="errors.email" class="text-danger">
                                    <small>{{ errors.email[0] }}</small>
                                </div>
                            </div>
                            <div class="col-4">
                                <label class="form-label">Age</label>
                                <input type="text" class="form-control" v-model="user.age" readonly/>
                                <div v-if="errors.age" class="text-danger">
                                    <small>{{ errors.age[0] }}</small>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Gender</label>
                                <select class="form-select" v-model="user.sex">
                                    <option value="Male" selected>Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Prefer not to Say">Prefer not to Say</option>
                                </select>
                                <div v-if="errors.sex" class="text-danger">
                                    <small>{{ errors.sex[0] }}</small>
                                </div>
                            </div>

                            <div class="col-6">
                                <label class="form-label">Phone Number</label>
                                <input type="tel" class="form-control" v-model="user.phone_number" />
                                <div v-if="errors.phone_number" class="text-danger">
                                    <small>{{ errors.phone_number[0] }}</small>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Marital Status</label>
                                <select class="form-select" v-model="user.marital_status">
                                    <option value="Single" selected>Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Widdow">Widdow</option>
                                    <option value="Divorce">Divorce</option>
                                    <option value="Separated">Separated</option>
                                </select>
                                <div v-if="errors.marital_status" class="text-danger">
                                    <small>{{ errors.marital_status[0] }}</small>
                                </div>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Role</label>
                                <select class="form-select" v-model="user.role">
                                    <option value="Patient" selected>Patient</option>
                                </select>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Password</label>
                                <input type="text" class="form-control bg-light" v-model="user.password" disabled />
                                <div v-if="errors.password" class="text-danger">
                                    <small>{{ errors.password[0] }}</small>
                                </div>
                            </div>

                        </div>

                        <div class="mt-3 d-grid">
                            <button type="submit" class="btn btn-success text-white">Add Patient</button>
                        </div>
                    </form>
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
            user: {
                id: "",
                firstname: "",
                middle_initial: "",
                lastname: "",
                home_address: "",
                birthdate: "",
                occupation: "",
                age: "",
                sex: "",
                marital_status: "",
                email: "",
                password: "",
                phone_number: "",
                role: "Patient", 
            },
            errors: {},
        };
    },
    watch: {
        "user.birthdate"(newBirthdate) {
            this.user.age = this.calculateAge(newBirthdate);
        }
    },
    methods: {
        calculateAge(birthdate) {
            if (!birthdate) return "";

            const birthDate = new Date(birthdate);
            const today = new Date();
            let age = today.getFullYear() - birthDate.getFullYear();
            const monthDiff = today.getMonth() - birthDate.getMonth();

            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }

            return age;
        },
        async submitUser() {
            try {
                Swal.fire({
                    title: "Please wait",
                    allowOutsideClick: false,
                    html: "Adding user",
                    icon: "warning",
                    showLoaderOnConfirm: true,
                    showConfirmButton: false,
                    onRender: () => Swal.showLoading(),
                });

                if (!this.user.password) {
                    this.user.password = this.generatePassword(this.user.role);
                }

                await axios.post("/user/staff/user/add", this.user);
                this.resetForm();
                $("#add-user-modal").modal("hide");

                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Patient has been added!",
                    showConfirmButton: false,
                    timer: 1500,
                });

                this.$emit("displayUsers");
            } catch (error) {
                Swal.close();
                if (error.response && error.response.status === 422) {
                    this.errors = error.response.data.errors;
                } else {
                    console.error("Error adding user:", error);
                }
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "Error adding user",
                    text: "An error occurred while adding the user.",
                    showConfirmButton: true,
                });
            }
        },

        resetForm() {
            this.user = {
                id: "",
                firstname: "",
                lastname: "",
                home_address: "",
                email: "",
                password: "",
                phone_number: "",
                role: "Patient",
            };
            this.errors = {};
        },

        generatePassword(role) {
            return role === "Patient" ? "Patient123!!" : "";
        },
    },
};
</script>
