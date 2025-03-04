<template>
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-sm p-4">
                    <h4 class="fw-bold mb-3 text-primary">Personal Information</h4>
                    <div class="row align-items-center">
                        <div class="col-lg-3 text-center">
                            <div class="mb-3 position-relative">
                                <img :src="profileImageSrc || defaultImagePath" 
                                     class="img-fluid rounded-circle border shadow-sm" 
                                     alt="profile image" 
                                     style="width: 130px; height: 130px; object-fit: cover;" />
                                <div class="mt-3">
                                    <button class="btn btn-sm btn-outline-primary me-2" @click="triggerFileInput">Upload</button>
                                    <button class="btn btn-sm btn-outline-danger" v-if="isImageUploaded" @click="removeImage">Remove</button>
                                    <input type="file" ref="fileInput" @change="handleFileChange" class="d-none" />
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label">First Name</label>
                                    <input type="text" class="form-control shadow-sm" v-model="profileInfo.firstname" :disabled="!personalDetails">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Last Name</label>
                                    <input type="text" class="form-control shadow-sm" v-model="profileInfo.lastname" :disabled="!personalDetails">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Middle Initial</label>
                                    <input type="text" class="form-control shadow-sm" v-model="profileInfo.middle_initial" :disabled="!personalDetails">
                                </div>
                            </div>
                            <div class="row g-3 mt-2">
                                <div class="col-md-6">
                                    <label class="form-label">Home Address</label>
                                    <input type="text" class="form-control shadow-sm" v-model="profileInfo.home_address" :disabled="!personalDetails">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Email Address</label>
                                    <input type="email" class="form-control shadow-sm" v-model="profileInfo.email" :disabled="!personalDetails">
                                </div>
                            </div>
                            <div class="row g-3 mt-2">
                                <div class="col-md-6">
                                    <label class="form-label">Phone Number</label>
                                    <div class="input-group shadow-sm">
                                        <span class="input-group-text bg-light">+63</span>
                                        <input type="text" class="form-control" v-model="profileInfo.phone_number" :disabled="!personalDetails">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Occupation</label>
                                    <input type="text" class="form-control shadow-sm" v-model="profileInfo.occupation" :disabled="!personalDetails">
                                </div>
                            </div>
                            <div class="row g-3 mt-2">
                                <div class="col-md-6">
                                    <label class="form-label">Marital Status</label>
                                    <select class="form-select shadow-sm" v-model="profileInfo.marital_status" :disabled="!personalDetails">
                                        <option disabled value="">Select</option>
                                        <option value="Single">Single</option>
                                        <option value="Married">Married</option>
                                        <option value="Widow">Widow</option>
                                        <option value="Prefer not to Say">Prefer not to say</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Gender</label>
                                    <select class="form-select shadow-sm" v-model="profileInfo.sex" :disabled="!personalDetails">
                                        <option disabled value="">Select</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Prefer not to Say">Prefer not to say</option>
                                    </select>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end mt-3">
                                <button class="btn btn-outline-primary me-2 shadow-sm" @click="toggleDetailsEdit">Edit</button>
                                <button class="btn btn-success shadow-sm" @click="updateProfile(profileInfo.id)" :disabled="!personalDetails">Save</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm p-4 mt-4">
                    <h4 class="fw-bold mb-3 text-primary">Change Password</h4>
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label class="form-label">Old Password</label>
                            <input type="password" class="form-control shadow-sm" v-model="oldPassword" :disabled="!passDetails">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">New Password</label>
                            <input type="password" class="form-control shadow-sm" v-model="newPassword" :disabled="!passDetails">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" class="form-control shadow-sm" v-model="confirmPassword" :disabled="!passDetails">
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-3">
                        <button class="btn btn-outline-primary me-2 shadow-sm" @click="togglePassEdit">Edit</button>
                        <button class="btn btn-success shadow-sm" @click="changePassword" :disabled="!passDetails">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            profileInfo: {
                id: '',
                firstname: '',
                lastname: '',
                middle_initial: '',
                profile_img: '',
                age: '',
                home_address: '',
                email: '',
                phone_number: '',
                occupation: '',
                marital_status: '',
                sex: ''
            },
            oldPassword: '',
            newPassword: '',
            confirmPassword: '',
            defaultImagePath: '/images/avatar.png',
            personalDetails: false,
            passDetails: false,
            errors: {}
        };
    },
    computed: {
        profileImageSrc() {
            return this.profileInfo.profile_img || this.defaultImagePath;
        },
        isImageUploaded() {
            return this.profileInfo.profile_img && this.profileInfo.profile_img !== this.defaultImagePath;
        },
    },
    methods: {
        toggleDetailsEdit() {
            this.personalDetails = !this.personalDetails;
            if (!this.personalDetails) {
                this.displayProfile();
            }
        },
        togglePassEdit() {
            this.passDetails = !this.passDetails;
        },
        changePassword() {
            const data = {
                old_password: this.oldPassword,
                password: this.newPassword,
                password_confirmation: this.confirmPassword
            };

            axios.post('/admin/profile/changePass', data)
                .then(() => {
                    this.errors = {};
                    this.oldPassword = '',
                    this.newPassword = '',
                    this.confirmPassword = ''
                    Swal.fire({
                        icon: 'success',
                        title: 'Password has been change!',
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer);
                            toast.addEventListener('mouseleave', Swal.resumeTimer);
                        }
                    });
                    this.togglePassEdit();
                })
                .catch((error) => {
                    console.log('The error :', error);
                    if (error.response && error.response.data) {
                        this.errors = error.response.data.errors || {};
                    }
                });
        },
        displayProfile() {
            axios.get('/admin/profile/user')
                .then(response => {
                    this.profileInfo = response.data;
                })
                .catch(error => {
                    console.log('The error was:', error);
                });
        },
        updateProfile(id) {
            axios.put(`/admin/profile/update/${id}`, this.profileInfo)
                .then(() => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Profile has been updated!',
                        timer: 2000,
                        timerProgressBar: true,
                        showConfirmButton: false
                    });
                    this.toggleDetailsEdit();
                })
                .catch(error => {
                    console.log('The error was:', error.response ? error.response.data : error.message);
                    Swal.fire({
                        icon: 'error',
                        title: 'Something went wrong',
                        text: error.response ? error.response.data.message : 'Error details unavailable'
                    });
                });
        },
        triggerFileInput() {
            this.$refs.fileInput.click();
        },
        handleFileChange(event) {
            const file = event.target.files[0];
            
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    this.profileInfo.profile_img = e.target.result; 
                };
                reader.readAsDataURL(file);

                const formData = new FormData();
                formData.append('profile_img', file);

                axios.post('/admin/profile/upload', formData)
                    .then((data) => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Image has been uploaded!',
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer);
                                toast.addEventListener('mouseleave', Swal.resumeTimer);
                            }
                        });
                        this.profileInfo.profile_img = data.data.data['profile_img'];
                    })
                    .catch(error => {
                        console.log('The error was:', error);
                    });
            }
        },
        removeImage() {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, remove it!"
            }).then(result => {
                if (result.isConfirmed) {
                    axios.delete('/admin/profile/destroy')
                        .then(() => {
                            this.profileInfo.profile_img = '';
                            this.$refs.fileInput.value = '';
                            Swal.fire({
                                icon: 'success',
                                title: 'Image has been removed!',
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 2000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer);
                                    toast.addEventListener('mouseleave', Swal.resumeTimer);
                                }
                            });
                        })
                        .catch(error => {
                            console.log('The error was:', error.response ? error.response.data : error.message);
                            Swal.fire({
                                icon: 'error',
                                title: 'Something went wrong',
                                text: error.response ? error.response.data.message : 'Error details unavailable'
                            });
                        });
                }
            }).catch(error => {
                console.log('The error was:', error);
            });
        },
        destroyUser(){
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, remove it!"
            }).then(result => {
                if (result.isConfirmed) {
                    axios.delete('/admin/profile/userDestroy')
                        .then(() => {
                            Swal.fire({
                                icon: 'success',
                                title: 'User has been remove!',
                                timer: 2000,
                                timerProgressBar: true,
                                showConfirmButton: false
                            });
                        })
                        .catch(error => {
                            console.log('The error was:', error.response ? error.response.data : error.message);
                            Swal.fire({
                                icon: 'error',
                                title: 'Something went wrong',
                                text: error.response ? error.response.data.message : 'Error details unavailable'
                            });
                        });
                }
            }).catch(error => {
                console.log('The error was:', error);
            });
        }
    },
    mounted() {
        this.displayProfile();
    }
}
</script>


<style scoped>
    .card {
        border-radius: 12px;
        background: #ffffff;
    }
    .form-control, .form-select {
        border-radius: 8px;
        border: 1px solid #ced4da;
        padding: 10px;
    }
    .btn {
        border-radius: 8px;
    }
    .input-group-text {
        border-radius: 8px 0 0 8px;
    }
    .form-label {
        font-weight: 600;
        color: #333;
    }
</style>
