<template>
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="d-flex flex-column p-3 align-items-center">
                <div class="card p-4 mb-3 w-100">
                    <div class="card-title">
                        <p class="fs-4 fw-semibold mb-3 ms-2">Personal Information</p>
                        <div class="d-flex align-items-center">
                            <div class="col col-lg-4 d-flex flex-column justify-content-center align-items-center">
                                <div class="image-container mb-1">
                                    <img :src="profileImageSrc || defaultProfile" name="profile_img" class="img-fluid rounded-5 mb-2" alt="photo-logo"/>
                                </div>
                                <div class="active-btn d-flex" v-if="profileInfo">
                                    <button class="btn btn-primary me-2 text-white" @click="toggleFileInput">
                                        <i class="fa-solid fa-upload me-2"></i>
                                        <span>Upload</span>
                                    </button>
                                    <input type="file" ref="fileInput" @change="imgHandlerPatient" style="display: none"/>
                                    <button class="btn btn-danger text-white" @click="removeImage" v-if="isImageUpload">
                                        <i class="fa-solid fa-trash me-2"></i>
                                        <span>Remove</span>
                                    </button>
                                </div>
                            </div>
                            <div class="col col-lg-8">
                                <div class="d-flex mb-1">
                                    <div class="w-100 me-2">
                                        <label class="fw-medium fs-6 mb-1 text-black-50">Firstname</label>
                                        <input type="text" class="form-control" id="fname" placeholder="Enter your firstname" v-model="profile.firstname" :disabled="!profileInfo"/>
                                    </div>
                                    <div class="w-100 me-2">
                                        <label class="fw-medium fs-6 mb-1 text-black-50">Lastname</label>
                                        <input type="text" class="form-control" id="lname" placeholder="Enter your lastname" v-model="profile.lastname" :disabled="!profileInfo"/>
                                    </div>
                                    <div class="w-100">
                                        <label class="fw-medium fs-6 mb-1 text-black-50">Middle Initial</label>
                                        <input type="text" class="form-control" id="mInitial" placeholder="Optional" v-model="profile.middle_initial" :disabled="!profileInfo"/>
                                    </div>
                                </div>
                                <div class="d-flex mb-1">
                                    <div class="w-100 me-2">
                                        <label class="fw-medium fs-6 mb-1 text-black-50">Age</label>
                                        <input type="text" class="form-control" id="age" placeholder="Enter your age" v-model="profile.age" :disabled="!profileInfo"/>
                                    </div>
                                    <div class="w-100 me-2">
                                        <label class="fw-medium fs-6 mb-1 text-black-50">Phone Number</label>
                                        <div class="input-group">
                                            <span class="input-group-text">+63</span>
                                            <input type="text" name="phone_number" class="form-control" v-model="profile.phone_number" :disabled="!profileInfo"/>
                                        </div>
                                    </div>
                                    <div class="w-100">
                                        <label class="fw-medium fs-6 mb-1 text-black-50">Email Address</label>
                                        <input type="email" class="form-control" id="email" placeholder="Enter your email" v-model="profile.email" :disabled="!profileInfo"/>
                                    </div>
                                </div>
                                <div class="d-flex mb-4">
                                    <div class="w-100 me-2">
                                        <label class="fw-medium fs-6 mb-1 text-black-50">Occupation</label>
                                        <input type="text" name="occupation" class="form-control" v-model="profile.occupation" :disabled="!profileInfo"/>
                                    </div>
                                    <div class="w-100 me-2">
                                        <label class="fw-medium fs-6 mb-1 text-black-50">Marital Status</label>
                                        <select class="form-control" name="marital_status" aria-label="marital_status" v-model="profile.marital_status" :disabled="!profileInfo">
                                            <option disabled selected value="">Marital Status*</option>
                                            <option value="Single">Single</option>
                                            <option value="Married">Married</option>
                                            <option value="Widow">Widow</option>
                                            <option value="Prefer not to Say">Prefer not to say</option>
                                        </select>
                                    </div>
                                    <div class="w-100">
                                        <label class="fw-medium fs-6 mb-1 text-black-50">Gender</label>
                                        <select class="form-control" name="sex" aria-label="sex" v-model="profile.sex" :disabled="!profileInfo">
                                            <option disabled selected value="">Gender*</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Prefer not to Say">Prefer not to say</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="active-btn d-flex justify-content-end">
                                    <button class="btn btn-primary me-2 text-white" @click="toggleProfileInfo">
                                        <i class="fa-solid fa-pen-to-square me-2"></i>
                                        <span>Edit Profile Information</span>
                                    </button>
                                    <button type="submit" class="btn btn-success text-white" @click="updateProfile(profile.id)" :disabled="!profileInfo">
                                        <i class="fa-solid fa-floppy-disk me-2"></i>
                                        <span>Save Changes</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col col-lg-12 p-0">
                    <div class="card p-4 mb-3">
                        <p class="fs-5 fw-semibold mb-2">Change Password</p>
                        <div class="d-flex mb-1">
                            <div class="w-100 me-2">
                                <label class="fw-medium fs-6 mb-1 text-black-50">Current Password</label>
                                <input type="password" class="form-control" name="old_password" placeholder="Old Password" :disabled="!infoPass"/>
                                <div v-if="errors.old_password" class="text-danger">
                                    <span><small>{{ errors.old_password[0] }}</small></span>
                                </div>
                            </div>
                            <div class="w-100 me-2">
                                <label class="fw-medium fs-6 mb-1 text-black-50">New Password</label>
                                <input type="password" class="form-control" name="password" placeholder="New Password" :disabled="!infoPass"/>
                                <div v-if="errors.password" class="text-danger">
                                    <span><small>{{ errors.password[0] }}</small></span>
                                </div>
                            </div>
                            <div class="w-100 mb-3">
                                <label class="fw-medium fs-6 mb-1 text-black-50">Confirm Password</label>
                                <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm your Password" :disabled="!infoPass"/>
                                <div v-if="errors.password_confirmation" class="text-danger">
                                    <span><small>{{ errors.password_confirmation[0] }}</small></span>
                                </div>
                            </div>
                        </div>
                        <div class="active-btn d-flex justify-content-end">
                                <button class="btn btn-primary me-2 text-white" @click="togglePassInfo">
                                    <i class="fa-solid fa-lock me-2"></i>
                                    <span>Change Password</span>
                                </button>
                                <button type="submit" class="btn btn-success text-white" :disabled="!infoPass" @click="changePassword">
                                    <i class="fa-solid fa-floppy-disk me-2"></i>
                                    <span>Save Changes</span>
                                </button>
                            </div>
                    </div>
                    <div class="col col-lg-12 p-0">
                        <div class="card p-4">
                            <p class="fs-5 fw-medium mb-0">
                                Delete your account
                            </p>
                            <p class="fs-6 text-black-50 text-break">
                                Permanently remove your Personal Account and all
                                of its associated content from this application.
                                This action cannot be undone, so please proceed
                                with caution. Once initiated, all data tied to
                                your account, including personal information and
                                interactions will be irretrievably deleted from
                                our system. We advise thorough consideration
                                before proceeding with this irreversible action.
                            </p>
                            <div class="active-btn d-flex justify-content-end">
                                <button class="btn btn-danger text-white" @click="destroyUser">
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
</template>

