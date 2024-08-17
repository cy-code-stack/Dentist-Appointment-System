<template>
    <div class="container-fluid">
        <div class="wrapper">
            <div class="d-flex flex-column p-3 align-items-center">
                <div class="card p-2">
                    <div class="card-title">
                        <p class="fs-4 fw-semibold mb-1 ms-2">Personal Information</p>
                        <div class="d-flex align-items-center">
                            <div class="col col-lg-3 d-flex flex-column justify-content-center align-items-center">
                                <div class="image-container mb-2">
                                    <img :src="profileImageSrc || defaultImagePath" name="profile_img" class="img-fluid rounded-5" alt="profile image" />
                                </div>
                                <div class="active-btn d-flex" v-if="personalDetails">
                                    <button @click="triggerFileInput" class="btn btn-primary me-2 text-white">
                                        <i class="fa-solid fa-upload me-2"></i>
                                        <span>Upload</span>
                                    </button>
                                    <input type="file" ref="fileInput" @change="handleFileChange" style="display: none;"/>
                                    
                                    <button class="btn btn-danger text-white" @click="removeImage" v-if="isImageUploaded">
                                        <i class="fa-solid fa-trash me-2"></i>
                                        <span>Remove</span>
                                    </button>
                                </div>
                            </div>
                            <div class="col col-lg-9">
                                <div class="d-flex mb-2">
                                    <div class="w-100 me-2">
                                        <input type="text" name="firstname" class="form-control" v-model="profileInfo.firstname" :disabled="!personalDetails">
                                    </div>
                                    <div class="w-100 me-2">
                                        <input type="text" name="lastname" class="form-control" v-model="profileInfo.lastname" :disabled="!personalDetails">
                                    </div>
                                    <div class="w-100 me-2">
                                        <input type="text" name="middle_initial" class="form-control" v-model="profileInfo.middle_initial" :disabled="!personalDetails">
                                    </div>
                                    <div class="w-100">
                                        <input type="text" name="age" class="form-control" v-model="profileInfo.age" :disabled="!personalDetails">
                                    </div>
                                </div>
                                <div class="d-flex mb-2">
                                    <div class="w-100 me-2">
                                        <input type="text" name="home_address" class="form-control" v-model="profileInfo.home_address" :disabled="!personalDetails">
                                    </div>
                                    <div class="w-100 me-2">
                                        <input type="email" name="email" class="form-control" v-model="profileInfo.email" :disabled="!personalDetails">
                                    </div>
                                    <div class="w-100">
                                        <div class="input-group">
                                            <span class="input-group-text">+63</span>
                                            <input type="text" name="phone_number" class="form-control" v-model="profileInfo.phone_number" :disabled="!personalDetails">
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex mb-4">
                                    <div class="w-100 me-2">
                                        <input type="text" name="occupation" class="form-control" v-model="profileInfo.occupation" :disabled="!personalDetails">
                                    </div>
                                    <div class="w-100 me-2">
                                        <select class="form-control" name="marital_status" aria-label="marital_status" v-model="profileInfo.marital_status" :disabled="!personalDetails">
                                            <option disabled value="">Marital Status*</option>
                                            <option value="Single">Single</option>
                                            <option value="Married">Married</option>
                                            <option value="Widow">Widow</option>
                                            <option value="Prefer not to Say">Prefer not to say</option>
                                        </select>
                                    </div>
                                    <div class="w-100 me-2">
                                        <select class="form-control" name="sex" aria-label="sex" v-model="profileInfo.sex" :disabled="!personalDetails">
                                            <option disabled value="">Gender*</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Prefer not to Say">Prefer not to say</option>
                                        </select>
                                    </div>
                                </div>
                                <div  class="active-btn d-flex justify-content-end">
                                    <button class="btn btn-primary me-2 text-white" @click="toggleDetailsEdit">
                                        <i class="fa-solid fa-pen-to-square me-2"></i>
                                        <span>Edit Personal Information</span>
                                    </button>
                                    <button @click="updateProfile(profileInfo.id)" class="btn btn-success text-white" :disabled="!personalDetails">
                                        <i class="fa-solid fa-floppy-disk me-2"></i>
                                        <span>Save Changes</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pass-cont">
                    <div class="row justify-content-between align-items-start">
                        <div class="col-lg-7">
                            <div class="card p-3 equal-height">
                                <div class="card-content">
                                    <p class="fs-5 fw-semibold mb-2">Change Password</p>
                                    <div class="row mb-3">
                                        <div class="col-12 mb-2">
                                            <input 
                                                type="password" 
                                                v-model="oldPassword" 
                                                class="form-control" 
                                                name="old_password" 
                                                placeholder="Old Password" 
                                                :disabled="!passDetails"
                                            />
                                            <div v-if="errors.old_password" class="text-danger">
                                                <span><small>{{ errors.old_password[0] }}</small></span>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-2">
                                            <input 
                                                type="password" 
                                                v-model="newPassword" 
                                                class="form-control" 
                                                name="password" 
                                                placeholder="New Password" 
                                                :disabled="!passDetails"
                                            />
                                            <div v-if="errors.password" class="text-danger">
                                                <span><small>{{ errors.password[0] }}</small></span>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <input 
                                                type="password" 
                                                v-model="confirmPassword" 
                                                class="form-control"
                                                name="password_confirmation"
                                                placeholder="Confirm your Password" 
                                                :disabled="!passDetails"
                                            />
                                            <div v-if="errors.password_confirmation" class="text-danger">
                                                <span><small>{{ errors.password_confirmation[0] }}</small></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <button 
                                            class="btn btn-primary me-2 text-white" 
                                            @click="togglePassEdit"
                                        >
                                            <i class="fa-solid fa-lock me-2"></i>
                                            <span>Change Password</span>
                                        </button>
                                        <button 
                                            class="btn btn-success text-white" 
                                            @click="changePassword"
                                            :disabled="!passDetails || errors.new_password || errors.new_password_confirmation"
                                        >
                                            <i class="fa-solid fa-floppy-disk me-2"></i>
                                            <span>Save Changes</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Delete Account Section -->
                        <div class="col-lg-5">
                            <div class="card p-3 equal-height">
                                <div class="card-content">
                                    <p class="fs-5 fw-medium mb-2">Delete your account</p>
                                    <p class="fs-6 text-black-50 text-justify mb-1">
                                        Permanently remove your Personal Account and all
                                        of its associated content from this application.
                                        This action cannot be undone, so please proceed
                                        with caution. Once initiated, all data tied to
                                        your account, including personal information and
                                        interactions will be irretrievably deleted from
                                        our system. We advise thorough consideration
                                        before proceeding with this irreversible action.
                                    </p>
                                    <div class="d-flex justify-content-end" @click="destroyUser">
                                        <button class="btn btn-danger text-white">
                                            <i class="fa-solid fa-trash me-2"></i>
                                            <span>Delete your account</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
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
    @import '/resources/css/Admin/profile.css'
</style>
