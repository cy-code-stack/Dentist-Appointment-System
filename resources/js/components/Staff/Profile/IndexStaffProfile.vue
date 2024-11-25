<template>
    <div class="container-fluid">
        <div class="container">
            <div class="d-flex flex-column p-3 align-items-center">
                <div class="card p-2 w-100">
                    <div class="card-title">
                        <p class="fs-4 fw-semibold mb-1 ms-2">Personal Information</p>
                        <div class="d-flex align-items-center">
                            <div class="col col-lg-4 d-flex flex-column justify-content-center align-items-center">
                                <div class="image-container mb-3">
                                    <img :src="profileImageSrc || defaultProfile" name="profile_img" class="img-fluid rounded-5"  alt="photo-logo" />
                                </div>
                                <div class="active-btn d-flex" v-if="assitantProfInfo">
                                    <button class="btn btn-primary me-2 text-white" @click="triggerFileInput">
                                        <i class="fa-solid fa-upload me-2"></i>
                                        <span>Upload</span>
                                    </button>
                                    <input type="file" ref="fileInput" @change="handlerImageFile" style="display: none;">
                                    <button class="btn btn-danger text-white" @click="removeAvatar" v-if="isImageUpload">
                                        <i class="fa-solid fa-trash me-2"></i>
                                        <span>Remove</span>
                                    </button>
                                </div>
                            </div>
                            <div class="col col-lg-8">
                                <div class="d-flex mb-1">
                                    <div class=" w-100 me-2">
                                        <label for="" class="fw-medium fs-6 mb-1 text-black-50">Firstname</label>
                                        <input type="text" class="form-control" id="fname" placeholder="Enter your firstname" v-model="assistantProfile.firstname" :disabled="!assitantProfInfo">
                                    </div>
                                    <div class=" w-100 me-2">
                                        <label for="" class="fw-medium fs-6 mb-1 text-black-50">Lastname</label>
                                        <input type="text" class="form-control" id="lname" placeholder="Enter your lastname" v-model="assistantProfile.lastname" :disabled="!assitantProfInfo">
                                    </div>
                                    <div class=" w-100">
                                        <label for="" class="fw-medium fs-6 mb-1 text-black-50">Middle Initial</label>
                                        <input type="text" class="form-control" id="mInitial" placeholder="Optional" v-model="assistantProfile.middle_initial" :disabled="!assitantProfInfo">
                                    </div>
                                </div>
                                <div class="d-flex mb-1">
                                    <div class=" w-100 me-2">
                                        <label for="" class="fw-medium fs-6 mb-1 text-black-50">Age</label>
                                        <input type="text" class="form-control" id="age" placeholder="Enter your age" v-model="assistantProfile.age" :disabled="!assitantProfInfo">
                                    </div>
                                    <div class="w-100 me-2">
                                        <label for="" class="fw-medium fs-6 mb-1 text-black-50">Phone Number</label>
                                        <div class="input-group">
                                            <span class="input-group-text">+63</span>
                                            <input type="text" name="phone_number" class="form-control" v-model="assistantProfile.phone_number" :disabled="!assitantProfInfo">
                                        </div>
                                    </div>
                                    <div class="w-100">
                                        <label for="" class="fw-medium fs-6 mb-1 text-black-50">Email Address</label>
                                        <input type="email" class="form-control" id="email" placeholder="Enter your email" v-model="assistantProfile.email" :disabled="!assitantProfInfo">
                                    </div>
                                </div>
                                <div class="d-flex mb-4">
                                    <div class="w-100 me-2">
                                        <label for="" class="fw-medium fs-6 mb-1 text-black-50">Occupation</label>
                                        <input type="text" name="occupation" class="form-control" v-model="assistantProfile.occupation" :disabled="!assitantProfInfo">
                                    </div>
                                    <div class="w-100 me-2">
                                        <label for="" class="fw-medium fs-6 mb-1 text-black-50">Marital Status</label>
                                        <select class="form-control" name="marital_status" aria-label="marital_status" v-model="assistantProfile.marital_status" :disabled="!assitantProfInfo">
                                            <option disabled selected value="">Marital Status*</option>
                                            <option value="Single">Single</option>
                                            <option value="Married">Married</option>
                                            <option value="Widow">Widow</option>
                                            <option value="Prefer not to Say">Prefer not to say</option>
                                        </select>
                                    </div>
                                    <div class="w-100">
                                        <label for="" class="fw-medium fs-6 mb-1 text-black-50">Gender</label>
                                        <select class="form-control" name="sex" aria-label="sex" v-model="assistantProfile.sex" :disabled="!assitantProfInfo">
                                            <option disabled selected value="">Gender*</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Prefer not to Say">Prefer not to say</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="active-btn d-flex justify-content-end">
                                    <button class="btn btn-primary me-2 text-white" @click="toogleProfInfo">
                                        <i class="fa-solid fa-pen-to-square me-2"></i>
                                        <span>Edit Profile Information</span>
                                    </button>
                                    <button type="submit" class="btn btn-success text-white" @click="updateProfile(assistantProfile.id)" :disabled="!assitantProfInfo">
                                        <i class="fa-solid fa-floppy-disk me-2"></i>
                                        <span>Save Changes</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                    <div class="col col-lg-12 p-0">
                        <div class="card p-4">
                            <p class="fs-5 fw-semibold mb-2">Change Password</p>
                            <div class="d-flex mb-1">
                                <div class=" w-100 me-2">
                                    <label for="" class="fw-medium fs-6 mb-1 text-black-50">Current Password</label>
                                    <input type="password" class="form-control" name="old_password" placeholder="Old Password" v-model="oldPassword" :disabled="!assitantPassInfo">
                                    <div v-if="errors.old_password" class="text-danger">
                                        <span><small>{{ errors.old_password[0] }}</small></span>
                                    </div>
                                </div>
                                <div class=" w-100 me-2">
                                    <label for="" class="fw-medium fs-6 mb-1 text-black-50">New Password</label>
                                    <input type="password" class="form-control" name="password" placeholder="New Password" v-model="newPassword" :disabled="!assitantPassInfo">
                                    <div v-if="errors.password" class="text-danger">
                                        <span><small>{{ errors.password[0] }}</small></span>
                                    </div>
                                </div>
                            </div>
                            <div class=" w-100 mb-3">
                                <label for="" class="fw-medium fs-6 mb-1 text-black-50">Confirm Password</label>
                                <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm your Password" v-model="confirmPassword" :disabled="!assitantPassInfo">
                                <div v-if="errors.password_confirmation" class="text-danger">
                                    <span><small>{{ errors.password_confirmation[0] }}</small></span>
                                </div>
                            </div>
                            <div class="active-btn d-flex justify-content-end">
                                <button class="btn btn-primary me-2 text-white" @click="tooglePassInfo">
                                    <i class="fa-solid fa-lock me-2"></i>
                                    <span>Change Password</span>
                                </button>
                                <button type="submit" class="btn btn-success text-white" @click="changePass" :disabled="!assitantPassInfo || errors.old_password || errors.new_password || errors.new_password_confirmation">
                                    <i class="fa-solid fa-floppy-disk me-2"></i>
                                    <span>Save Changes</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col col-lg-12 p-0">
                        <div class="card p-4">
                            <p class="fs-5 fw-medium mb-0">Delete your account</p>
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
                                <button class="btn btn-danger text-white" @click="destroyUserCred">
                                    <i class="fa-solid fa-trash me-2"></i>
                                    <span>Delete your account</span>
                                </button>
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
    data(){
        return{
            assistantProfile: {
                id: '',
                firstname: '',
                lastname: '',
                middle_initial: '',
                email: '',
                home_address: '',
                phone_number: '',
                age: '',
                sex: '',
                profile_img: '',
                marital_status: '',
                occupation: ''
            },
            errors: {},
            defaultProfile: '/images/avatar.png',
            assitantProfInfo: false,
            assitantPassInfo: false,
            oldPassword: '',
            newPassword: '',
            confirmPassword: '',
        }
    },
    computed:{
        profileImageSrc(){
            return this.assistantProfile?.profile_img || this.defaultProfile;
        },
        isImageUpload(){
            return this.assistantProfile.profile_img && this.assistantProfile.profile_img !== this.defaultProfile;
        }
    },
    methods:{
        toogleProfInfo(){
            this.assitantProfInfo = !this.assitantProfInfo;
            if (!this.assitantProfInfo) {
                this.displayProfile(); 
            }
        },
        tooglePassInfo(){
            this.assitantPassInfo = !this.assitantPassInfo;
        }, 
        triggerFileInput(){
            this.$refs.fileInput.click();
        },
        handlerImageFile(event){
            const imgFile = event.target.files[0];
            if (imgFile) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    this.assistantProfile.profile_img = e.target.result; 
                };
                reader.readAsDataURL(imgFile);

                const formData = new FormData();
                formData.append('profile_img', imgFile)

                axios.post('/user/assistant/profile/upload', formData)
                    .then((data)=>{
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
                        this.assistantProfile.profile_img = data.data.data['profile_img'];
                    }).catch((e)=>{
                        console.log(e);
                    });
            }
        },

        displayProfile(){
            axios.get('/user/assistant/profile/display')
                .then((response)=>{
                    this.assistantProfile = response.data.data;
                }).catch((e)=>{
                    console.log(e);
                });
        },

        changePass(){
            const data = {
                old_password: this.oldPassword,
                password: this.newPassword,
                password_confirmation: this.confirmPassword
            };

            axios.post('/user/assistant/profile/passChange', data)
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

        removeAvatar(){
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
                    axios.delete('/user/assistant/profile/removeAvatar')
                        .then(() => {
                            this.assistantProfile.profile_img = '';
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

        updateProfile(id){
            axios.put(`/user/staff/profile/update/${id}`, this.assistantProfile)
                .then((response)=>{
                    Swal.fire({
                        icon: 'success',
                        title: 'Profile has been updated!',
                        timer: 2000,
                        timerProgressBar: true,
                        showConfirmButton: false
                    });
                    this.toogleProfInfo();
                }).catch((e)=>{
                    console.log(e);
                });
        },

        destroyUserCred(){
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
                    axios.delete('/user/assistant/profile/destroy')
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
    mounted(){
        this.displayProfile();
    }
}
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