<script>
import axios from "axios";
export default {
    data() {
        return {
            profile: {
                id: "",
                firstname: "",
                lastname: "",
                middle_initial: "",
                email: "",
                home_address: "",
                phone_number: "",
                age: "",
                sex: "",
                profile_img: "",
                marital_status: "",
                occupation: ""
            },
            defaultProfile: "/images/avatar.png",
            profileInfo: false,
            oldPassword: '',
            newPassword: '',
            confirmPassword: '',
            errors: {},
            infoPass: false,
        };
    },
    computed: {
        profileImageSrc(){
            return this.profile.profile_img || this.defaultProfile;
        },
        isImageUpload(){
            return this.profile.profile_img && this.profile.profile_img !== this.defaultProfile;
        }
    },
    methods: {
        toggleProfileInfo(){
            return this.profileInfo = !this.profileInfo;
        },
        togglePassInfo(){
            return this.infoPass = !this.infoPass;
        },
        toggleFileInput(){
            this.$refs.fileInput.click();
        },
        imgHandlerPatient(event){
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = (e) =>{
                    this.profile.profile_img = e.target.result;
                };
                reader.readAsDataURL(file);

                const formData = new FormData();
                formData.append('profile_img', file);

                axios.post('/user/patient/profile/uploadImage', formData)
                    .then((response)=>{
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
                        this.profile.profile_img = response.data.data['profile_img'];
                    }).catch((e)=>{
                        console.log(e);
                    });
            }
        },
        displayProfile(){
            axios.get('/user/patient/profile/displayUser')
                .then((response)=>{
                    this.profile = response.data;
                }).catch((e)=>{
                    console.log(e);
                });
        },
        updateProfile(id){
            axios.put(`/user/patient/profile/updateProfile/${id}`, this.profile)
                .then((response)=>{
                    Swal.fire({
                        icon: 'success',
                        title: 'Profile has been updated!',
                        timer: 2000,
                        timerProgressBar: true,
                        showConfirmButton: false
                    });
                    this.toggleProfileInfo();
                }).catch((e)=>{
                    console.log(e);
                });
        },
        removeImage(){
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
                    axios.delete('/user/patient/profile/deleteImage')
                        .then(() => {
                            this.profile.profile_img = '';
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
        changePassword(){
            const data = {
                old_password: this.oldPassword,
                password: this.newPassword,
                password_confirmation: this.confirmPassword
            };

            axios.post('/user/patient/profile/change_pass', data)
                .then(()=>{
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
                    this.errors();
            }).catch((error)=>{
                console.log('The error :', error);
                if (error.response && error.response.data) {
                    this.errors = error.response.data.errors || {};
                }
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
                    axios.delete('/user/patient/profile/deleteUser')
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
    },
};
</script>

<style scope>
.image-container {
    max-width: 200px;
    max-height: 200px;
    overflow: hidden;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 50%;
    background-color: #f8f9fa;
}

.image-container img {
    object-fit: cover;
    max-width: 180px;
    max-height: 180px;
}
</style>
