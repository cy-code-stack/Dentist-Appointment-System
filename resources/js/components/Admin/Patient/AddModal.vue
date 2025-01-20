<template>
    <div class="modal fade" id="add-user-modal">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container">
                        <form @submit.prevent="submitUser">
                            <div class="d-flex justify-content-between w-100">
                                <p class="fs-5 fw-medium">Add Details</p>
                                <button
                                    type="button"
                                    class="btn-close btn-black"
                                    data-bs-dismiss="modal"
                                    aria-label="Close"
                                ></button>
                            </div>
                            <div
                                class="company-serv card w-100 mb-3 d-flex align-items-between justify-content-between p-3"
                            >
                                <p class="fw-medium mb-2">
                                    Fill the form for adding a user.
                                </p>
                                <div
                                    class="form-group mb-1 d-flex justify-content-between w-100"
                                >
                                    <div class="me-1">
                                        <label class="form-label"
                                            >Firstname</label
                                        >
                                        <input
                                            type="text"
                                            class="form-control"
                                            v-model="user.firstname"
                                        />
                                        <div
                                            v-if="errors.firstname"
                                            class="text-danger"
                                        >
                                            <small class="fw-medium">{{
                                                errors.firstname[0]
                                            }}</small>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="form-label"
                                            >Lastname</label
                                        >
                                        <input
                                            type="text"
                                            class="form-control"
                                            v-model="user.lastname"
                                        />
                                        <div
                                            v-if="errors.lastname"
                                            class="text-danger"
                                        >
                                            <small class="fw-medium">{{
                                                errors.lastname[0]
                                            }}</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-1">
                                    <label class="form-label mb-1"
                                        >Home Address</label
                                    >
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="user.home_address"
                                    />
                                    <div
                                        v-if="errors.home_address"
                                        class="text-danger"
                                    >
                                        <small class="fw-medium">{{
                                            errors.home_address[0]
                                        }}</small>
                                    </div>
                                </div>
                                <div class="form-group mb-1">
                                    <label class="form-label mb-1">Email</label>
                                    <input
                                        type="email"
                                        class="form-control"
                                        v-model="user.email"
                                    />
                                    <div
                                        v-if="errors.email"
                                        class="text-danger"
                                    >
                                        <small class="fw-medium">{{
                                            errors.email[0]
                                        }}</small>
                                    </div>
                                </div>
                                <div class="form-group mb-1">
                                    <label class="form-label mb-1"
                                        >Password</label
                                    >
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="user.password"
                                        disabled
                                    />
                                    <div
                                        v-if="errors.password"
                                        class="text-danger"
                                    >
                                        <small class="fw-medium">{{
                                            errors.password[0]
                                        }}</small>
                                    </div>
                                </div>
                                <div class="form-group mb-1">
                                    <label class="form-label mb-1"
                                        >Cellphone Number</label
                                    >
                                    <input
                                        type="tel"
                                        class="form-control"
                                        v-model="user.phone_number"
                                    />
                                    <div
                                        v-if="errors.phone_number"
                                        class="text-danger"
                                    >
                                        <small class="fw-medium">{{
                                            errors.phone_number[0]
                                        }}</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label mb-1">Role</label>
                                    <select
                                        type="text"
                                        class="form-control"
                                        v-model="user.role"
                                    >
                                        <option value="Patient" selected>Patient</option>
                                    </select>
                                </div>
                            </div>

                            <div class="active-btn">
                                <button
                                    type="submit"
                                    class="btn btn-success text-white btn-md-1 w-100"
                                >
                                    Add User
                                </button>
                            </div>
                        </form>
                    </div>
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
                lastname: "",
                home_address: "",
                email: "",
                password: "",
                phone_number: "",
                role: "Patient", 
            },
            errors: {},
        };
    },
    methods: {
        async submitUser() {
            try {
                Swal.fire({
                    title: "Please wait",
                    allowOutsideClick: false,
                    html: "Adding user",
                    icon: "warning",
                    showLoaderOnConfirm: true,
                    showConfirmButton: false,
                    onRender: () => {
                        Swal.showLoading();
                    },
                });

                if (!this.user.password) {
                    this.user.password = this.generatePassword(this.user.role);
                }

                const response = await axios.post("user/admin/patient/add", this.user);

                this.resetForm();
                $("#add-user-modal").modal("hide");

                // Close the loading alert
                Swal.close();

                await Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Patient has been added!",
                    showConfirmButton: false,
                    timer: 1500,
                });

                this.$emit("displayUsers");
            } catch (error) {
                // Close the loading alert in case of error
                Swal.close();

                if (error.response && error.response.status === 422) {
                    // Validation error
                    this.errors = error.response.data.errors;
                } else {
                    // Handle other errors
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
            switch (role) {
                case "Patient":
                    return "Patient123!!";
                default:
                    return "";
            }
        },
    },
    mounted() {},
};
</script>
