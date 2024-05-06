<template>
    <div class="container-fluid">
        <div class="container">
            <div class="d-flex flex-column p-3 align-items-center">
                <div class="card p-2 w-100">
                    <div class="card-title">
                        <p class="fs-4 fw-semibold mb-1 ms-2">Personal Information</p>
                        <div class="d-flex align-items-center">
                            <div class="col col-lg-4 d-flex flex-column justify-content-center align-items-center">
                                <img src="../../../../../public/images/avatar.png" class="img-fluid rounded-5 opacity-75" aalt="photo-logo" />
                                <div class="active-btn d-flex">
                                    <button class="btn btn-info me-2 text-white">
                                        <i class="fa-solid fa-upload me-2"></i>
                                        <span>Upload</span>
                                    </button>
                                    <button class="btn btn-danger text-white">
                                        <i class="fa-solid fa-trash me-2"></i>
                                        <span>Delete</span>
                                    </button>
                                </div>
                            </div>
                            <div class="col col-lg-8">
                                <div class="d-flex mb-1">
                                    <div class=" w-100 me-2">
                                        <label for="" class="fw-medium fs-6 mb-1 text-black-50">Firstname</label>
                                        <input type="text" class="form-control" id="fname" placeholder="Enter your firstname">
                                    </div>
                                    <div class=" w-100 me-2">
                                        <label for="" class="fw-medium fs-6 mb-1 text-black-50">Lastname</label>
                                        <input type="text" class="form-control" id="lname" placeholder="Enter your lastname">
                                    </div>
                                    <div class=" w-100">
                                        <label for="" class="fw-medium fs-6 mb-1 text-black-50">Middle Initial</label>
                                        <input type="text" class="form-control" id="mInitial" placeholder="Optional">
                                    </div>
                                </div>
                                <div class="d-flex mb-4">
                                    <div class=" w-100 me-2">
                                        <label for="" class="fw-medium fs-6 mb-1 text-black-50">Age</label>
                                        <input type="text" class="form-control" id="age" placeholder="Enter your age">
                                    </div>
                                    <div class=" w-100 me-2">
                                        <label for="" class="fw-medium fs-6 mb-1 text-black-50">Contact Number</label>
                                        <input type="text" class="form-control" id="cNumber" placeholder="09123456789">
                                    </div>
                                    <div class=" w-100">
                                        <label for="" class="fw-medium fs-6 mb-1 text-black-50">Email Address</label>
                                        <input type="email" class="form-control" id="email" placeholder="Enter your email">
                                    </div>
                                </div>
                                <div class="active-btn d-flex justify-content-end">
                                    <button class="btn btn-info me-2 text-white">
                                        <i class="fa-solid fa-pen-to-square me-2"></i>
                                        <span>Edit</span>
                                    </button>
                                    <button class="btn btn-success text-white">
                                        <i class="fa-solid fa-check me-2"></i>
                                        <span>Done</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                    <div class="col p-0">
                        <div class="card p-2 ">
                            <p class="fs-5 fw-semibold mb-2 ms-1">Change Password</p>
                            <div class="d-flex mb-1">
                                <div class=" w-100 me-2">
                                    <label for="" class="fw-medium fs-6 mb-1 text-black-50">Current Password</label>
                                    <input type="password" class="form-control" id="password" placeholder="Old Password">
                                </div>
                                <div class=" w-100 me-2">
                                    <label for="" class="fw-medium fs-6 mb-1 text-black-50">New Password</label>
                                    <input type="password" class="form-control" id="new_password" placeholder="New Password">
                                </div>
                            </div>
                            <div class=" w-100 mb-3">
                                <label for="" class="fw-medium fs-6 mb-1 text-black-50">Confirm Password</label>
                                <input type="password" class="form-control" id="password_confirmation" placeholder="Confirm your Password">
                            </div>
                            <div class="active-btn d-flex justify-content-end">
                                <button class="btn btn-info me-2 text-white">
                                    <i class="fa-solid fa-lock me-2"></i>
                                    <span>Change Password</span>
                                </button>
                                <button class="btn btn-success text-white">
                                    <i class="fa-solid fa-check me-2"></i>
                                    <span>Done</span>
                                </button>
                            </div>
                        </div>
                    </div>
                <div class="col p-0">
                        <div class="card p-2 ">
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
</template>

<script>
export default {
    setup () {
        

        return {}
    }
}
</script>

<style scope>

</style>