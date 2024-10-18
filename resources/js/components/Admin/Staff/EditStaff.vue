<template>
    <div class="modal fade" id="edit-user-modal">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container">
                        <div class="d-flex justify-content-between w-100">
                            <p class="fs-5 fw-medium">Edit Details</p>
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
                                Edit the necessarily details
                            </p>
                            <div
                                class="form-group mb-1 d-flex justify-content-between w-100"
                            >
                                <div class="me-1">
                                    <label class="form-label">Firstname</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="user.firstname"
                                    />
                                </div>
                                <div>
                                    <label class="form-label">Lastname</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="user.lastname"
                                    />
                                </div>
                            </div>
                            <div class="form-group mb-1">
                                <label class="form-label mb-1"
                                    >Home Address
                                </label>
                                <input
                                    type="text"
                                    class="form-control"
                                    v-model="user.home_address"
                                />
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
                                <label class="form-label mb-1"
                                    >Cellphone Number</label
                                >
                                <input
                                    type="tel"
                                    class="form-control"
                                    v-model="user.phone_number"
                                />
                            </div>
                            <div class="form-group">
                                <label class="form-label mb-1">Role</label>
                                <select
                                    type="text"
                                    class="form-control"
                                    id="role"
                                    v-model="user.role"
                                >
                                    <!-- <option value="Patient">Patient</option> -->
                                    <option value="assistant" selected>Assistant</option>
                                </select>
                                <!-- <p class="mt-2 fs-6 fw-medium">Current Role: <span class="text-success">{{ user.role }}</span></p> -->
                            </div>
                        </div>

                        <div class="active-btn">
                            <button
                                type="submit"
                                class="btn btn-success text-white btn-md-1 w-100"
                                @click="updateUser(user.id)"
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
                .put("/user/admin/user/update/" + id, this.user)
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
                    console.log(error);
                });
        },
    },
    watch: {
        edited_select_user: {
            handler(val) {
                this.user.id = val.id;
                this.user.firstname = val.firstname;
                this.user.lastname = val.lastname;
                this.user.home_address = val.home_address;
                this.user.email = val.email;
                this.user.phone_number = val.phone_number;
                this.user.role = val.role;
            },
            deep: true,
        },
    },
    mounted() {
        // console.log("Component loaded");
    },
};
</script>
