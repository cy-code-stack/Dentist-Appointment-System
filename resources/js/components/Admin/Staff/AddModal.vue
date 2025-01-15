<template>
    <div class="modal fade" id="add-user-modal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Add Details</h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>
                <div class="modal-body overflow-auto">
                    <form @submit.prevent="submitUser">
                        <div class="mb-3">
                            <label class="form-label">Firstname</label>
                            <input type="text" class="form-control" v-model="user.firstname" />
                            <div v-if="errors.firstname" class="text-danger">
                                <small>{{ errors.firstname[0] }}</small>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Lastname</label>
                            <input type="text" class="form-control" v-model="user.lastname" />
                            <div v-if="errors.lastname" class="text-danger">
                                <small>{{ errors.lastname[0] }}</small>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Home Address</label>
                            <input type="text" class="form-control" v-model="user.home_address" />
                            <div v-if="errors.home_address" class="text-danger">
                                <small>{{ errors.home_address[0] }}</small>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" v-model="user.email" />
                            <div v-if="errors.email" class="text-danger">
                                <small>{{ errors.email[0] }}</small>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input
                                type="text"
                                class="form-control"
                                v-model="user.password"
                                disabled
                            />
                            <div v-if="errors.password" class="text-danger">
                                <small>{{ errors.password[0] }}</small>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Cellphone Number</label>
                            <input type="tel" class="form-control" v-model="user.phone_number" />
                            <div v-if="errors.phone_number" class="text-danger">
                                <small>{{ errors.phone_number[0] }}</small>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Role</label>
                            <select class="form-control" v-model="user.role">
                                <option value="Assistant" selected>Assistant</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Add User</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import Swal from "sweetalert2";

export default {
    data() {
        return {
            user: {
                firstname: "",
                lastname: "",
                home_address: "",
                email: "",
                password: "",
                phone_number: "",
                role: "Assistant",
            },
            errors: {},
        };
    },
    methods: {
        async submitUser() {
            try {
                Swal.fire({
                    title: "Please wait",
                    html: "Adding user...",
                    allowOutsideClick: false,
                    didOpen: () => Swal.showLoading(),
                });

                if (!this.user.password) {
                    this.user.password = this.generatePassword(this.user.role);
                }

                const response = await axios.post("/user/admin/user/add", this.user);
                this.resetForm();
                $("#add-user-modal").modal("hide");

                Swal.fire({
                    icon: "success",
                    title: "Staff has been added!",
                    timer: 1500,
                    showConfirmButton: false,
                });

                this.$emit("displayUsers");
            } catch (error) {
                Swal.close();

                if (error.response?.status === 422) {
                    this.errors = error.response.data.errors;
                } else {
                    console.error(error);
                    Swal.fire({
                        icon: "error",
                        title: "Error adding user",
                        text: error.message || "An error occurred.",
                    });
                }
            }
        },
        resetForm() {
            this.user = {
                firstname: "",
                lastname: "",
                home_address: "",
                email: "",
                password: "",
                phone_number: "",
                role: "Assistant",
            };
            this.errors = {};
        },
        generatePassword(role) {
            const passwords = {
                Assistant: "Staff123!!",
            };
            return passwords[role] || "Default123!!";
        },
    },
};
</script>
