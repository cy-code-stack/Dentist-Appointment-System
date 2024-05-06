<template>
        <div class="modal fade" id="book-appointment-modal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="container">
                            <p class="fs-5 fw-medium">Booking Summary</p>
                            <div class="company-serv card w-100 mb-2 d-flex align-items-between justify-content-between">
                                <div class="row p-2 d-flex align-items-center justify-content-between">
                                    <div class="col">
                                        <i class="las la-user-cog fs-2"><span class="fs-6 fw-medium ms-2">Sample Services</span></i>
                                    </div>
                                    <div class="col ">
                                        <i class="las la-user-nurse fs-2"><span class="fs-6 fw-medium ms-2">Doctor Name</span></i>
                                    </div>
                                </div>
                            </div>

                            <div class="company-serv card w-100 mb-3 d-flex align-items-between justify-content-between">
                                <div class="row p-2 d-flex align-items-center justify-content-between">
                                    <div class="col">
                                        <i class="las la-calendar-alt fs-2"><span class="fs-6 fw-medium ms-2">05/01/24</span></i>
                                    </div>
                                    <div class="col ">
                                        <i class="las la-business-time fs-2"><span class="fs-6 fw-medium ms-2">8:30 AM - 9:30 AM</span></i>
                                    </div>
                                </div>
                            </div>

                            <div class="company-serv card w-100 mb-3 d-flex align-items-between justify-content-between p-4">
                                <p class="fw-medium">Please enter your details</p>
                                    <div class="form-group mb-1">
                                        <label class="form-label mb-1">Firstname <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="Enter your firstname">
                                    </div>
                                    <div class="form-group mb-1">
                                        <label class="form-label mb-1">Lastname <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="Enter your lastname">
                                    </div>
                                    <div class="form-group mb-1">
                                        <label class="form-label mb-1">Home Address </label>
                                        <input type="text" class="form-control" placeholder="Complete Home Address">
                                    </div>
                                    <div class="form-group mb-1">
                                        <label class="form-label mb-1">Email <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" placeholder="youremail@gmail.com">
                                    </div>
                                    <div class="form-group mb-1">
                                        <label class="form-label mb-1">Cellphone Number <span class="text-danger">*</span></label>
                                        <input type="tel" class="form-control" placeholder="09123456789">
                                    </div>
                            </div>

                            <div class="active-btn">
                                <button type="submit" class="btn btn-info text-white btn-md-1 w-100">Confirm Appointment</button>
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
export default {
    data() {
        return {};
    },
    methods: {},
    mounted() {
        // console.log("Component loaded");
    },
};
</script>
