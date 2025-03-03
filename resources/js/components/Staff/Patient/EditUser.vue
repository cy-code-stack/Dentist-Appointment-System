<template>
    <div class="modal fade" id="edit-user-modal" ref="editUserModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body overflow-auto">
                    <div class="container">
                        <div class="d-flex justify-content-between w-100">
                            <p class="fs-5 fw-medium">Edit Patient</p>
                            <button
                                type="button"
                                class="btn-close btn-black"
                                data-bs-dismiss="modal"
                                aria-label="Close"
                            ></button>
                        </div>
                        <div class="mb-1 d-flex flex-column p-3">
                            <p class="fw-medium mb-2">
                                Edit the necessary details
                            </p>
                            <div class="form-group mb-1 d-flex justify-content-between w-100 gap-2">
                                <div class="w-100">
                                    <label class="form-label">Firstname</label>
                                    <input type="text" class="form-control w-100" v-model="user.firstname"/>
                                </div>
                                <div class="w-100">
                                    <label class="form-label">Lastname</label>
                                    <input type="text" class="form-control w-100" v-model="user.lastname"/>
                                </div>
                            </div>
                            <div class="form-group mb-1 w-100">
                                <label class="form-label mb-1">Home Address</label>
                                <input type="text" class="form-control w-100" v-model="user.home_address"/>
                            </div>
                            <div class="form-group mb-1">
                                <label class="form-label mb-1">Email</label>
                                <input
                                    type="email"
                                    class="form-control"
                                    v-model="user.email"
                                />
                            </div>
                            <div class="form-group mb-1">
                                <label class="form-label mb-1">Cellphone Number</label>
                                <input
                                    type="tel"
                                    class="form-control"
                                    v-model="user.phone_number"
                                />
                            </div>
                            <div class="form-group">
                                <label class="form-label mb-1">Role</label>
                                <select
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
                                @click="updateUser"
                            >
                                Edit
                            </button>
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
import axios from "axios";
import { Modal } from "bootstrap";

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
            modalInstance: null,
        };
    },
    methods: {
        updateUser() {
            axios
                .put(`/user/staff/user/update/${this.user.id}`, this.user)
                .then((response) => {
                    console.log(response);
                    this.hideModal();
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Patient has been updated!",
                        showConfirmButton: false,
                        timer: 2000,
                    });
                    this.$emit("updatedUsers");
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        showModal() {
            if (this.modalInstance) {
                this.modalInstance.show();
            }
        },
        hideModal() {
            if (this.modalInstance) {
                this.modalInstance.hide();
            }
        },
    },
    watch: {
        edited_select_user: {
            handler(val) {
                if (val) {
                    this.user = { ...val }; // Use spread operator to ensure reactivity
                    this.showModal(); // Show modal when user data is updated
                }
            },
            deep: true,
        },
    },
    mounted() {
        this.modalInstance = new Modal(this.$refs.editUserModal);
    },
};
</script>
