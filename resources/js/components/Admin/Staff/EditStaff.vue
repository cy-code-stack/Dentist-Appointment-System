<template>
    <div class="modal fade" id="edit-user-modal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body overflow-auto">
                    <div class="container-fluid">
                        <div class="d-flex justify-content-between w-100">
                            <p id="editUserModalLabel" class="fs-5 fw-medium">Edit Details</p>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="card w-100 mb-3 p-3">
                            <p class="fw-medium mb-2">Edit the necessary details</p>
                            <div class="form-group mb-3 w-100 d-flex justify-content-center gap-3">
                                <div class="block">
                                    <label class="form-label">Firstname</label>
                                    <input type="text" class="form-control" v-model="user.firstname" placeholder="Enter Firstname"/>
                                </div>
                                <div class="block">
                                    <label class="form-label">Middle Initial</label>
                                    <input type="text" class="form-control" v-model="user.middle_initial"/>
                                </div>
                                <div>
                                    <label class="form-label">Lastname</label>
                                    <input type="text" class="form-control" v-model="user.lastname" placeholder="Enter Lastname"/>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Home Address</label>
                                <input type="text" class="form-control" v-model="user.home_address" placeholder="Enter Home Address"/>
                            </div>
                            <div class="form-group mb-3 d-flex justify-content-center align-items-center gap-3">
                                <div class="block w-100">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" v-model="user.email" placeholder="Enter Email"/>
                                </div>
                                <div class="block w-100">
                                    <label class="form-label">Password</label>
                                    <input type="password" class="form-control" v-model="user.password"/>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Cellphone Number</label>
                                <input type="tel" class="form-control" v-model="user.phone_number" placeholder="Enter Phone Number"/>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Role</label>
                                <select class="form-control" v-model="user.role">
                                    <option value="Assistant" selected>Assistant</option>
                                    <option value="Patient">Patient</option>
                                </select>
                            </div>
                        </div>

                        <div class="active-btn">
                            <button type="button" class="btn btn-success w-100" @click="updateUser(user.id)">Edit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import Swal from "sweetalert2";

export default {
    props: ["edited_select_user"],
    data() {
        return {
            user: {
                id: "",
                firstname: "",
                middle_initial: "",
                lastname: "",
                home_address: "",
                email: "",
                password: "",
                phone_number: "",
                role: "",
            },
        };
    },
    methods: {
        validateForm() {
            if (
                !this.user.firstname ||
                !this.user.lastname ||
                !this.user.email ||
                !this.user.password ||
                !this.user.phone_number ||
                !this.user.role
            ) {
                Swal.fire({
                    icon: "warning",
                    title: "Validation Error",
                    text: "Please fill in all the required fields.",
                });
                return false;
            }
            return true;
        },
        updateUser(id) {
            if (!this.validateForm()) {
                return;
            }
            axios
                .put(`/user/admin/user/update/${id}`, this.user)
                .then((response) => {
                    console.log(response);
                    $("#edit-user-modal").modal("hide");
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Staff has been updated!",
                        showConfirmButton: false,
                        timer: 2000,
                    });
                    this.$emit("updatedUsers");
                })
                .catch((error) => {
                    console.error(error);
                    Swal.fire({
                        icon: "error",
                        title: "Update Failed",
                        text: "An error occurred while updating the user.",
                    });
                });
        },
    },
    watch: {
        edited_select_user: {
            handler(val) {
                Object.assign(this.user, val);
            },
            deep: true,
        },
    },
};
</script>
