<template>
    <div class="modal fade" id="edit-user-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body overflow-auto">
                    <div class="container">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="fw-semibold">Edit User Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <p class="text-muted">Update the necessary details below.</p>

                        <div class="mb-3">
                            <div class="row g-2">
                                <div class="col-md-6">
                                    <label class="form-label">First Name</label>
                                    <input type="text" class="form-control" v-model="user.firstname" placeholder="Enter first name" />
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Last Name</label>
                                    <input type="text" class="form-control" v-model="user.lastname" placeholder="Enter last name" />
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Home Address</label>
                            <input type="text" class="form-control" v-model="user.home_address" placeholder="Enter home address" />
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" v-model="user.email" placeholder="Enter email" />
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Cellphone Number</label>
                            <input type="tel" class="form-control" v-model="user.phone_number" placeholder="Enter phone number" />
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Role</label>
                            <select class="form-select" v-model="user.role">
                                <option value="Patient" selected>Patient</option>
                            </select>
                        </div>

                        <div class="d-grid">
                            <button type="button" class="btn btn-success text-white" @click="updateUser(user.id)">
                                Save Changes
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
@import "/resources/css/Patient/indexpatient.css";
</style>

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
                lastname: "",
                home_address: "",
                email: "",
                phone_number: "",
                role: "",
            },
        };
    },
    methods: {
        updateUser(id) {
            axios
                .put(`/user/admin/patient/update/${id}`, this.user)
                .then(() => {
                    $("#edit-user-modal").modal("hide");
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Patient details updated successfully!",
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
                        text: "Something went wrong. Please try again.",
                    });
                });
        },
    },
    watch: {
        edited_select_user: {
            handler(val) {
                this.user = { ...val };
            },
            deep: true,
        },
    },
};
</script>
